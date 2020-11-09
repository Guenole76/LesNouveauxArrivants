<?php
	if(isset($_SESSION['id_demandeur']))
	{
		if($_SESSION['id_demandeur'] == $_SESSION['id'])
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