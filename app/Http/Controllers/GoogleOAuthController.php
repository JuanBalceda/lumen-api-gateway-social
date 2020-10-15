<?php

namespace App\Http\Controllers;

use App\Services\OAuthTokenService;
use App\Traits\ConsumeExternalService;
use Google_Client;
use Google_Service_Oauth2;
use Illuminate\Http\Request;

class GoogleOAuthController extends Controller
{
    use ConsumeExternalService;

    private $client;
    private $base_uri;
    private $redirect_uri;
    private $state_params;

    public $oAuthTokenService;

    public function __construct(OAuthTokenService $oAuthTokenService)
    {
        $this->oAuthTokenService = $oAuthTokenService;

        $this->base_uri = 'https://www.googleapis.com/oauth2/v3';

        $this->redirect_uri = config('services.google.redirect');
        $this->state_params = "{app_state=store}"; // For testing purposes

        $this->initGoogleClient();
    }

    private function initGoogleClient()
    {
        $client_secret = base_path('client_secret.json');

        $this->client = new Google_Client();
        $this->client->setAuthConfig($client_secret);
        $this->client->addScope('openid profile email');
        $this->client->setRedirectUri($this->redirect_uri);
        $this->client->setAccessType('offline');
        $this->client->setIncludeGrantedScopes(true);
        $this->client->setState($this->state_params);
    }

    public function redirectToProvider()
    {

        $auth_url = $this->client->createAuthUrl();
        return redirect($auth_url);
    }

    public function handleProviderCallback(Request $request)
    {
        $state = $request->query('state');
        $code = $request->query('code');

        $this->client->authenticate($code);

        $oauth2Service = new Google_Service_Oauth2($this->client);
        $user_data = $oauth2Service->userinfo->get();

        return $this->oAuthTokenService->getUserAccessToken('google', $user_data);
    }

}
