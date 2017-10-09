<?php
$greet = getenv('GREETING');
echo $greet;

include "lib/helper.php";
$test = "";
$dice = array("dice","ทอย","@d");

if(contains($test, $dice))
{
  echo "true";
}

echo $test;
?>
