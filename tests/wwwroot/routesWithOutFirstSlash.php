<?php

// ========================
//    for routing tests
// ========================
get('', function() {
  echo "GET /";
});

get('foo', function() {
  echo "GET /foo";
});

get('foo/{a}', function($a) {
  echo "GET /foo/".$a;
});
get('bar/{a}', function($a, $b) {
  echo "GET /bar/".$a.'/'.($b ?? 'NULL');
});
get('one/{a}', 'HomeController@one');
get('two/{a}', 'HomeController@two');
get('two/{a}/{b}', 'HomeController@two');

post('', function() {
  echo "POST /";
});

put('', function() {
  echo "PUT /";
});

patch('', function() {
  echo "PATCH /";
});

delete('', function() {
  echo "DELETE /";
});

options('', function() {
  echo "OPTIONS /";
});

headMethod('', function() {
  header('custom-header: hello Pinatra!');
});

// ========================
//    for view tests
// ========================
get('view/simple', function() {
  return view('testView');
});
get('view/with-data/{a}/{b}/{c}', function($a, $b, $c) {
  return view('testView')->with('a', $a)
                         ->withB($b)
                         ->withSnakeVar($c);
});