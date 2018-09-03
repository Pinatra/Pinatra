<?php

namespace Tests\Feature\Routing;

use Tests\BaseTestCase;

/**
 * Tests for :any
 */
class AnyTest extends BaseTestCase
{
  public function testGET()
  {
    $str = $this->generateRandomString();
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/'.$str), 'GET /:any '.$str);
  }
}