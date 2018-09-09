<?php

namespace Pinatra\Model;

use Illuminate\Database\Capsule\Manager;

class Model extends \Illuminate\Database\Eloquent\Model
{
  public static $config = [];
  private static $fired = false;
  public function __construct()
  {
    if (!self::$fired) {
      $capsule = new Manager;
      $capsule->addConnection(self::$config);
      $capsule->setAsGlobal();
      $capsule->bootEloquent();
      self::$fired = true;
    }
  }
}