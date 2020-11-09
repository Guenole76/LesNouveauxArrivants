<?php
session_start();
include('mysql.php');
if(isset($_POST['valider']))
{
	$_SESSION['id_inscrit'] = $_POST['id_inscrit'];
	header('Location: presentationprofil.php');
}elseif(isset($_POST['voir']))
{
	$req1 = $bdd->prepare('SELECT id_conversation, situation_conversation, id_membre_situation FROM conversations WHERE id_membre_1 = ? AND id_membre_2 = ?');
	$req1->execute(array($_SESSION['id'], $_POST['id_inscrit']));
	$donnees1 = $req1->fetch();
	$req2 = $bdd->prepare('SELECT id_conversation FROM conversations WHERE id_membre_1 = ? AND id_membre_2 = ?');
	$req2->execute(array($_POST['id_inscrit'], $_SESSION['id']));
	$donnees2 = $req2->fetch();
	if($donnees1['id_conversation'] < $donnees2['id_conversation'])
	{
		$_SESSION['id_conversation'] = $donnees1['id_conversation'];
		$_SESSION['id_inscrit'] = $_POST['id_inscrit'];
		header('Location: messages.php');
	}else
	{
		$_SESSION['id_conversation'] = $donnees2['id_conversation'];
		$_SESSION['id_inscrit'] = $_POST['id_inscrit'];
		header('Location: messages.php');
	}
}elseif(isset($_POST['bloquer']))
{
	$req3 = $bdd->prepare('UPDATE conversations SET situation_conversation = ?, id_membre_situation = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
	$req3->execute(array(2, $_SESSION['id'], $_SESSION['id'], $_POST['id_inscrit']));
	$req4 = $bdd->prepare('UPDATE conversations SET situation_conversation = ?, id_membre_situation = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
	$req4->execute(array(2, $_SESSION['id'], $_POST['id_inscrit'], $_SESSION['id']));
	header('Location: conversationsbloquees.php');
}elseif(isset($_POST['debloquer']))
{
	$req5 = $bdd->prepare('UPDATE conversations SET situation_conversation = ?, id_membre_situation = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
	$req5->execute(array(1, $_SESSION['id'], $_SESSION['id'], $_POST['id_inscrit']));
	$req5 = $bdd->prepare('UPDATE conversations SET situation_conversation = ?, id_membre_situation = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
	$req5->execute(array(1, $_SESSION['id'], $_POST['id_inscrit'], $_SESSION['id']));
	header('Location: conversations.php');
}else
{
	header('conversations.php');
}
?>