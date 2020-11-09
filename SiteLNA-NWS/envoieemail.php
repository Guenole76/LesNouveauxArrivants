<?php 
session_start();
if(isset($_POST['valider']))
{
	if(isset($_SESSION['caem']))
	{
		$req = $bdd->prepare('SELECT code_inscrit FROM inscrits WHERE caem = ?');
		$req->execute(array($_SESSION['caem']));
		$donnees = $req->fetch();
		$lien = "https://www.lesnouveauxarrivants.fr/confirmation2.php?code=".$donnees['code_inscrit'];
		$to = $_SESSION['caem'];
		$subject = "E-mail pour confirmer l'inscription";
		$message = "Veuillez cliquer sur le lien ci-dessous, pour confirmer votre inscription. ".$lien."";
		$message = wordwrap($message, 70, "\r\n", true);
		mail($to, $subject, $message, 'De: Les Nouveaux Arrivants');
		header('Location: confirmation1.php');
	}elseif(isset($_SESSION['cnaem']))
	{
		$req = $bdd->prepare('SELECT code_inscrit FROM inscrits WHERE id = ?');
		$req->execute(array($_SESSION['id']));
		$donnees = $req->fetch();
		$lien = "https://www.lesnouveauxarrivants.fr/confirmation4.php?code=".$donnees['code_inscrit'];
		$to = $_SESSION['cnaem'];
		$subject = "E-mail pour valider votre changement d'adresse e-mail.";
		$message = "Veuillez cliquer sur le lien ci-dessous, pour valider votre changement d'adresse e-mail: ".$lien."";
		$message = wordwrap($message, 70, "\r\n");
		mail($to, $subject, $message, 'De: Les Nouveaux Arrivants');
		header('Location: confirmation3.php');
	}else
	{
		header('Location: profil.php');
	}
}else
{
	header('Location: profil.php');
}
?>