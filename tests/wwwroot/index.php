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


register_shutdown_function('dispatch');
