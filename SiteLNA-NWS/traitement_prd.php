<?php
session_start();
include('mysql.php');
if(isset($_POST['valider']))
{
	$_SESSION['id_inscrit'] = $_POST['id_inscrit'];
	header('Location: presentationprofil.php');
}elseif(isset($_POST['accepter']))
{
	$time = time();
	if(isset($_POST['id_inscrit']))
	{	
		$req1 = $bdd->prepare('SELECT id_relation FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req1->execute(array($_SESSION['id'], $_POST['id_inscrit']));
		$donnees1 = $req1->fetch();
		if(isset($donnees1['id_relation']))
		{
			$_SESSION['message1'] = "Vous êtes déjà en lien avec cette personne.";
			header('Location: propositions_de_symapthie.php');
		}else
		{	
			$req2 = $bdd->prepare('INSERT INTO relations (id_membre_1, id_membre_2, surnom3, validations3, points_de_relation, glacage, groupe_relationnel, protection, t_sympathie)
			VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$req2->execute(array($_SESSION['id'], $_POST['id_inscrit'], "", 2, 10, 1, 1, 2, $time));
			$req3 = $bdd->prepare('INSERT INTO relations (id_membre_1, id_membre_2, surnom3, validations3, points_de_relation, glacage, groupe_relationnel, protection, t_sympathie)
			VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$req3->execute(array($_POST['id_inscrit'], $_SESSION['id'], "", 2, 10, 1, 1, 2, $time));
			$req4 = $bdd->prepare('DELETE FROM sympathie WHERE id_membre_s = ? AND id_membre_d = ?');
			$req4->execute(array($_SESSION['id'], $_POST['id_inscrit']));
			$_SESSION['message1'] = "L'ajout sympathique est fait !";
			header('Location: propositions_de_sympathie.php');
		}	
	}else
	{
		$_SESSION['message1'] = "Un problèmes est survenu, veuillez nous contacter pour arranger les choses.";
		header('Location: propositions_de_sympathie.php');
	}
}elseif(isset($_POST['acceptertld']))
{
	$time = time();
	$req1 = $bdd->prepare('SELECT id_membre_d FROM sympathie WHERE id_membre_s = ? AND valeur_s = ?');
	$req1->execute(array($_SESSION['id'], 1));
	$donnees1 = $req1->fetch();
	if(isset($donnees1['id_membre_d']))
	{	
		do
		{
			$req2 = $bdd->prepare('SELECT id_relation FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
			$req2->execute(array($_SESSION['id'], $donnees1['id_membre_d']));
			$donnees2 = $req2->fetch();
			if(isset($donnees2['id_relation']))
			{
				$req3 = $bdd->prepare('DELETE FROM sympathie WHERE id_membre_s = ? AND id_membre_d = ?');
				$req3->execute(array($_SESSION['id'], $donnees1['id_membre_d']));
			}else
			{	
				$req4 = $bdd->prepare('INSERT INTO relations (id_membre_1, id_membre_2, surnom3, validations3, points_de_relation, glacage, groupe_relationnel, protection, t_sympathie)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
				$req4->execute(array($_SESSION['id'], $donnees1['id_membre_d'], "", 2, 10, 1, 1, 2, $time));
				$req5 = $bdd->prepare('INSERT INTO relations (id_membre_1, id_membre_2, surnom3, validations3, points_de_relation, glacage, groupe_relationnel, protection, t_sympathie)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
				$req5->execute(array($donnees1['id_membre_d'], $_SESSION['id'], "", 2, 10, 1, 1, 2, $time));
				$req6 = $bdd->prepare('DELETE FROM sympathie WHERE id_membre_s = ? AND id_membre_d = ?');
				$req6->execute(array($_SESSION['id'], $donnees1['id_membre_d']));
				$_SESSION['message1'] = "L'ajout sympathique est fait !";
			}
		}while($donnees1 = $req1->fetch());
		header('Location: propositions_de_sympathie.php');
	}else
	{
				header('Location: propositions_de_sympathie.php');
	}
}elseif(isset($_POST['reserve']))
{
	$req = $bdd->prepare('UPDATE sympathie SET valeur_s = ? WHERE id_membre_s = ? AND id_membre_d = ?');
	$req->execute(array(2, $_SESSION['id'], $_POST['id_inscrit']));
	header('Location: propositions_de_sympathie.php');
}elseif(isset($_POST['rejetertlr']))
{
	$req = $bdd->prepare('DELETE FROM sympathie WHERE id_membre_s = ? AND valeur_s = ?');
	$req->execute(array($_SESSION['id'], 2));
	header('Location: reserve_de_sympathie.php');
}elseif(isset($_POST['supprimer']))
{
	$req = $bdd->prepare('DELETE FROM sympathie WHERE id_membre_s = ? AND id_membre_d = ?');
	$req->execute(array($_SESSION['id'], $_POST['id_inscrit']));
	header('Location: propositions_de_sympathie.php');
}elseif(isset($_POST['retirer']))
{
	$req = $bdd->prepare('DELETE FROM sympathie WHERE id_membre_s = ? AND id_membre_d = ?');
	$req->execute(array($_POST['id_inscrit'], $_SESSION['id']));
	header('Location: vos_demandes_de_sympathie.php');
}elseif(isset($_POST['supprimertld']))
{
	$req = $bdd->prepare('DELETE FROM sympathie WHERE id_membre_d = ?');
	$req->execute(array($_SESSION['id']));
	header('Location: vos_demandes_de_sympathie.php');
}else
{
	header('Location: propositions_de_sympathie.php');
}
?>