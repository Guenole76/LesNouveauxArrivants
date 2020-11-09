<?php
session_start();
$code = $_GET['code'];
if(isset($_SESSION[$code]))
{
	if($_SESSION[$code] == 1)
	{
		$_SESSION[$code] = 2;
		$_SESSION['validation'] = 1;
		header('Location: confirmation2.php');
	}else
	{
		$_SESSION['message1000'] = "Mauvais code";
		header('Location: index.php');
	}
}else
{
	$_SESSION['message1001'] = "La session n'existe pas" ;
	header('Location: index.php');
}
?>