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
    return $router->app->version();
});

$router->group(['middleware' => 'client.credentials'], function () use ($router) {

    /**
     * Authors routes
     */

    $router->get('/authors', 'AuthorController@index');
    $router->post('/authors', 'AuthorController@store');
    $router->get('/authors/{idAuthor}', 'AuthorController@show');
    $router->put('/authors/{idAuthor}', 'AuthorController@update');
    $router->patch('/authors/{idAuthor}', 'AuthorController@update');
    $router->delete('/authors/{idAuthor}', 'AuthorController@destroy');


    /**
     * Books routes
     */

    $router->get('/books', 'BookController@index');
    $router->post('/books', 'BookController@store');
    $router->get('/books/{idBook}', 'BookController@show');
    $router->put('/books/{idBook}', 'BookController@update');
    $router->patch('/books/{idBook}', 'BookController@update');
    $router->delete('/books/{idBook}', 'BookController@destroy');
});

