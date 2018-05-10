<?php

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

$router->group(['prefix' => 'v1/'], function () use ($router) {

  $router->get('auth','Auth@generateToken');

  $router->group(['middleware' => 'auth'], function () use ($router) {

    $router->group(['prefix' => 'contact'], function () use ($router) {
      $router->get('','Contacts@get');
      $router->post('','Contacts@add');
      $router->put('{id:[0-9]+}','Contacts@update');
      $router->delete('{id:[0-9]+}','Contacts@delete');
    });
    $router->group(['prefix' => 'document'], function () use ($router) {
      $router->get('','Documents@get');
      $router->post('','Documents@add');
      $router->put('{id:[0-9]+}','Documents@update');
      $router->delete('{id:[0-9]+}','Documents@delete');
    });
    $router->group(['prefix' => 'chain'], function () use ($router) {
      $router->get('','Chains@get');
      $router->post('','Chains@add');
      $router->delete('{id:[0-9]+}','Chains@delete');
      $router->get('{id:[0-9]+}/message','Chains@getMessage');
      $router->post('{id:[0-9]+}/message','Chains@addMessage');
      $router->get('sync','Chains@sync');
    });
    $router->group(['prefix' => 'event'], function () use ($router) {
      $router->get('','Events@get');
      $router->post('','Events@add');
      $router->put('{id:[0-9]+}','Events@update');
      $router->delete('{id:[0-9]+}','Events@delete');
    });

  });

});
