<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Models\Partner;
use App\Models\PartnerCategory;
use App\Notifications\LoginCredentialsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partner_categories = PartnerCategory::all();
        return view('backoffice.pages.partner.index', compact('partner_categories'));
    }

    public function fetch_resource()
    {
        $datas =  [];
        foreach (Partner::all() as $partner) {
            $partner = $partner->toArray();
            $partner['picture_1'] = Storage::disk('public')->url($partner['picture_1']);

            $partner['page_link'] = route('client.partner.show', ['slug' => $partner['slug']]);
            $datas[] = $partner;
        }
        return response()->json(['data' => $datas]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backoffice.pages.partner.create', ['partner_categories' => PartnerCategory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerRequest $request)
    {
        $validated_inputs = $request->validationData();
        $validated_inputs['offers'] = $request->input('offers');

        $validated_inputs['picture_1'] = '';
        $validated_inputs['picture_2'] = '';
        $validated_inputs['picture_3'] = '';
        $validated_inputs['picture_4'] = '';


        if ($request->hasFile('picture_4') && !$request->file('picture_4')->getError()) {
            $picture_4_file = $request->file('picture_4');
            $validated_inputs['picture_4'] = $picture_4_file->store('Partners') ?? '';
        }

        if ($request->hasFile('picture_3') && !$request->file('picture_3')->getError()) {
            $picture_3_file = $request->file('picture_3');
            $validated_inputs['picture_3'] = $picture_3_file->store('Partners') ?? '';
        }

        if ($request->hasFile('picture_2') && !$request->file('picture_2')->getError()) {
            $picture_2_file = $request->file('picture_2');
            $validated_inputs['picture_2'] = $picture_2_file->store('Partners') ?? '';
        }

        if ($request->hasFile('picture_1') && !$request->file('picture_1')->getError()) {
            $picture_1_file = $request->file('picture_1');
            $validated_inputs['picture_1'] = $picture_1_file->store('Partners') ?? '';
        }

        $password = $validated_inputs['password'];
        $newest = Partner::create($validated_inputs);
        if ($newest) {
            $newest->notify(new LoginCredentialsNotification($validated_inputs['email'], $password, 'partner'));
            return response()->json(['message' => 'Partenaire créé avec succès'], 200);
        } else {
            foreach ([$validated_inputs['picture_4'] ?? '', $validated_inputs['picture_3'] ?? '', $validated_inputs['picture_2'] ?? '', $validated_inputs['picture_1'] ?? ''] as $file_path) {
                $uploaded_file_path = public_path($file_path);
                if (File::exists($uploaded_file_path)) {
                    File::delete($uploaded_file_path);
                }
            }

            return response()->json(['errors' => ['general' => ['Une erreur est survenue']]], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        $validated_inputs = $request->validated();
        $validated_inputs['offers'] = $request->input('offers');

        $picture_1_old_file_path = '';
        $picture_2_old_file_path = '';
        $picture_3_old_file_path = '';
        $picture_4_old_file_path = '';
        $validated_inputs['picture_1'] = $partner->picture_1;
        $validated_inputs['picture_2'] = $partner->picture_2;
        $validated_inputs['picture_3'] = $partner->picture_3;
        $validated_inputs['picture_4'] = $partner->picture_4;

        if ($request->hasFile('picture_1')) {
            $picture_1_old_file_path = public_path($partner->picture_1);

            $picture_1_file = $request->file('picture_1');
            $validated_inputs['picture_1'] =
                $picture_1_file->store('Partners')
                ?? $validated_inputs['picture_1'];
        }

        if ($request->hasFile('picture_2')) {
            $picture_2_old_file_path = public_path($partner->picture_2);

            $picture_2_file = $request->file('picture_2');
            $validated_inputs['picture_2'] =
                $picture_2_file->store('Partners')
                ?? $validated_inputs['picture_2'];
        }


        if ($request->hasFile('picture_3')) {
            $picture_3_old_file_path = public_path($partner->picture_3);

            $picture_3_file = $request->file('picture_3');
            $validated_inputs['picture_3'] =
                $picture_3_file->store('Partners')
                ?? $validated_inputs['picture_3'];
        }

        if ($request->hasFile('picture_4')) {
            $picture_4_old_file_path = public_path($partner->picture_4);

            $picture_4_file = $request->file('picture_4');
            $validated_inputs['picture_4'] =
                $picture_4_file->store('Partners')
                ?? $validated_inputs['picture_4'];
        }


        if ($partner->update($validated_inputs)) {
            if ($request->hasFile('picture_4') && File::exists($picture_4_old_file_path))
                File::delete($picture_4_old_file_path);

            if ($request->hasFile('picture_3') && File::exists($picture_1_old_file_path))
                File::delete($picture_3_old_file_path);


            if ($request->hasFile('picture_2') && File::exists($picture_2_old_file_path))
                File::delete($picture_2_old_file_path);

            if ($request->hasFile('picture_1') && File::exists($picture_1_old_file_path))
                File::delete($picture_1_old_file_path);


            return response()->json([
                'message' => 'Partenaire modifié avec succès',
            ], 200);
        } else {

            foreach ([$validated_inputs['picture_2'], $validated_inputs['picture_1']] as $file_path) {
                $uploaded_file_path = public_path($file_path);
                if (File::exists($uploaded_file_path)) {
                    File::delete($uploaded_file_path);
                }
            }
            return response()->json(['errors' => ['general' => ['Une erreur est survenue']]], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function suspense(Request $request)
    {
        $partner = Partner::findOrFail($request->input('id'));
        $partner->suspended = $request->input('suspended') == 'true' ? 1 : 0;
        $partner->save();

        return response()->json();
    }
}
