<?php

namespace App\Repositories;

interface IEmployeeRepository extends IRepository {
  public function getGroupOfEmployee($id);
}