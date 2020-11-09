<?php 
session_start();
include('mysql.php');
function random_str($id, $nbr)
{
	$str = $id;
	$chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHJKLMNOPQRSUTVWXYZ0123456789";
	$nb_chars = strlen($chaine);

	for($i=0; $i<$nbr; $i++)
	{
		$str .= $chaine[ rand(0, ($nb_chars-1)) ];
	}

	return $str;
}
if(isset($_SESSION['id_proposition']))
{
	if(isset($_POST['oui']))
	{
		$req1 = $bdd->prepare('SELECT * FROM demande WHERE id_demande = ?');
		$req1->execute(array($_SESSION['id_demande']));
		$donnees1 = $req1->fetch();
		
		$req2 = $bdd->prepare('SELECT id_repondant, id_demandeur, proposition FROM proposition WHERE id_proposition = ?');
		$req2->execute(array($_SESSION['id_proposition']));
		$donnees2 = $req2->fetch();
		
		$req3 = $bdd->prepare('SELECT l FROM inscrits WHERE id = ?');
		$req3->execute(array($donnees2['id_repondant']));
		$donnees3 = $req3->fetch();
		
		$code_sortie = random_str($_SESSION['id_proposition'], 10);
		$description = $donnees1['description']. " " .$donnees2['proposition'];
		
		$req4 = $bdd->prepare('INSERT INTO sortie (id_membre_createur, lieu, intitule, ddref_sortie,
		vdres_sortie, date, heure, minute, description, nbrparticipants, duree, tarif, id_demande, code_sortie, valeur_sortie) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$req4->execute(array($donnees2['id_repondant'], $donnees3['l'], $donnees1['intitule'], $donnees1['ddref'], $donnees1['vdres'],
		$donnees1['date'], $donnees1['heure'], $donnees1['minute'], $description, $donnees1['nbr_participants'], $donnees1['duree'], $donnees1['tarif'], $donnees1['id_demande'], $code_sortie, 0));
		
		$req5 = $bdd->prepare('SELECT id_relation FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req5->execute(array($donnees2['id_repondant'], $_SESSION['id_demandeur']));
		$donnees5 = $req5->fetch();
		
		if(isset($donnees5['id_relation']))
		{
			echo "Rien";
		}else
		{
			$req6 = $bdd->prepare('INSERT INTO sympathie (id_membre_s, id_membre_d, valeur_s) VALUES (?, ?, ?)');
			$req6->execute(array($donnees2['id_repondant'], $_SESSION['id_demandeur'], 1));
		}
		$req7 = $bdd->prepare('SELECT id_sortie FROM sortie WHERE code_sortie = ?');
		$req7->execute(array($code_sortie));
		$donnees7 = $req7->fetch();
		$req8 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
		$req8->execute(array($donnees7['id_sortie'], $_SESSION['id_demandeur'], 0, 2));
		$req9 = $bdd->prepare('UPDATE demande SET valeur_demande = ? WHERE id_demande = ?');
		$req9->execute(array(2, $donnees1['id_demande']));
		$req_supprimer_proposition = $bdd->prepare('UPDATE proposition SET valeur_proposition = ? WHERE id_proposition = ?');
		$req_supprimer_proposition->execute(array(2, $_SESSION['id_proposition']));
		unset($_SESSION['id_demande']);
		unset($_SESSION['id_proposition']);
		header('Location: liste_propositions_personnelles.php');
	}else
	{
		$req_supprimer_proposition = $bdd->prepare('UPDATE proposition SET valeur_proposition = ? WHERE id_proposition = ?');
		$req_supprimer_proposition->execute(array(2, $_SESSION['id_proposition']));
		unset($_SESSION['id_demande']);
		unset($_SESSION['id_proposition']);
		header('Location: liste_propositions_personnelles.php');
	}
}else
{
	header('Location: liste_propositions_personnelles.php');
}
?>