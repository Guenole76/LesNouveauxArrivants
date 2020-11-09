<?php 
session_start();
include('mysql.php');
if(isset($_POST['valider']))
{
	$_SESSION['id_inscrit'] = $_POST['id_membre'];
	header('Location: presentationprofil.php');
}elseif(isset($_POST['retirer']))
{
	$req1 = $bdd->prepare('DELETE FROM inscrits_sortie WHERE id_sortie = ? AND id_membre = ?');
	$req1->execute(array($_SESSION['id_sortie'], $_POST['id_membre']));
	header('Location: retirerdesinscrits.php');
}else
{
	header('Location: profil.php');
}
?>