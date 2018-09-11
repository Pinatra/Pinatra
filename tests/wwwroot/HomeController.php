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
  public function exception()
  {
    throw new Exception("On Pupose HaHa!", 1);
  }
  public function VIEW_BASE_PATH()
  {
    return view('a');
  }
  public function emptyViewName()
  {
    define('VIEW_BASE_PATH', VIEW_BASE_PATH_PREPARE);
    return view();
  }
}