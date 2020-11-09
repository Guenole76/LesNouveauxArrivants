<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('navphoto.php');
include('lienauto.php');
if(isset($_SESSION['id_sortie']))
{
	$req1 = $bdd->prepare('SELECT * FROM sortie WHERE id_sortie = ?');
	$req1->execute(array($_SESSION['id_sortie']));
	$donnees1 = $req1->fetch();
}else
{
	header('Location: profil.php');
}
$_SESSION['id_membre_createur'] = $donnees1['id_membre_createur'];
$_SESSION['id_inscrit'] = $donnees1['id_membre_createur'];
$req3 = $bdd->prepare('SELECT surnom1, surnom2, photodep1, photodep2, l, nom_l, photo_l FROM inscrits WHERE id = ?');
$req3->execute(array($donnees1['id_membre_createur']));
$donnees3 = $req3->fetch();
if($donnees1['id_membre_createur'] !== $_SESSION['id'])
{
	$req3_2 = $bdd->prepare('SELECT surnom3 s3, validations3 vds3, points_de_relation pdr, groupe_relationnel gr 
	FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
	$req3_2->execute(array($_SESSION['id'], $donnees1['id_membre_createur']));
	$donnees3_2 = $req3_2->fetch();
	if(isset($donnees3_2['s3']))
	{
		if($donnees3_2['gr'] >= 2)
		{
			if($donnees3_2['vds3'] == 1)
			{
				$titre = $donnees3_2['s3'];
			}else
			{
				if($donnees3['l'] == 1)
				{
					$titre = $donnees3['nom_l'];
				}else
				{
					if($donnees3_2['pdr'] >= 50)
					{
						$titre = $donnees3['surnom2'];
					}else
					{
						$titre = $donnees3['surnom1'];
					}
				}
					
			}
		}else
		{
			if($donnees3['l'] == 1)
			{
				$titre = $donnees3['nom_l'];
			}else
			{
				if($donnees3_2['pdr'] >= 50)
				{
					$titre = $donnees3['surnom2'];
				}else
				{
					$titre = $donnees3['surnom1'];
				}
			}
		}
	}else
	{
		if($donnees3['l'] == 1)
		{
			$titre = $donnees3['nom_l'];
		}else
		{
			if($donnees3_2['pdr'] >= 50)
			{
				$titre = $donnees3['surnom2'];
			}else
			{
				$titre = $donnees3['surnom1'];
			}
		}
	}
}else
{
	if($donnees3['l'] == 1)
	{
		$titre = $donnees3['nom_l'];
	}else
	{
		$titre = $donnees3['surnom1'];
	}
}
$req4 = $bdd->prepare('SELECT id_membre FROM inscrits_sortie WHERE id_sortie = ? AND valeur_membre = ?');
$req4->execute(array($_SESSION['id_sortie'], 1));
$donnees4 = $req4->fetch();
$req5 = $bdd->prepare('SELECT COUNT(id_membre) as nbr_membre FROM inscrits_sortie WHERE id_sortie = ? AND valeur_membre = ?');
$req5->execute(array($_SESSION['id_sortie'], 1));
$donnees5 = $req5->fetch();
$n = 1;
if(isset($donnees4['id_membre']))
{ 
	do
	{
		$id[$n] = $donnees4['id_membre'];
		$req6 = $bdd->prepare('SELECT surnom1, surnom2, l, nom_l FROM inscrits WHERE id = ?');
		$req6->execute(array($donnees4['id_membre']));
		$donnees6 = $req6->fetch();
		$req6_2 = $bdd->prepare('SELECT surnom3 s3, validations3 vds3, points_de_relation pdr, groupe_relationnel gr 
		FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req6_2->execute(array($_SESSION['id'], $donnees4['id_membre']));
		$donnees6_2 = $req6_2->fetch();
		if(isset($donnees6_2['s3']))
		{
			if($donnees6_2['gr'] >= 2)
			{
				if($donnees6_2['vds3'] == 1)
				{
					$surnom[$n] = $donnees6_2['s3'];
				}else
				{
					if($donnees6['l'] == 1)
					{
						$surnom[$n] = $donnees6['nom_l'];
					}else
					{
						if($donnees6_2['pdr'] >= 50)
						{
							$surnom[$n] = $donnees6['surnom2'];
						}else
						{
							$surnom[$n] = $donnees6['surnom1'];
						}
					}
						
				}
			}else
			{
				if($donnees6['l'] == 1)
				{
					$surnom[$n] = $donnees6['nom_l'];
				}else
				{
					if($donnees6_2['pdr'] >= 50)
					{
						$surnom[$n] = $donnees6['surnom2'];
					}else
					{
						$surnom[$n] = $donnees6['surnom1'];
					}
				}
			}
		}else
		{
			if($donnees6['l'] == 1)
			{
				$surnom[$n] = $donnees6['nom_l'];
			}else
			{
				if($donnees6_2['pdr'] >= 50)
				{
					$surnom[$n] = $donnees6['surnom2'];
				}else
				{
					$surnom[$n] = $donnees6['surnom1'];
				}
			}
		}
		$n++;
	}while($donnees4 = $req4->fetch());
	$inscrits = 1;
}else
{
	$inscrits = "Il n'y a pas d'inscrit"; 
}
if(isset($donnees3['photodep1']))
{
	if($donnees3['l'] == 1)
	{
		$photo = '<img src="dossierphotosdeslieux\\'. $donnees3['photo_l'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
	}else
	{
		if($donnees1['id_membre_createur'] !== $_SESSION['id'])
		{
			if($donnees3_2['pdr'] >= 50)
			{
				$photo = '<img src="listephotosdeprofil\\'. $donnees3['photodep2'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
			}else
			{
				$photo = '<img src="listephotosdeprofil\\'. $donnees3['photodep1'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
			} 
		}else
		{
			$photo = '<img src="listephotosdeprofil\\'. $donnees3['photodep1'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
		}
	}
}else
{
	$photo = "";
}
$date = date('d/m/Y', $donnees1['date']);
$placerestantes = $donnees1['nbrparticipants'] - $donnees5['nbr_membre'];
if($placerestantes < 0)
{
	$mantantes = "place(s) manquante(s)";
}else
{
	$mantantes = "place(s) restante(s)";
}
$placerestantes = abs($placerestantes); 
$req7 = $bdd->prepare('SELECT id_boite, nomboite, placemax FROM boite WHERE id_sortie = ? AND valeur_boite = ?');
$req7->execute(array($_SESSION['id_sortie'], 1));
$donnees7 = $req7->fetch();
$m = 1;
$p = 1;
if(isset($donnees7['id_boite']))
{
	do
	{
		$idboite[$m] = $donnees7['id_boite'];
		$nomboite[$m] = $donnees7['nomboite'];
		$placemax[$m] = $donnees7['placemax'];
		$req8 = $bdd->prepare('SELECT ins.id id, ins.surnom1 s1, ins.surnom2 s2, ins.l l, ins.nom_l nom_l FROM inscrits AS ins LEFT JOIN inscrits_boite AS insb
		ON ins.id = insb.id_inscrit WHERE insb.id_boite = ? AND insb.valeur_inscrit = ?');
		$req8->execute(array($donnees7['id_boite'], 1));
		$donnees8 = $req8->fetch();
		if(isset($donnees8['id']))
		{
			do
			{
				$req8_2 = $bdd->prepare('SELECT surnom3 s3, validations3 vds3, points_de_relation pdr, groupe_relationnel gr 
				FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
				$req8_2->execute(array($_SESSION['id'], $donnees8['id']));
				$donnees8_2 = $req8_2->fetch();
				if(isset($donnees8_2['s3']))
				{
					if($donnees8_2['gr'] >= 2)
					{
						if($donnees8_2['vds3'] == 1)
						{
							$id2[$m][$p] = $donnees8['id'];
							$surnom2[$m][$p] = $donnees8_2['s3'];
						}else
						{
							if($donnees8['l'] == 1)
							{
								$id2[$m][$p] = $donnees8['id'];
								$surnom2[$m][$p] = $donnees8['nom_l'];
							}else
							{
								if($donnees8_2['pdr'] >= 50)
								{
									$id2[$m][$p] = $donnees8['id'];
									$surnom2[$m][$p] = $donnees8['s2'];
								}else
								{
									$id2[$m][$p] = $donnees8['id'];
									$surnom2[$m][$p] = $donnees8['s1'];
								}
							}
								
						}
					}else
					{
						if($donnees8['l'] == 1)
						{
							$id2[$m][$p] = $donnees8['id'];
							$surnom2[$m][$p] = $donnees8['nom_l'];
						}else
						{
							if($donnees8_2['pdr'] >= 50)
							{
								$id2[$m][$p] = $donnees8['id'];
								$surnom2[$m][$p] = $donnees8['s2'];
							}else
							{
								$id2[$m][$p] = $donnees8['id'];
								$surnom2[$m][$p] = $donnees8['s1'];
							}
						}
					}
				}else
				{
					if($donnees8['l'] == 1)
					{
						$id2[$m][$p] = $donnees8['id'];
						$surnom2[$m][$p] = $donnees8['nom_l'];
					}else
					{
						if($donnees8_2['pdr'] >= 50)
						{
							$id2[$m][$p] = $donnees8['id'];
							$surnom2[$m][$p] = $donnees8['s2'];
						}else
						{
							$id2[$m][$p] = $donnees8['id'];
							$surnom2[$m][$p] = $donnees8['s1'];
						}
					}
				}
				$p++;
			}while($donnees8 = $req8->fetch());
		}
		$insb[$m] = $p;
		$m++;
		$p = 1;
	}while($donnees7 = $req7->fetch());
}
if(isset($_POST['pagecom']))
{
	$_SESSION['pagecom'] = $_POST['pagecom'];
}
if(!isset($_SESSION['pagecom']))
{
	$_SESSION['pagecom'] = 1; 
}
$limite = ($_SESSION['pagecom'] - 1) * 10;
$limitefinale = $_SESSION['pagecom'] * 10;
$req9 = $bdd->prepare('SELECT id_com, id_inscrit, date_com, com FROM commentaire WHERE id_sortie = ? AND valeur_com = ?');
$req9->execute(array($_SESSION['id_sortie'], 1));
$donnees9 = $req9->fetch();
$k = 1;
if(isset($donnees9['id_inscrit']))
{
	do
	{
		$req10 = $bdd->prepare('SELECT id, surnom1, surnom2, photodep1, photodep2, l, nom_l, photo_l FROM inscrits WHERE id = ?');
		$req10->execute(array($donnees9['id_inscrit']));
		$donnees10 = $req10->fetch();
		$req10_2 = $bdd->prepare('SELECT surnom3 s3, validations3 vds3, points_de_relation pdr, groupe_relationnel gr 
		FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req10_2->execute(array($_SESSION['id'], $donnees10['id']));
		$donnees10_2 = $req10_2->fetch();
		$idcom[$k] = $donnees9['id_com'];
		$datecom[$k] = $donnees9['date_com'];
		$com[$k] = $donnees9['com'];
		if(isset($donnees10_2['s3']))
		{
			if($donnees10_2['gr'] >= 2)
			{
				if($donnees10_2['vds3'] == 1)
				{
					$idcomtateur[$k] = $donnees10['id'];
					$surnomcom[$k] = $donnees10_2['s3'];
					if($donnees10['l'] == 1)
					{
						$photocom[$k] = '<img src="dossierphotosdeslieux\\'. $donnees10['photo_l'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
					}else
					{
						if($donnees10_2['pdr'] >= 50)
						{
							$photocom[$k] = '<img src="listephotosdeprofil\\'. $donnees10['photodep2'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
						}else
						{
							$photocom[$k] = '<img src="listephotosdeprofil\\'. $donnees10['photodep1'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
						}
					}
				}else
				{
					if($donnees10['l'] == 1)
					{
						$idcomtateur[$k] = $donnees10['id'];
						$surnomcom[$k] = $donnees10['nom_l'];
						$photocom[$k] = '<img src="dossierphotosdeslieux\\'. $donnees10['photo_l'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
					}else
					{
						if($donnees10_2['pdr'] >= 50)
						{
							$idcomtateur[$k] = $donnees10['id'];
							$surnomcom[$k] = $donnees10['surnom2'];
							$photocom[$k] = '<img src="listephotosdeprofil\\'. $donnees10['photodep2'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
						}else
						{
							$idcomtateur[$k] = $donnees10['id'];
							$surnomcom[$k] = $donnees10['surnom1'];
							$photocom[$k] = '<img src="listephotosdeprofil\\'. $donnees10['photodep1'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
						}
					}
						
				}
			}else
			{
				if($donnees10['l'] == 1)
				{
					$idcomtateur[$k] = $donnees10['id'];
					$surnomcom[$k] = $donnees10['nom_l'];
					$photocom[$k] = '<img src="dossierphotosdeslieux\\'. $donnees10['photo_l'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
				}else
				{
					if($donnees10_2['pdr'] >= 50)
					{
						$idcomtateur[$k] = $donnees10['id'];
						$surnomcom[$k] = $donnees10['surnom2'];
						$photocom[$k] = '<img src="listephotosdeprofil\\'. $donnees10['photodep2'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
					}else
					{
						$idcomtateur[$k] = $donnees10['id'];
						$surnomcom[$k] = $donnees10['surnom1'];
						$photocom[$k] = '<img src="listephotosdeprofil\\'. $donnees10['photodep1'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
					}
				}
			}
		}else
		{
			if($donnees10['l'] == 1)
			{
				$idcomtateur[$k] = $donnees10['id'];
				$surnomcom[$k] = $donnees10['nom_l'];
				$photocom[$k] = '<img src="dossierphotosdeslieux\\'. $donnees10['photo_l'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
			}else
			{
				if($donnees10_2['pdr'] >= 50)
				{
					$idcomtateur[$k] = $donnees10['id'];
					$surnomcom[$k] = $donnees10['surnom2'];
					$photocom[$k] = '<img src="listephotosdeprofil\\'. $donnees10['photodep2'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
				}else
				{
					$idcomtateur[$k] = $donnees10['id'];
					$surnomcom[$k] = $donnees10['surnom1'];
					$photocom[$k] = '<img src="listephotosdeprofil\\'. $donnees10['photodep1'] .' " height="200" width="200" alt="Photo de profil" title="Photo de profil" /></br>' ;
				}
			}
		}
		$k++;
	}while($donnees9 = $req9->fetch());
}
$req11 = $bdd->prepare('SELECT COUNT(com) as nbr_com FROM commentaire WHERE id_sortie = ? AND valeur_com = ?');
$req11->execute(array($_SESSION['id_sortie'], 1));
$donnees11 = $req11->fetch();
$nbrpages = intval(($donnees11['nbr_com']/10)) + 1;
$k = $k - 1;
if($k < $limitefinale)
{
	$l = $k;
}else
{
	$l = $limitefinale;
}
$limite = $limite + 1 ;
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Présentation de la sortie - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navsortie.php"); ?>
					<div class="div9cadre div12cadre taille">
						<ul class="ulprofil">
							<li><a href='invites.php'class="amaison">Invités</a></li>
							<?php 
								if($donnees1['id_membre_createur'] == $_SESSION['id'])
								{
									echo "<li><a href='modifierlasortie.php' class='amaison'>Modifier la sortie</a></li>
									<li><a href='retirerdesinscrits.php' class='amaison'>Retirer des inscrits</a></li>
									<li><a href='supprimerlasortie.php' class='amaison'>Supprimer la sortie</a></li>";
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
								<?php 
									if($donnees1['s_privative'] == 1)
									{
										echo "<h3><a href='presentationprofil.php' class='amaison'>Sortie privée de " .$titre. "</a> </h3>";
									}else
									{
										echo "<h3><a href='presentationprofil.php' class='amaison'>Sortie publique de " .$titre. "</a> </h3>";
									}
								 ?>
								<?php $intitule = wordwrap($donnees1['intitule'], 21, "\r\n", true);
								echo $intitule; ?> le <?php echo $date; ?> à <?php echo $donnees1['vdres_sortie']; ?>
								à partir de <?php echo $donnees1['heure']. "h" .$donnees1['minute']; ?><br/>
								Pour une durée d'au moins <?php echo $donnees1['duree']; ?>h <br/>et un tarif de <?php echo $donnees1['tarif']; ?>€/pers.
							</div>
						</div>
					</div>
					<div class="div9cadre div10cadre">
						<a href="sinscrireousedesinscrireaunesortie.php" class="amaison taille taille2">S'inscrire/Se désinscrire</a><br/>
						<h3 class="taille">Description de la sortie</h3>
						<?php $description = wordwrap($donnees1['description'], 50, "\r\n", true);
						$description = lienauto($description);
						echo "<p>" .$description. "</p>"; ?> <br/>
						<div class="taille" style="margin-bottom: 15px;">
							Inscrits : <?php echo $donnees5['nbr_membre']. "/" .$donnees1['nbrparticipants']. " (" .$placerestantes. " " .$mantantes. ")" ; ?> <br/>
						</div>
						<?php
						if($inscrits == 1)
						{
							for($i = 1; $i <= $donnees5['nbr_membre']; $i++)
							{
								if($id[$i] == $_SESSION['id'])
								{
									if($i > 1)
									{
										$vtransfert = $id[1];
										$vtdeux = $surnom[1];
										$id[1] = $_SESSION['id'];
										$surnom[1] = $surnom[$i];
										$id[$i] = $vtransfert;
										$surnom[$i] = $vtdeux;
									}
								} 
							}
							for($i = 1; $i <= $donnees5['nbr_membre']; $i++)
							{
								echo "<div class='div7presen'><form method='post' action='traitementpresentationprofil.php'>
								<input type='hidden' name='id_membre' value=" .$id[$i]. " />
								<input type='submit' name='valider' value=\"" .$surnom[$i]."\" class='boutonnom'/>
								</form></div>";
							}
						}else
						{
							echo $inscrits;
						}
						?>
					</div>
					<?php 
						echo
						"<div class='div9cadre div10cadre'>
							<h3 class='taille'>Créer une boîte</h3>
							<form method='post' action='traitementcreationduneboite.php'>
								<input type='text' name='nomboite' placeholder='Nom de la boîte' maxlength=30 required class='input2'/>
								<input type='number' min=0 name='placemax'placeholder='Nombre de place' required class='input2'/><br/>
								<input type='submit' name='valider' value='Créer votre boîte' class='boutonamais'/>
							</form>
						</div>";
					if($m > 1)
						{
							for($i = 1; $i < $m; $i++)
							{
								echo "<div class='div9cadre div10cadre'>
								<h3 class='taille'>" .$nomboite[$i]. "</h3>";
								for($o = 1; $o < $insb[$i]; $o++)
								{
									echo "<div class='div7presen'><form method='post' action='traitementpresentationprofil.php'>
									<input type='hidden' name='id_membre' value=" .$id2[$i][$o]. " />
									<input type='submit' name='valider' value=\"" .$surnom2[$i][$o]. "\" class='boutonnom'/>
									</form></div>";
								}
								if($donnees1['id_membre_createur'] == $_SESSION['id'])
								{
									echo "<form method='post' action='traitementboite.php'>
									<input type='hidden' name='id_boite' value=" .$idboite[$i]. " />
									<input type='hidden' name='pmax' value=" .$placemax[$i]. " />";
									if($insb[$i] <= $placemax[$i])
									{
										echo "<input type='submit' name='inscription' value=\"S'inscrire ou se désinscrire\" class='boutonnom'/>";
									}else
									{
										echo "<input type='submit' name='desinscription' value=\"Se désinscrire\" class='boutonnom'/>";
									}
									echo "<input type='submit' name='plusun' value=+1 class='boutonnom'/>
									<input type='submit' name='moinsun' value=-1 class='boutonnom'/>
									<input type='submit' name='supprimer' value='Supprimer' class='boutonnom'/>
									</form>";
								}else
								{
									echo "<form method='post' action='traitementboite.php'>
									<input type='hidden' name='id_boite' value=" .$idboite[$i]. " />
									<input type='hidden' name='pmax' value=" .$placemax[$i]. " />";
									if($insb[$i] <= $placemax[$i])
									{
										echo "<input type='submit' name='inscription' value=\"S'inscrire ou se désinscrire\" class='boutonnom'/>";
									}else
									{
										echo "<input type='submit' name='desinscription' value=\"Se désinscrire\" class='boutonnom'/>";
									}
									echo "<input type='submit' name='plusun' value=+1 class='boutonnom'/>
									<input type='submit' name='moinsun' value=-1 class='boutonnom'/>
									</form>";
								}
								echo "Cette boîte peut contenir " .$placemax[$i]. " personne(s) maximum.</div>";
							}
							echo "<br/>";
						}
					?>
					<?php 
							if($k >=  1)
							{
								for($j = $limite; $j <= $l; $j++)
								{
									date_default_timezone_set("Europe/Paris"); 
									$temps = date('d/m/Y à H:i', $datecom[$j]);
									echo "<div class='div9cadre div10cadre'>
									<div class='div5presen'>" .$photocom[$j]. "</div>
									<div class='div6presen'>";
									if($idcomtateur[$j] == $_SESSION['id'])
									{
										echo "<form method='post' action='traitementcomsortie.php'>
										<input type='hidden' name='idcom' value=" .$idcom[$j]. " />
										<input type='submit' name='supprimer' value='Supprimer le commentaire' class='boutonnom'/></form>";
									}elseif($donnees1['id_membre_createur'] == $_SESSION['id'])
									{
										echo "<form method='post' action='traitementcomsortie.php'>
										<input type='hidden' name='idcom' value=" .$idcom[$j]. " />
										<input type='submit' name='supprimer' value='Supprimer le commentaire' class='boutonnom'/></form>";
									}
									echo $surnomcom[$j]. " le " .$temps. "<br/>" .$com[$j]. "</div></div>";
								}
							}else
							{
								echo "<div class='div9cadre div10cadre'>Il n'y a pas de de commentaire.</div>";
							}
						?>
					<div class="div9cadre div10cadre">
						<form method="post" action="presentationdelasortie.php" class="form">
						<?php
							for($i = 1; $i <= $nbrpages; $i++)
							{
								echo "<input type='submit' name='page' value=" .$i. " class='boutonamais'/>";
							}
						?>
						</form>
					</div>
					<div class="div9cadre div10cadre">
						<form method="post" action="traitementcomsortie.php" class="form">
							<label>Votre commentaire</label><br/>
							<textarea name="com" rows=7 cols=40 placeholder="Votre commentaire" class="textareames" required ></textarea><br/>
							<input type="submit" name="valider" value="Poster votre commentaire" class="boutonamais"/>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>