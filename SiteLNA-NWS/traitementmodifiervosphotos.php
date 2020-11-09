<?php 
session_start();
include('mysql.php');
$validation = 0; 
$lienvalider = 0; 
if(isset($_POST['valider']))
{
	$_SESSION['message1'] = "";
}else
{
	$_SESSION['message1'] = "Vous n'avez pas cliqué sur le bouton de modification.";
	header('Location: modifierlesinformations.php');
}
if(!preg_match("#^[ ]*$#", $_POST['photodep1']))
{
	$_SESSION['message2'] = "";
	$lienvalider++;
	$validation++; 
}
if(!preg_match("#^[ ]*$#", $_POST['photodep2']))
{
	$_SESSION['message3'] = "";
	$lienvalider++;
	$validation++; 
}
if($_POST['photodep1'] == $_POST['photodep2'])
{
	$lienvalider++;
	$_SESSION['message4'] = "Vos deux photos de profil sont identiques";
}else
{
	$lienvalider++;
	$validation++;
	$_SESSION['message4'] = "";
}
if($lienvalider == $validation)
{
	if(!preg_match("#^[ ]*$#", $_POST['photodep1']))
	{
		$req1_2 = $bdd->prepare('SELECT photodep2 FROM inscrits WHERE id = ?');
		$req1_2->execute(array($_SESSION['id']));
		$donnees1_2 = $req1_2->fetch();
		$_POST['photodep1'] .= ".JPG";
		if($_POST['photodep1'] == $donnees1_2['photodep2'])
		{
			$_SESSION['message5'] = "Vos deux photos de profil sont identiques";	
		}else
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET photodep1 = ? WHERE id = ?');
			$req1->execute(array($_POST['photodep1'], $_SESSION['id']));
		}
	}
	if(!preg_match("#^[ ]*$#", $_POST['photodep2']))
	{
		$req2_2 = $bdd->prepare('SELECT photodep1 FROM inscrits WHERE id = ?');
		$req2_2->execute(array($_SESSION['id']));
		$donnees2_2 = $req2_2->fetch();
		$_POST['photodep2'] .= ".JPG";
		if($_POST['photodep2'] == $donnees2_2['photodep1'])
		{
			$_SESSION['message6'] = "Vos deux photos de profil sont identiques";	
		}else
		{
			$req2 = $bdd->prepare('UPDATE inscrits SET photodep2 = ? WHERE id = ?');
			$req2->execute(array($_POST['photodep2'], $_SESSION['id']));
		}
	}
	header('Location: modifiervosphotos.php');
}else
{
	header('Location: modifiervosphotos.php');
}
?>