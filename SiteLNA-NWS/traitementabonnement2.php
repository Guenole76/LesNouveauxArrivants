<?php
session_start();
include('mysql.php');
if(isset($_SESSION['id']))
{
	if(isset($_POST['valider']))
	{
		$timestamp_actuel = time();
		$timestamp_mois_prec = $timestamp_actuel - 60*60*24*30;
		$timestamp_mois_suiv = $timestamp_actuel + 60*60*24*30;
		$req_abonnement = $bdd->prepare('SELECT timestamp_partage FROM duree_abonnement WHERE id_membre = ?');
		$req_abonnement->execute(array($_SESSION['id']));
		$donnees_changement = $req_abonnement->fetch();
		if($donnees_changement['timestamp_partage'] < $timestamp_mois_prec)
		{
			$req_changement_duree_t = $bdd->prepare('UPDATE duree_abonnement SET timestamp_partage = ? WHERE id_membre = ?');
			$req_changement_duree_t->execute(array($timestamp_mois_suiv, $_SESSION['id']));
			$req_changement = $bdd->prepare('UPDATE inscrits SET abonnement_en_cours = ? WHERE id = ?');
			$req_changement->execute(array('Partage', $_SESSION['id']));
			header('Location: informationspersonnelles.php');
		}else
		{
			$_SESSION['message'] == 105;
			header('Location: abonnement.php');	
		}
	}else
	{
		$_SESSION['message'] == 101;
		header('Location: abonnement.php');
	}
}else
{
	header('Location: abonnement.php');
}
?>