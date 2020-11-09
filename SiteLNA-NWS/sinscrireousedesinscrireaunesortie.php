<?php 
session_start();
include('mysql.php');
if(isset($_SESSION['id_sortie']))
{
	$req1 = $bdd->prepare('SELECT COUNT(id_membre) as nbr_participant_actuel FROM inscrits_sortie WHERE id_sortie = ?');
	$req1->execute(array($_SESSION['id_sortie']));
	$donnees1 = $req1->fetch();
	$req2 = $bdd->prepare('SELECT nbrparticipants FROM sortie WHERE id_sortie = ?');
	$req2->execute(array($_SESSION['id_sortie']));
	$donnees2 = $req2->fetch();
	$placesrestantes = $donnees2['nbrparticipants'] - $donnees1['nbr_participant_actuel'];
	if($placesrestantes > 0)
	{
		$req3 = $bdd->prepare('SELECT * FROM inscrits_sortie WHERE id_sortie = ? AND id_membre = ?');
		$req3->execute(array($_SESSION['id_sortie'], $_SESSION['id']));
		$donnees3 = $req3->fetch();
		do
		{
			if(!isset($donnees3['id_membre']))
			{
				$req4 = $bdd->prepare('INSERT INTO inscrits_sortie(id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES(?, ?, ?, ?)');
				$req4->execute(array($_SESSION['id_sortie'], $_SESSION['id'], 2, 1));
				header('Location: presentationdelasortie.php');
			}elseif($donnees3['valeur_membre'] == 2)
			{
				$req5 = $bdd->prepare('UPDATE inscrits_sortie SET valeur_membre = ? WHERE id_sortie = ? AND id_membre = ?');
				$req5->execute(array(1, $_SESSION['id_sortie'], $_SESSION['id']));
				header('Location: presentationdelasortie.php');
			}else
			{
				$req6 = $bdd->prepare('UPDATE inscrits_sortie SET valeur_membre = ? WHERE id_sortie = ? AND id_membre = ?');
				$req6->execute(array(2, $_SESSION['id_sortie'], $_SESSION['id']));
				header('Location: presentationdelasortie.php');
			}
		}while($donnees3 = $req3->fetch());
	}else
	{
		$req3 = $bdd->prepare('SELECT * FROM inscrits_sortie WHERE id_sortie = ? AND id_membre = ?');
		$req3->execute(array($_SESSION['id_sortie'], $_SESSION['id']));
		$donnees3 = $req3->fetch();
		if(!isset($donnees3['id_membre']))
		{
			$_SESSION['message157'] = "Il n'y a plus de place.";
			header('Location: presentationdelasortie.php');
		}elseif($donnees3['valeur_membre'] == 2)
		{
			$_SESSION['message157'] = "Il n'y a plus de place.";
			header('Location: presentationdelasortie.php');
		}else
		{
			$req6 = $bdd->prepare('UPDATE inscrits_sortie SET valeur_membre = ? WHERE id_sortie = ? AND id_membre = ?');
			$req6->execute(array(2, $_SESSION['id_sortie'], $_SESSION['id']));
			header('Location: presentationdelasortie.php');
		}
	}
}else
{
	header('Location: presentationdelasortie.php');
}
?>