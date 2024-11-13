<?php 

const routeProject = "ProjectController@";
const routeProjectLink = "/projects";

$router->group(['prefix' => '/api'], function () use ($router) {
  // Version 1
  $router->group(['prefix' => '/v1'.routeProjectLink], function () use ($router) {
    //Employee routes
    $router->get("/index", routeProject."index");
    $router->get("/find/{id}", routeProject."findById");
    $router->post("/store", routeProject."store");
    $router->post("/update", routeProject."update");
    $router->delete("/delete/{id}", routeProject."delete"); 
  });

  // Version 2
  $router->group(['prefix' => '/v2'.routeProjectLink], function () use ($router) {
    //Employee routes
    $router->get("/index", routeProject."index");
    $router->get("/find/{id}", routeProject."find");
    $router->post("/store", routeProject."store");
    $router->post("/update", routeProject."update");
    $router->delete("/delete", routeProject."delete"); 
  });
  
});