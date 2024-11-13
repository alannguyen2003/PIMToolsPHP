<?php

namespace App\Services;

use App\Repositories\IRepository;

interface IProjectService extends IRepository {
  public function getGroupHandle($id);

  public function projectValidation($data);
}