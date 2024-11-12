<?php 

const routeAuthenticate = "AuthenticationController@";
const routeLinkAuthenticate = "/authenticate";

$router->group(['prefix' => '/api'], function () use ($router) {
  // Version 1
  $router->group(['prefix' => '/v1'.routeLinkAuthenticate], function () use ($router) {
    //Authentication routes
    $router->post("login", routeAuthenticate."login");
    $router->post("register", routeAuthenticate."register");
    $router->get("get-profile", ['middleware' => 'auth', 'uses' => routeAuthenticate."getProfile"]);
    // $router->get("get-profile", routeAuthenticate."getProfile");

  });

  // Version 2
  $router->group(['prefix' => '/v2'.routeLinkAuthenticate], function () use ($router) {
    //Authentication routes routes
    $router->post("login", routeAuthenticate."login");
    $router->get("get-profile", ['middleware' => 'auth', 'uses' => routeAuthenticate."getProfile"]);
  });
  
});