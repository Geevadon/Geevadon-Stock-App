<?php

namespace App\Http\Controllers;

use App\Rules\PasswordExistsRule;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user ();

        return view ('profiles.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort (404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth ()->user ()->id != $id) {
            abort (404);
        }
        $user = User::findOrFail ($id);
        $users = User::all ();

        return view ('profiles.edit', compact('user', 'users'));
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
        request()->validate([
            'name' => ['required', 'string', 'unique:users,name,'.$id],
            'email' => ['required', 'email', 'unique:users,email,'.$id],
            'sex' => ['required', 'string', 'max:1', 'in:M,F'],
            'photo' => ['image', 'nullable'],
            'description' => ['string', 'min:5', 'nullable'],
        ], [
            'sex.max' => 'Veillez choisir un seul caractère (M ou F).',
            'email.unique' => 'Cette adresse email est déjà prise.',
            'name.unique' => 'Ce nom d\'utilisateur est déjà pris.',
            'sex.in' => 'Seuls les caractèes "F" et "M" sont acceptés.'
        ]);

        // On met a jour la photo de profil s'il l'utilisateur l'a souhaité
        if (request()->photo) {

            // On supprime d'abord l'ancienne image si elle est differente de l'image par defaut
            $userImage = auth ()->user ()->profile->photo;
            $oldImage = public_path('storage/'.auth ()->user ()->profile->photo);

            if ($userImage != 'avatars/default.png') {
                @unlink ($oldImage);
            }

            // On sauvegarde la nouvelle image dans le dossier concerné
            $realPath = request ()->photo->store ('avatars', 'public');

            // On redimentionne l'image à la bonne taille
            Image::make (public_path('storage/'.$realPath))
                    ->fit (250, 250)
                    ->save ();

            // On met a jour le chemin de l'image
            auth()->user ()->profile->update ([
                'photo' => $realPath
            ]);
        }

        // Mis a jour du reste des informations de l'utilisateur
        auth()->user ()->update ([
            'name' => request ()->name,
            'email' => auth ()->user ()->email == 'admin@admin.com' ? 'admin@admin.com' : request ()->email
        ]);

        auth()->user ()->profile->update ([
            'sex' => request ()->sex,
            'description' => request ()->description
        ]);

        set_message_flash ('Votre profil a été mis à jour avec succès !');

        return redirect()->route ('profile.index');
    }

    /**
     * Change user password.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        request ()->validate ([
            'old_password' => ['required', 'string', 'min:4', new PasswordExistsRule (auth ()->user ()->password)],
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ], [
            'password.confirmed' => 'Les deux mots de passe ne correspondent pas.'
        ]);

        // On met a jour le mot de passe s'il l'utilisateur l'a souhaité
        auth()->user ()->update ([
            'password' => Hash::make (request ()->password)
        ]);

        set_message_flash ('Mot de passe modifié avec succès !');

        return redirect()->route ('profile.edit', auth ()->user ()->id);

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
