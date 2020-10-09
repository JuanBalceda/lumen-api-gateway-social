<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use phpseclib\Crypt\Random;

class OAuthTokenService
{
    use ApiResponse;

    public function getUserAccessToken($provider, $user_data)
    {
        if ($user = User::where('email', $user_data->email)->first()) {

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
                'name' => $user_data->name,
                'email' => $user_data->email,
                'password' => Hash::make(Random::string(32))
            ]);

            $access_token = $user->createToken($provider)->accessToken;

            return $this->generateAccessToken($access_token, $user);
        }
    }

    private function generateAccessToken($access_token, $user)
    {
        $data['user'] = $user;
        $data['access_token'] = $access_token;

        return $this->validResponse($data);
    }
}
