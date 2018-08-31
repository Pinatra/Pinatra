<?php

use Pinatra\Routing\Router;

function get(...$params)
{
  Router::get(...$params);
}
function dispatch()
{
  Router::dispatch();
}

register_shutdown_function('dispatch');
