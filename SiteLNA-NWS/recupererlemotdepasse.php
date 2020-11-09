<?php 
session_start();
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Récupération de mot de passe - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headernc.php"); ?>
		<section class="sectioncgu">
			<div class="pcgu">
				<div class="div9cadre4 div11cadre">
					<?php 
						for($i = 156; $i <= 159; $i++)
						{
							if(isset($_SESSION['message'.$i]))
								{
								if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
								{
									echo $_SESSION['message'.$i].'<br/>';
									$_SESSION['message'.$i] = ""; 
								}
							}
						}
					?>
					<h2 class="trecuperermdp">Récupérer le mot de passe</h2>
					<form method="post" action="traitementrecupererlemotdepasse.php">
						<input type="text" name="aem" placeholder="Votre adresse e-mail" class="input"><br/>
						<input type="submit" name="valider" value="Envoyer" class="boutonamais"/>
					</form>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>