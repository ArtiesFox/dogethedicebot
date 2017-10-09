<?php
$greet = getenv('GREETING');
echo $greet;

if (isset($_GET['test'])) 
{
  $test = $_GET['test'];
}
else
{
  $test = "not found";
}

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
