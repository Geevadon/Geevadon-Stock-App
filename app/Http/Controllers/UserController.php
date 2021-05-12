<?php

namespace App\Http\Controllers;

use App\Rules\CantDeleteAdmin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort (404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth ()->user ()->email != 'admin@admin.com') {
            return redirect()->route ('profile.edit', auth ()->user ()->id);
        }
        return view ('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request ()->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ],[
            'name.unique' => 'Ce nom d\'utilisateur est déjà utilisé.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'password.confirmed' => 'Les deux mots de passe ne correspondent pas.'
        ]);

        User::create ([
            'name' => request ()->name,
            'email' => request ()->email,
            'password' => Hash::make (request ()->password),
        ]);

        set_message_flash('Utilisateur crée avec succès !');

        return redirect()->route ('profile.edit', auth ()->user ()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort (404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_user()
    {
        request ()->validate([
            'user_id' => ['required', 'numeric', new CantDeleteAdmin]
        ]);

        // On supprime d'abord l'ancienne image si elle est differente de l'image par defaut
        $user = User::findOrFail (request ()->user_id);
        $userImage = $user->profile->photo;
        $oldImage = public_path('storage/'.$user->profile->photo);

        if ($userImage != 'avatars/default.png') {
            @unlink ($oldImage);
        }

        User::destroy (request ()->user_id);

        set_message_flash('Utilisateur supprimé avec succès !');

        return redirect()->route ('profile.edit', auth()->user ()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
