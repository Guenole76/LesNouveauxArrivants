<?php 
session_start();
include('verificationid.php');
include('verificationidrepondant.php');
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Supprimer la proposition - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navsortie.php"); ?>
					<?php include("nav_proposition.php"); ?>
					<?php include("navvoirlaproposition.php"); ?>
				</div>
				<div class="div2amais">
					<div class="div9cadre div10cadre">
						<h2>Supprimer la proposition</h2>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							<form method="post" action="traitementsupprimerlaproposition.php">
								<label>Voulez-vous vraiment supprimer votre proposition ?<br/>(attention, vous supprimerez la proposition en cliquant sur Oui)</label><br/>
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