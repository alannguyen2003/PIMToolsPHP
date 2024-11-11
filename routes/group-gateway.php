<?php 

const routeGroup = "GroupController@";
const routeLinkGroup = "/groups";

$router->group(['prefix' => '/api'], function () use ($router) {
  // Version 1
  $router->group(['prefix' => '/v1'.routeLinkGroup], function () use ($router) {
    //Employee routes
    $router->get("/index", ['middleware' => 'auth', routeGroup."index"]);
    $router->get("/find/{id}", routeGroup."findById");
    $router->post("/store", routeGroup."store");
    $router->post("/update", routeGroup."update");
    $router->delete("/delete/{id}", routeGroup."delete"); 
    $router->get("/get-group-leader/{id}", routeGroup."getGroupLeader"); 
  });

  // Version 2
  $router->group(['prefix' => '/v2'.routeLinkGroup], function () use ($router) {
    //Employee routes
    $router->get("/index", routeGroup."index");
    $router->get("/find/{id}", routeGroup."find");
    $router->post("/store", routeGroup."store");
    $router->post("/update", routeGroup."update");
    $router->delete("/delete", routeGroup."delete"); 
  });
  
});