<?php
$greet = getenv('GREETING');
echo $greet;

include "lib/helper.php";
$dice = array("dice","ทอย","@d");

if(contains($test, $dice))
{
  echo "true";
}

echo $test;
?>
