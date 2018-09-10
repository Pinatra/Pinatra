<?php

namespace Pinatra\Model;

use Illuminate\Database\Capsule\Manager;

class DB extends Manager
{
  
  public static function table($table, $connection = NULL)
  {
    new Model;
    return parent::table($table, $connection);
  }
}