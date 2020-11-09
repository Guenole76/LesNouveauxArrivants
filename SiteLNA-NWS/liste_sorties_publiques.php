<?php 
session_start();
include('mysql.php');
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
$req1 = $bdd->prepare('SELECT id_sortie FROM sortie WHERE s_privative = ? AND valeur_sortie = ? ORDER BY date, heure, minute');
$req1->execute(array(2, 0));
$donnees1 = $req1->fetch();
$temps_limite = time() - 60 * 60 * 24;
$n = 1;
do
{
	$req2 = $bdd->prepare('SELECT id_membre_createur, intitule, vdres_sortie vdres, date, heure, minute, nbrparticipants nbrp, duree, tarif FROM sortie WHERE id_sortie = ? AND date > ? AND valeur_sortie = ? ORDER BY date');
	$req2->execute(array($donnees1['id_sortie'], $temps_limite, 0));
	$donnees2 = $req2->fetch();
	if(isset($donnees2['date']))
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
		if($nbrpr[$n] < -1)
		{
			$mantantes[$n] = "places manquantes";
		}elseif($nbrpr[$n] == -1)
		{
			$mantantes[$n] = "place manquante";
		}elseif($nbrpr[$n] == 0)
		{
			$mantantes[$n] = "place restante";
		}elseif($nbrpr[$n] == 1)
		{
			$mantantes[$n] = "place restante";
		}elseif($nbrpr[$n] > 1)
		{
			$mantantes[$n] = "places restantes";
		}
		$nbrpr[$n] = abs($nbrpr[$n]); 
		$duree[$n] = $donnees2['duree'];
		$tarif[$n] = $donnees2['tarif'];
		$n++;
	}
}while($donnees1 = $req1->fetch());
$req3 = $bdd->prepare('SELECT COUNT(id_sortie) as nbr_sortie FROM sortie WHERE date > ? AND s_privative = ? AND valeur_sortie = ?');
$req3->execute(array($temps_limite, 2, 0));
$donnees3 = $req3->fetch();
$nbrpages = intval(($donnees3['nbr_sortie']/10)) + 1; 
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
		<title>Liste des sorties publiques - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php 
		if(isset($_SESSION['id']))
		{
			include("headerc.php");
		}else
		{
			include("headernc.php");
		}
		?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php 
						if(isset($_SESSION['id']))
						{
							include("navsortie.php");
						}else
						{
							echo '<div class="div9cadre div11cadre div12cadre taille">Seuls les membres du site ont accès aux détails des sorties<br/>
							<a href="inscription.php" class="aspo">Inscrivez-vous</a></div>';
						}
					?>
				</div>
				<div class="div2amais">
					<div class="div9cadre div10cadre">
						<h2>Liste des sorties publiques</h2>
						<h3><a href="creationdesortie.php" class="aspo taille">Créer votre sortie</a></h3>
					</div>
						<?php 
							if($n >= 1)
							{
								for($i = $limite; $i <= $m; $i++)
								{
									$temps = date('d/m/Y', $date[$i]);
									echo "<div class='div9cadre div10cadre'><form method='post' action='traitementlistedessorties.php' class='form'>
										<label>" .$intitule[$i]. " le " .$temps. " à " .$vdres[$i]. " à partir de " .$heure[$i]. "h" .$minute[$i]. "<br/>
										pour une durée d'au moins " .$duree[$i]. "h et un tarif de " .$tarif[$i]. "€/pers. </label><br/>
										" .$nbrpr[$i]. " " .$mantantes[$i]. "<br/>
										<input type='hidden' name='id_sortie' value=" .$id_sortie[$i]. "/>
										<input type='submit' name='valider4' value='Afficher la sortie' class='boutonamais'/>
										</form></div>";
								}
							}else
							{
								echo "<div class='div9cadre div10cadre'>Il n'y a pas de sortie.</div>";
							}
						?>
					<div class="div9cadre div10cadre">
						<form method="post" action="liste_sorties_publiques.php" class="form">
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