<?php 
session_start();
if(isset($_POST['valider']))
{
	if(isset($_POST['choixa']))
	{
		if($_POST['choixa'] == 1)
		{
			$_SESSION['choixa'] = $_POST['choixa'];
			$_SESSION['message'] = 0;
			header('Location: confirmationabonnement.php');
		}elseif($_POST['choixa'] == 2)
		{
			$_SESSION['choixa'] = $_POST['choixa'];
			$_SESSION['message'] = 0;
			header('Location: confirmationabonnement.php');
		}else
		{
			$_SESSION['message'] = 104;
			header('Location: abonnement.php');
		}
	}else
	{
		$_SESSION['message'] = 102;
		header('Location: abonnement.php');
	}
}else
{
	$_SESSION['message'] = 101;
	header('Location: abonnement.php');
}
?>