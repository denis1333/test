<?php

$mtrarray = [];
$helparray = [];

$i = 0;

while (count($mtrarray) != 30)
{
	array_push($mtrarray, []);
	for ($j = 0 ; $j < 3 ; $j++)
	{
		array_push($mtrarray[$i], [[],[],[]]);
	}
	$i++;
}

while (count($helparray) != 30)
	{	
		$str = '0123456789';
		$str = str_shuffle($str);
		array_push($helparray, $str);
	}

for ($i = 0 ; $i < count($mtrarray) ; $i++)
{
	$mtrarray[$i][0][0] = $helparray[$i][0];
	$mtrarray[$i][0][1] = $helparray[$i][1];
	$mtrarray[$i][0][2] = $helparray[$i][2];
	$mtrarray[$i][1][0] = $helparray[$i][3];
	$mtrarray[$i][1][1] = $helparray[$i][4];
	$mtrarray[$i][1][2] = $helparray[$i][5];
	$mtrarray[$i][2][0] = $helparray[$i][6];
	$mtrarray[$i][2][1] = $helparray[$i][7];
	$mtrarray[$i][2][2] = $helparray[$i][8];
}

$sum = [];

for ($i = 0 ; $i < count($mtrarray) ; $i++)
{
	for ($j = 0 ; $j < count($mtrarray[$i]) ; $j++)
	{
		array_push($sum, $mtrarray[$i][$j][0] + $mtrarray[$i][$j][1] + $mtrarray[$i][$j][2]);
	}
}

$unicsum = array_unique($sum);
$strUnicSum = implode(',', $unicsum);
print_r($strUnicSum);
echo "<p> Уникальных сумм ";
print_r(count($unicsum));
echo "</p>";
?>