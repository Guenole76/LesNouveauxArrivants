<?php 
session_start();
$_SESSION['id'] = 0;
unset($_SESSION['id_conversation']);
unset($_SESSION['id_inscrit']);
unset($_SESSION['id_sortie']);
unset($_SESSION['id']);
for($i = 0; $i <= 155; $i++)
{
	unset($_SESSION['message'.$i]);
}
unset($_SESSION['message157']);
if(empty($_SESSION['id']))
{
	header('Location: index.php'); 
}else
{
	header('Location: profil.php');
}
?>