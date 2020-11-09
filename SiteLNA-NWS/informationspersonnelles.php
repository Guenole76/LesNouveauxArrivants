<?php 
session_start();
include('verificationid.php');
include('mysql.php');
if(isset($_SESSION['id']))
{
	$req = $bdd->prepare('SELECT * FROM inscrits WHERE id = ?');
	$req->execute(array($_SESSION['id']));
	$donnees = $req->fetch();
	$req1 = $bdd->prepare('SELECT * FROM duree_abonnement WHERE id_membre = ?');
	$req1->execute(array($_SESSION['id']));
	$donnees1 = $req1->fetch();
	$req2 = $bdd->prepare('SELECT * FROM rencontre WHERE id_l = ?');
	$req2->execute(array($_SESSION['id']));
	$donnees2 = $req2->fetch();
}else
{
	header('Location:deconnexion.php');
}
if(isset($donnees2['id_rencontre']))
{ 
	for($n = 1; $n <= 14; $n++)
	{
		$nom[$n] = $donnees2['nom_r'.$n];
		$lieu[$n] = $donnees2['lieu_r'.$n];
		$jour[$n] = $donnees2['jour_r'.$n];
		$heure[$n] = $donnees2['heure_r'.$n];
		$minute[$n] = $donnees2['minute_r'.$n];
		$duree[$n] = $donnees2['duree_r'.$n];
		$validite[$n] = $donnees2['validite_r'.$n];
	}
}else
{
	$rencontre = "Vous ne proposez aucun horaire de rencontre"; 
}
$temps_actuel = time();
include('navphoto.php');
include('lienauto.php');
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Informations personnelles - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectioninfosperso">
			<div class="pinfosperso">
				<div class="div1profil">
					<div class="div9cadre div11cadre div12cadre">
						<?php echo $photo; ?>
						<?php 
							if($donneesphoto['l'] == 1)
							{
								$titre = $donneesphoto['nom_l'];
							}else
							{
								$titre = $donneesphoto['surnom1'];
							}
						?>
						<?php echo $titre. "<br/>";  ?>
						<?php echo "Niveau " .$donneesphoto['nv_relationnel']; ?>
					</div>
					<?php include("navprofil.php"); ?>
				</div>
				<div class="div2profil">
					<div class="div9cadre div10cadre">
						<h2>Vos informations personnelles</h2>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							<?php
								if($donnees1['timestamp_partage'] > $temps_actuel)
								{
									$date_partage = date('d/m/y', $donnees1['timestamp_partage']);
									echo 'Votre abonnement "Partage" terminera le ' .$date_partage. '<br/>';
								}else
								{
									echo "L'abonnement \"Partage\" n'est pas effectif<br/>";
								}
							?>
						</p>
						<p>
							<form method="post" action="abonnement.php">
							<input type="submit" name="abo" value="Voir les privilèges" class="boutoninfosperso" />
							</form>
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<?php 
							if($donnees['l'] == 1)
							{
								echo "Lieu";
							}
						?>
						<p>
							Surnom 1 : <?php echo $donnees['surnom1']; ?><br/>
							Surnom 2 : <?php echo $donnees['surnom2']; ?>
						</p>
						<p>
							Date de naissance : <?php echo ''.$donnees['jdn'].' '.$donnees['mdn'].' '.$donnees['adn'].''; ?>
						</p>
						<p>
							Département de référence : <?php echo $donnees['ddref']; ?><br/>
							Ville de résidence : <?php echo $donnees['vdres']; ?>
						</p>
						<p>
							Sexe : <?php echo $donnees['s']; ?>
							<form method="post" action="traitementinformationspersonnelles.php">
							<input type="submit" name="minfos" value="Modifier vos informations et vos photos" class="boutoninfosperso"/>
							</form>
						</p>
					</div>
					<?php 
						if($donnees['l'] == 1)
							{
								$condition = wordwrap($donnees2['condition_r'], 40, "\r\n", true);
								$condition2 = lienauto($condition);
								echo "<div class='div9cadre div10cadre'>
										<p>
											Votre nom de lieu : " .$donnees['nom_l']. "<br/>
											Vos conditions : " .$donnees2['condition_r']. "<br/>
										</p>
										<p>
											<form method='post' action='traitementinformationspersonnelles.php'>
											<input type='submit' name='minfos_l' value='Modifier vos informations de lieu' class='boutoninfosperso'/>
											</form>
										</p>
									 </div>";
								 for($n = 1; $n <= 14; $n++)
								{
									if($validite[$n] == 1)
									{	
										echo "<div class='div9cadre3 div10cadre'>Rencontre type ".$n." (effective) <br/>". $nom[$n]. " à " .$lieu[$n]. " le " .$jour[$n]. " à " .$heure[$n]. "h" .$minute[$n]. " pour une durée de " .$duree[$n]. "h</div>";
									}else
									{
										echo "<div class='div9cadre3 div10cadre'>Rencontre type ".$n." (non effective) <br/>". $nom[$n]. " à " .$lieu[$n]. " le " .$jour[$n]. " à " .$heure[$n]. "h" .$minute[$n]. " pour une durée de " .$duree[$n]. "h</div>";
									}
								}
							}
					?>
					<div class="div9cadre div10cadre">
						<p>
							Votre code sympathie : <?php echo $donnees['code_sympathie']; ?>
							<form method="post" action="traitementinformationspersonnelles.php">
							<input type="submit" name="mcs" value="Modifier votre code sympathie" class="boutoninfosperso"/>
							</form>
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							Adresse e-mail : <?php echo $donnees['caem']; ?>
							<form method="post" action="traitementinformationspersonnelles.php">
							<input type="submit" name="maem" value="Modifier votre adresse e-mail" class="boutoninfosperso"/>
							</form>
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							Gestion des emails
							<form method="post" action="traitementinformationspersonnelles.php">
							<input type="submit" name="mgdm" value="Modifier la gestion" class="boutoninfosperso"/>
							</form>
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							Modifier votre mot de passe 
							<form method="post" action="traitementinformationspersonnelles.php">
							<input type="submit" name="mmdp" value="Modifier votre mot de passe" class="boutoninfosperso"/>
							</form>
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							Disparaître
							<form method="post" action="traitementinformationspersonnelles.php">
							<input type="submit" name="d" value="Disparaître" class="boutoninfosperso"/>
							</form>
						</p>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>