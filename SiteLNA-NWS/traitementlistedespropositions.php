<?php 
session_start();
include('mysql.php');
if(isset($_POST['valider']))
{
	$_SESSION['id_demande'] = $_POST['id_demande'];
	$_SESSION['id_proposition'] = $_POST['id_proposition'];
	header('Location: presentationdelaproposition.php');
}else
{
	header('Location: liste_propositions_personnelles.php');
}