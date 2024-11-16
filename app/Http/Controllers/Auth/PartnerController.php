<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PartnerController extends Controller
{

    public function login(): View
    {
        return view('partner_backoffice.pages.auth.login');
    }

    public function do_login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $instance = Partner::whereEmail($email)
            ->first();


        if ($instance && Hash::check($password, $instance->password)) {
            //if ($instance->suspended)
            //  return redirect()->back()->withErrors(['login' => 'Ce compte a été suspendu']);


            if (!$instance->first_login) {
                $instance->first_login = new DateTime();
                $instance->save();
            }

            /* if ($request->has('remember')) {
                $cookie = cookie('partner_id', $instance->id, 60 * 24 * 31); // cookie d'authentification
            } else { */
            $cookie = cookie('partner_id', $instance->id, 60 * 12); // cookie d'authentification
            //}

            return redirect()->intended(route('partner.panel.gift_card'))->withCookie($cookie);
        }

        return redirect()->back()->withErrors(['login' => 'Identifiants incorrects']);
    }

    public function logout(): RedirectResponse
    {
        $cookie = cookie('partner_id', 0, -1); // cookie d'authentification
        return redirect()->route('partner.auth.login_page')->withCookie($cookie);
    }
}
