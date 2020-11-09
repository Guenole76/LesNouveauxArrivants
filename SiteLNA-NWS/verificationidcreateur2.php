<?php
	$req_id_co_orga = $bdd->prepare('SELECT valeur_co_orga FROM inscrits_sortie WHERE id_sortie = ? AND id_membre = ?');
	$req_id_co_orga->execute(array($_SESSION['id_sortie'], $_SESSION['id']));
	$donnees_id_co_orga = $req_id_co_orga->fetch();
	if(isset($_SESSION['id_membre_createur']))
	{
		if($_SESSION['id_membre_createur'] == $_SESSION['id'])
		{
			$verification = "C'est bon";
		}else
		{
			header('Location: profil.php');
		}
	}else
	{
		header('Location: profil.php');
	}
?>