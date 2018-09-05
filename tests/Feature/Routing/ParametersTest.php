<?php

namespace Tests\Feature\Routing;

use Tests\BaseTestCase;

/**
 * Tests for :num
 */
class ParametersTest extends BaseTestCase
{
  public function testOneParameter()
  {
    $str1 = $this->generateRandomString();
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/foo/'.$str1), 'GET /foo/'.$str1);
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/foo/'.$str1.'?slash=true'), 'GET /foo/'.$str1);
  }
  public function testTwoParametersWhenRouterNeedOne()
  {
    $str1 = $this->generateRandomString();
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/foo/'.$str1), 'GET /foo/'.$str1);
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/foo/'.$str1.'?slash=true'), 'GET /foo/'.$str1);
  }
  public function testTwoParametersWhenRouterNeedOneAndFunctionNeedTwo()
  {
    $str1 = $this->generateRandomString();
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/bar/'.$str1), 'GET /bar/'.$str1.'/NULL');
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/bar/'.$str1.'?slash=true'), 'GET /bar/'.$str1.'/NULL');
  }

  public function testOneParameterWithController()
  {
    $str1 = $this->generateRandomString();
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/one/'.$str1), 'GET /one/'.$str1);
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/one/'.$str1.'?slash=true'), 'GET /one/'.$str1);
  }
  public function testTwoParametersWhenRouterNeedOneWithController()
  {
    $str1 = $this->generateRandomString();
    $str2 = $this->generateRandomString();
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/two/'.$str1.'/'.$str2), 'GET /two/'.$str1.'/'.$str2);
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/two/'.$str1.'/'.$str2.'?slash=true'), 'GET /two/'.$str1.'/'.$str2);
  }
  public function testTwoParametersWhenRouterNeedOneAndFunctionNeedTwoWithController()
  {
    $str1 = $this->generateRandomString();
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/two/'.$str1), 'GET /two/'.$str1.'/NULL');
    $this->assertEquals(file_get_contents('http://127.0.0.1:50000/two/'.$str1.'?slash=true'), 'GET /two/'.$str1.'/NULL');
  }
}