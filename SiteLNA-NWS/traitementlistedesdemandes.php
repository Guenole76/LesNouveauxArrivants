<?php 
session_start();
include('mysql.php');
if(isset($_POST['valider']))
{
	$_SESSION['id_demande'] = $_POST['id_demande'];
	header('Location: presentationdelademande.php');
}else
{
	header('Location: liste_demandes_personnelles.php');
}