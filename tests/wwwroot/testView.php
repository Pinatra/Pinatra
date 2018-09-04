<?php

if (!isset($a)) {
  echo "no param";
}
echo $a ?? '';
echo $b ?? '';
echo $snake_var ?? '';