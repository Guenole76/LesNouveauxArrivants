<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=calm;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
date_default_timezone_set('UTC');
$utc = 1;
?>