<?php 
session_start();
include('expression_r.php');
include('mysql.php');
$validation = 0;
if(isset($_POST['valider']))
{
	$req1 = $bdd->prepare('SELECT l FROM inscrits WHERE id = ?');
	$req1->execute(array($_SESSION['id']));
	$donnees1 = $req1->fetch();
	$_SESSION['message106'] = "";
}else
{
	$_SESSION['message106'] = "Vous n'avez pas cliqué sur le bouton de validation.";
	header('Location: creationdesortie.php');
}
if(!preg_match("#^[ ]*$#", $_POST['isortie']))
{
	$_POST['isortie'] = htmlspecialchars($_POST['isortie'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['isortie']))
	{
		$_SESSION['message107'] = "";
		$_SESSION['isortie'] = $_POST['isortie'];
		$validation++;
	}else
	{
		$_SESSION['message107'] = "Votre intitulé contient des caractères interdits.";
	}
}else
{
	$_SESSION['message107'] = "Veuillez nous donner un intitulé pour votre sortie, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['ddrefsortie']))
{
	$_SESSION['message109'] = "";
	$validation++;
}else
{
	$_SESSION['message109'] = "Veuillez nous donner la ville de référence de votre sortie, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['vdressortie']))
{
	$_POST['vdressortie'] = htmlspecialchars($_POST['vdressortie'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['vdressortie']))
	{
		$_SESSION['message110'] = "";
		$_SESSION['vdressortie'] = $_POST['vdressortie'];
		$validation++;
	}else
	{
		$_SESSION['message110'] = "La ville de résidence de votre sortie contient des caractères interdits.";
	}
}else
{
	$_SESSION['message110'] = "Veuillez nous donner la ville de résidence de votre sortie, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['dsortie']))
{
	$_POST['dsortie'] = strtotime($_POST['dsortie']);
	$_SESSION['message111'] = "";
	$validation++;
}else
{
	$_SESSION['message111'] = "Veuillez nous donner la date de votre sortie, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['hsortie']))
{
	$_SESSION['message112'] = "";
	$validation++;
}else
{
	$_SESSION['message112'] = "Veuillez nous donner l'heure de votre sortie, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['msortie']))
{
	$_SESSION['message113'] = "";
	$validation++;
}else
{
	$_SESSION['message113'] = "Veuillez nous donner l'heure complète de votre sortie, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['nbrpsortie']))
{
	$_SESSION['message114'] = "";
	$validation++;
}else
{
	$_SESSION['message114'] = "Veuillez entrer le nombre de participants maximum à votre sortie, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['duree']))
{
	$_SESSION['message114'] = "";
	$validation++;
}else
{
	$_SESSION['message114'] = "Veuillez entrer la durée de votre sortie, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['tarif']))
{
	$_SESSION['message115'] = "";
	$validation++;
}else
{
	$_SESSION['message115'] = "Veuillez entrer le tarif de votre sortie, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['s_p']))
{
	$_SESSION['message116'] = "";
	$validation++;
}else
{
	$_SESSION['message116'] = "Veuillez choisir si votre sortie doit être publique ou privée, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['descripsortie']))
{
	$_POST['descripsortie'] = htmlspecialchars($_POST['descripsortie'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['descripsortie']))
	{
		$_SESSION['message116'] = "";
		$_SESSION['descripsortie'] = $_POST['descripsortie'];
		$validation++;
	}else
	{
		$_SESSION['message116'] = "La description de votre sortie contient des caractères interdits.";
	}
}else
{
	$_SESSION['message116'] = "Veuillez entrer la description de votre sortie, s'il vous plaît.";
}
if($validation == 11)
{
		$req = $bdd->prepare('INSERT INTO sortie (id_membre_createur, lieu, intitule, ddref_sortie,
		vdres_sortie, date, heure, minute, description, nbrparticipants, duree, tarif, s_privative, id_demande, code_sortie, valeur_sortie) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$req->execute(array($_SESSION['id'], $donnees1['l'], $_POST['isortie'], $_POST['ddrefsortie'],
		$_POST['vdressortie'], $_POST['dsortie'], $_POST['hsortie'], $_POST['msortie'], $_POST['descripsortie'], $_POST['nbrpsortie'], $_POST['duree'], $_POST['tarif'], $_POST['s_p'], 0, "", 0));
		header('Location: liste_sorties_organisees_par_vous.php');
}else
{
	header('Location: creationdesortie.php');
}
?>