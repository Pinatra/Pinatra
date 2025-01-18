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
  public function two($a, $b = null)
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
    return view();
  }
}