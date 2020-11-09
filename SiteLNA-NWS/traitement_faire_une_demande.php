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
	header('Location: faire_une_demande.php');
}
if(!preg_match("#^[ ]*$#", $_POST['isortie']))
{
	$_POST['isortie'] = htmlspecialchars($_POST['isortie'], ENT_NOQUOTES);
	$lienvalider++;
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
	$_SESSION['message107'] = "Veuillez nous donner un intitulé, s'il vous plaît.";
	$lienvalider++;
}
if(!preg_match("#^[ ]*$#", $_POST['ddrefsortie']))
{
	$_SESSION['message109'] = "";
	$validation++;
	$lienvalider++;
}else
{
	$_SESSION['message109'] = "Veuillez nous donner le département où se fera la sortie, s'il vous plaît.";
	$lienvalider++;
}
if(!preg_match("#^[ ]*$#", $_POST['vdressortie']))
{
	$_POST['vdressortie'] = htmlspecialchars($_POST['vdressortie'], ENT_NOQUOTES);
	$lienvalider++;
	if(preg_match($expression_r, $_POST['vdressortie']))
	{
		$_SESSION['message110'] = "";
		$_SESSION['vdressortie'] = $_POST['vdressortie'];
		$validation++;
	}else
	{
		$_SESSION['message110'] = "La ville de résidence contient des caractères interdits.";
	}
}else
{
	$_SESSION['message110'] = "Veuillez nous donner la ville de résidence, s'il vous plaît.";
	$lienvalider++;
}
if(!preg_match("#^[ ]*$#", $_POST['dsortie']))
{
	$_POST['dsortie'] = strtotime($_POST['dsortie']);
	$_SESSION['message111'] = "";
	$validation++;
	$lienvalider++;
}else
{
	$_SESSION['message111'] = "Veuillez nous donner la date, s'il vous plaît.";
	$lienvalider++;
}
if(!preg_match("#^[ ]*$#", $_POST['hsortie']))
{
	$_SESSION['message112'] = "";
	$validation++;
	$lienvalider++;
}else
{
	$_SESSION['message112'] = "Veuillez nous donner une heure, s'il vous plaît.";
	$lienvalider++;
}
if(!preg_match("#^[ ]*$#", $_POST['msortie']))
{
	$_SESSION['message113'] = "";
	$validation++;
	$lienvalider++;
}else
{
	$_SESSION['message113'] = "Veuillez nous donner l'heure complète, s'il vous plaît.";
	$lienvalider++;
}
if(!preg_match("#^[ ]*$#", $_POST['nbrpsortie']))
{
	$_SESSION['message114'] = "";
	$validation++;
	$lienvalider++;
}else
{
	$_SESSION['message114'] = "Veuillez entrer le nombre de participants, s'il vous plaît.";
	$lienvalider++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree']))
{
	$_SESSION['message115'] = "";
	$validation++;
	$lienvalider++;
}else
{
	$_SESSION['message115'] = "Veuillez entrer le nombre de participants, s'il vous plaît.";
	$lienvalider++;
}
if(!preg_match("#^[ ]*$#", $_POST['tarif']))
{
	$_SESSION['message116'] = "";
	$validation++;
	$lienvalider++;
}else
{
	$_SESSION['message116'] = "Veuillez entrer un tarif par personne, s'il vous plaît.";
	$lienvalider++;
}
if(!preg_match("#^[ ]*$#", $_POST['s_p']))
{
	$_SESSION['message116'] = "";
	$validation++;
	$lienvalider++;
}else
{
	$_SESSION['message116'] = "Veuillez choisir si votre sortie doit être publique ou privée, s'il vous plaît.";
	$lienvalider++;
}
if(!preg_match("#^[ ]*$#", $_POST['descripsortie']))
{
	$_POST['descripsortie'] = htmlspecialchars($_POST['descripsortie'], ENT_NOQUOTES);
	$lienvalider++;
	if(preg_match($expression_r, $_POST['descripsortie']))
	{
		$_SESSION['message116'] = "";
		$_SESSION['descripsortie'] = $_POST['descripsortie'];
		$validation++;
	}else
	{
		$_SESSION['message116'] = "L'information complémentaire contient des caractères interdits.";
	}
}else
{
	$_POST['descripsortie'] = "Aucune information complémentaire";
}
if($validation == $lienvalider)
{
		$req = $bdd->prepare('INSERT INTO demande (id_demandeur, intitule, ddref,
		vdres, date, heure, minute, nbr_participants, duree, tarif, s_privative, description, valeur_demande) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$req->execute(array($_SESSION['id'], $_POST['isortie'], $_POST['ddrefsortie'],
		$_POST['vdressortie'], $_POST['dsortie'], $_POST['hsortie'], $_POST['msortie'], $_POST['nbrpsortie'], $_POST['duree'], $_POST['tarif'], $_POST['s_p'], $_POST['descripsortie'], 1));
		header('Location: liste_demandes_personnelles.php');
}else
{
	header('Location: faire_une_demande.php');
}
?>