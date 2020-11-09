<?php 
session_start();
include('mysql.php');
if(isset($_POST['change']))
{
	$req = $bdd->prepare('SELECT val_email_j, email_ins_s, email_ins_b, email_com_s, email_mes, email_prop FROM inscrits WHERE id = ?');
	$req->execute(array($_SESSION['id']));
	$donnees = $req->fetch();
	if($_POST['emailnum'] == 1)
	{
		if($donnees['val_email_j'] == 1)
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET val_email_j = ? WHERE id = ?');
			$req1->execute(array(0, $_SESSION['id']));
		}else
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET val_email_j = ? WHERE id = ?');
			$req1->execute(array(1, $_SESSION['id']));
		}
		header('Location: modifierlagestiondesemails.php');
	}elseif($_POST['emailnum'] == 2)
	{
		if($donnees['email_ins_s'] == 1)
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET email_ins_s = ? WHERE id = ?');
			$req1->execute(array(0, $_SESSION['id']));
		}else
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET email_ins_s = ? WHERE id = ?');
			$req1->execute(array(1, $_SESSION['id']));
		}
		header('Location: modifierlagestiondesemails.php');
	}elseif($_POST['emailnum'] == 3)
	{
		if($donnees['email_ins_b'] == 1)
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET email_ins_b = ? WHERE id = ?');
			$req1->execute(array(0, $_SESSION['id']));
		}else
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET email_ins_b = ? WHERE id = ?');
			$req1->execute(array(1, $_SESSION['id']));
		}
		header('Location: modifierlagestiondesemails.php');
	}elseif($_POST['emailnum'] == 4)
	{
		if($donnees['email_com_s'] == 1)
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET email_com_s = ? WHERE id = ?');
			$req1->execute(array(0, $_SESSION['id']));
		}else
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET email_com_s = ? WHERE id = ?');
			$req1->execute(array(1, $_SESSION['id']));
		}
		header('Location: modifierlagestiondesemails.php');
	}elseif($_POST['emailnum'] == 5)
	{
		if($donnees['email_mes'] == 1)
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET email_mes = ? WHERE id = ?');
			$req1->execute(array(0, $_SESSION['id']));
		}else
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET email_mes = ? WHERE id = ?');
			$req1->execute(array(1, $_SESSION['id']));
		}
		header('Location: modifierlagestiondesemails.php');
	}elseif($_POST['emailnum'] == 6)
	{
		if($donnees['email_prop'] == 1)
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET email_prop = ? WHERE id = ?');
			$req1->execute(array(0, $_SESSION['id']));
		}else
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET email_prop = ? WHERE id = ?');
			$req1->execute(array(1, $_SESSION['id']));
		}
		header('Location: modifierlagestiondesemails.php');
	}
	header('Location: modifierlagestiondesemails.php');
}else
{
	header('Location: modifierlagestiondesemails.php');
}
?>