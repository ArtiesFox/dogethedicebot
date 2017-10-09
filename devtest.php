<?php
$greet = getenv('GREETING');
echo $greet;
$test = $_GET['test']

include "lib/helper.php";
echo "-- included</br>";

$dice = array("dice","ทอย","@d");
echo "-- array</br>";

if(contains($test, $dice))
{
  echo "true";
}

echo "-- if</br>";

echo $test;
?>
