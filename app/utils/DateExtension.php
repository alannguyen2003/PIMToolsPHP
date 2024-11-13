<?php

namespace App\Utils;

class DateExtension {
  public static function getCurrentDate() {
    date_default_timezone_set("Asia/Bangkok");
    $date = date(time());
    return $date;
  }

  public static function getDateTimeByFormat($data) {
    return date('Y-m-d H:i:s', DateExtension::getCurrentDate());
  }
}