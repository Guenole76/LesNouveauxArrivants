<?php
session_start();
include('mysql.php');
include('verificationid.php');
if(isset($_SESSION['id']))
{
	$req1 = $bdd->prepare('SELECT * FROM duree_abonnement WHERE id_membre = ?');
	$req1->execute(array($_SESSION['id']));
	$donnees1 = $req1->fetch();
	if(isset($_GET['cid']))
	{
		if(isset($donnees1['validation_abo']))
		{
			if($donnees1['validation_abo'] == 1)
			{
				$temps_abo = time() + 60*60*24*30.5;
				$req2 = $bdd->prepare('UPDATE duree_abonnement SET timestamp_partage = ? AND validation_abo = ? AND cid = ? WHERE id_membre = ?');
				$req2->execute(array($temps_abo, 3, $_GET['cid'], $_SESSION['id']));
				header('Location: validationdachat2.php');
			}elseif($donnees1['validation_abo'] == 2)
			{
				$temps_abo = time() + 60*60*24*7;
				$req2 = $bdd->prepare('UPDATE duree_abonnement SET timestamp_partage = ? AND validation_abo = ? AND cid = ? WHERE id_membre = ?');
				$req2->execute(array($temps_abo, 3, $_GET['cid'], $_SESSION['id']));
				header('Location: validationdachat2.php');
			}else
			{
				$_SESSION['message1011'] = "Vous n'avez pas réglé votre abonnement.";
				header('Location: profil.php');
			}
		}else
		{
			$_SESSION['message1011'] = "Vous n'avez pas réglé votre abonnement.";
			header('Location: profil.php');
		}
	}else
	{
		$_SESSION['message1011'] = "Vous n'avez pas cliqué sur le lien que nous vous avons envoyé.";
		header('Location: profil.php');
	}
}else
{
	$_SESSION['message1011'] = "Vous devez vous connecter avant de valider votre abonnement.";
	header('Location:index.php');
}
?>