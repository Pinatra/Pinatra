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
    var_dump(file_get_contents('http://127.0.0.1:50000/'));
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/'), 'GET /');
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/?slash=true'), 'GET /');
  }

  public function testSimpleGET()
  {
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/foo'), 'GET /foo');
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/foo?slash=true'), 'GET /foo');
  }

  public function testPOST()
  {
    $opts = array('http' => [
      'method'  => 'POST'
    ]);
    $context  = stream_context_create($opts);

    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/', false, $context), 'POST /');
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/?slash=true', false, $context), 'POST /');
  }

  public function testPUT()
  {
    $opts = array('http' => [
      'method'  => 'PUT'
    ]);
    $context  = stream_context_create($opts);

    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/', false, $context), 'PUT /');
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/?slash=true', false, $context), 'PUT /');
  }

  public function testPATCH()
  {
    $opts = array('http' => [
      'method'  => 'PATCH'
    ]);
    $context  = stream_context_create($opts);

    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/', false, $context), 'PATCH /');
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/?slash=true', false, $context), 'PATCH /');
  }

  public function testDELETE()
  {
    $opts = array('http' => [
      'method'  => 'DELETE'
    ]);
    $context  = stream_context_create($opts);

    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/', false, $context), 'DELETE /');
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/?slash=true', false, $context), 'DELETE /');
  }

  public function testOPTIONS()
  {
    $opts = array('http' => [
      'method'  => 'OPTIONS'
    ]);
    $context  = stream_context_create($opts);

    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/', false, $context), 'OPTIONS /');
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/?slash=true', false, $context), 'OPTIONS /');
  }

  public function testHEAD()
  {
    $opts = array('http' => [
      'method'  => 'HEAD'
    ]);
    $context  = stream_context_create($opts);
    
    file_get_contents('http://127.0.0.1:50000/', false, $context);
    $this->assertTrue(in_array('custom-header: hello Pinatra!', $http_response_header));
    
    file_get_contents('http://127.0.0.1:50000/?slash=true', false, $context);
    $this->assertTrue(in_array('custom-header: hello Pinatra!', $http_response_header));
  }
}