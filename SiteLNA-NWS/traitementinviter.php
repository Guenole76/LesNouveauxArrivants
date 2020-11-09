<?php 
session_start();
include('expression_r.php');
if(isset($_POST['rechercher']))
{
	$_SESSION['page'] = 1;
	if(!preg_match("#^[ ]*$#", $_POST['lrelation']))
	{
		$_SESSION['relation_i'] = $_POST['lrelation'];
	}else
	{
		$_SESSION['relation_i'] = 0;
	}
	if(!preg_match("#^[ ]*$#", $_POST['llieu']))
	{
		$_SESSION['lieu_i'] = $_POST['llieu'];
	}else
	{
		$_SESSION['lieu_i'] = 0;
	}
	if(!preg_match("#^[ ]*$#", $_POST['lda']))
	{
		$_SESSION['da_i'] = $_POST['lda'];
	}else
	{
		$_SESSION['da_i'] = 0;
	}
	if(!preg_match("#^[ ]*$#", $_POST['lds']))
	{
		$_SESSION['ds_i'] = $_POST['lds'];
	}else
	{
		$_SESSION['ds_i'] = 0;
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom']))
	{
		$_POST['nom'] = htmlspecialchars($_POST['nom'], ENT_NOQUOTES);
		if(preg_match($expression_r, $_POST['nom']))
		{
			$_SESSION['nom_i'] = $_POST['nom'];
		}else
		{
			$_SESSION['nom_i'] = "";
		}
	}else
	{
		$_SESSION['nom_i'] = "";
	}
	if(!preg_match("#^[ ]*$#", $_POST['prenom']))
	{
		$_POST['prenom'] = htmlspecialchars($_POST['prenom'], ENT_NOQUOTES);
		if(preg_match($expression_r, $_POST['prenom']))
		{
			$_SESSION['prenom_i'] = $_POST['prenom'];
		}else
		{
			$_SESSION['prenom_i'] = "";
		}
	}else
	{
		$_SESSION['prenom_i'] = "";
	}
	header('Location: invites.php');
}else
{
	$_SESSION['relation_i'] = 0;
	$_SESSION['lieu_i'] = 0;
	$_SESSION['da_i'] = 0;
	$_SESSION['ds_i'] = 0;
	$_SESSION['nom_i'] = "";
	$_SESSION['prenom_i'] = "";
	header('Location: invites.php');
}
?>