<?php

namespace App\Http\Controllers;

use App\Services\OAuthTokenService;
use App\Traits\ApiResponse;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    use ApiResponse;

    public $oAuthTokenService;

    public function __construct(OAuthTokenService $oAuthTokenService)
    {
        $this->oAuthTokenService = $oAuthTokenService;
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user_data = Socialite::driver($provider)->stateless()->user();

        return $this->oAuthTokenService->getUserAccessToken('facebook', $user_data);
    }

    public function generateAccessToken($access_token, $user)
    {
        $data['user'] = $user;
        $data['access_token'] = $access_token;

        return $this->validResponse($data);
    }
}
