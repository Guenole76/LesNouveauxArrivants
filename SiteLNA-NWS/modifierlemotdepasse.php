<?php 
session_start();
include('verificationid.php');
if(!isset($_SESSION['message']))
{
	$_SESSION['message'] = 0; 
}
if($_SESSION['message'] == 0)
{
	$_SESSION['envoye'] = "";
}elseif($_SESSION['message'] == 53)
{
	$_SESSION['envoye'] =  "Le bouton modifier n'a pas été cliqué.";
}elseif($_SESSION['message'] == 54)
{
	$_SESSION['envoye'] = "Veuillez saisir un nouveau mot de passe.";
}elseif($_SESSION['message'] == 55)
{
	$_SESSION['envoye'] = "Veuillez saisir la confirmation du nouveau mot de passe.";
}elseif($_SESSION['message'] == 56)
{
	$_SESSION['envoye'] = "Veuillez saisir votre ancien mot de passe";
}elseif($_SESSION['message'] == 57)
{
	$_SESSION['envoye'] = "Votre nouveau mot de passe contient des caractères interdits.";
}elseif($_SESSION['message'] == 58)
{
	$_SESSION['envoye'] = "Votre confirmation du nouveau contient des caractères interdits.";
}elseif($_SESSION['message'] == 59)
{
	$_SESSION['envoye'] = "Votre mot de passe contient des caractères interdits.";
}elseif($_SESSION['message'] == 60)
{
	$_SESSION['envoye'] = "Les mots de passe ne sont pas identiques.";
}elseif($_SESSION['message'] == 61)
{
	$_SESSION['envoye'] = "L'ancien mot de passe est érroné";
}
include('mysql.php');
include('navphoto.php');
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Modifier le mot de passe - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionmodlad">
			<div class="pmodlad">
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
							if($_SESSION['message'] >= 53 AND $_SESSION['message'] <= 61 )
							{
								echo $_SESSION['envoye'];
							}
						?>
						<h2>Modifier votre mot de passe</h2>
					</div>
					<div class="div9cadre div10cadre">
						<form method="post" action="traitementmodifierlemotdepasse.php">
							<p>
								<label for="nmdp" class="labelmodlad">Nouveau mot de passe</label><br/><input type="password" name="nmdp" id="nmdp" maxlength=45 class="inputmodlad"/><br/>
								<label for="cnmdp" class="labelmodlad">Confirmation du nouveau mot de passe</label><br/><input type="password" 
								name="cnmdp" id="cnmdp" maxlength=45 class="inputmodlad"/><br/>
								<label for="amdp" class="labelmodlad">Ancien mot de passe</label><br/><input type="password" name="mdp" id="amdp" maxlength=45 class="inputmodlad"/><br/>
								<div class="envoyermodlad">
									<input type="submit" name="valider" value="Modifier" class="boutonmodlad"/>
									<a href="informationspersonnelles.php" class="amodlad">Annuler</a> 
								</div>
							</p>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>