<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request)
    {
        $user = $request->user();

        if ($user && $user->usertype === 'admin') {
            return redirect()->intended(route('adminpanel.index'));
        }

        if ($user && $user->usertype === 'airline') {
            return redirect()->intended(route('adminpanel.index'));
        }

        return redirect()->intended(route('dashboard'));
    }
}
