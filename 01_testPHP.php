<?php

$a = 5;
$b = 10;

function test(&$a, $b)
{
	$a = $a - $b;
	echo "Toi dang o day";
	echo $a;
}
test($a, $b);
echo $a;



?>