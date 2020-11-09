<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('navphoto.php');
$req1 = $bdd->prepare('SELECT id_sortie_type, intitule, ddref_sortie_type ddref, vdres_sortie_type vdres, description, nbrparticipants, duree, tarif, s_privative s_p, num_sortie_type numst 
FROM sortietype WHERE id_membre_createur = ?');
$req1->execute(array($_SESSION['id']));
$donnees1 = $req1->fetch();
$n = 1;
if(isset($donnees1['id_sortie_type']))
{ 
	do
	{
		$id_sortie_type[$n] = $donnees1['id_sortie_type'];	 
		$intitule[$n] = $donnees1['intitule'];
		$ddref[$n] = $donnees1['ddref'];
		$vdres[$n] = $donnees1['vdres'];
		$description[$n] = $donnees1['description'];
		$nbrp[$n] = $donnees1['nbrparticipants'];
		if($nbrp[$n] > 1)
		{
			$nbrp[$n] = $nbrp[$n]. " places";
		}else
		{
			$nbrp[$n] = $nbrp[$n]. " place";
		}
		$duree[$n] = $donnees1['duree'];
		$tarif[$n] = $donnees1['tarif'];
		if($donnees1['s_p'] == 1)
		{
			$s_p[$n] = "Sortie privée";
		}else
		{
			$s_p[$n] = "Sortie publique";
		}
		$numst[$n] = $donnees1['numst'];
		$n++;
	}while($donnees1 = $req1->fetch());
	$sortie_type = 1;
}else
{
	$sortie_type = "Vous n'avez créé aucune sortie type.";
}
$n = $n - 1;
?>

<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Choix de la sortie type - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navprofil.php"); ?>
				</div>
				<div class="div2amais">
					<div class="div9cadre div10cadre">
						<h2>Choix de la sortie type</h2>
					</div>
					<?php 
						if($sortie_type == 1)
						{
							for($i = 1; $i <= $n; $i++)
							{
								echo "<div class='div9cadre div10cadre'><form method='post' action='creerapartirdunesortietype.php' class='form'>
								<label><span class='taille' style='font-weight: bold;'>Sortie type " .$numst[$i]. " (" .$s_p[$i]. ")</span><br/>" .$intitule[$i]. " à " .$vdres[$i]. " avec " .$nbrp[$i]." pour une durée d'au moins " .$duree[$i]. "h et un tarif de " .$tarif[$i]. "€/pers. <br/> " .$description[$i]. "</label><br/>
								<input type='hidden' name='id_sortie_type' value=" .$id_sortie_type[$i]. " />
								<input type='submit' name='valider' value='Choisir cette sortie type' class='boutonamais'/>
								</form></div>";
							}
						}else
						{
							echo "<div class='div9cadre div10cadre'>" .$sortie_type. "</div>";
						}
					?>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>