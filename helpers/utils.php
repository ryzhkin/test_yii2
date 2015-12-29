<?php

class Utils {
    public static function convertDate($date) {
      $parts = explode('/', $date);
      return $parts[2].'-'.$parts[1].'-'.$parts[0].' 00:00:00';
    }

}