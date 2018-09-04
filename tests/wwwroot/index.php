<?php

require dirname(dirname(dirname(__FILE__))).'/vendor/autoload.php';

define('VIEW_BASE_PATH', __DIR__.'/');

// ========================
//    for routing tests
// ========================
get('/', function() {
  echo "GET /";
});

post('/', function() {
  echo "POST /";
});

put('/', function() {
  echo "PUT /";
});

patch('/', function() {
  echo "PATCH /";
});

delete('/', function() {
  echo "DELETE /";
});

options('/', function() {
  echo "OPTIONS /";
});

head('/', function() {
  header('custom-header: hello Pinatra!');
});

get('/foo', function() {
  echo "GET /foo";
});

get('/:num', function($a) {
  echo "GET /:num ".$a;
});

get('/:any', function($a) {
  echo "GET /:any ".$a;
});

// ========================
//    for view tests
// ========================
get('/view/simple', function() {
  return view('testView');
});
get('/view/with-data/:any/:any/:any', function($a, $b, $c) {
  return view('testView')->with('a', $a)
                         ->withB($b)
                         ->withSnakeVar($c);
});


// ========================
//    :all test must be at last
// ========================
get('/:all', function($a = 100, $b = 10000) {
  echo "GET /:all ".$a.' '.$b;
});


if (getenv('APP_ENV') == 'testing') {
  register_shutdown_function('dispatch');
}
