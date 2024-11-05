<?php

const route = "EmployeeController@";

$router->group(['prefix' => '/api/v1/employees'], function () use ($router) {
  //Employee routes
  $router->get("/index", route."index");
  $router->get("/find/{id}", route."find");
  $router->post("/store", route."store");
  $router->post("/update", route."update");
  $router->delete("/delete", route."delete");
});