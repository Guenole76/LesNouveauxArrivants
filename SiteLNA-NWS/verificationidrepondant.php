<?php
	if(isset($_SESSION['id_repondant']))
	{
		if($_SESSION['id_repondant'] == $_SESSION['id'])
		{
			$verification = "C'est bon";
		}else
		{
			header('Location: profil.php');
		}
	}else
	{
		header('Location: profil.php');
	}
?>