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

$router->get('/login/{user}/{pass}', 'AuthController@login');

$router->group(['middleware'=>['auth']], function() use($router){
    $router->get('/usuario', 'UserController@index');
    $router->get('/usuario/{user}', 'UserController@get');
    $router->post('/usuario', 'UserController@create');
    $router->put('/usuario/{user}', 'UserController@update');
    $router->delete('/usuario/{user}', 'UserController@destroy');

    //$router->get('/topic', 'UserController@index');

    //Rutas Topics
    $router->get('/topicos', 'TopicController@index');
    $router->get('/topicos/{id}', 'TopicController@get');
    $router->post('/topicos', 'TopicController@create');
    $router->put('/topicos/{id}', 'TopicController@update');
    $router->delete('/topicos/{id}', 'TopicController@destroy');

     //Rutas Post
     $router->get('/posts', 'PostController@index');
     $router->get('/posts/{id}', 'PostController@get');
     $router->post('/posts', 'PostController@create');
     $router->put('/posts/{id}', 'PostController@update');
     $router->delete('/posts/{id}', 'PostController@destroy');
}
);