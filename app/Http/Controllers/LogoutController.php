<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

final class LogoutController
{
    public function __invoke()
    {
        Auth::logout();

        return htmx()->redirect(route('login'))->response(null);
    }
}
