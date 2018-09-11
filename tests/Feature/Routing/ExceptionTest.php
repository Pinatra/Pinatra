<?php

namespace Tests\Feature\Routing;

use Tests\BaseTestCase;

/**
 * Tests for all supported HTTP methods
 */
class ExceptionTest extends BaseTestCase
{
  public function testException()
  {
    $context = stream_context_create(array(
      'http' => array(
        'ignore_errors' => true
      )
    ));
    $result = file_get_contents('http://127.0.0.1:50000/exception', false, $context);
    $this->assertContains('Exception: On Pupose HaHa!', $result);
    $this->assertContains('Whoops! There was an error.', $result);
  }
  public function testViewExceptions()
  {
    $context = stream_context_create(array(
      'http' => array(
        'ignore_errors' => true
      )
    ));
    $result = file_get_contents('http://127.0.0.1:50000/exception/no-VIEW_BASE_PATH', false, $context);
    $this->assertContains('VIEW_BASE_PATH is undefined!', $result);
    $this->assertContains('Whoops! There was an error.', $result);

    $result = file_get_contents('http://127.0.0.1:50000/exception/empty-view-name', false, $context);
    $this->assertContains('View name can not be empty!', $result);
    $this->assertContains('Whoops! There was an error.', $result);
  }
}