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

$names = file("knowledgebase/triggerword.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
echo count($names).'<br>';
foreach($names as $name)
{
   echo "{$name} {strlen($name)}<br>";
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
