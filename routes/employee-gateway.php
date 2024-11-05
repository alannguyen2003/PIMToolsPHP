<?php

$router->group(['prefix' => '/api/v1'], function () use ($router) {
  //Employee routes
  $router->get("/employees/index", "EmployeeController@index");
  $router->post("/employees/store", "EmployeeController@store");
  $router->post("/employees/update", "EmployeeController@update");
});