<?php 
session_start();
include('expression_r.php');
include('mysql.php');
$validation = 0;
$lienvalider = 0;
if(isset($_POST['valider']))
{
	$_SESSION['message106'] = "";
}else
{
	$_SESSION['message106'] = "Vous n'avez pas cliqué sur le bouton de validation.";
	header('Location: faire_une_proposition.php');
}
if(!preg_match("#^[ ]*$#", $_POST['proposition']))
{
	$_POST['proposition'] = htmlspecialchars($_POST['proposition'], ENT_NOQUOTES);
	$lienvalider++;
	if(preg_match($expression_r, $_POST['proposition']))
	{
		$_SESSION['message116'] = "";
		$_SESSION['proposition'] = $_POST['proposition'];
		$validation++;
	}else
	{
		$_SESSION['message116'] = "La proposition contient des caractères interdits.";
	}
}else
{
	$_POST['proposition'] = "Il n'y a aucune proposition.";
}
if($validation == $lienvalider)
{	
	if(isset($_SESSION['id_demande']))
	{
		$req = $bdd->prepare('INSERT INTO proposition (id_demande, id_repondant, id_demandeur, proposition, valeur_proposition) 
		VALUES (?, ?, ?, ?, ?)');
		$req->execute(array($_SESSION['id_demande'],$_SESSION['id'] ,$_SESSION['id_demandeur'] , $_POST['proposition'], 1));
		header('Location: liste_propositions_personnelles.php');
	}else
	{
		header('Location: liste_demandes_utilisateurs.php');
	}
}else
{
	header('Location: faire_une_proposition.php');
}
?>