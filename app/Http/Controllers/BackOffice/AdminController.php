<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\CustomLog;
use App\Models\Admin;
use App\Notifications\LoginCredentialsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backoffice.pages.handle_admin_accounts');
    }

    public function fetch_resource()
    {
        $datas =  [];
        foreach (Admin::all() as $admin) {
            $datas[] =  $admin->toArray();
        }
        return response()->json(['data' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|unique:admins,email',
            'name' => 'required|string|unique:admins,name',
        ]);
        $password = Str::random(12);

        $credentials = $request->only(['email', 'name']);
        $credentials['password'] = Hash::make($password);

        $newest = Admin::create($credentials);

        if ($newest) {
            $newest->notify(new LoginCredentialsNotification($request->input('email'), $password, 'admin'));

            // Récupérer l'admin qui a effectué la modification
            $adminName = Admin::findOrFail($request->cookie('admin_id'))->name;

            // Création du log personnalisé avec l'auteur de la modification (admin)
            CustomLog::create([
                'content' => "L'admin {$adminName} a créé un nouveau compte Admin : {$newest->name}.",
                'color' => 'success', // couleur de la notification
                'icon' => 'fas fa-user-plus', // icône pour la notification
            ]);


            return response()->json(['message' => 'Un nouvel administrateur a été créé avec succès.'], 200);
        } else {

            return response()->json(['errors' => ['general' => ['Une erreur est survenue']]], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin_account)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('admins', 'name')->ignore($admin_account->id),
            ],
            'suspended' => 'nullable|string|in:true,false'
        ]);

        if ($admin_account->update($request->only(['name', 'email']))) {

            $admin_account->suspended = $request->input('suspended') == 'true' ? 1 : 0;
            $admin_account->save();

            // Récupérer l'admin qui a effectué la modification
            $adminName = Admin::findOrFail($request->cookie('admin_id'))->name;

            // Création du log personnalisé avec l'auteur de la modification (admin)
            CustomLog::create([
                'content' => "L'admin {$adminName} a modifié les informations du compte Admin : {$admin_account->name}.",
                'color' => 'warning', // couleur de la notification
                'icon' => 'fas fa-user-edit', // icône pour la notification
            ]);

            return response()->json([
                'message' => 'Les informations ont été mises à jour avec succès',
            ], 200);
        } else {

            return response()->json(['errors' => ['general' => ['Une erreur est survenue']]], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function suspense(Request $request)
    {
        $admin = Admin::findOrFail($request->input('id'));

        if ($request->cookie('admin_id') == $admin->id)
            return response('Vous ne pouvez pas suspendre votre propre compte.', 403);


        $admin->suspended = $request->input('suspended') == 'true' ? 1 : 0;
        $admin->save();


        // Récupérer l'admin qui a effectué la modification
        $adminName = Admin::findOrFail($request->cookie('admin_id'))->name;

        // Création du log personnalisé avec l'auteur de la modification (admin)
        CustomLog::create([
            'content' => "L'admin {$adminName} a " . ($admin->suspended ? 'suspendu' : 'réactivé') . " le compte Admin : {$admin->name}.",
            'color' => 'danger', // couleur de la notification
            'icon' => 'fas fa-user-slash', // icône pour la notification
        ]);


        return response()->json();
    }
}
