<?php
session_start();
$code = $_GET['code'];
if(isset($_SESSION[$code]))
{
	$req = $bdd->prepare('SELECT code_inscrit FROM inscrits WHERE id = ?');
	$req->execute(array($code));
	$donnees = $req->fetch();
	if($_SESSION[$code] == 1)
	{
		$_SESSION[$code] = 2;
		$_SESSION['validation2'] = 1;
		header('Location: confirmation4.php');
	}else
	{
		header('Location: profil.php');
	}
}else
{
	header('Location: profil.php');
}