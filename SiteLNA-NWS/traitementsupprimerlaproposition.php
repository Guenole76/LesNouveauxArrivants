<?php 
session_start();
include('mysql.php');
if(isset($_SESSION['id_demande']))
{
	if(isset($_POST['oui']))
	{
		$req_supprimer_proposition = $bdd->prepare('UPDATE proposition SET valeur_proposition = ? WHERE id_proposition = ?');
		$req_supprimer_proposition->execute(array(2, $_SESSION['id_proposition']));
		unset($_SESSION['id_demande']);
		header('Location: liste_proposition_personnelles.php');
	}else
	{
		header('Location: presentationdelaproposition.php');
	}
}else
{
	header('Location: liste_propositions_personnelles.php');
}
?>