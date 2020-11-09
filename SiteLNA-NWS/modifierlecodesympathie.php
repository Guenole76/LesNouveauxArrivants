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
		<title>Modifier votre code sympathie - Les Nouveaux Arrivants</title>
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
							for($i = 1; $i < 7; $i++)
							{
								if(isset($_SESSION['message'.$i]))
								{
									if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
									{
										echo $_SESSION['message'.$i].'<br/>';
									}
								}
							}
							for($i = 1; $i <= 6; $i++)
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
						<h2>Modifier votre code sympathie</h2>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							<form method="post" action="traitementmodifierlecodesympathie.php">
								<label>Entrez votre nouveau code sympathie (Entre 8 et 45 caractères)</label><br/>
								<input type="text" name="nvcode" placeholder="Votre nouveau code sympathie" maxlength=45 class="input"><br/>
								<label>Entrez votre mot de passe</label><br/>
								<input type="password" name="mdpcode" placeholder="Votre mot de passe" maxlength=45 class="input"><br/>
								<input type="submit" name="valider" value="Modifier votre code" class="boutonamais"/>
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