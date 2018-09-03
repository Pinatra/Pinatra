<?php


function startWebServer()
{
  $documentRoot = __DIR__.'/wwwroot';
  $output = [];
  exec('php -S 127.0.0.1:50000 -t '.$documentRoot.'>/dev/null 2>&1 & echo $!', $output);
  echo "PHP built-in webserver started!".PHP_EOL;
  sleep(1);
  $pid = (int) $output[0];
  register_shutdown_function(function() use ($pid) {
    echo sprintf('%s - Killing process with ID %d', date('r'), $pid) . PHP_EOL;
    exec('kill ' . $pid);
  });
}

startWebServer();