<?php 
session_start();
include('verificationid.php');
include('verificationidrepondant.php');
include('mysql.php');
include('navphoto.php');
include('lienauto.php');
$req1 = $bdd->prepare('SELECT proposition FROM proposition WHERE id_proposition = ?');
$req1->execute(array($_SESSION['id_proposition']));
$donnees1 = $req1->fetch();
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Modifier la proposition - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navsortie.php"); ?>
					<?php include("nav_demande.php"); ?>
					<?php include("navvoirlaproposition.php"); ?>
				</div>
				<div class="div2amais">
					<div class="div9cadre div10cadre">
						<?php 
							for($i = 117; $i <= 127; $i++)
							{
								if(isset($_SESSION['message'.$i]))
									{
									if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
									{
										echo $_SESSION['message'.$i].'<br/>';
									}
								}
							}
						?>
						<h2 class="taille">La proposition</h2>
					</div>
					<div class="div9cadre div10cadre taille">
						<p>
							<?php $description = wordwrap($donnees1['proposition'], 40, "\r\n", true); 
							$description2 = lienauto($description);
							echo $description2; ?> <br/>
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<h2 class="taille">Modifier la proposition</h2>
						<form method="post" action="traitementmodifierlaproposition.php">
							<label class="taille">La proposition</label><br/>
							<textarea name="proposition" rows=7 cols=40 placeholder="La proposition" class="textareames"><?php echo $description; ?></textarea><br/>
							<input type="submit" name="valider" value="Modifier la proposition" class="boutonamais"/>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>