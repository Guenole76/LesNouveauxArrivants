<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('expression_r.php');
$temps = time();
if(isset($_POST['intrus']))
{
	$req_rel_intrus = $bdd->prepare('SELECT id_relation, points_de_relation pdr FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
	$req_rel_intrus->execute(array($_SESSION['id'], $_SESSION['id_inscrit']));
	$donnees_rel_intrus = $req_rel_intrus->fetch();
	if(!isset($donnees_rel_intrus['id_relation']))
	{
		$req_ajt = $bdd->prepare('INSERT INTO relations (id_membre_1, id_membre_2, surnom3, validations3, points_de_relation, glacage, groupe_relationnel, protection, t_sympathie) 
		VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$req_ajt->execute(array($_SESSION['id'], $_SESSION['id_inscrit'], "", 2, 0, 1, 4, 2, $temps));
	}elseif($donnees_rel_intrus['pdr'] < 10)
	{
		$req_changement_gr = $bdd->prepare('UPDATE relations SET groupe_relationnel = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req_changement_gr->execute(array(4, $_SESSION['id'], $_SESSION['id_inscrit']));
	}
}
if(isset($_POST['valider']))
{
	if($_SESSION['id'] !== $_SESSION['id_inscrit'])
	{
		if(!preg_match("#^[ ]*$#", $_POST['surnom3']))
		{
			if(preg_match($expression_r, $_POST['surnom3']))
			{
				$req_rel = $bdd->prepare('SELECT id_relation FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
				$req_rel->execute(array($_SESSION['id'], $_SESSION['id_inscrit']));
				$donnees_rel = $req_rel->fetch();
				if(isset($donnees_rel['id_relation']))
				{
					$req_cs3 = $bdd->prepare('UPDATE relations SET surnom3 = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
					$req_cs3->execute(array($_POST['surnom3'], $_SESSION['id'], $_SESSION['id_inscrit']));
				}else
				{
					$_SESSION['message11'] = "Vous n'avez aucune relation avec cette personne";	
				}
			}else
			{
				$_SESSION['message11'] = "Votre surnom contient des caractères interdits";
			}	
		}else
		{
			$_SESSION['message11'] = "Votre surnom ne contient aucun caractère";
		}
	}else
	{
		$_SESSION['message11'] = "Seuls les autres utilisateurs peuvent obtenir un surnom de votre part";
	}
}
if(isset($_POST['activer']))
{
	if($_SESSION['id'] !== $_SESSION['id_inscrit'])
	{
		$req_rel = $bdd->prepare('SELECT id_relation FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req_rel->execute(array($_SESSION['id'], $_SESSION['id_inscrit']));
		$donnees_rel = $req_rel->fetch();
		if(isset($donnees_rel['id_relation']))
		{
			$req_cvds3 = $bdd->prepare('UPDATE relations SET validations3 = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
			$req_cvds3->execute(array(1, $_SESSION['id'], $_SESSION['id_inscrit']));
		}else
		{
			$_SESSION['message11'] = "Vous n'avez aucune relation avec cette personne";	
		}
	}else
	{
		$_SESSION['message11'] = "Seuls les autres utilisateurs peuvent obtenir un surnom de votre part";
	}
}
if(isset($_POST['desactiver']))
{
	if($_SESSION['id'] !== $_SESSION['id_inscrit'])
	{
		$req_rel = $bdd->prepare('SELECT id_relation FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req_rel->execute(array($_SESSION['id'], $_SESSION['id_inscrit']));
		$donnees_rel = $req_rel->fetch();
		if(isset($donnees_rel['id_relation']))
		{
			$req_cvds3 = $bdd->prepare('UPDATE relations SET validations3 = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
			$req_cvds3->execute(array(2, $_SESSION['id'], $_SESSION['id_inscrit']));
		}else
		{
			$_SESSION['message11'] = "Vous n'avez aucune relation avec cette personne";	
		}
	}else
	{
		$_SESSION['message11'] = "Seuls les autres utilisateurs peuvent obtenir un surnom de votre part";
	}
}
$req1 = $bdd->prepare('SELECT surnom1 s1, surnom2 s2, photodep1 pdp1, photodep2 pdp2, ddref, vdres, l, nom_l, photo_l, abonnement_en_cours, nv_relationnel 
FROM inscrits WHERE id = ?');
$req1->execute(array($_SESSION['id_inscrit']));
$donnees1 = $req1->fetch();
$req_abo = $bdd->prepare('SELECT abonnement_en_cours FROM inscrits WHERE id = ?');
$req_abo->execute(array($_SESSION['id']));
$donnees_abo = $req_abo->fetch();
if($_SESSION['id'] !== $_SESSION['id_inscrit'])
{
	if(isset($donnees1['s1']))
	{
		$req1_2 = $bdd->prepare('SELECT surnom3 s3, validations3 vds3, points_de_relation pdr, groupe_relationnel gr
		FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req1_2->execute(array($_SESSION['id'], $_SESSION['id_inscrit']));
		$donnees1_2 = $req1_2->fetch();
		if(isset($donnees1_2['gr']))
		{
			$gr = $donnees1_2['gr'];
			if($donnees1_2['gr'] >= 2)
			{
				if(!preg_match("#^[ ]*$#", $donnees1_2['s3']))
				{
					if($donnees1_2['vds3'] == 1)
					{
						$surnom = $donnees1_2['s3'];
						$nouv = 0;
						if($donnees1['l'] == 1)
						{
							$photo = $donnees1['photo_l'];
						}else
						{
							if($donnees1_2['pdr'] >= 50)
							{
								$photo = $donnees1['pdp2'];
							}else
							{
								$photo = $donnees1['pdp1'];
							}
						}
					}else
					{
						if($donnees1['l'] == 1)
						{
							$surnom = $donnees1['nom_l'];
							$photo = $donnees1['photo_l'];
							$nouv = 0;
						}else
						{
							if($donnees1_2['pdr'] >= 50)
							{
								$photo = $donnees1['pdp2'];
								$surnom = $donnees1['s2'];
								$nouv = 0;
							}else
							{
								$photo = $donnees1['pdp1'];
								$surnom = $donnees1['s1'];
								$nouv = 0;
							}
						}
					}
				}else
				{
					if($donnees1['l'] == 1)
					{
						$surnom = $donnees1['nom_l'];
						$photo = $donnees1['photo_l'];
						$nouv = 0;
					}else
					{
						if($donnees1_2['pdr'] >= 50)
						{
							$photo = $donnees1['pdp2'];
							$surnom = $donnees1['s2'];
							$nouv = 0;
						}else
						{
							$photo = $donnees1['pdp1'];
							$surnom = $donnees1['s1'];
							$nouv = 0;
						}
					}
				}
			}else
			{
				if($donnees1['l'] == 1)
				{
					$surnom = $donnees1['nom_l'];
					$photo = $donnees1['photo_l'];
					if($donnees1_2['pdr'] < 10)
					{
						$nouv = 1;
					}else
					{
						$nouv = 0;
					}
				}else
				{
					if($donnees1_2['pdr'] >= 50)
					{
						$photo = $donnees1['pdp2'];
						$surnom = $donnees1['s2'];
						$nouv = 0;
					}else
					{
						$photo = $donnees1['pdp1'];
						$surnom = $donnees1['s1'];
						if($donnees1_2['pdr'] < 10)
						{
							$nouv = 1;
						}else
						{
							$nouv = 0;
						}
					}
				}
			}
		}else
		{
			if($donnees1['l'] == 1)
			{
				$surnom = $donnees1['nom_l'];
				$photo = $donnees1['photo_l'];
			}else
			{
				$photo = $donnees1['pdp1'];
				$surnom = $donnees1['s1'];
			}
			$nouv = 1;
;		}
	}
}else
{
	if($donnees1['l'] == 1)
	{
		$surnom = $donnees1['nom_l'];
		$photo = $donnees1['photo_l'];
		$nouv = 0;
	}else
	{
		$photo = $donnees1['pdp1'];
		$surnom = $donnees1['s1'];
		$nouv = 0;
	}
}
if(isset($donnees1['pdp1']))
{
	if($donnees1['l'] == 1)
	{
		$photo = '<img src="dossierphotosdeslieux\\'. $donnees1['photo_l'] .' " height="200" width="200" alt="Votre photo de profil" title="Votre photo de profil" /></br>' ;
	}else
	{
			$photo = '<img src="listephotosdeprofil\\'. $photo .' " height="200" width="200" alt="Votre photo de profil" title="Votre photo de profil" /></br>'; 
	}
}else
{
	$photo = "";
}
if($donnees1['l'] == 1)
{
	$req1_3 = $bdd->prepare('SELECT *
	FROM rencontre WHERE id_l = ?');
	$req1_3->execute(array($_SESSION['id_inscrit']));
	$donnees1_3 = $req1_3->fetch();	
	if(isset($donnees1_3['id_rencontre']))
	{
		if($donnees1_3['valeur_l'] == 1)
		{
			$condition = $donnees1_3['condition_r'];
			for($i = 1; $i <= 14; $i++)
			{
				$nom[$i] = $donnees1_3['nom_r'.$i];
				$lieu[$i] = $donnees1_3['lieu_r'.$i];
				$jour[$i] = $donnees1_3['jour_r'.$i];
				$heure[$i] = $donnees1_3['heure_r'.$i];
				$minute[$i] = $donnees1_3['minute_r'.$i];
				$duree[$i] = $donnees1_3['duree_r'.$i];
				$validite[$i] = $donnees1_3['validite_r'.$i];
			}
		}
	}
}
$longabo = strlen($donnees_abo['abonnement_en_cours']);
if($longabo == 8)
{
	$limitation = 0;
}elseif($longabo == 7)
{
	$limitation = 1;
}
$req2 = $bdd->prepare('SELECT id_conversation, situation_conversation, id_membre_situation FROM conversations WHERE id_membre_1 = ? AND id_membre_2 = ?');
$req2->execute(array($_SESSION['id'], $_SESSION['id_inscrit']));
$donnees2 = $req2->fetch();
$req3 = $bdd->prepare('SELECT id_conversation FROM conversations WHERE id_membre_1 = ? AND id_membre_2 = ?');
$req3->execute(array($_SESSION['id_inscrit'], $_SESSION['id']));
$donnees3 = $req3->fetch();

if(isset($donnees2['situation_conversation']))
{
	if($donnees2['id_conversation'] < $donnees3['id_conversation'])
	{
		$id_conversation = $donnees2['id_conversation'];
	}else
	{
		$id_conversation = $donnees3['id_conversation'];
	}
	if($donnees2['situation_conversation'] == 2)
	{
		if($donnees2['id_membre_situation'] == $_SESSION['id'])
		{
			$_SESSION['id_conversation'] = $id_conversation;
			$inputmessage = "<a href='messages.php' class='amaison'>Voir le dernier message</a>";
		}else
		{
			$inputmessage = "";
		}
	}elseif($donnees2['situation_conversation'] == 1)
	{
		$_SESSION['id_conversation'] = $id_conversation;
		$inputmessage = "<a href='messages.php' class='amaison'>Discuter</a>";
	}
}else
{
	$inputmessage = "<a href='messages.php' class='amaison'>Commencer une discussion</a>";
}

?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Présentation du profil - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais" style="min-height: 290px;">
				<div class="div5presen">
					<div class="div9cadre div10cadre">
						<?php
							for($i = 1; $i <= 7; $i++)
							{
								if(isset($_SESSION['message'.$i]))
								{
									if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
									{
										echo $_SESSION['message'.$i].'<br/>';
									}
								}
							}
							for($i = 1; $i <= 7; $i++)
							{
								if(isset($_SESSION['message'.$i]))
								{
									if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
									{
										$_SESSION['message'.$i] = "";
									}
								}
							}
						?>
						<?php
							if($_SESSION['id'] !== $_SESSION['id_inscrit'])
							{
								if($nouv == 0)
								{
									if($limitation == 1)
									{	
										if($gr >= 2)
										{
											if(isset($_SESSION['id_sortie']))
											{
												echo $photo. '<br/><form method="post" action="presentationprofil.php"><input type="text" name="surnom3" maxlength=100 id="surnom"
												value="' .$surnom. '" class="input4"/>
												<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/><br/>
												Niveau ' .$donnees1["nv_relationnel"]. '</div><div class="div9cadre div10cadre">
												<input type="submit" name="activer" value="Activer le surnom" class="boutonmodlesinfos"/>
												<input type="submit" name="desactiver" value="Désactiver le surnom" class="boutonmodlesinfos"/></div><div class="div9cadre div10cadre taille">
												<a href="presentationdelasortie.php" class="amaison">Voir la sortie</a>
												</div></form></div><div class="div6presen">
												<div class="div9cadre div10cadre taille">De  '.$donnees1["ddref"]. ' à ' .$donnees1["vdres"]. '<br/>' .$inputmessage. '</div>';
											}else
											{
												echo $photo. '<br/><form method="post" action="presentationprofil.php"><input type="text" name="surnom3" maxlength=100 id="surnom"
												value="' .$surnom. '" class="input4"/>
												<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/><br/>
												Niveau ' .$donnees1["nv_relationnel"]. '</div><div class="div9cadre div10cadre">
												<input type="submit" name="activer" value="Activer le surnom" class="boutonmodlesinfos"/>
												<input type="submit" name="desactiver" value="Désactiver le surnom" class="boutonmodlesinfos"/>
												</div></form></div><div class="div6presen">
												<div class="div9cadre div10cadre taille">De  '.$donnees1["ddref"]. ' à ' .$donnees1["vdres"]. '<br/>' .$inputmessage. '</div>';
											}
										}else
										{
											if(isset($_SESSION['id_sortie']))
											{
												echo $photo. '<br/>' .$surnom. '<br/>
												Niveau ' .$donnees1["nv_relationnel"]. '</div><div class="div9cadre div10cadre taille">
												<a href="presentationdelasortie.php" class="amaison">Voir la sortie</a>
												</div></div><div class="div6presen">
												<div class="div9cadre div10cadre taille">De  '.$donnees1["ddref"]. ' à ' .$donnees1["vdres"]. '<br/>' .$inputmessage. '</div>';
											}else
											{
												echo $photo. '<br/>' .$surnom. '<br/>
												Niveau ' .$donnees1["nv_relationnel"]. '</div></div><div class="div6presen">
												<div class="div9cadre div10cadre taille">De  '.$donnees1["ddref"]. ' à ' .$donnees1["vdres"]. '<br/>' .$inputmessage. '</div>';
											}
										}
									}else
									{
										if($gr == 4)
										{
											if(isset($_SESSION['id_sortie']))
											{
												echo $photo. '<br/><form method="post" action="presentationprofil.php"><input type="text" name="surnom3" maxlength=100 id="surnom"
												value="' .$surnom. '" class="input4"/>
												<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/><br/>
												Niveau ' .$donnees1["nv_relationnel"]. '</div><div class="div9cadre div10cadre">
												<input type="submit" name="activer" value="Activer le surnom" class="boutonmodlesinfos"/>
												<input type="submit" name="desactiver" value="Désactiver le surnom" class="boutonmodlesinfos"/></div><div class="div9cadre div10cadre taille">
												<a href="presentationdelasortie.php" class="amaison">Voir la sortie</a>
												</div></form></div><div class="div6presen">
												<div class="div9cadre div10cadre taille">De  '.$donnees1["ddref"]. ' à ' .$donnees1["vdres"]. '<br/>' .$inputmessage. '</div>';
											}else
											{
												echo $photo. '<br/><form method="post" action="presentationprofil.php"><input type="text" name="surnom3" maxlength=100 id="surnom"
												value="' .$surnom. '" class="input4"/>
												<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/><br/>
												Niveau ' .$donnees1["nv_relationnel"]. '</div><div class="div9cadre div10cadre">
												<input type="submit" name="activer" value="Activer le surnom" class="boutonmodlesinfos"/>
												<input type="submit" name="desactiver" value="Désactiver le surnom" class="boutonmodlesinfos"/>
												</div></form></div><div class="div6presen">
												<div class="div9cadre div10cadre taille">De  '.$donnees1["ddref"]. ' à ' .$donnees1["vdres"]. '<br/>' .$inputmessage. '</div>';
											}
										}else
										{
											if(isset($_SESSION['id_sortie']))
											{
												echo $photo. '<br/>' .$surnom. '<br/>
												Niveau ' .$donnees1["nv_relationnel"]. '</div><div class="div9cadre div10cadre taille">
												<a href="presentationdelasortie.php" class="amaison">Voir la sortie</a>
												</div></div><div class="div6presen">
												<div class="div9cadre div10cadre taille">De  '.$donnees1["ddref"]. ' à ' .$donnees1["vdres"]. '<br/>' .$inputmessage. '</div>';
											}else
											{
												echo $photo. '<br/>' .$surnom. '<br/>
												Niveau ' .$donnees1["nv_relationnel"]. '</div></div><div class="div6presen">
												<div class="div9cadre div10cadre taille">De  '.$donnees1["ddref"]. ' à ' .$donnees1["vdres"]. '<br/>' .$inputmessage. '</div>';
											}
										}
									}
								}else
								{
									if(isset($_SESSION['id_sortie']))
									{
										echo $photo. '<br/>' .$surnom. '<br/>
										Niveau ' .$donnees1["nv_relationnel"]. '</div><form method="post" action="presentationprofil.php"><div class="div9cadre div10cadre">
										<input type="submit" name="intrus" value="Changer en intrus" class="boutonmodlesinfos"/></div><div class="div9cadre div10cadre taille">
										<a href="presentationdelasortie.php" class="amaison">Voir la sortie</a>
										</div></form></div><div class="div6presen">
										<div class="div9cadre div10cadre taille">De  '.$donnees1["ddref"]. ' à ' .$donnees1["vdres"]. '<br/>' .$inputmessage. '</div>';
									}else
									{
										echo $photo. '<br/>' .$surnom. '<br/>
										Niveau ' .$donnees1["nv_relationnel"]. '</div><form method="post" action="presentationprofil.php"><div class="div9cadre div10cadre">
										<input type="submit" name="intrus" value="Changer en intrus" class="boutonmodlesinfos"/></div></form></div><div class="div6presen">
										<div class="div9cadre div10cadre taille">De  '.$donnees1["ddref"]. ' à ' .$donnees1["vdres"]. '<br/>' .$inputmessage. '</div>'; 
									}
								}
							}else
							{
								if(isset($_SESSION['id_sortie']))
								{
									echo '<span style=\'font-weight: bold; font-size: 1.4em; \'>C\'est vous</span><br/>' .$photo. '<br/>' .$surnom. '<br/>
									Niveau ' .$donnees1["nv_relationnel"]. '</div><div class="div9cadre div10cadre taille">
									<a href="presentationdelasortie.php" class="amaison">Voir la sortie</a>
									</div></div><div class="div6presen">
									<div class="div9cadre div10cadre taille">De  '.$donnees1["ddref"]. ' à ' .$donnees1["vdres"]. '<br/>' .$inputmessage. '</div>';
								}else
								{
									echo '<span style=\'font-weight: bold; font-size: 1.4em; \'>C\'est vous</span><br/>' .$photo. '<br/>' .$surnom. '<br/>
									Niveau ' .$donnees1["nv_relationnel"]. '</div></div><div class="div6presen">
									<div class="div9cadre div10cadre taille">De  '.$donnees1["ddref"]. ' à ' .$donnees1["vdres"]. '<br/>' .$inputmessage. '</div>'; 
								}
							}
							if($donnees1['l'] == 1)
							{	
								echo '<div class="div9cadre div10cadre taille">
								<form method="post" action="traitementpresentationprofil_sympathie.php" class="form">
								<input type="submit" name="sympathiser" value="Faire une demande de sympathie" class="boutonnom" />
								</form>
								</div>'; 
								if(isset($donnees1_3['id_rencontre']))
								{
									if($donnees1_3['valeur_l'] == 1)
									{
										echo '<div class="div9cadre div10cadre taille">' .$condition. '</div>'; 
										for($i = 1; $i <= 14; $i++)
										{
											if($validite[$i] == 1)
											{
												echo '<div class="div9cadre div10cadre taille">
												<span style="font-weight: bold;">Rencontre type ' .$i. '</span><br/>
												' .$nom[$i]. '<br/>
												Lieu de rencontre: ' .$lieu[$i]. '<br/>
												Le ' .$jour[$i]. ' à ' .$heure[$i]. 'h' .$minute[$i].' pour une durée de ' .$duree[$i]. 'h</div>';
											}
										}
									}
								}
							}
						?>
					</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>