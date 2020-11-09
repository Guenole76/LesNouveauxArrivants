<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('navphoto.php');
if(isset($_POST['page']))
{
	$_SESSION['page'] = $_POST['page'];
}
if(!isset($_SESSION['page']))
{
	$_SESSION['page'] = 1; 
}
$limite = ($_SESSION['page'] - 1) * 10 + 1;
$limitefinale = $_SESSION['page'] * 10;
$req_sortie1 = $bdd->prepare('SELECT id_sortie FROM sortie WHERE lieu = ? AND valeur_sortie = ?');
$req_sortie1->execute(array(1, 1));
$donnees_sortie1 = $req_sortie1->fetch();
if(isset($donnees_sortie1['id_sortie']))
{
	do
	{
		$req_changement_valeur = $bdd->prepare('UPDATE inscrits_sortie SET valeur_membre = ? WHERE id_sortie = ?');
		$req_changement_valeur->execute(array(3, $donnees_sortie1['id_sortie']));
		$req_changement_valeur_sortie = $bdd->prepare('UPDATE sortie SET valeur_sortie = ? WHERE id_sortie = ?');
		$req_changement_valeur_sortie->execute(array(2, $donnees_sortie1['id_sortie']));
	}while($donnees_sortie1 = $req_sortie1->fetch());
}
$req1 = $bdd->prepare('SELECT ins_s.id_sortie id_sortie 
FROM inscrits_sortie AS ins_s LEFT JOIN sortie AS s ON ins_s.id_sortie = s.id_sortie
WHERE ins_s.id_membre = ? AND ins_s.valeur_membre BETWEEN 1 AND 2 AND s.lieu = ? ORDER BY s.date, s.heure, s.minute ');
$req1->execute(array($_SESSION['id'], 1));
$donnees1 = $req1->fetch();
$temps_limite = time() - 60 * 60 * 24;
$n = 1;
do
{
	$req2 = $bdd->prepare('SELECT id_membre_createur, intitule, vdres_sortie vdres, date, heure, minute, nbrparticipants nbrp, duree, tarif, s_privative FROM sortie WHERE id_sortie = ? AND date > ? AND valeur_sortie = ? ORDER BY date');
	$req2->execute(array($donnees1['id_sortie'], $temps_limite, 0));
	$donnees2 = $req2->fetch();
	if(isset($donnees2['date']))
	{
		if($_SESSION['id'] !== $donnees2['id_membre_createur'])
		{
			$reqnbri = $bdd->prepare('SELECT COUNT(id_membre) as nbri FROM inscrits_sortie WHERE id_sortie = ? AND valeur_membre = ?');
			$reqnbri->execute(array($donnees1['id_sortie'], 1));
			$donneesnbri = $reqnbri->fetch();
			$id_sortie[$n] = $donnees1['id_sortie'];
			$intitule[$n] = $donnees2['intitule'];
			$vdres[$n] = $donnees2['vdres'];
			$date[$n] = $donnees2['date'];
			$heure[$n] = $donnees2['heure'];
			$minute[$n] = $donnees2['minute'];
			$nbrpr[$n] = $donnees2['nbrp'] - $donneesnbri['nbri'];
			if($nbrpr[$n] < 0)
			{
				$mantantes[$n] = "place(s) manquante(s)";
			}else
			{
				$mantantes[$n] = "place(s) restante(s)";
			}
			$nbrpr[$n] = abs($nbrpr[$n]);
			$duree[$n] = $donnees2['duree'];
			$tarif[$n] = $donnees2['tarif'];
			if($donnees2['s_privative'] == 1)
			{
				$s_p[$n] = "Sortie privée";
			}else
			{
				$s_p[$n] = "Sortie publique";
			}
				$n++;
		}
	}
}while($donnees1 = $req1->fetch());
$req3 = $bdd->prepare('SELECT ins_s.id_sortie id_sortie FROM inscrits_sortie AS ins_s LEFT JOIN sortie AS s ON ins_s.id_sortie = s.id_sortie
WHERE ins_s.id_membre = ? AND s.id_membre_createur != ? AND s.lieu = ?');
$req3->execute(array($_SESSION['id'], $_SESSION['id'], 1));
$donnees3 = $req3->fetch();
$nbrsortie = 0;
if(isset($donnees3['id_sortie']))
{
	do
	{
		$req4 = $bdd->prepare('SELECT valeur_sortie FROM sortie WHERE id_sortie = ?');
		$req4->execute(array($donnees3['id_sortie']));
		$donnees4 = $req4->fetch();
		if($donnees4['valeur_sortie'] == 0)
		{
			$nbrsortie = $nbrsortie + 1;
		}
	}while($donnees3 = $req3->fetch());
}else
{
	$nbrsortie = 0;
}
$nbrpages = intval(($nbrsortie/10)) + 1;
$n = $n - 1;
if($n < $limitefinale)
{
	$m = $n;
}else
{
	$m = $limitefinale;
}
?>

<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Liste des sorties des lieux - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navsortie.php"); ?>
				</div>
				<div class="div2amais">
					<div class="div9cadre div10cadre">
						<h2>Liste des sorties des lieux</h2>
						<h3><a href="creationdesortie.php" class="aspo taille">Créer votre sortie</a></h3>
					</div>
						<?php 
							if($n >=  1)
							{
								for($i = $limite; $i <= $m; $i++)
								{
									$temps = date('d/m/Y', $date[$i]);
									echo "<div class='div9cadre div10cadre'><form method='post' action='traitementlistedessorties.php' class='form'>
										<label>" .$s_p[$i]. " <br/>" .$intitule[$i]. " le " .$temps. " à " .$vdres[$i]. " à partir de " .$heure[$i]. "h" .$minute[$i]. "<br/>
										pour une durée d'au moins " .$duree[$i]. "h et un tarif de " .$tarif[$i]. "€/pers. </label><br/>
										" .$nbrpr[$i]. " " .$mantantes[$i]. "<br/>
										<input type='hidden' name='id_sortie' value=" .$id_sortie[$i]. "/>
										<input type='submit' name='valider3' value='Afficher la sortie' class='boutonamais'/>
										</form></div>";
								}
							}else
							{
								echo "<div class='div9cadre div10cadre'>Il n'y a pas de sortie.</div>";
							}
						?>
					<div class="div9cadre div10cadre">
						<form method="post" action="liste_sorties_des_lieux.php" class="form">
						<?php
							for($i = 1; $i <= $nbrpages; $i++)
							{
								echo "<input type='submit' name='page' value=" .$i. " class='boutonamais'/>";
							}
						?>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>