<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * @desc Show the form for creating a new resource.
     * @route GET /login
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * @desc Store a newly created resource in storage.
     * @route POST /login
     */
    public function store(Request $request)
    {
       $attributes = request()->validate([
          'email' => ['required', 'email'],
          'password' => ['required'],
       ]);

       // Tenter de connecter le user
       if (! Auth::attempt($attributes)) {
          throw ValidationException::withMessages([
             'email' => 'Sorry, those credentials do not match.',
          ]);
       }

       // Regénérer le token de session
       request()->session()->regenerate();

       return redirect('/');
    }

    /**
     * @desc Remove the specified resource from storage.
     * @route DELETE /logout
     */
    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
