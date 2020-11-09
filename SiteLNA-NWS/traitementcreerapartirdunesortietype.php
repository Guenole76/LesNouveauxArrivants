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
	header('Location: creerapartirdunesortietype.php');
}
if(isset($_SESSION['idstc']))
{
	$req1b = $bdd->prepare('SELECT * FROM sortietype WHERE id_sortie_type = ?');
	$req1b->execute(array($_SESSION['idstc']));
	$donnees1b = $req1b->fetch();
}else
{
	header('Location: choixdesortietype.php');
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
if($validation == 3)
{
		$req = $bdd->prepare('INSERT INTO sortie (id_membre_createur, lieu, intitule, ddref_sortie,
		vdres_sortie, date, heure, minute, description, nbrparticipants, duree, tarif, s_privative, id_demande, code_sortie, valeur_sortie) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$req->execute(array($_SESSION['id'], $donnees1['l'], $donnees1b['intitule'], $donnees1b['ddref_sortie_type'],
		$donnees1b['vdres_sortie_type'], $_POST['dsortie'], $_POST['hsortie'], $_POST['msortie'], $donnees1b['description'], $donnees1b['nbrparticipants'], $donnees1b['duree'], $donnees1b['tarif'], $donnees1b['s_privative'], 0, "", 0));
		header('Location: liste_sorties_organisees_par_vous.php');
}else
{
	header('Location: creationdesortie.php');
}
?>