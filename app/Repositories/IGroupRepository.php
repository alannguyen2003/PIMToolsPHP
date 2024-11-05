<?php 
namespace App\Repositories;

interface IGroupRepository {
  public function findAll();
  public function findById($id);
}