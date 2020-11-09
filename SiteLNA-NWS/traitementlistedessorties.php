<?php 
session_start();
if(isset($_POST['valider1']))
{
	if(isset($_POST['id_sortie']))
	{
		$_SESSION['id_sortie'] = $_POST['id_sortie'];
		header('Location: presentationdelasortie.php');
	}else
	{
		header('Location: liste_sorties_organisees_par_vous.php');
	}
}elseif(isset($_POST['valider2']))
{
	if(isset($_POST['id_sortie']))
	{
		$_SESSION['id_sortie'] = $_POST['id_sortie'];
		header('Location: presentationdelasortie.php');
	}else
	{
		header('Location: liste_sorties_ou_vous_etes_invite.php');
	}
}elseif(isset($_POST['valider3']))
{
	if(isset($_POST['id_sortie']))
	{
		$_SESSION['id_sortie'] = $_POST['id_sortie'];
		header('Location: presentationdelasortie.php');
	}else
	{
		header('Location: liste_sorties_des_lieux.php');
	}
}elseif(isset($_POST['valider4']))
{
	if(isset($_POST['id_sortie']))
	{
		$_SESSION['id_sortie'] = $_POST['id_sortie'];
		header('Location: presentationdelasortie.php');
	}else
	{
		header('Location: liste_sorties_publiques.php');
	}
}else
{
	header('Location: liste_sorties_publiques.php');
}