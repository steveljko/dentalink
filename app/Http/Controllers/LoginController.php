<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

final class LoginController
{
    public function __invoke(): View
    {
        return view('login');
    }

    public function handle(LoginRequest $request)
    {
        $creds = $request->only('username', 'password');

        if (Auth::attempt($creds)) {
            return htmx()->redirect(route('dashboard'))->response(null);
        }

        throw ValidationException::withMessages([
            'username' => 'Korisničko ime ili šifra nisu tačni, pokušajte ponovo.',
        ]);
    }
}
