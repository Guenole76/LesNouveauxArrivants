<?php 
include('mysql.php');
date_default_timezone_set('UTC');
$req_liste_inscrit = $bdd->prepare('SELECT id, caem FROM inscrits WHERE val_email_j = ? AND valeur_inscrit = ?');
$req_liste_inscrit->execute(array(1, 1));
$donnees_liste_inscrit = $req_liste_inscrit->fetch();
$jour = time() - 60*60*18;
$jour1 = time() - 60*60*16;
$joursuivant = $jour + 60*60*24;
$joursuivant1 = $jour1 + 60*60*24;
if(isset($donnees_liste_inscrit['id']))
{
	do
	{
		$n = 0;
		$m = 0;
		$req_liste_sortie = $bdd->prepare('SELECT id_sortie FROM inscrits_sortie WHERE id_membre = ? AND valeur_membre < ?');
		$req_liste_sortie->execute(array($donnees_liste_inscrit['id'], 3));
		$donnees_liste_sortie = $req_liste_sortie->fetch();
		if(isset($donnees_liste_sortie['id_sortie']))
		{
			do
			{
				$req_liste_donnees_s = $bdd->prepare('SELECT date, heure, s_privative, valeur_sortie FROM sortie WHERE id_sortie = ?');
				$req_liste_donnees_s->execute(array($donnees_liste_sortie['id_sortie']));
				$donnees_s = $req_liste_donnees_s->fetch();
				if($donnees_s['valeur_sortie'] == 0)
				{
					if($donnees_s['s_privative'] == 1)
					{
						if($donnees_s['date'] > $jour AND $donnees_s['date'] < $jour1)
						{
							if($donnees_s['heure'] >= 17)
							{
								$n++;
							}
						}elseif($donnees_s['date'] > $joursuivant AND $donnees_s['date'] < $joursuivant1)
						{
							if($donnees_s['heure'] < 17)
							{
								$n++;
							}
						}
					}elseif($donnees_s['s_privative'] == 2)
					{
						if($donnees_s['date'] > $jour AND $donnees_s['date'] < $jour1)
						{
							if($donnees_s['heure'] >= 17)
							{
								$m++;
							}
						}elseif($donnees_s['date'] > $joursuivant AND $donnees_s['date'] < $joursuivant1)
						{
							if($donnees_s['heure'] < 17)
							{
								$m++;
							}
						}
					}
				}
			}while($donnees_liste_sortie = $req_liste_sortie->fetch());
		}
		$req_liste_donnees_spu_1 = $bdd->prepare('SELECT date, heure FROM sortie WHERE date < ? AND s_privative = ? AND valeur_sortie = ?');
		$req_liste_donnees_spu_1->execute(array($jour1,2,0));
		$donnees_spu_1 = $req_liste_donnees_spu_1->fetch();
		$spu1 = 0;
		if(isset($donnees_spu_1['date']))
		{
			do
			{
				if($donnees_spu_1['date'] > $jour)
				{
					if($donnees_spu_1['heure'] >= 17)
					{
						$spu1++;
					}
				}
			}while($donnees_spu_1 = $req_liste_donnees_spu_1->fetch());
		}
		$req_liste_donnees_spu_2 = $bdd->prepare('SELECT date, heure FROM sortie WHERE date < ? AND s_privative = ? AND valeur_sortie = ?');
		$req_liste_donnees_spu_2->execute(array($joursuivant1,2,0));
		$donnees_spu_2 = $req_liste_donnees_spu_2->fetch();
		$spu2 = 0;
		if(isset($donnees_spu_2['date']))
		{
			do
			{
				if($donnees_spu_2['date'] > $joursuivant)
				{
					if($donnees_spu_1['heure'] < 17)
					{
						$spu2++;
					}
				}
			}while($donnees_spu_2 = $req_liste_donnees_spu_2->fetch());
		}
		$spu = $spu1+ $spu2;
		if($spu == 0)
		{
			$m = "aucune sortie publique aura lieu.";
		}elseif($spu == 1)
		{
			if($m == 0)
			{
				$m = "une sortie publique aura lieu.";
			}elseif($m == 1)
			{
				$m = "une sortie publique aura lieu, et l'organisateur vous a invité.";
			}else
			{
				$m = "une sortie publique aura lieu.";
			}
		}else
		{
			if($m == 0)
			{
				$m =  $spu." sorties publiques auront lieu.";
			}elseif($m == 1)
			{
				$m =  $spu." sorties publiques auront lieu, et vous êtes invité à l'une d'entre elles.";
			}else
			{
				$m = $spu." sorties publiques auront lieu, et vous êtes invité à " .$m. " d'entre elles.";
			}
		}
		if($n == 0)
		{
			$n = "aucune sortie privée vous attend.";
		}elseif($n == 1)
		{
			$n = "une sortie privée vous attend.";
		}else
		{
			$n = $n." sorties privées vous attendent.";
		}
		$to = $donnees_liste_inscrit['caem'];
		$subject = "Annonce des prochaines sorties sur Les Nouveaux Arrivants";
		$message = "Dans les prochaines 24h, " .$m. " Et, en ce qui concerne les sorties privées, 
		" .$n. " N'hésitez pas à proposer des sorties, c'est gratuit ! Cliquez sur le lien suivant pour vous connecter: https://www.lesnouveauxarrivants.fr. Bonne soirée !";
		$message = wordwrap($message, 70, "\r\n", true);

	}while($donnees_liste_inscrit = $req_liste_inscrit->fetch());
}
?>