<?php 
$timestamp_actuel = time();
$req_abonnement = $bdd->prepare('SELECT timestamp_partage FROM duree_abonnement WHERE id_membre = ?');
$req_abonnement->execute(array($_SESSION['id']));
$donnees_changement = $req_abonnement->fetch();
if(isset($donnees_changement['timestamp_partage']))
{
	if($donnees_changement['timestamp_partage'] > $timestamp_actuel)
	{
		$req_changement = $bdd->prepare('UPDATE inscrits SET abonnement_en_cours = ? WHERE id = ?');
		$req_changement->execute(array('Partage', $_SESSION['id']));
	}else
	{
		$req_changement = $bdd->prepare('UPDATE inscrits SET abonnement_en_cours = ? WHERE id = ?');
		$req_changement->execute(array('Echanges', $_SESSION['id']));
		$req_changement_lieu = $bdd->prepare('UPDATE inscrits SET l = ? WHERE id = ?');
		$req_changement_lieu->execute(array(2, $_SESSION['id']));
	}
}else
{
	$req_creation = $bdd->prepare('INSERT INTO duree_abonnement(id_membre, timestamp_partage, validation_abo) VALUES(?, ?, ?)');
	$req_creation->execute(array($_SESSION['id'], $timestamp_actuel, 3));
}
?>