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
$limit = ($_SESSION['page'] - 1) * 10;
$temps_limite = time() - 60 * 60 * 36;
$req1 = $bdd->prepare('SELECT id_sortie, intitule, vdres_sortie vdres, date, heure, minute, nbrparticipants nbrp, duree, tarif, s_privative 
FROM sortie 
WHERE id_membre_createur = ? AND date > ? 
ORDER BY date, heure, minute
LIMIT '.$limit.', 10');
$req1->execute(array($_SESSION['id'], $temps_limite));
$donnees1 = $req1->fetch();
$n = 1;
if(isset($donnees1['id_sortie']))
{ 
	do
	{
		$reqnbri = $bdd->prepare('SELECT COUNT(id_membre) as nbri FROM inscrits_sortie WHERE id_sortie = ? AND valeur_membre = ?');
		$reqnbri->execute(array($donnees1['id_sortie'], 1));
		$donneesnbri = $reqnbri->fetch();
		$id_sortie[$n] = $donnees1['id_sortie'];	 
		$intitule[$n] = $donnees1['intitule'];
		$vdres[$n] = $donnees1['vdres'];
		$date[$n] = date('d/m/Y', $donnees1['date']);
		$heure[$n] = $donnees1['heure'];
		$minute[$n] = $donnees1['minute'];
		$nbrpr[$n] = $donnees1['nbrp'] - $donneesnbri['nbri'];
		if($nbrpr[$n] < 0)
		{
			$mantantes[$n] = "place(s) manquante(s)";
		}else
		{
			$mantantes[$n] = "place(s) restante(s)";
		}
		$nbrpr[$n] = abs($nbrpr[$n]); 
		$duree[$n] = $donnees1['duree'];
		$tarif[$n] = $donnees1['tarif'];
		if($donnees1['s_privative'] == 1)
		{
			$s_p[$n] = "Sortie privée";
		}else
		{
			$s_p[$n] = "Sortie publique";
		}
		$n++;
	}while($donnees1 = $req1->fetch());
	$sortie = 1;
}else
{
	$sortie = "Vous n'organisez aucune sortie.";
}
$req2 = $bdd->prepare('SELECT COUNT(*) as nbr_sortie FROM sortie WHERE id_membre_createur = ? AND date > ? AND valeur_sortie = ?');
$req2->execute(array($_SESSION['id'], $temps_limite, 0));
$donnees2 = $req2->fetch();
$nbrpages = intval(($donnees2['nbr_sortie']/10)) + 1; 
$n = $n - 1;
?>

<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Liste des sorties organisées par vous - Les Nouveaux Arrivants</title>
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
						<h2>Liste des sorties que vous organisez</h2>
						<h3><a href="creationdesortie.php" class="aspo taille">Créer votre sortie</a></h3>
					</div>
					<?php 
						if($sortie == 1)
						{
							for($i = 1; $i <= $n; $i++)
							{
								echo "<div class='div9cadre div10cadre'><form method='post' action='traitementlistedessorties.php' class='form'>
								<label>" .$s_p[$i]. " <br/>" .$intitule[$i]. " le " .$date[$i]. " à " .$vdres[$i]. " à partir de " .$heure[$i]. "h" .$minute[$i]. "<br/>
								pour une durée d'au moins " .$duree[$i]. "h et un tarif de " .$tarif[$i]. "€/pers. </label><br/>
								" .$nbrpr[$i]. " " .$mantantes[$i]. "<br/>
								<input type='hidden' name='id_sortie' value=" .$id_sortie[$i]. " />
								<input type='submit' name='valider1' value='Afficher la sortie' class='boutonamais'/>
								</form></div>";
							}
						}else
						{
							echo "<div class='div9cadre div10cadre'>" .$sortie. "</div>";
						}
					?>
					<div class="div9cadre div10cadre div11cadre">
						<form method="post" action="liste_sorties_organisees_par_vous.php" class="form">
						<?php
							for($i = 1; $i <= $nbrpages; $i++)
							{
								echo "<input type='submit' name='page' value=" .$i. "  class='boutonamais'/>";
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