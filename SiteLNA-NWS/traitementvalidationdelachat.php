<?php 
session_start();
if(isset($_SESSION['choixa']))
{
	$_SESSION['validation'] = 1;
	header('Location: validationdelachat.php');
}else
{
	header('Location: abonnement.php');
}
?>