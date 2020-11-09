<?php 
session_start(); 
include('verificationid.php');
include('mysql.php');
include('navphoto.php');
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Modifier vos photos de profil - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionmodlaphoto">
			<div class="pmodlaphoto">
				<div class="div1profil">
					<div class="div9cadre div11cadre div12cadre";>
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
							for($i = 1; $i <= 6; $i++)
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
						<h2>Modifier vos photos de profil</h2>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							<form method="post" action="traitementmodifiervosphotos.php" enctype="multipart/form-data">
								<div class="photomlp">
									<img class="photomlp2" src="listephotosdeprofil/lalibellule.JPG" alt="La Libellule" title="La Libellule"/>
									<img class="photomlp2" src="listephotosdeprofil/lecouple.JPG" alt="Le Couple" title="Le Couple"/>
									<img class="photomlp2" src="listephotosdeprofil/lefeu.jPG" alt="Le Feu" title="Le Feu"/>
									<img class="photomlp2" src="listephotosdeprofil/lesmoutons.JPG" alt="Les Moutons" title="Les Moutons"/>
									<img class="photomlp2" src="listephotosdeprofil/loiseau.JPG" alt="L'Oiseau" title="L'Oiseau"/>
								</div>
								<div class="photomlp">
									<img class="photomlp2" src="listephotosdeprofil/maindanslesable.JPG" alt="La Main dans le sable" title="La Main dans le sable"/>
									<img class="photomlp2" src="listephotosdeprofil/nuiteclairee.JPG" alt="La Nuit élairée" title="La Nuit éclairée"/>
									<img class="photomlp2" src="listephotosdeprofil/patrouillefrancaise.JPG" alt="La Patrouille de France" title="La Patrouille de France"/>
									<img class="photomlp2" src="listephotosdeprofil/tourjeannedarc.JPG" alt="La Tour Jeanne d'Arc" title="La Tour Jeanne d'Arc"/>
									<img class="photomlp2" src="listephotosdeprofil/troisverres.JPG" alt="Les Trois verres" title="Les Trois verres"/>
								</div>
										<label for="photodep1" class="labelmodlesinfos">Photo de profil 1</label><br/>
										<select name="photodep1" class="inputmodlesinfos">
											<?php include('listephotodep.php'); ?>
										</select><br/>
										<label for="photodep2" class="labelmodlesinfos">Photo de profil 2 (différente de la photo 1)</label><br/>
										<select name="photodep2" class="inputmodlesinfos">
											<?php include('listephotodep.php'); ?>
										</select><br/>
								<input type="submit" name="valider" value="Modifier vos photos" class="boutonmodlaphoto"/><br/>
							</form>
						</p>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>