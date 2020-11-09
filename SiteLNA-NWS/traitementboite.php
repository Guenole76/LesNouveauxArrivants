<?php 
session_start();
include('mysql.php');
if(isset($_POST['plusun']))
{
	$nouvelleplace = $_POST['pmax'] + 1;
	$req = $bdd->prepare('UPDATE boite SET placemax = ? WHERE id_boite = ?');
	$req->execute(array($nouvelleplace, $_POST['id_boite']));
	header('Location: presentationdelasortie.php');
}elseif(isset($_POST['moinsun']))
{
	$nouvelleplace = $_POST['pmax'] - 1;
	$req = $bdd->prepare('UPDATE boite SET placemax = ? WHERE id_boite = ?');
	$req->execute(array($nouvelleplace, $_POST['id_boite']));
	header('Location: presentationdelasortie.php');
}elseif(isset($_POST['supprimer']))
{
	$req = $bdd->prepare('UPDATE boite SET valeur_boite = ? WHERE id_boite = ?');
	$req->execute(array(2, $_POST['id_boite']));
	header('Location: presentationdelasortie.php');
}elseif(isset($_POST['inscription']))
{
	$req = $bdd->prepare('SELECT id_inscrit, valeur_inscrit FROM inscrits_boite WHERE id_boite = ? AND id_inscrit = ?');
	$req->execute(array($_POST['id_boite'], $_SESSION['id']));
	$donnees = $req->fetch();
	if($donnees['id_inscrit'] == $_SESSION['id'])
	{
		if($donnees['valeur_inscrit'] == 1)
		{
			$req1 = $bdd->prepare('UPDATE inscrits_boite SET valeur_inscrit = ? WHERE id_boite = ? AND id_inscrit = ?');
			$req1->execute(array(2, $_POST['id_boite'], $_SESSION['id']));
			header('Location: presentationdelasortie.php');
		}else
		{
			$req1 = $bdd->prepare('UPDATE inscrits_boite SET valeur_inscrit = ? WHERE id_boite = ? AND id_inscrit = ?');
			$req1->execute(array(1, $_POST['id_boite'], $_SESSION['id']));
			header('Location: presentationdelasortie.php');
		}
	}else
	{
		$req = $bdd->prepare('INSERT INTO inscrits_boite (id_boite, id_inscrit, valeur_inscrit) VALUES (?, ?, ?)');
		$req->execute(array($_POST['id_boite'], $_SESSION['id'], 1));
		header('Location: presentationdelasortie.php');
	}
}elseif(isset($_POST['desinscription']))
{
	$req = $bdd->prepare('SELECT id_inscrit, valeur_inscrit FROM inscrits_boite WHERE id_boite = ? AND id_inscrit = ?');
	$req->execute(array($_POST['id_boite'], $_SESSION['id']));
	$donnees = $req->fetch();
	if($donnees['id_inscrit'] == $_SESSION['id'])
	{
			$req1 = $bdd->prepare('UPDATE inscrits_boite SET valeur_inscrit = ? WHERE id_boite = ? AND id_inscrit = ?');
			$req1->execute(array(2, $_POST['id_boite'], $_SESSION['id']));
			header('Location: presentationdelasortie.php');
	}else
	{
		header('Location: presentationdelasortie.php');
	}
}else
{
	header('Location: presentationdelasortie.php');
}