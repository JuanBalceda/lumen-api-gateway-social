<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return view('index');  //$router->app->version();
});

$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->get('/users/me', 'UserController@me');

});

$router->group(['middleware' => 'client.credentials'], function () use ($router) {

    /**
     * Users routes
     */
    $router->get('/users', 'UserController@index');
    $router->post('/users', 'UserController@store');
    $router->get('/users/{idBook}', 'UserController@show');
    $router->put('/users/{idBook}', 'UserController@update');
    $router->patch('/users/{idBook}', 'UserController@update');
    $router->delete('/users/{idBook}', 'UserController@destroy');
});

/**
 * Socialite authentication
 */
$router->get('/auth/{provider}', 'SocialAuthController@redirectToProvider');
$router->get('/auth/{provider}/callback', 'SocialAuthController@handleProviderCallback');

/**
 * OAuth authentication
 */
$router->get('/oauth/facebook', 'FacebookOAuthController@redirectToProvider');
$router->get('/oauth/facebook/callback', 'FacebookOAuthController@handleProviderCallback');
$router->get('/oauth/google', 'GoogleOAuthController@redirectToProvider');
$router->get('/oauth/google/callback', 'GoogleOAuthController@handleProviderCallback');
