<?php 
session_start();
include('mysql.php');
$validation = 0;
$profil = 0;
if(isset($_POST['valider']))
{
	$_SESSION['id_inscrit'] = $_POST['id_membre'];
	$profil++;
}
if(isset($_POST['inviter']))
{
	$req1 = $bdd->prepare('SELECT valeur_membre FROM inscrits_sortie WHERE id_sortie = ? AND id_membre = ? AND valeur_membre BETWEEN 1 AND 2');
	$req1->execute(array($_SESSION['id_sortie'], $_POST['id_membre']));
	$donnees1 = $req1->fetch();
	if(!isset($donnees1['valeur_membre']))
	{
		$req2 = $bdd->prepare('INSERT INTO inscrits_sortie(id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES(?, ?, ?, ?)');
		$req2->execute(array($_SESSION['id_sortie'], $_POST['id_membre'], 2, 2));
	}else
	{
		$_SESSION['message151'] = "Cette personne fait déjà partie de vos invités ou inscrits.";
	}
	$validation++;
}
if(isset($_POST['retirer']))
{
	$req3 = $bdd->prepare('DELETE FROM inscrits_sortie WHERE id_sortie = ? AND id_membre = ? AND valeur_membre = ?');
	$req3->execute(array($_SESSION['id_sortie'], $_POST['id_membre'], 2));
	$validation++;
}
if(isset($_POST['co_orga1']))
{
	$req4 = $bdd->prepare('UPDATE inscrits_sortie SET valeur_co_orga = ? WHERE id_sortie = ? AND id_membre = ?');
	$req4->execute(array(1, $_SESSION['id_sortie'], $_POST['id_membre']));
	$validation++;
}elseif(isset($_POST['co_orga2']))
{
	$req5 = $bdd->prepare('UPDATE inscrits_sortie SET valeur_co_orga = ? WHERE id_sortie = ? AND id_membre = ?');
	$req5->execute(array(2, $_SESSION['id_sortie'], $_POST['id_membre']));
	$validation++;
}
if($validation == 1)
{
	if($_POST['invitation'] == 0)
	{
		header('Location: invites.php');
	}elseif($_POST['invitation'] == 1)
	{
		header('Location: inviter_recommandations_1.php');
	}elseif($_POST['invitation'] == 2)
	{
		header('Location: inviter_recommandations_2.php');
	}elseif($_POST['invitation'] == 3)
	{
		header('Location: inviter_recommandations_pro.php');
	}elseif($_POST['invitation'] == 4)
	{
		header('Location: inviter_gr1.php');
	}elseif($_POST['invitation'] == 5)
	{
		header('Location: inviter_gr2.php');
	}elseif($_POST['invitation'] == 6)
	{
		header('Location: inviter_gr_pro.php');
	}elseif($_POST['invitation'] == 7)
	{
		header('Location: inviter_relationseternelles.php');
	}elseif($_POST['invitation'] == 8)
	{
		header('Location: inviter_relationsparfaites.php');
	}elseif($_POST['invitation'] == 9)
	{
		header('Location: inviter_relationsfortes.php');
	}elseif($_POST['invitation'] == 10)
	{
		header('Location: inviter_relationsamicales.php');
	}elseif($_POST['invitation'] == 11)
	{
		header('Location: inviter_relationsnaissantes.php');
	}elseif($_POST['invitation'] == 12)
	{
		header('Location: inviter_membredemongroupe.php');
	}elseif($_POST['invitation'] == 13)
	{
		header('Location: inviter_membresdesautresgroupes.php');
	}
}elseif($profil == 1)
{
	header('Location: presentationprofil.php');
}else
{
	header('Location: invites.php');
}
?>