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
    $this->assertContains('Illuminate\Database\Eloquent\Collection Object', file_get_contents('http://127.0.0.1:50000/model'));
  }
  public function testDB()
  {
    $this->assertContains('Illuminate\Support\Collection Object', file_get_contents('http://127.0.0.1:50000/db'));
  }
}