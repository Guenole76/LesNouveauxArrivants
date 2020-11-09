<?php 
session_start();
include('verificationid.php');
include('verificationiddemandeur.php');
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Supprimer la demande - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navsortie.php"); ?>
					<?php include("nav_demande.php"); ?>
					<?php include("navvoirlademande.php"); ?>
				</div>
				<div class="div2amais">
					<div class="div9cadre div10cadre">
						<h2>Supprimer la demande</h2>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							<form method="post" action="traitementsupprimerlademande.php">
								<label>Voulez-vous vraiment supprimer votre demande ?<br/>(attention, vous supprimerez la demande en cliquant sur Oui)</label><br/>
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