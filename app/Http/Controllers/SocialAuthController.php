<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Carbon\Carbon;
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

            $oauth_access_token = $user->tokens()
                ->where('name', $provider)
                ->whereDate('expires_at', '>', Carbon::now())
                ->first();

            if (isset($oauth_access_token)) {
                $access_token = $oauth_access_token->id;
            } else {
                $access_token = $user->createToken($provider)->accessToken;
            }

            return $this->generateAccessToken($access_token, $user);
        } else {

            $user = User::create([
                'name' => $social_user->name,
                'email' => $social_user->email,
                'password' => Hash::make(Random::string(32))
            ]);

            $access_token = $user->createToken($provider)->accessToken;

            return $this->generateAccessToken($access_token, $user);
        }
    }

    public function generateAccessToken($access_token, $user)
    {
        $data['user'] = $user;
        $data['access_token'] = $access_token;

        return $this->validResponse($data);
    }
}
