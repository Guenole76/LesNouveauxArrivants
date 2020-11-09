<?php 
session_start();
include('expression_r.php');
$validation = 0;
$lienvalider = 0;
if(isset($_POST['valider']))
{
	$_SESSION['message152'] = "";
}else
{
	$_SESSION['message152'] = "Vous n'avez pas cliqué sur le bouton Envoyer";
	header('Location: contact.php');
}
if(!preg_match("#^[ ]*$#", $_POST['aem']))
{
	$lienvalider++;
	if(preg_match(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['aem']))
	{
		$_POST['aem'] = htmlspecialchars($_POST['aem'], ENT_NOQUOTES);
		$_SESSION['message156'] = "";
		$_SESSION['aem'] = $_POST['aem'];
		$validation++;
	}else
	{
		$_SESSION['message156'] = "Votre adresse email contient des caractères interdits";
	}
}else
{
	$_SESSION['aem'] = "Pas d'adresse mail";
}
if(!preg_match("#^[ ]*$#", $_POST['sujet']))
{
	$lienvalider++;
	if(preg_match($expression_r, $_POST['sujet']))
	{
		$_POST['sujet'] = htmlspecialchars($_POST['sujet'], ENT_NOQUOTES);
		$_SESSION['message153'] = "";
		$_SESSION['sujet'] = $_POST['sujet'];
		$validation++;
	}else
	{
		$_SESSION['message153'] = "Votre sujet contient des caractères interdits";
	}
}else
{
	$_SESSION['sujet'] = "Pas de sujet";
}
if(!preg_match("#^[ ]*$#", $_POST['messagec']))
{
	$lienvalider++;
	if(preg_match($expression_r, $_POST['messagec']))
	{
		$_POST['messagec'] = htmlspecialchars($_POST['messagec'], ENT_NOQUOTES);
		$_SESSION['message154'] = "";
		$_SESSION['message155'] = "";
		$_SESSION['messagec'] = $_POST['messagec'];
		$validation++;
	}else
	{
		$_SESSION['message154'] = "Votre message contient des caractères interdits";
	}
}else
{
	$_SESSION['message155'] = "Il n'y a pas de message";
}
if($validation == $lienvalider)
{
	if(!preg_match("#^[ ]*$#", $_SESSION['messagec']))
	{
		$to = "communication.comealamaison@outlook.com";
		$_SESSION['messagec'] = wordwrap($_SESSION['messagec'], 70, "\r\n", true);
		$_SESSION['sujet'] .= "-" .$_SESSION['aem']; 
		mail($to, $_SESSION['sujet'], $_SESSION['messagec']);
		header('Location: contact.php'); 
	}else
	{
		header('Location: contact.php'); 
	}
}else
{
	header('Location: contact.php');
}
?>