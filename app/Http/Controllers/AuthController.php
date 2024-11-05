<?php

namespace App\Http\Controllers;

use App\CustomHelpers;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Mail\VerifyEmail;
use App\Models\PartnerCategory;
use App\Models\User;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $newest = User::create($request->validated());
        if ($newest) {
            $receiver_email = $newest->email;
            Mail::to($receiver_email)->send(new VerifyEmail($receiver_email));

            return redirect()->intended(route('client.login_page'));
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to find the user by email
        $user = User::where('email', $credentials['email'])->first();

        // Check if user exists
        if (!$user) {
            return redirect()->back()->withErrors(['general' => 'Cette adresse mail n\'existe pas en base.']);
        }

        // Check if user is verified
        if (!$user->email_verified_at) {
            return redirect()->back()->withErrors(['general' => 'Veuillez valider votre compte.']);
        }

        // Attempt to authenticate and remember if requested
        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended(route('client.home'));
        }

        // Fallback for incorrect credentials
        return redirect()->back()->withErrors(['general' => 'Identifiants incorrects']);
    }


    public function profile()
    {
        $orders = auth()->user()->giftCards->load('paymentInfo');
        foreach ($orders as $order) {
            if (!in_array($order->paymentInfo->status, ['SUCCESSFUL', 'FAILED'])  && $order->paymentInfo->payment_network)
                CustomHelpers::getPaymentStatus($order->paymentInfo);
        }

        return view('new_client_site.pages.profile_page', [
            'categories' => PartnerCategory::all(),
            'orders' => $orders
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('client.home');
    }

    public function verify_email($token)
    {
        $email = self::getTokenEmail($token);
        $user = User::whereEmail($email)->firstOrFail();
        if (!$user->email_verified_at) {
            $user->email_verified_at = new DateTime();
            $user->save();
        }

        return !$user->password ?
            redirect()->route('client.change_password-page', ['origin_hashed' => $email])
            : redirect()->route('client.login');
    }

    public function change_password_page(string $origin_hashed): View
    {
        return view('auth.change_password', ['origin_hashed' => $origin_hashed]);
    }

    public function change_password(ChangePasswordRequest $request): RedirectResponse
    {
        $email = self::getTokenEmail($request->input('origin'));
        $user = User::whereEmail($email)->firstOrFail();
        $user->password = $request->input('password');
        $user->updated_at = new DateTime();
        $user->save();
        return redirect()->route('auth.password_changed');
    }


    static public function getTokenEmail(string $token): string
    {
        $decoded = decrypt($token);
        $email = explode('@@special-touch_amanda-saf@@', $decoded)[0];
        return $email;
    }
}
