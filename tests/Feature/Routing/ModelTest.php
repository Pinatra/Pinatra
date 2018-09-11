<?php

namespace Tests\Feature\Routing;

use Tests\BaseTestCase;

/**
 * Tests for all supported HTTP methods
 */
class ModelTest extends BaseTestCase
{
  public function testModel()
  {
    if (getenv('APP_MACHINE') == 'MAC') {
      $this->modelTest();
      $this->DBTest();
    } else {
      $this->assertTrue(true);
    }
  }
  public function modelTest()
  {
    $this->assertContains('Illuminate\Database\Eloquent\Collection Object', file_get_contents('http://127.0.0.1:50000/model'));
  }
  public function DBTest()
  {
    $this->assertContains('Illuminate\Support\Collection Object', file_get_contents('http://127.0.0.1:50000/db'));
  }
}