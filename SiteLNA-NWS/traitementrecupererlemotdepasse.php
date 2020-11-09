<?php 
session_start();
include('mysql.php');
$validation = 0;
$lienvalider = 0;
if(isset($_POST['valider']))
{
	$_SESSION['message156'] = "";
}else
{
	$_SESSION['message156'] = "Vous n'avez pas cliqué sur le bouton Envoyer";
	header('Location: recupererlemotdepasse.php');
}
if(!preg_match("#^[ ]*$#", $_POST['aem']))
{
	$_POST['aem'] = htmlspecialchars($_POST['aem']);
	$lienvalider++;
	if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['aem']))
	{
		$_SESSION['message157'] = "";
		$validation++;
	}else
	{
		$_SESSION['message157'] = "Votre adresse contient des caractères interdits.";
	}
}else
{
	$_SESSION['message158'] = "Veuillez entrer votre adresse e-mail.";
	$lienvalider++; 
}
if($validation == $lienvalider)
{
	$req = $bdd->prepare('SELECT surnom1, cmdp, l, nom_l FROM inscrits WHERE caem = ?');
	$req->execute(array($_POST['aem']));
	$donnees = $req->fetch();
	if(isset($donnees['cmdp']))
	{
		$to = $_POST['aem'];
		if($donnees['l'] == 2)
		{
			$message = $donnees['surnom1']. ", voici votre mot de passe : " .$donnees['cmdp']; 
		}else
		{
			$message = $donnees['nom_l']. ", voici votre mot de passe : " .$donnees['cmdp']; 
		}
		mail($to, "Mot de passe", $message);
		header('Location: recupererlemotdepasse.php'); 
	}else
	{
		$_SESSION['message159'] = "Aucun compte n'est associé à cette adresse e-mail";
		header('Location: recupererlemotdepasse.php'); 
	}
}else
{
	header('Location: recupererlemotdepasse.php');
}
?>