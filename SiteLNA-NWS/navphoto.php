<?php
$reqphoto = $bdd->prepare('SELECT surnom1, l, nom_l, photodep1, photodep2, photo_l, nv_relationnel FROM inscrits WHERE id = ?');
$reqphoto->execute(array($_SESSION['id']));
$donneesphoto = $reqphoto->fetch();
if(isset($donneesphoto['photodep1']))
{
	if($donneesphoto['l'] == 1)
	{
		$photo = '<img src="dossierphotosdeslieux\\'. $donneesphoto['photo_l'] .' " height="200" width="200" alt="Votre photo de profil" title="Votre photo de profil" /></br>' ;
	}else
	{
		if($donneesphoto['photodep1'] !== 0)
		{
			$photo = '<img src="listephotosdeprofil\\'. $donneesphoto['photodep1'] .' " height="200" width="200" alt="Votre photo de profil" title="Votre photo de profil" /></br>' ;
		}else
		{
			$photo = ""; 
		}
	}
}else
{
	$photo = "";
}
?>