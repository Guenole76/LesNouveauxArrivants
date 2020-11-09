<?php 
session_start();
include('expression_r.php');
include('mysql.php');
$validation = 0;
if(isset($_POST['valider']))
{
	$_SESSION['message106'] = "";
}elseif(isset($_POST['supprimer']))
{
	$req1 = $bdd->prepare('UPDATE commentaire SET valeur_com = ? WHERE id_com = ?');
	$req1->execute(array(2, $_POST['idcom']));
	header('Location: presentationdelasortie.php');
}else
{
	$_SESSION['message106'] = "Vous n'avez pas cliqué sur le bouton de validation.";
	header('Location: creationdesortie.php');
}
if(!preg_match("#^[ ]*$#", $_POST['com']))
{
	$_POST['com'] = htmlspecialchars($_POST['com'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['com']))
	{
		$_SESSION['message116'] = "";
		$_SESSION['com'] = $_POST['com'];
		$validation++;
	}else
	{
		$_SESSION['message116'] = "Votre commentaire contient des caractères interdits.";
	}
}else
{
	$_SESSION['message116'] = "Veuillez entrer votre commentaire, s'il vous plaît.";
}
if($validation == 1)
{
	$date = time();
	$req = $bdd->prepare('INSERT INTO commentaire (id_sortie, id_inscrit, date_com, com, valeur_com) VALUES (?, ?, ?, ?, ?)');
	$req->execute(array($_SESSION['id_sortie'], $_SESSION['id'], $date, $_POST['com'], 1));
	header('Location: presentationdelasortie.php');
}else
{
	header('Location: presentationdelasortie.php');
}
?>