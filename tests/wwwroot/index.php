<?php

require dirname(dirname(dirname(__FILE__))).'/vendor/autoload.php';

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

get('/:all', function($a = 100, $b = 10000) {
  echo "GET /:all ".$a.' '.$b;
});


if (getenv('APP_ENV') == 'testing') {
  register_shutdown_function('dispatch');
}

