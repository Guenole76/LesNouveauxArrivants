<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('navphoto.php');
include('lienauto.php');
if(isset($_SESSION['id_demande']))
{
	$req1 = $bdd->prepare('SELECT * FROM demande WHERE id_demande = ?');
	$req1->execute(array($_SESSION['id_demande']));
	$donnees1 = $req1->fetch();
}else
{
	header('Location: liste_propositions_personnelles.php');
}
$_SESSION['id_demandeur'] = $donnees1['id_demandeur'];
$req2 = $bdd->prepare('SELECT surnom1, surnom2, photodep1, photodep2, l, nom_l, photo_l FROM inscrits WHERE id = ?');
$req2->execute(array($donnees1['id_demandeur']));
$donnees2 = $req2->fetch();
if($_SESSION['id'] !== $_SESSION['id_demandeur'])
{
	$req2_2 = $bdd->prepare('SELECT surnom3 s3, validations3 vds3, points_de_relation pdr, groupe_relationnel gr FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
	$req2_2->execute(array($_SESSION['id'], $donnees1['id_demandeur']));
	$donnees2_2 = $req2_2->fetch();
	if($donnees2_2['gr'] >= 2)
	{
		if(!preg_match("#^[ ]*$#", $donnees2_2['s3']))
		{
			if($donnees2_2['vds3'] = 1)
			{
				$surnom = $donnees2_2['s3'];
				if($donnees2['l'] == 1)
				{
					$photo = $donnees2['photo_l'];
				}else
				{
					if($donnees2_2['pdr'] >= 50)
					{
						$photo = $donnees2['photodep2'];
					}else
					{
						$photo = $donnees2['photodep1'];
					}
				}
			}else
			{
				if($donnees2['l'] == 1)
				{
					$surnom = $donnees2['nom_l'];
					$photo = $donnees2['photo_l'];
				}else
				{
					if($donnees2_2['pdr'] >= 50)
					{
						$surnom = $donnees2['surnom2'];
						$photo = $donnees2['photodep2'];
					}else
					{
						$surnom = $donnees2['surnom1'];
						$photo = $donnees2['photodep1'];
					}
				}
			}
		}else
		{
			if($donnees2['l'] == 1)
			{
				$surnom = $donnees2['nom_l'];
				$photo = $donnees2['photo_l'];
			}else
			{
				if($donnees2_2['pdr'] >= 50)
				{
					$surnom = $donnees2['surnom2'];
					$photo = $donnees2['photodep2'];
				}else
				{
					$surnom = $donnees2['surnom1'];
					$photo = $donnees2['photodep1'];
				}
			}
		}
	}else
	{
		if($donnees2['l'] == 1)
		{
			$surnom = $donnees2['nom_l'];
			$photo = $donnees2['photo_l'];
		}else
		{
			if($donnees2_2['pdr'] >= 50)
			{
				$surnom = $donnees2['surnom2'];
				$photo = $donnees2['photodep2'];
			}else
			{
				$surnom = $donnees2['surnom1'];
				$photo = $donnees2['photodep1'];
			}
		}
	}
}else
{
	if($donnees2['l'] == 1)
		{
			$surnom = $donnees2['nom_l'];
			$photo = $donnees2['photo_l'];
		}else
		{
			$surnom = $donnees2['surnom1'];
			$photo = $donnees2['photodep1'];
		}
}
if(isset($photo))
{
	if($donnees2['l'] == 1)
	{
		$photo = '<img src="dossierphotosdeslieux\\'. $photo .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
	}else
	{
		$photo = '<img src="listephotosdeprofil\\'. $photo .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
	}
}else
{
	$photo = "";
}
$date = date('d/m/Y', $donnees1['date']);
if(isset($_SESSION['id_proposition']))
{
	$req3 = $bdd->prepare('SELECT id_repondant, proposition FROM proposition WHERE id_proposition = ?');
	$req3->execute(array($_SESSION['id_proposition']));
	$donnees3 = $req3->fetch();
}else
{
	header('Location: liste_propositions_personnelles.php');
}
$_SESSION['id_repondant'] = $donnees3['id_repondant'];
if($donnees3['id_repondant'] == $_SESSION['id'])
{
	$_SESSION['id_inscrit'] = $donnees1['id_demandeur']; 
}else
{
	$_SESSION['id_inscrit'] = $donnees3['id_repondant']; 
}
$req4 = $bdd->prepare('SELECT surnom1, surnom2, photodep1, photodep2, l, nom_l, photo_l FROM inscrits WHERE id = ?');
$req4->execute(array($donnees3['id_repondant']));
$donnees4 = $req4->fetch();
if($_SESSION['id'] !== $donnees3['id_repondant'])
{
	$req4_2 = $bdd->prepare('SELECT surnom3 s3, validations3 vds3, points_de_relation pdr, groupe_relationnel gr FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
	$req4_2->execute(array($_SESSION['id'], $donnees3['id_repondant']));
	$donnees4_2 = $req4_2->fetch();
	if(!preg_match("#^[ ]*$#", $donnees4_2['s3']))
	{
		if($donnees4_2['vds3'] = 1)
		{
			$surnom2 = $donnees4_2['s3'];
			if($donnees1['l'] == 1)
			{
				$photo2 = $donnees4['photo_l'];
			}else
			{
				if($donnees4_2['pdr'] >= 50)
				{
					$photo2 = $donnees4['photodep2'];
				}else
				{
					$photo2 = $donnees4['photodep1'];
				}
			}
		}else
		{
			if($donnees2['l'] == 1)
			{
				$surnom2 = $donnees4['nom_l'];
				$photo2 = $donnees4['photo_l'];
			}else
			{
				if($donnees4_2['pdr'] >= 50)
				{
					$surnom2 = $donnees4['surnom2'];
					$photo2 = $donnees4['photodep2'];
				}else
				{
					$surnom2 = $donnees4['surnom1'];
					$photo2 = $donnees4['photodep1'];
				}
			}
		}
	}else
	{
		if($donnees4['l'] == 1)
		{
			$surnom2 = $donnees4['nom_l'];
			$photo2 = $donnees4['photo_l'];
		}else
		{
			if($donnees4_2['pdr'] >= 50)
			{
				$surnom2 = $donnees4['surnom2'];
				$photo2 = $donnees4['photodep2'];
			}else
			{
				$surnom2 = $donnees4['surnom1'];
				$photo2 = $donnees4['photodep1'];
			}
		}
	}
}else
{
	if($donnees4['l'] == 1)
		{
			$surnom2 = $donnees4['nom_l'];
			$photo2 = $donnees4['photo_l'];
		}else
		{
			$surnom2 = $donnees4['surnom1'];
			$photo2 = $donnees4['photodep1'];
		}
}
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Présentation de la proposition - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navsortie.php"); ?>
					<?php include("nav_proposition.php"); ?>
					<div class="div9cadre div12cadre taille">
						<ul class="ulprofil">
							<?php 
								if($donnees3['id_repondant'] == $_SESSION['id'])
								{
									echo "<li><a href='modifierlaproposition.php' class='amaison'>Modifier la proposition</a></li>
									<li><a href='supprimerlaproposition.php' class='amaison'>Supprimer la proposition</a></li>";
									$proposition = "Votre proposition";
									$demandeur = "<a href='presentationprofil.php' class='amaison'>Demande de " .$surnom. " </a>";
								}else
								{
									echo "<li><a href='repondre_a_la_proposition.php' class='amaison'>Répondre</a></li>";
									$proposition = "<a href='presentationprofil.php' class='amaison'>Proposition de " .$surnom2. " </a>";
									$demandeur = "Demande de " .$surnom;
								}
							?>
						</ul>
					</div>
				</div>
				<div class="div2amais">
					<div>
						<div class="div9cadre div10cadre">
							<div class="div5presen">
								<?php
									for($i = 157; $i <= 157; $i++)
									{
										if(isset($_SESSION['message'.$i]))
											{
											if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
											{
												echo $_SESSION['message'.$i].'<br/>';
											}
										}
									}
									$_SESSION['message157'] = "";
								?>
								<?php echo $photo; ?>
							</div>
							<div class="div6presen taille">
								<?php echo "<h3>" .$demandeur. "</h3>"; ?>
								<?php 
									if($donnees1['s_privative'] == 1)
									{
										$s_p = "Sortie privée";
									}else
									{
										$s_p = "Sortie publique"; 
									}
								?>
								<?php $intitule = wordwrap($donnees1['intitule'], 21, "\r\n", true);
								echo $s_p. "<br/>" .$intitule; ?> à <?php echo $donnees1['vdres']; ?><br/>
								Le <?php echo $date. " à " .$donnees1['heure']. "h" .$donnees1['minute']; ?><br/>
								Pour une durée d'au moins <?php echo $donnees1['duree']; ?>h<br/>
								Avec <?php echo $donnees1['nbr_participants']. " participants"; ?> et un tarif de <?php echo $donnees1['tarif']. "€/pers."; ?>
							</div>
						</div>
					</div>
					<div class="div9cadre div10cadre">
						<h3 class="taille">Informations complémentaire</h3>
						<?php $description = wordwrap($donnees1['description'], 50, "\r\n", true);
						$description = lienauto($description);
						echo "<p>" .$description. "</p>"; ?> <br/>
					</div>
					<div class="div9cadre div10cadre">
						<h3 class="taille"><?php echo $proposition; ?></h3>
						<?php $description = wordwrap($donnees3['proposition'], 50, "\r\n", true);
						$description = lienauto($description);
						echo "<p>" .$description. "</p>"; ?> <br/>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>