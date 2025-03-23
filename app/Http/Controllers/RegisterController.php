<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * @desc Show the form for creating a new resource.
     * @route GET /register
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * @desc Store a newly created resource in storage.
     * @route POST /register
     */
    public function store(Request $request)
    {
       // Valider les données User
       $userAttributes = $request->validate([
           'name' => ['required'],
           'email' => ['required', 'email', 'unique:users,email'],
           'password' => ['required', 'confirmed', Password::min(6)]
        ]);

       // Valider les données Employer
       $employerAttributes = $request->validate([
          'employer' => ['required'],
          'logo' => ['required', File::types( ['png', 'jpg', 'jpeg', 'svg', 'webp'])]
       ]);

       // Créer le user
       $user = User::create($userAttributes);

       // Stocker le logo dans un dossier "logos"
       $logoPath = $request->logo->store('logos');

       // Créer l'employer
       $user->employer()->create([
          'name' => $employerAttributes['employer'],
          'logo' => $logoPath,
       ]);

       // Login le user
       Auth::login($user);

       return redirect('/');
    }

}
