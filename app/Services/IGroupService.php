<?php 
namespace App\Services;

interface IGroupService {
  public function findAll();
  public function findById($id);
}