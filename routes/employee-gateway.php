<?php

const route = "EmployeeController@";
const routeLink = "/employees";

$router->group(['prefix' => '/api'], function () use ($router) {
  // Version 1
  $router->group(['prefix' => '/v1'.routeLink], function () use ($router) {
    //Employee routes
    $router->get("/index", route."index");
    $router->get("/find/{id}", route."find");
    $router->post("/store", route."store");
    $router->post("/update", route."update");
    $router->delete("/delete", route."delete"); 
  });

  // Version 2
  $router->group(['prefix' => '/v2'.routeLink], function () use ($router) {
    //Employee routes
    $router->get("/index", route."index");
    $router->get("/find/{id}", route."find");
    $router->post("/store", route."store");
    $router->post("/update", route."update");
    $router->delete("/delete", route."delete"); 
  });
  
});