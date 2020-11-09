<?php 
session_start();
include('verificationid.php');
include('mysql.php');
?>

<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Faire une proposition - Les Nouveaux Arrivants</title>
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
					<div class="div9cadre div10cadre taille">
						<?php 
							for($i = 106; $i <= 116; $i++)
							{
								if(isset($_SESSION['message'.$i]))
								{
									if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
									{
										echo $_SESSION['message'.$i].'<br/>';
									}
								}
							}
							for($i = 106; $i <= 116; $i++)
							{
								if(isset($_SESSION['message'.$i]))
								{
									$_SESSION['message'.$i] = ""; 
								}
							}
						?>
						<h2>Faire une proposition</h2>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							<form method="post" action="traitementfaireuneproposition.php">
								<label class="taille">La proposition</label><br/>
								<textarea name="proposition" rows=7 cols=40 placeholder="Votre proposition" class="textareames"></textarea><br/>
								<input type="submit" name="valider" value="Envoyer votre proposition" class="boutonamais"/>
							</form>
						</p>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>