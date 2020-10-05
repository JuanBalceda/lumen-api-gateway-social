<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use phpseclib\Crypt\Random;

class SocialAuthController extends Controller
{

    use ApiResponse;

    public function __construct()
    {
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $social_user = Socialite::driver($provider)->stateless()->user();

        if ($user = User::where('email', $social_user->email)->first()) {
            return $this->generateAccessToken($provider, $user);
        } else {
            $user = User::create([
                'name' => $social_user->name,
                'email' => $social_user->email,
                'password' => Hash::make(Random::string(32))
            ]);
            return $this->generateAccessToken($provider, $user);
        }
    }

    public function generateAccessToken($provider, $user)
    {
        $data['access_token'] = $user->createToken($provider)->accessToken;

        return $this->validResponse($data);
    }
}
