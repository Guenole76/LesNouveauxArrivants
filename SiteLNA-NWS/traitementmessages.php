<?php 
session_start();
include('expression_r.php');
include('mysql.php');
$validation = 0;
if(isset($_SESSION['id_inscrit']))
{
	if(isset($_POST['valider']))
	{
		$validation++;
		$_SESSION['message150'] = "";
	}else
	{
		$_SESSION['message150'] = "Vous n'avez pas cliqué sur le bouton Envoyer.";
	}
	if(!preg_match("#^[ ]*$#", $_POST['message']))
	{
		$_SESSION['message'] = htmlspecialchars($_POST['message'], ENT_NOQUOTES);
		if(preg_match($expression_r, $_POST['message']))
		{
			$_SESSION['message152'] = "";
			$validation++;
		}else
		{
			$_SESSION['message152'] = "Le message que vous voulez envoyer contient de caractères interdits.";
		}
	}else
	{
		$_SESSION['message152'] = "Veuillez taper un ou plusieurs mots avant d'envoyer votre message s'il vous plaît.";
	}
	if($validation == 2)
	{
		if(!isset($_SESSION['id_conversation']))
		{
			$timestamp_conversation = time();
			$req3 = $bdd->prepare('INSERT INTO conversations(id_membre_1, id_membre_2, situation_conversation, vu, l, id_membre_situation, timestamp_conversation) VALUES(?, ?, ?, ?, ?, ?, ?)');
			$req3->execute(array($_SESSION['id'], $_SESSION['id_inscrit'], 1, 1,  $_SESSION['l_inscrit'], $_SESSION['id'], $timestamp_conversation));
			$req4 = $bdd->prepare('SELECT id_conversation FROM conversations WHERE id_membre_1 = ? AND id_membre_2 = ?');
			$req4->execute(array($_SESSION['id'], $_SESSION['id_inscrit']));
			$donnees4 = $req4->fetch();
			$req5= $bdd->prepare('INSERT INTO messages(id_conversation, id_membre_message, message, timestamp_message) VALUES(?, ?, ?, ?)');
			$req5->execute(array($donnees4['id_conversation'], $_SESSION['id'], $_POST['message'], $timestamp_conversation));
			$_SESSION['id_conversation'] = $donnees4['id_conversation'];
			$req6 = $bdd->prepare('INSERT INTO conversations(id_membre_1, id_membre_2, situation_conversation, vu, l, id_membre_situation, timestamp_conversation) VALUES(?, ?, ?, ?, ?, ?, ?)');
			$req6->execute(array($_SESSION['id_inscrit'], $_SESSION['id'], 1, 2, $_SESSION['l_utilisateur'], $_SESSION['id'], $timestamp_conversation));
			header('Location: messages.php');
		}else
		{
			$timestamp_message = time();
			$req7 = $bdd->prepare('INSERT INTO messages(id_conversation, id_membre_message, message, timestamp_message) VALUES(?, ?, ?, ?)');
			$req7->execute(array($_SESSION['id_conversation'], $_SESSION['id'], $_POST['message'], $timestamp_message));
			$req8 = $bdd->prepare('UPDATE conversations SET timestamp_conversation = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
			$req8->execute(array($timestamp_message, $_SESSION['id'], $_SESSION['id_inscrit']));
			$req9 = $bdd->prepare('UPDATE conversations SET vu = ?, timestamp_conversation = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
			$req9->execute(array(2, $timestamp_message, $_SESSION['id_inscrit'], $_SESSION['id']));
			header('Location: messages.php');
		}
	}else
	{
		header('Location: messages.php');
	}
}else
{
	header('Location: profil.php');
}

?>