<?php

namespace App\Services;
use Illuminate\Http\Request;


interface IEmployeeService extends IService { 
  public function getGroupByEmployeeId($id);  

}