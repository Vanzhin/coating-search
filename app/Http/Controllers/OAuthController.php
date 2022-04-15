<?php

namespace App\Http\Controllers;

use App\Contracts\OAuth;
use App\Events\LoginEvent;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    /**
     * @param string $network
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect(string $network)
    {
        return Socialite::driver($network)->redirect();
    }

    public function callback(string $network, OAuth $service)
    {
        return redirect($service->setUser(
            Socialite::driver($network)->user(),
            $network
        ));


    }
}
