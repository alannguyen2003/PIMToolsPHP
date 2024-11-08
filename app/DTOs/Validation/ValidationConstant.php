<?php

namespace App\DTOs\Validation;

class ValidationConstant {
  
  public static function isRequired() {
    return " is required!";
  }

  public static function lessThanExpectedCharacters($numberOfCharacters) {
    return " must be less than ".$numberOfCharacters." characters!";
  }

  public static function longerThanExpectedCharacters($numberOfCharacters) {
    return " must be longer than ".$numberOfCharacters." characters!";
  }
}