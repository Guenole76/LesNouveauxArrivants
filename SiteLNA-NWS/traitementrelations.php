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
if(isset($_POST['glacage']))
{
	if(preg_match("#^O#i", $_POST['glacage']))
	{
		$req1 = $bdd->prepare('UPDATE relations SET glacage = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req1->execute(array(2, $_SESSION['id'], $_POST['id_membre']));
	}else
	{
		$req1 = $bdd->prepare('UPDATE relations SET glacage = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req1->execute(array(1, $_SESSION['id'], $_POST['id_membre']));
	}
	$validation++;
}
if(isset($_POST['groupe_relationnel']))
{
	if($_POST['groupe_relationnel'] == 1)
	{
		$req2 = $bdd->prepare('UPDATE relations SET groupe_relationnel = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req2->execute(array(1, $_SESSION['id'], $_POST['id_membre']));
	}elseif($_POST['groupe_relationnel'] == 2)
	{
		$req2 = $bdd->prepare('UPDATE relations SET groupe_relationnel = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req2->execute(array(2, $_SESSION['id'], $_POST['id_membre']));
	}elseif($_POST['groupe_relationnel'] == 3)
	{
		$req2 = $bdd->prepare('UPDATE relations SET groupe_relationnel = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req2->execute(array(3, $_SESSION['id'], $_POST['id_membre']));
	}elseif($_POST['groupe_relationnel'] == 4)
	{
		$req2 = $bdd->prepare('UPDATE relations SET groupe_relationnel = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req2->execute(array(4, $_SESSION['id'], $_POST['id_membre']));
	}
	$validation++;
}
if(isset($_POST['protection']))
{
	if($_POST['protection'] == 2)
	{
		$req1 = $bdd->prepare('UPDATE relations SET protection = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req1->execute(array(1, $_SESSION['id'], $_POST['id_membre']));
	}else
	{
		$req1 = $bdd->prepare('UPDATE relations SET protection = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req1->execute(array(2, $_SESSION['id'], $_POST['id_membre']));
	}
	$validation++;
}
if($validation == 1)
{
	if($_POST['gr'] == 1)
	{
		header('Location: groupe_relationnel_1.php');
	}elseif($_POST['gr'] == 2)
	{
		header('Location: groupe_relationnel_2.php');
	}elseif($_POST['gr'] == 3)
	{
		header('Location: groupe_relationnel_pro.php');
	}elseif($_POST['gr'] == 4)
	{
		header('Location: groupe_des_intrus.php');
	}else
	{
		header('Location: groupe_relationnel_1.php');
	}
}elseif($profil == 1)
{
	header('Location: presentationprofil.php');
}else
{
	header('Location: groupe_relationnel_1.php');
}
?>