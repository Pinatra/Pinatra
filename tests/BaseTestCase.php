<?php

namespace Tests;

abstract class BaseTestCase extends \PHPUnit\Framework\TestCase
{
  use PreparePinatraApplication;

  public function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  }
}
