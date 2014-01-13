<?php
$starttime = time();
class Foo  
{
    public $var = '3.1415962654';  
}
 
for ( $i = 0; $i <= 1000000; $i++ )  
{
    $a = new Foo;  
    $a->self = $a; 
	$var = $a->var;
	echo $i."==>".$var."\n";  
}
$endtime = time();

$consumetime = $endtime - $starttime;

echo "all consume time is:".$consumetime;

?>