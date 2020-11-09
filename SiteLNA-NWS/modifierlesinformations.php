<?php 
session_start(); 
include('verificationid.php');
include('mysql.php');
$req = $bdd->prepare('SELECT surnom1, surnom2, photodep1, photodep2, vdres FROM inscrits WHERE id = ?');
$req->execute(array($_SESSION['id']));
$donnees = $req->fetch();
include('navphoto.php');
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Modifier les informations personnelles - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionmodlesinfos">
			<div class="pmodlesinfos">
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
						<?php
							for($i = 1; $i <= 14; $i++)
							{
								if(isset($_SESSION['message'.$i]))
									{
									if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
									{
										echo $_SESSION['message'.$i].'<br/>';
									}
								}
							}
							for($i = 1; $i <= 14; $i++)
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
						<h2>Modifier vos informations personnelles</h2>
					</div>
					<div class="div9cadre div10cadre">
						<a href="modifiervosphotos.php" class="amodlesinfos2">Modifier vos photos</a> 
					</div>
					<div class="div9cadre div10cadre">
						<p>
							<form method="post" action="traitementmodifierlesinformations.php">
								<label for="surnom1" class="labelmodlesinfos">Surnom 1</label><br/>
								<select name="surnom1" class="inputmodlesinfos">
									<?php include('listesurnoms.php'); ?>
								</select><br/>
								<label for="surnom2" class="labelmodlesinfos">Surnom 2 (différent du surnom 1)</label><br/>
								<select name="surnom2" class="inputmodlesinfos">
									<?php include('listesurnoms.php'); ?>
								</select>
								<div class="datemodlesinfos">Date de naissance</div>
								<select name="jdn" class="selectmodlesinfos">
									<option value="" selected >Jour</option>
									<?php for($jour = 1; $jour <= 31; $jour++)
									{
										echo '<option value="'. $jour .'">'. $jour .'</option>';
									} 
									?>
								</select>
								<select name="mdn" class="selectmodlesinfos">
									<?php include('moisdelannee.php'); ?>
								</select>
								<select name="adn" class="selectmodlesinfos">
									<option value="" selected>Année</option>
									<?php for($annee = 2017; $annee >= 1900; $annee--)
									{
										echo '<option value="'. $annee .'">'. $annee .'</option>';
									} 
									?>
								</select> <br/>
								<label class="labelmodlesinfos">Département de référence</label><br/>
								<select name="ddref" class="selectmodlesinfos">
									<?php include('departementdefrance.php'); ?>
								</select>
								<br/>
								<label for="vdres" class="labelmodlesinfos">Ville de résidence</label><br/><input type="text" name="vdres" maxlength=100 id="vdres" placeholder="Ex: Havre, Orsay, etc..."
								value="<?php echo $donnees['vdres']; ?>" class="inputmodlesinfos"/><br/>
								<input type="radio" name="s" value="homme" id="homme" class="radiomodlesinfos"/><label for="homme" class="labelmodlesinfos">Homme</label>
								<input type="radio" name="s" value="femme" id="femme" class="radiomodlesinfos"/><label for="femme" class="labelmodlesinfos">Femme</label><br/>
								<div style="margin-top: 20px;">
									<input type="radio" name="l" value="1" id="lieu" class="radiomodlesinfos"/><label for="lieu" class="labelmodlesinfos">Lieu</label>
									<input type="radio" name="l" value="2" id="individu" class="radiomodlesinfos"/><label for="individu" class="labelmodlesinfos">Individu</label><br/>
								</div>
								<div class="envoyermodlesinfos" style="margin-top: 20px;">
									<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
									<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
								</div>
							</form>
						</p>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>