<?php 
session_start();
include('expression_r.php');
include('mysql.php');
$validation = 0;
if(isset($_POST['valider']))
{
	$req1 = $bdd->prepare('SELECT COUNT(id_sortie_type) as nbrst FROM sortietype WHERE id_membre_createur = ?');
	$req1->execute(array($_SESSION['id']));
	$donnees1 = $req1->fetch();
	$_SESSION['message106'] = "";
}else
{
	$_SESSION['message106'] = "Vous n'avez pas cliqué sur le bouton de validation.";
	header('Location: creationdesortietype.php');
}
if(!preg_match("#^[ ]*$#", $_POST['isortietype']))
{
	$_POST['isortietype'] = htmlspecialchars($_POST['isortietype'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['isortietype']))
	{
		$_SESSION['message107'] = "";
		$_SESSION['isortietype'] = $_POST['isortietype'];
		$validation++;
	}else
	{
		$_SESSION['message107'] = "Votre intitulé contient des caractères interdits.";
	}
}else
{
	$_SESSION['message107'] = "Veuillez nous donner un intitulé pour votre sortie type, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['ddrefsortietype']))
{
	$_SESSION['message109'] = "";
	$validation++;
}else
{
	$_SESSION['message109'] = "Veuillez nous donner la ville de référence de votre sortie type, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['vdressortietype']))
{
	$_POST['vdressortietype'] = htmlspecialchars($_POST['vdressortietype'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['vdressortietype']))
	{
		$_SESSION['message110'] = "";
		$_SESSION['vdressortietype'] = $_POST['vdressortietype'];
		$validation++;
	}else
	{
		$_SESSION['message110'] = "La ville de résidence de votre sortie type contient des caractères interdits.";
	}
}else
{
	$_SESSION['message110'] = "Veuillez nous donner la ville de résidence de votre sortie type, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['nbrpsortietype']))
{
	$_SESSION['message114'] = "";
	$validation++;
}else
{
	$_SESSION['message114'] = "Veuillez entrer le nombre de participants maximum à votre sortie type, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['dureetype']))
{
	$_SESSION['message114'] = "";
	$validation++;
}else
{
	$_SESSION['message114'] = "Veuillez entrer la durée de votre sortie type, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['tariftype']))
{
	$_SESSION['message115'] = "";
	$validation++;
}else
{
	$_SESSION['message115'] = "Veuillez entrer le tarif de votre sortie type, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['s_ptype']))
{
	$_SESSION['message116'] = "";
	$validation++;
}else
{
	$_SESSION['message116'] = "Veuillez choisir si votre sortie type doit être publique ou privée, s'il vous plaît.";
}
if(!preg_match("#^[ ]*$#", $_POST['descripsortietype']))
{
	$_POST['descripsortietype'] = htmlspecialchars($_POST['descripsortietype'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['descripsortietype']))
	{
		$_SESSION['message116'] = "";
		$_SESSION['descripsortietype'] = $_POST['descripsortietype'];
		$validation++;
	}else
	{
		$_SESSION['message116'] = "La description de votre sortie contient des caractères interdits.";
	}
}else
{
	$_SESSION['message116'] = "Veuillez entrer la description de votre sortie type, s'il vous plaît.";
}
if($donnees1['nbrst'] < 14)
{
	if($validation == 8)
	{
		if($donnees1['nbrst'] > 0)
		{
			$num_st = $donnees1['nbrst'] + 1;
		}else
		{
			$num_st = 1;
		}
		$req = $bdd->prepare('INSERT INTO sortietype (id_membre_createur, intitule, ddref_sortie_type,
		vdres_sortie_type, description, nbrparticipants, duree, tarif, s_privative, num_sortie_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$req->execute(array($_SESSION['id'], $_POST['isortietype'], $_POST['ddrefsortietype'],
		$_POST['vdressortietype'], $_POST['descripsortietype'], $_POST['nbrpsortietype'], $_POST['dureetype'], $_POST['tariftype'], $_POST['s_ptype'], $num_st));
		header('Location: listesortiestype.php');
	}else
	{
		header('Location: creationdesortietype.php');
	}
}else
{
	header('Location: creationdesortietype.php');
}
?>