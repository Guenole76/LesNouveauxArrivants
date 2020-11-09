<?php 
session_start();
include('expression_r.php');
if(isset($_POST['valider']))
{
	if(isset($_POST['id_sortie']))
	{
		$_SESSION['id_sortie'] = $_POST['id_sortie'];
		header('Location: presentationdelasortie.php');
	}else
	{
		header('Location: sorties.php');
	}
}elseif(isset($_POST['rechercher']))
{
	$_SESSION['page'] = 1;
	if(!preg_match("#^[ ]*$#", $_POST['vdressortie']))
	{
		$_POST['vdressortie'] = htmlspecialchars($_POST['vdressortie'], ENT_NOQUOTES);
		if(preg_match($expression_r, $_POST['vdressortie']))
		{
			$_SESSION['vdres'] = $_POST['vdressortie'];
		}else
		{
			$_SESSION['vdres'] = "";
		}
	}else
	{
		$_SESSION['vdres'] = "";
	}
	if(!preg_match("#^[ ]*$#", $_POST['tsortie']))
	{
		$_SESSION['type'] = $_POST['tsortie'];
	}else
	{
		$_SESSION['type'] = 1;
	}
	header('Location: sorties.php');
}elseif(isset($_POST['proposer']))
{
	if(isset($_SESSION['id']))
	{
		header('Location: proposerunesortie.php');
	}else
	{
		header('Location: inscription.php');
	}
}else
{
	$_SESSION['vdres'] = "";
	$_SESSION['type'] = 1;
	header('Location: sorties.php');
}
?>