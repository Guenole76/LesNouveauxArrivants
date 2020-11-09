<?php
session_start();
include('expression_r.php');
include('mysql.php');  
if(isset($_POST['sympathiser']))
{
	if(isset($_SESSION['id_inscrit']))
	{
		if($_SESSION['id'] !== $_SESSION['id_inscrit'])
		{
			$req_rel = $bdd->prepare('SELECT id_relation FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
			$req_rel->execute(array($_SESSION['id'], $_SESSION['id_inscrit']));
			$donnees_rel = $req_rel->fetch();
			if(isset($donnees_rel['id_relation']))
			{
				$_SESSION['message1'] = "Vous avez déjà une relation avec cette personne.";
				header('Location: presentationprofil.php');
			}else
			{
				$req_verif = $bdd->prepare('SELECT id_sympathie FROM sympathie WHERE id_membre_s = ?, id_membre_d = ?');
				$req_verif->execute(array($_SESSION['id_inscrit'], $_SESSION['id']));
				$donnees_verif = $req_verif->fetch();
				if(isset($donnees_verif['id_sympathie']))
				{	
					$_SESSION['message1'] = "Vous avez déjà une demande en cours.";
					header('Location: presentationprofil.php');
				}else
				{
					$req_ajt_code = $bdd->prepare('INSERT INTO sympathie (id_membre_s, id_membre_d, valeur_s) 
					VALUES(?, ?, ?)');
					$req_ajt_code->execute(array($_SESSION['id_inscrit'], $_SESSION['id'], 1));
					$_SESSION['message1'] = "La demande sympathique est faite !";
					header('Location: presentationprofil.php');
				}
			}
		}else
		{
			$_SESSION['message1'] = "Vous ne pouvez pas sympathiser avec vous-même.";
			header('Location: presentationprofil.php');
		}
	}else
	{
		$_SESSION['message1'] = "Il manque l'identifiant de la personne avec qui vous voulez sympathiser.";
		header('Location: presentationprofil.php');
	}
}else
{
	$_SESSION['message1'] = "Vous n'avez pas cliqué sur le bouton d'ajout.";
	header('Location: presentationprofil.php');
}
?>