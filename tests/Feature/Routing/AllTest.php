<?php

namespace Tests\Feature\Routing;

use Tests\BaseTestCase;

/**
 * Tests for :all
 */
class AllTest extends BaseTestCase
{
  public function testStrStrGET()
  {
    $str1 = $this->generateRandomString();
    $str2 = $this->generateRandomString();
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/'.$str1.'/'.$str2), 'GET /:all '.$str1.' '.$str2);
  }
  public function testNumStrGET()
  {
    $str1 = mt_rand(0, 100000);
    $str2 = $this->generateRandomString();
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/'.$str1.'/'.$str2), 'GET /:all '.$str1.' '.$str2);
  }
  public function testStrNumGET()
  {
    $str1 = $this->generateRandomString();
    $str2 = mt_rand(0, 100000);
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/'.$str1.'/'.$str2), 'GET /:all '.$str1.' '.$str2);
  }
}