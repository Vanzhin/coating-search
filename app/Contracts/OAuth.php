<?php

namespace App\Contracts;

use Laravel\Socialite\Contracts\User;

interface OAuth
{
    /**
     * @param User $socialUser
     * @param string $network
     * @return string
     */
    public function setUser(User $socialUser, string $network) : string;

}
