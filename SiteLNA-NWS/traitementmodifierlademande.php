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
	header('Location: modifierlademande.php');
}
if(!preg_match("#^[ ]*$#", $_POST['idemande']))
{
	$lienvalider++;
	$_POST['idemande'] = htmlspecialchars($_POST['idemande'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['idemande']))
	{
		$_SESSION['message118'] = "";
		$_SESSION['idemande'] = $_POST['idemande'];
		$validation++;
	}else
	{
		$_SESSION['message118'] = "Votre intitulé contient des caractères interdits.";
	}
}
if(!preg_match("#^[ ]*$#", $_POST['ddrefdemande']))
{
	$_SESSION['message120'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['vdresdemande']))
{
	$_POST['vdresdemande'] = htmlspecialchars($_POST['vdresdemande'], ENT_NOQUOTES);
	$lienvalider++;
	if(preg_match($expression_r, $_POST['vdresdemande']))
	{
		$_SESSION['message121'] = "";
		$_SESSION['vdresdemande'] = $_POST['vdresdemande'];
		$validation++;
	}else
	{
		$_SESSION['message121'] = "La ville de résidence de votre demande contient des caractères interdits.";
	}
}
if(!preg_match("#^[ ]*$#", $_POST['ddemande']))
{
	$_POST['ddemande'] = strtotime($_POST['ddemande']);
	$_SESSION['message122'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['hdemande']))
{
	$_SESSION['message123'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['mdemande']))
{
	$_SESSION['message124'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nbrpdemande']))
{
	$_SESSION['message125'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['dureedemande']))
{
	$_SESSION['message125'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['tarifdemande']))
{
	$_SESSION['message126'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['s_pdemande']))
{
	$_SESSION['message116'] = "";
	$validation++;
	$lienvalider++;
}
if(!preg_match("#^[ ]*$#", $_POST['icdemande']))
{
	$_POST['icdemande'] = htmlspecialchars($_POST['icdemande'], ENT_NOQUOTES);
	$lienvalider++;
	if(preg_match($expression_r, $_POST['icdemande']))
	{
		$_SESSION['message127'] = "";
		$_SESSION['icdemande'] = $_POST['icdemande'];
		$validation++;
	}else
	{
		$_SESSION['message127'] = "Les informations complémentaires de votre demande contient des caractères interdits.";
	}
}
if($validation == $lienvalider)
{
	if(!preg_match("#^[ ]*$#", $_POST['idemande']))
	{
		$req1 = $bdd->prepare('UPDATE demande SET intitule = ? WHERE id_demande = ?');
		$req1->execute(array($_POST['idemande'], $_SESSION['id_demande']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['dureedemande']))
	{
		$req2 = $bdd->prepare('UPDATE demande SET duree = ? WHERE id_demande = ?');
		$req2->execute(array($_POST['dureedemande'], $_SESSION['id_demande']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['ddrefdemande']))
	{
		$req3 = $bdd->prepare('UPDATE demande SET ddref = ? WHERE id_demande = ?');
		$req3->execute(array($_POST['ddrefdemande'], $_SESSION['id_demande']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['vdresdemande']))
	{
		$req4 = $bdd->prepare('UPDATE demande SET vdres = ? WHERE id_demande = ?');
		$req4->execute(array($_POST['vdresdemande'], $_SESSION['id_demande']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['ddemande']))
	{
		$req5 = $bdd->prepare('UPDATE demande SET date = ? WHERE id_demande = ?');
		$req5->execute(array($_POST['ddemande'], $_SESSION['id_demande']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['hdemande']))
	{
		$req6 = $bdd->prepare('UPDATE demande SET heure = ? WHERE id_demande = ?');
		$req6->execute(array($_POST['hdemande'], $_SESSION['id_demande']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['mdemande']))
	{
		$req7 = $bdd->prepare('UPDATE demande SET minute = ? WHERE id_demande = ?');
		$req7->execute(array($_POST['mdemande'], $_SESSION['id_demande']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nbrpdemande']))
	{
		$req8 = $bdd->prepare('UPDATE demande SET nbr_participants = ? WHERE id_demande = ?');
		$req8->execute(array($_POST['nbrpdemande'], $_SESSION['id_demande']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['tarifdemande']))
	{
		$req9 = $bdd->prepare('UPDATE demande SET tarif = ? WHERE id_demande = ?');
		$req9->execute(array($_POST['tarifdemande'], $_SESSION['id_demande']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['s_pdemande']))
	{
		$req10 = $bdd->prepare('UPDATE demande SET s_privative = ? WHERE id_demande = ?');
		$req10->execute(array($_POST['s_pdemande'], $_SESSION['id_demande']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['icdemande']))
	{
		$req11 = $bdd->prepare('UPDATE demande SET description = ? WHERE id_demande = ?');
		$req11->execute(array($_POST['icdemande'], $_SESSION['id_demande']));
	}
	header('Location: modifierlademande.php'); 
}else
{
	header('Location: modifierlademande.php');
}
?>