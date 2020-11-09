<?php 
session_start();
include('verificationid.php');
include('mysql.php');
if(!isset($_SESSION['message']))
{
	$_SESSION['message'] = 0; 
}
if($_SESSION['message'] == 0)
{
	$_SESSION['envoye'] = "";
}
include('navphoto.php');
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Disparaître - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<div class="div11cadre div9cadre div12cadre">
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
				<div class="div2amais">
					<div class="div9cadre div10cadre">
						<?php
							for($i = 1; $i < 4; $i++)
							{
								if(isset($_SESSION['message'.$i]))
								{
									if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
									{
										echo $_SESSION['message'.$i].'<br/>';
									}
								}
							}
							for($i = 1; $i <= 3; $i++)
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
						<h2>Disparaître</h2>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							Vous disparaîtrez du site après avoir validé votre mot de passe, <br/>
							et ne recevrez plus d'e-mail annonçant les prochaines sorties sur le site
							<form method="post" action="traitementdisparaitre.php">
								<label>Entrez votre mot de passe</label><br/>
								<input type="password" name="mdp" placeholder="Votre mot de passe" maxlength=45 class="input"><br/>
								<input type="submit" name="valider" value="Valider" class="boutonamais"/>
								<a href="informationspersonnelles.php" class="amodlad">Annuler</a> 
							</form>
						</p>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>