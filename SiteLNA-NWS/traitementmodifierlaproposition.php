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
if(!preg_match("#^[ ]*$#", $_POST['proposition']))
{
	$_POST['proposition'] = htmlspecialchars($_POST['proposition'], ENT_NOQUOTES);
	$lienvalider++;
	if(preg_match($expression_r, $_POST['proposition']))
	{
		$_SESSION['message127'] = "";
		$_SESSION['proposition'] = $_POST['proposition'];
		$validation++;
	}else
	{
		$_SESSION['message127'] = "La proposition contient des caractères interdits.";
	}
}
if($validation == $lienvalider)
{
	if(!preg_match("#^[ ]*$#", $_POST['proposition']))
	{
		$req10 = $bdd->prepare('UPDATE proposition SET proposition = ? WHERE id_proposition = ?');
		$req10->execute(array($_POST['proposition'], $_SESSION['id_proposition']));
	}
	header('Location: modifierlaproposition.php'); 
}else
{
	header('Location: modifierlaproposition.php');
}
?>