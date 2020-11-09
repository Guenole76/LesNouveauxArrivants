<?php 
session_start();
include('expression_r.php');
include('mysql.php');
$validation = 0;
$lienvalider = 0;
if(isset($_POST['valider']))
{
	$_SESSION['message117'] = "";
}else
{
	$_SESSION['message117'] = "Vous n'avez pas cliqué sur le bouton de validation.";
	header('Location: modifierlasortie.php');
}
if(!preg_match("#^[ ]*$#", $_POST['isortie']))
{
	$lienvalider++;
	$_POST['isortie'] = htmlspecialchars($_POST['isortie'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['isortie']))
	{
		$_SESSION['message118'] = "";
		$_SESSION['isortie'] = $_POST['isortie'];
		$validation++;
	}else
	{
		$_SESSION['message118'] = "Votre intitulé contient des caractères interdits.";
	}
}
if(!preg_match("#^[ ]*$#", $_POST['ddrefsortie']))
{
	$_SESSION['message120'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['vdressortie']))
{
	$_POST['vdressortie'] = htmlspecialchars($_POST['vdressortie'], ENT_NOQUOTES);
	$lienvalider++;
	if(preg_match($expression_r, $_POST['vdressortie']))
	{
		$_SESSION['message121'] = "";
		$_SESSION['vdressortie'] = $_POST['vdressortie'];
		$validation++;
	}else
	{
		$_SESSION['message121'] = "La ville de résidence de votre sortie contient des caractères interdits.";
	}
}
if(!preg_match("#^[ ]*$#", $_POST['dsortie']))
{
	$_POST['dsortie'] = strtotime($_POST['dsortie']);
	$_SESSION['message122'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['hsortie']))
{
	$_SESSION['message123'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['msortie']))
{
	$_SESSION['message124'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nbrpsortie']))
{
	$_SESSION['message125'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['dureesortie']))
{
	$_SESSION['message125'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['tarifsortie']))
{
	$_SESSION['message126'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['s_psortie']))
{
	$_SESSION['message116'] = "";
	$validation++;
	$lienvalider++;
}
if(!preg_match("#^[ ]*$#", $_POST['descripsortie']))
{
	$_POST['descripsortie'] = htmlspecialchars($_POST['descripsortie'], ENT_NOQUOTES);
	$lienvalider++;
	if(preg_match($expression_r, $_POST['descripsortie']))
	{
		$_SESSION['message127'] = "";
		$_SESSION['descripsortie'] = $_POST['descripsortie'];
		$validation++;
	}else
	{
		$_SESSION['message127'] = "La description de votre sortie contient des caractères interdits.";
	}
}
if($validation == $lienvalider)
{
	if(!preg_match("#^[ ]*$#", $_POST['isortie']))
	{
		$req1 = $bdd->prepare('UPDATE sortie SET intitule = ? WHERE id_sortie = ?');
		$req1->execute(array($_POST['isortie'], $_SESSION['id_sortie']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['dureesortie']))
	{
		$req2 = $bdd->prepare('UPDATE sortie SET duree = ? WHERE id_sortie = ?');
		$req2->execute(array($_POST['dureesortie'], $_SESSION['id_sortie']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['ddrefsortie']))
	{
		$req3 = $bdd->prepare('UPDATE sortie SET ddref_sortie = ? WHERE id_sortie = ?');
		$req3->execute(array($_POST['ddrefsortie'], $_SESSION['id_sortie']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['vdressortie']))
	{
		$req4 = $bdd->prepare('UPDATE sortie SET vdres_sortie = ? WHERE id_sortie = ?');
		$req4->execute(array($_POST['vdressortie'], $_SESSION['id_sortie']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['dsortie']))
	{
		$req5 = $bdd->prepare('UPDATE sortie SET date = ? WHERE id_sortie = ?');
		$req5->execute(array($_POST['dsortie'], $_SESSION['id_sortie']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['hsortie']))
	{
		$req6 = $bdd->prepare('UPDATE sortie SET heure = ? WHERE id_sortie = ?');
		$req6->execute(array($_POST['hsortie'], $_SESSION['id_sortie']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['msortie']))
	{
		$req7 = $bdd->prepare('UPDATE sortie SET minute = ? WHERE id_sortie = ?');
		$req7->execute(array($_POST['msortie'], $_SESSION['id_sortie']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nbrpsortie']))
	{
		$req8 = $bdd->prepare('UPDATE sortie SET nbrparticipants = ? WHERE id_sortie = ?');
		$req8->execute(array($_POST['nbrpsortie'], $_SESSION['id_sortie']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['tarifsortie']))
	{
		$req9 = $bdd->prepare('UPDATE sortie SET tarif = ? WHERE id_sortie = ?');
		$req9->execute(array($_POST['tarifsortie'], $_SESSION['id_sortie']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['s_psortie']))
	{
		$req10 = $bdd->prepare('UPDATE sortie SET s_privative = ? WHERE id_sortie = ?');
		$req10->execute(array($_POST['s_psortie'], $_SESSION['id_sortie']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['descripsortie']))
	{
		$req11 = $bdd->prepare('UPDATE sortie SET description = ? WHERE id_sortie = ?');
		$req11->execute(array($_POST['descripsortie'], $_SESSION['id_sortie']));
	}
	header('Location: modifierlasortie.php'); 
}else
{
	header('Location: modifierlasortie.php');
}
?>