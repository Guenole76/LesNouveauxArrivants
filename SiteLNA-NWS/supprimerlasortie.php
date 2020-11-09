<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('verificationidcreateur2.php');
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Supprimer la sortie - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navsortie.php"); ?>
					<?php include("navvoirlasortie.php"); ?>
				</div>
				<div class="div2amais">
					<div class="div9cadre div10cadre">
						<h2>Supprimer la sortie</h2>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							<form method="post" action="traitementsupprimerlasortie.php">
								<label>Voulez-vous vraiment supprimer votre sortie ?<br/>(attention, vous supprimerez la sortie en cliquant sur Oui)</label><br/>
								<input type="submit" name="oui" value="Oui" class="boutonamais"/> 
								<input type="submit" name="non" value="Non" class="boutonamais"/>
								
							</form>
						</p>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>