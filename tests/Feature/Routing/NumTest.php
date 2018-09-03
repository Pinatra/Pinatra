<?php

namespace Tests\Feature\Routing;

use Tests\BaseTestCase;

/**
 * Tests for :num
 */
class NumTest extends BaseTestCase
{
  public function testGET()
  {
    $num = mt_rand(0, 100000);
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/'.$num), 'GET /:num '.$num);
  }
}