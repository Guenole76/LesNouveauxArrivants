<?php 
	if(isset($_SESSION['id']))
	{
		if($_SESSION['id'] > 0)
		{
			$verification = "C'est bon";
		}else
		{
			$_SESSION['message156'] = "Vous pourrez profiter du site en vous connectant";
			header('Location: deconnexion.php');
		}
	}else
	{
		$_SESSION['message156'] = "Vous pourrez profiter du site en vous connectant";
		header('Location: deconnexion.php');
	}
?>