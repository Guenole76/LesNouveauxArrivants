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
}elseif($_SESSION['message'] == 43)
{
	$_SESSION['envoye'] =  "Le bouton modifier n'a pas été cliqué.";
}elseif($_SESSION['message'] == 44)
{
	$_SESSION['envoye'] = "Veuillez saisir une nouvelle adresse e-mail";
}elseif($_SESSION['message'] == 45)
{
	$_SESSION['envoye'] = "Veuillez saisir la confirmation de la nouvelle adresse e-mail.";
}elseif($_SESSION['message'] == 46)
{
	$_SESSION['envoye'] = "Veuillez saisir votre mot de passe";
}elseif($_SESSION['message'] == 47)
{
	$_SESSION['envoye'] = "Votre nouvelle adresse e-mail contient des caractères interdits.";
}elseif($_SESSION['message'] == 48)
{
	$_SESSION['envoye'] = "Votre confirmation de la nouvelle adresse e-mail contient des caractères interdits.";
}elseif($_SESSION['message'] == 49)
{
	$_SESSION['envoye'] = "Votre mot de passe contient des caractères interdits.";
}elseif($_SESSION['message'] == 50)
{
	$_SESSION['envoye'] = "Les adresses e-mail données ne sont pas identiques.";
}elseif($_SESSION['message'] == 51)
{
	$_SESSION['envoye'] = "Le mot de passe est érroné";
}elseif($_SESSION['message'] == 52)
{
	$_SESSION['envoye'] = "Cette adresse e-mail est déjà utilisée.";
}
include('mysql.php');
include('navphoto.php');
 ?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Modifier l'adresse e-mail - Les Nouveaux Arrivants</title>
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
							if($_SESSION['message'] >= 43 AND $_SESSION['message'] <= 52 )
							{
								echo $_SESSION['envoye'];
							}
						?>
						<h2>Modifier votre adresse e-mail</h2>
					</div>
					<div class="div9cadre div10cadre">
						<form method="post" action="traitementmodifierladresseemail.php">
							<p>
								<label for="nemail" class="labelmodlad">Nouvelle adresse e-mail</label><br/><input type="email" name="naem" id="nemail" placeholder="Ex: xyz@hotmail.fr" class="inputmodlad"/><br/>
								<label for="ncemail" class="labelmodlad">Confirmation de la nouvelle adresse</label><br/><input type="email" name="cnaem" id="ncemail" class="inputmodlad"/><br/>
								<label for="mdp" class="labelmodlad">Votre mot de passe</label><br/><input type="password" name="mdp" id="mdp" class="inputmodlad" /><br/>
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