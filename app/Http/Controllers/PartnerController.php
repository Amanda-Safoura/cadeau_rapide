<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\GiftCard;
use App\Models\GiftCardShipping;
use App\Models\Partner;
use App\Models\PartnerCategory;
use App\Models\PaymentInfo;
use App\Models\Shipping;
use Feexpay\FeexpayPhp\FeexpayClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    public function index()
    {
        $categories = PartnerCategory::all();
        $partners = Partner::where('suspended', false)
            ->orderBy('name')
            ->paginate(20);
        $groupedPartners = $partners->groupBy(function ($partner) {
            return strtoupper(substr($partner->name, 0, 1));
        });

        return view('new_client_site.pages.partner_all', compact('categories', 'groupedPartners', 'partners'));
    }

    public function index_popularity_sorting()
    {
        $categories = PartnerCategory::all();
        $partners = Partner::where('suspended', false)
            ->withCount('giftCards')
            ->orderBy('gift_cards_count', 'desc')
            ->paginate(20);
        return view('new_client_site.pages.partner_all_popularity_sorting', compact('categories', 'partners'));
    }

    public function resultByLetter($letter)
    {
        $partners = Partner::where('suspended', false)
            ->where('name', 'like', "{$letter}%")
            ->paginate(9);
        $categories = PartnerCategory::all();

        return view('new_client_site.pages.partner_alphabetical_result', compact('partners', 'categories', 'letter'));
    }

    public function category(Request $request, $name)
    {
        $category = PartnerCategory::where('name', $name)->firstOrFail();

        if ($request->input('sortBy') !== 'popularity') $partners = Partner::where('suspended', false)
            ->where('category_id', $category->id)
            ->paginate(9);
        else $partners = Partner::where('suspended', false)
            ->withCount('giftCards')
            ->orderBy('gift_cards_count', 'desc')
            ->paginate(9);

        $categories = PartnerCategory::all();

        return view('new_client_site.pages.category', compact('partners', 'categories', 'category'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $partners = Partner::where('name', 'like', "%{$keyword}%")
            ->orWhere('tags', 'like', "%{$keyword}%")
            ->orWhereHas('category', function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->where('suspended', false)
            ->paginate(9);
        $categories = PartnerCategory::all();

        return view('new_client_site.pages.partner_search', compact('partners', 'categories', 'keyword'));
    }

    public function profile($slug)
    {
        $partner = Partner::where('suspended', false)
            ->where('slug', $slug)
            ->firstOrFail();
        $categories = PartnerCategory::all();

        return view('new_client_site.pages.partner_show', compact('partner', 'categories'));
    }

    public function orderingPage($slug)
    {
        $partner = Partner::where('slug', $slug)->firstOrFail();
        $categories = PartnerCategory::all();
        $shippings = Shipping::all();

        $settings = DB::table('gift_card_settings')->first();
        $customization_fee = $settings ? $settings->customization_fee : 0;

        return view('new_client_site.pages.ordering_page', compact('partner', 'categories', 'shippings', 'customization_fee'));
    }

    public function storeGiftCard(StoreOrderRequest $request)
    {
        $new_gift_card = null;
        $new_payment_info = null;
        if ($new_gift_card = GiftCard::create($request->only(
            'user_id',
            'amount',
            'personal_message',
            'client_name',
            'client_email',
            'client_phone',
            'is_client_beneficiary',
            'beneficiary_name',
            'beneficiary_email',
            'beneficiary_phone',
            'is_customized',
            'customization_fee',
            'requires_delivery',
            'delivery_address',
            'delivery_date',
            'validity_duration',
            'shipping_id',
            'partner_id',
            'total_amount',
        ))) {

            $infos_from_request = $request->only(
                'payment_phone',
                'payment_network',
                'payment_otp',
                'cardType',
                'firstNameCard,',
                'lastNameCard',
                'emailCard',
                'countryCard',
                'addressCard',
                'districtCard',
                'currency',
            );

            if ($new_payment_info = PaymentInfo::create(array_merge($infos_from_request, ['gift_card_id' => $new_gift_card->id]))) {
                $new_gift_card->payment_info_id = $new_payment_info->id;
                $new_gift_card->save();

                $partner = Partner::findOrFail($new_gift_card->partner_id);
                // Initialiser le SDK
                $skeleton = new FeexpayClass(env('FEEXPAY_SHOP_ID'), env('FEEXPAY_TOKEN_KEY_API'), route('client.partner.ordering_page', ['slug' => $partner->slug]), "LIVE", "");

                // Déterminer le mode de paiement
                $network = $new_payment_info->payment_network;
                $amount = $new_gift_card->amount;
                $phone = $new_payment_info->payment_phone;
                $otp = $new_payment_info->payment_network === 'ORANGE SN' ? $new_payment_info->payment_otp : '';

                // Traitement du paiement mobile
                if (in_array($network, ['MTN', 'MOOV', 'MOOV TG', 'TOGOCOM TG', 'ORANGE SN', 'MTN CI'])) {
                    $response = $skeleton->paiementLocal($amount, $phone, $network, $new_gift_card->client_name, $new_gift_card->client_email, '', '', $otp);

                    $new_payment_info->reference = $response;
                    $new_payment_info->save();

                    return redirect()->back()->with('message', 'Nous avons bien enregistré votre commande.');
                }
                // Traitement du paiement web
                elseif (in_array($network, ['FREE SN', 'ORANGE CI', 'MOOV CI', 'WAVE CI', 'MOOV BF', 'ORANGE BF'])) {
                    $response = $skeleton->requestToPayWeb($amount, $phone, $network, $new_gift_card->client_name, $new_gift_card->client_email, "cancel_url", "return_url");
                    $reference = $response["reference"];

                    $new_payment_info->reference = $reference;
                    $new_payment_info->save();

                    return redirect($response["payment_url"]);
                }
                // Traitement du paiement par carte bancaire
                elseif ($request->has('card_number')) {
                    $responseCard = $skeleton->paiementCard($amount, $phone, $new_payment_info->cardType, $new_payment_info->firstNameCard, $new_payment_info->lastNameCard,  $new_payment_info->emailCard, $new_payment_info->countryCard, $new_payment_info->addressCard, $new_payment_info->districtCard, $new_payment_info->currency, 'callback_info_url', '');
                    $redirectUrl = $responseCard["url"];

                    if (isset($redirectUrl)) {
                        return redirect()->to($redirectUrl);
                    }
                    return redirect()->back()->with('message', 'Erreur lors du traitement du paiement par carte.');
                }
                // Si aucun mode de paiement valide n'est trouvé
                else {
                    return redirect()->back()->with('message', 'Veuillez vérifier vos informations de paiement.');
                }
            }
        }

        return redirect()->back()->with('message', 'Erreur lors du traitement de la commande.');
    }
}
