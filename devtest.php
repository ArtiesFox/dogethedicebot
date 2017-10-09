<?php
$greet = getenv('GREETING');
echo $greet;

if (isset($_GET['test'])) 
{
  $test = $_GET['test'];
}
else
{
  $test = "not found<br>";
}

include "lib/helper.php";
echo "-- included<br>";

$dice = array("dice","ทอย","@d");
echo "-- array<br>";

if(contains($test, $dice))
{
  echo "true<br>";
}

echo "-- if<br>";

$names = file("knowledgebase/triggerword.txt");
echo count($names).'<br>';
foreach($names as $name)
{
   echo $name.'<br>';
}

if(startwithinarray($test, $names))
{
  echo "triggered!!<br>";
}
else
{
  echo "lemme sleep<br>";
}

echo $test;
?>
