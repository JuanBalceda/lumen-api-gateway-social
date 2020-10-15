<?php

namespace App\Http\Controllers;

use App\Services\OAuthTokenService;
use App\Traits\ConsumeExternalService;
use Illuminate\Http\Request;

class FacebookOAuthController extends Controller
{

    use ConsumeExternalService;

    private $base_uri;
    private $app_id;
    private $secret;
    private $redirect_uri;
    private $state_param;

    public $oAuthTokenService;

    public function __construct(OAuthTokenService $oAuthTokenService)
    {
        $this->base_uri = 'https://graph.facebook.com/v8.0';

        $this->app_id = config('services.facebook.client_id');
        $this->secret = config('services.facebook.client_secret');
        $this->redirect_uri = config('services.facebook.redirect');

        $this->state_param = "{app_state=store}"; // For testing purposes

        $this->oAuthTokenService = $oAuthTokenService;
    }

    public function redirectToProvider()
    {
        $FACEBOOK_OAUTH_URI = "https://www.facebook.com/v8.0/dialog/oauth?client_id={$this->app_id}&redirect_uri={$this->redirect_uri}&state={$this->state_param}";
        return redirect($FACEBOOK_OAUTH_URI);
    }

    public function handleProviderCallback(Request $request)
    {
        $state = $request->query('state');
        $code = $request->query('code');

        $FACEBOOK_ACCESS_TOKEN_ENDPOINT = "/oauth/access_token?client_id={$this->app_id}&redirect_uri={$this->redirect_uri}&client_secret={$this->secret}&code={$code}";

        $access_token_response = $this->performRequest('GET', $FACEBOOK_ACCESS_TOKEN_ENDPOINT);
        $access_token = json_decode($access_token_response)->access_token;

        $FACEBOOK_USER_ENDPOINT = "/me?fields=name,email&access_token={$access_token}";
        $user_response = $this->performRequest('GET', $FACEBOOK_USER_ENDPOINT);

        $user_data = json_decode($user_response);

        return $this->oAuthTokenService->getUserAccessToken('facebook', $user_data);
    }

}
