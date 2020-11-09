<?php 
session_start();
include('expression_r.php');
include('mysql.php');
$validation = 0;
if(isset($_POST['valider']))
{
	$_SESSION['message106'] = "";
}else
{
	$_SESSION['message106'] = "Vous n'avez pas cliqué sur le bouton de validation.";
	header('Location: presentationdelasortie.php');
}
if(!preg_match("#^[ ]*$#", $_POST['nomboite']))
{
	$_POST['nomboite'] = htmlspecialchars($_POST['nomboite'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nomboite']))
	{
		$_SESSION['message107'] = "";
		$_SESSION['nomboite'] = $_POST['nomboite'];
		$validation++;
	}else
	{
		$_SESSION['message107'] = "Votre nom de boîte contient des caractères interdits.";
	}
}else
{
	$_SESSION['message107'] = "Veuillez nous donner un nom pour votre boîte, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['placemax']))
{
	$_SESSION['message114'] = "";
	$validation++;
}else
{
	$_SESSION['message114'] = "Veuillez entrer la place maximum de votre boîte, s'il vous plaît.";
}
if($validation == 2)
{
		$req = $bdd->prepare('INSERT INTO boite (id_sortie, nomboite, placemax, valeur_boite) VALUES (?, ?, ?, ?)');
		$req->execute(array($_SESSION['id_sortie'], $_POST['nomboite'], $_POST['placemax'], 1));
		header('Location: presentationdelasortie.php');
}else
{
	header('Location: presentationdelasortie.php');
}
?>