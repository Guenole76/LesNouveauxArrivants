<?php
session_start();
include('mysql.php');
if(isset($_GET['cid']))
{
	$temps_abo = time() + 60*60*24*30.5;
	$req1 = $bdd->prepare('UPDATE duree_abonnement SET timestamp_partage = ? WHERE cid = ?');
	$req1->execute(array($temps_abo, $_GET['cid']));
	header('Location: index.php');
}
?>