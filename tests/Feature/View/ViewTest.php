<?php

namespace Tests\Feature\View;

use Tests\BaseTestCase;

/**
 * View tests
 */
class ViewTest extends BaseTestCase
{
  public function testSimpleView()
  {
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/view/simple'), 'no param');
  }
  // public function testViewWithParams()
  // {
  //   $str1 = $this->generateRandomString();
  //   $str2 = $this->generateRandomString();
  //   $str3 = $this->generateRandomString();
  //   $this->assertEquals(file_get_contents('http://127.0.0.1:50000/view/with-data/'.$str1.'/'.$str2.'/'.$str3), $str1.' '.$str2.' '.$str3);
  // }
}