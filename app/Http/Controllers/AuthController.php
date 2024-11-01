<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\PartnerCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        // Assuming you have a StoreUserRequest for validation
        if (User::create($request->validated())) {
            return redirect()->intended('client.login');
        }
    }

    public function login(Request $request)
    {
        if ($request->has(['email', 'password'])) {
            if (Auth::attempt($request->only(['email', 'password']), $request->has(['remember']))) {
                return redirect()->intended('client.home');
            }
        }

        return redirect()->back()->withErrors(['general' => 'Identifiants incorrects']);
    }

    public function profile()
    {
        return view('new_client_site.pages.profile_page', [
            'categories' => PartnerCategory::all(),
            'orders' => auth()->user()->giftCards
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('client.home');
    }
}
