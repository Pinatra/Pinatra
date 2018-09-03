<?php

namespace Tests\Feature\Routing;

use Tests\BaseTestCase;

/**
 * Tests for all supported HTTP methods
 */
class MethodsTest extends BaseTestCase
{
  public function testGET()
  {
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/'), 'GET /');
  }
}