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
	header('Location: modifierunesortietype.php');
}
if(!preg_match("#^[ ]*$#", $_POST['isortietype']))
{
	$lienvalider++;
	$_POST['isortietype'] = htmlspecialchars($_POST['isortietype'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['isortietype']))
	{
		$_SESSION['message118'] = "";
		$_SESSION['isortietype'] = $_POST['isortietype'];
		$validation++;
	}else
	{
		$_SESSION['message118'] = "Votre intitulé contient des caractères interdits.";
	}
}
if(!preg_match("#^[ ]*$#", $_POST['ddrefsortietype']))
{
	$_SESSION['message120'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['vdressortietype']))
{
	$_POST['vdressortietype'] = htmlspecialchars($_POST['vdressortietype'], ENT_NOQUOTES);
	$lienvalider++;
	if(preg_match($expression_r, $_POST['vdressortietype']))
	{
		$_SESSION['message121'] = "";
		$_SESSION['vdressortietype'] = $_POST['vdressortietype'];
		$validation++;
	}else
	{
		$_SESSION['message121'] = "La ville de résidence de votre sortie contient des caractères interdits.";
	}
}
if(!preg_match("#^[ ]*$#", $_POST['nbrpsortietype']))
{
	$_SESSION['message125'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['dureesortietype']))
{
	$_SESSION['message125'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['tarifsortietype']))
{
	$_SESSION['message126'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['s_psortietype']))
{
	$_SESSION['message116'] = "";
	$validation++;
	$lienvalider++;
}
if(!preg_match("#^[ ]*$#", $_POST['descripsortietype']))
{
	$_POST['descripsortietype'] = htmlspecialchars($_POST['descripsortietype'], ENT_NOQUOTES);
	$lienvalider++;
	if(preg_match($expression_r, $_POST['descripsortietype']))
	{
		$_SESSION['message127'] = "";
		$_SESSION['descripsortietype'] = $_POST['descripsortietype'];
		$validation++;
	}else
	{
		$_SESSION['message127'] = "La description de votre sortie contient des caractères interdits.";
	}
}
if($validation == $lienvalider)
{
	if(!preg_match("#^[ ]*$#", $_POST['isortietype']))
	{
		$req1 = $bdd->prepare('UPDATE sortietype SET intitule = ? WHERE id_sortie_type = ?');
		$req1->execute(array($_POST['isortietype'], $_SESSION['idst']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['dureesortietype']))
	{
		$req2 = $bdd->prepare('UPDATE sortietype SET duree = ? WHERE id_sortie_type = ?');
		$req2->execute(array($_POST['dureesortietype'], $_SESSION['idst']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['ddrefsortietype']))
	{
		$req3 = $bdd->prepare('UPDATE sortietype SET ddref_sortie_type = ? WHERE id_sortie_type = ?');
		$req3->execute(array($_POST['ddrefsortietype'], $_SESSION['idst']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['vdressortietype']))
	{
		$req4 = $bdd->prepare('UPDATE sortietype SET vdres_sortie_type = ? WHERE id_sortie_type = ?');
		$req4->execute(array($_POST['vdressortietype'], $_SESSION['idst']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nbrpsortietype']))
	{
		$req8 = $bdd->prepare('UPDATE sortietype SET nbrparticipants = ? WHERE id_sortie_type = ?');
		$req8->execute(array($_POST['nbrpsortietype'], $_SESSION['idst']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['tarifsortietype']))
	{
		$req9 = $bdd->prepare('UPDATE sortietype SET tarif = ? WHERE id_sortie_type = ?');
		$req9->execute(array($_POST['tarifsortietype'], $_SESSION['idst']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['s_psortietype']))
	{
		$req10 = $bdd->prepare('UPDATE sortietype SET s_privative = ? WHERE id_sortie_type = ?');
		$req10->execute(array($_POST['s_psortietype'], $_SESSION['idst']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['descripsortietype']))
	{
		$req11 = $bdd->prepare('UPDATE sortietype SET description = ? WHERE id_sortie_type = ?');
		$req11->execute(array($_POST['descripsortietype'], $_SESSION['idst']));
	}
	header('Location: modifierunesortietype.php'); 
}else
{
	header('Location: modifierunesortietype.php');
}
?>