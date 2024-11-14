<?php 

namespace App\Constant;

class MessageConstant {
  //Success cases
  const GET_ALL = "Find all successfully!";
  const CREATED = "Create new entity successfully!";
  const DELETED = "Delete entity successfully!";
  const UPDATED = "Update entity successfully!";
  const FIND_SUCCESS = "Found entity successfully!";
  const SUCCESSFUL_AUTHENTICATION = "Login successful!!";
  
  //Error cases
  const NOT_FOUND = "Entity not found!";
  const BAD_REQUEST = "Bad Request!!";
  const UNAUTHORIZED = "Unauthorized!";
  const EXISTED = "New entity to add is existed!";
  const DELETED_FAILED = "Entity deleted failed!!";
  const FORBIDDEN = "You don't have permission to use this action!!";
}