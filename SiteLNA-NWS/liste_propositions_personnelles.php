<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('navphoto.php');
unset($_SESSION['id_proposition']);
unset($_SESSION['id_demande']);
if(isset($_POST['page']))
{
	$_SESSION['page'] = $_POST['page'];
}
if(!isset($_SESSION['page']))
{
	$_SESSION['page'] = 1; 
}
$limite = ($_SESSION['page'] - 1) * 10;
$limitefinale = $_SESSION['page'] * 10;
$temps_limite = time();
$req1 = $bdd->prepare('SELECT de.id_demande id_demande, de.intitule intitule, de.vdres vdres, de.date date, de.heure heure, de.minute minute, de.nbr_participants nbrp, de.duree duree, de.tarif tarif, de.s_privative s_privative FROM demande AS de LEFT JOIN proposition AS pro ON de.id_demande = pro.id_demande
WHERE pro.id_repondant = ? AND de.date > ? AND pro.valeur_proposition = ? ORDER BY de.date');
$req1->execute(array($_SESSION['id'], $temps_limite, 1));
$donnees1 = $req1->fetch();
$req1b = $bdd->prepare('SELECT pro.id_proposition id FROM demande AS de RIGHT JOIN proposition AS pro ON de.id_demande = pro.id_demande
WHERE pro.id_repondant = ? AND de.date > ? AND pro.valeur_proposition = ? ORDER BY date');
$req1b->execute(array($_SESSION['id'], $temps_limite, 1));
$donnees1b = $req1b->fetch();
$n = 1;
if(isset($donnees1['id_demande']))
{	
	do
	{
		$id_demande[$n] = $donnees1['id_demande'];
		$intitule[$n] = $donnees1['intitule'];
		$vdres[$n] = $donnees1['vdres'];
		$date[$n] = $donnees1['date'];
		$heure[$n] = $donnees1['heure'];
		$minute[$n] = $donnees1['minute'];
		$nbrp[$n] = $donnees1['nbrp'];
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
}
$m = 1;
if(isset($donnees1b['id']))
{	
	do
	{
		$id_proposition[$m] = $donnees1b['id'];
		$m++;
	}while($donnees1b = $req1b->fetch());
}
$req2 = $bdd->prepare('SELECT COUNT(de.id_demande) nbr_proposition FROM demande as de LEFT JOIN proposition as pro ON de.id_demande = pro.id_demande
WHERE pro.id_repondant = ? AND de.date > ? AND pro.valeur_proposition = ?');
$req2->execute(array($_SESSION['id'], $temps_limite, 1));
$donnees2 = $req2->fetch();
if(isset($donnees2['nbr_proposition']))
{
	$nbrproposition = $donnees2['nbr_proposition'];
}else
{
	$nbrproposition = 0; 
}
$nbrpages = intval(($nbrproposition/10)) + 1;
$n = $n - 1;
if($n < $limitefinale)
{
	$m = $n;
}else
{
	$m = $limitefinale;
}
$limite = $limite + 1; 
?>

<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Liste de vos propositions personnelles - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navsortie.php"); ?>
					<?php include("nav_proposition.php"); ?>
				</div>
				<div class="div2amais">
					<div class="div9cadre div10cadre">
						<h2>Liste de vos propositions personnelles</h2>
					</div>
						<?php 
							if($m >= $limite)
							{
								for($i = $limite; $i <= $m; $i++)
								{
									$temps = date('d/m/Y', $date[$i]);
									echo "<div class='div9cadre div10cadre'><form method='post' action='traitementlistedespropositions.php' class='form'>
										<label>" .$s_p[$i]. " <br/>" .$intitule[$i]. " le " .$temps. " à " .$vdres[$i]. " à partir de " .$heure[$i]. "h" .$minute[$i]. "<br/>
										pour une durée d'au moins " .$duree[$i]. "h, avec " .$nbrp[$i]. " participants, et un tarif de " .$tarif[$i]. "€/pers.</label><br/>
										<input type='hidden' name='id_demande' value=" .$id_demande[$i]. " />
										<input type='hidden' name='id_proposition' value=" .$id_proposition[$i]. " />
										<input type='submit' name='valider' value='Afficher la proposition' class='boutonamais'/>
										</form></div>";
								}
							}else
							{
								echo "<div class='div9cadre div10cadre'>Il n'y a pas de proposition.</div>";
							}
						?>
					<div class="div9cadre div10cadre">
						<form method="post" action="liste_propositions_personnelles.php" class="form">
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