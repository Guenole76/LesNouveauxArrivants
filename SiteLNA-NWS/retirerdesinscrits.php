<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('verificationidcreateur2.php');
include('navphoto.php');
$req1 = $bdd->prepare('SELECT id_membre FROM inscrits_sortie WHERE id_sortie = ? AND valeur_membre = ?');
$req1->execute(array($_SESSION['id_sortie'], 1));
$donnees1 = $req1->fetch();
$req2 = $bdd->prepare('SELECT COUNT(id_membre) as nbr_membre FROM inscrits_sortie WHERE id_sortie = ? AND valeur_membre = ?');
$req2->execute(array($_SESSION['id_sortie'], 1));
$donnees2 = $req2->fetch();
$n = 1;
if(isset($donnees1['id_membre']))
{ 
	do
	{
		$req3 = $bdd->prepare('SELECT id, surnom1, surnom2, l, nom_l FROM inscrits WHERE id = ?');
		$req3->execute(array($donnees1['id_membre']));
		$donnees3 = $req3->fetch();
		$req3_2 = $bdd->prepare('SELECT surnom3 s3, validations3 vds3, points_de_relation pdr, groupe_relationnel gr 
		FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req3_2->execute(array($_SESSION['id'], $donnees1['id_membre']));
		$donnees3_2 = $req3_2->fetch();
		if(isset($donnees3_2['s3']))
		{
			if($donnees3_2['gr'] >= 2)
			{
				if($donnees3_2['vds3'] == 1)
				{
					$id[$n] = $donnees1['id_membre'];
					$surnom[$n] = $donnees3_2['s3'];
				}else
				{
					if($donnees3['l'] == 1)
					{
						$id[$n] = $donnees1['id_membre'];
						$surnom[$n] = $donnees3['nom_l'];
					}else
					{
						if($donnees3_2['pdr'] >= 50)
						{
							$id[$n] = $donnees1['id_membre'];
							$surnom[$n] = $donnees3['surnom2'];
						}else
						{
							$id[$n] = $donnees1['id_membre'];
							$surnom[$n] = $donnees3['surnom1'];
						}
					}
						
				}
			}else
			{
				if($donnees3['l'] == 1)
				{
					$id[$n] = $donnees1['id_membre'];
					$surnom[$n] = $donnees3['nom_l'];
				}else
				{
					if($donnees3_2['pdr'] >= 50)
					{
						$id[$n] = $donnees1['id_membre'];
						$surnom[$n] = $donnees3['surnom2'];
					}else
					{
						$id[$n] = $donnees1['id_membre'];
						$surnom[$n] = $donnees3['surnom1'];
					}
				}
			}
		}else
		{
			if($donnees3['l'] == 1)
			{
				$id[$n] = $donnees1['id_membre'];
				$surnom[$n] = $donnees3['nom_l'];
			}else
			{
				if($donnees3_2['pdr'] >= 50)
				{
					$id[$n] = $donnees1['id_membre'];
					$surnom[$n] = $donnees3['surnom2'];
				}else
				{
					$id[$n] = $donnees1['id_membre'];
					$surnom[$n] = $donnees3['surnom1'];
				}
			}
		}
		$n++;
	}while($donnees1 = $req1->fetch());
	$inscrits = 1;
}else
{
	$inscrits = "Il n'y a pas d'inscrit"; 
}
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Retirer des inscrits - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navsortie.php"); ?>
					<?php include("navvoirlasortie.php"); ?>
				</div>
				<div class="div2amais">
					<div class="div9cadre div10cadre">
						<h2>Retirer un ou plusieurs inscrits</h2>
					</div>
					<?php 
						if($inscrits == 1)
						{
							for($i = 1; $i <= $donnees2['nbr_membre']; $i++)
							{
								echo "<div class='div7presen div9cadre div10cadre'><form method='post' action='traitementpresentationprofil.php' class='form'>
								<input type='hidden' name='id_membre' value=" .$id[$i]. " />
								<input type='submit' name='valider' value=\"" .$surnom[$i]. "\" class='boutonnom'/>
								<input type='submit' name='retirer' value='X' class='boutonnom' />
								</form></div>";
							}
						}else
						{
							echo "<div class='div7presen div9cadre div10cadre'>" .$inscrits. "</div>";
						}
					?>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>