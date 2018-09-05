<?php

/**
 * HomeController
 */
class HomeController
{
  public function one($a)
  {
    echo 'GET /one/'.$a;
  }
  public function two($a, $b)
  {
    echo 'GET /two/'.$a.'/'.($b ?? 'NULL');
  }
}