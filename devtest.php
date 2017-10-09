<?php
$greet = getenv('GREETING');
echo $greet;

include "lib/helper.php";
echo "-- included";

$dice = array("dice","ทอย","@d");
echo "-- array \r\n";

if(contains($test, $dice))
{
  echo "true";
}
echo "-- if";

echo $test;
?>
