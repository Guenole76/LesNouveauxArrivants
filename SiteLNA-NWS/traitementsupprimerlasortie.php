<?php 
session_start();
include('mysql.php');
if(isset($_SESSION['id_sortie']))
{
	if(isset($_POST['oui']))
	{
		$req_supprimer_sortie = $bdd->prepare('UPDATE sortie SET valeur_sortie = ? WHERE id_sortie = ?');
		$req_supprimer_sortie->execute(array(1, $_SESSION['id_sortie']));
		unset($_SESSION['id_sortie']);
		header('Location: profil.php');
	}else
	{
		header('Location: presentationdelasortie.php');
	}
}else
{
	header('Location: profil.php');
}
?>