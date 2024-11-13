<?php

namespace App\Repositories;

interface IProjectRepository extends IRepository {
    public function getGroupHandle($id);
    public function isExistProjectNumber($number);
}