<?php 
session_start();
include('mysql.php');
if(isset($_SESSION['id_demande']))
{
	if(isset($_POST['oui']))
	{
		$req_supprimer_demande = $bdd->prepare('UPDATE demande SET valeur_demande = ? WHERE id_demande = ?');
		$req_supprimer_demande->execute(array(2, $_SESSION['id_demande']));
		unset($_SESSION['id_demande']);
		header('Location: liste_demandes_personnelles.php');
	}else
	{
		header('Location: presentationdelademande.php');
	}
}else
{
	header('Location: liste_demandes_personnelles.php');
}
?>