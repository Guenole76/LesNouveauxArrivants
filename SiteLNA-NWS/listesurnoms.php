<?php
$chainev = "aeiouy";
$nb_charsv = strlen($chainev);
$chainemajuc = "BCDFGHJKLMNPQRSTVWXZ";
$nb_charsmajuc = strlen($chainemajuc);
$chaineminc = "bcdfghjklmnpqrstvwxz";
$nb_charsminc = strlen($chaineminc);
$n = 0;
$j = 0;
for($i=0; $i<$nb_charsmajuc; $i++)
{
	for($j=0; $j<$nb_charsv ; $j++)
	{
	$str[$n] = $chainemajuc[$i];
	$str[$n] .= $chainev[$j];
	$str[$n] .= $chaineminc[$i];
	$str[$n] .= $chainev[$j];
	$n++;
	}
}
$str2 = '<option value="">Liste de surnoms</option>';
var_dump($n);
for($i=0; $i<$n; $i++)
{
	$str2 .= '<option value="'.$str[$i].'">'.$str[$i].'</option>';
}
var_dump($str2);
echo $str2;
?>