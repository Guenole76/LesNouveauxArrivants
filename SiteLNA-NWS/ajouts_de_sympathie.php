<?php 
session_start();
include('verificationid.php');
include('mysql.php');
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Ajouts de sympathie - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionajt">
			<div>
				<div class="div1ajt">
					<?php include('navrelations.php');?>
				</div>
				<div class="div2ajt">
					<div class="div9cadre div10cadre">
						<h2>Ajout par code sympathie</h2>
						<?php
					for($i = 1; $i <= 7; $i++)
					{
						if(isset($_SESSION['message'.$i]))
						{
							if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
							{
								echo $_SESSION['message'.$i].'<br/>';
							}
						}
					}
					for($i = 1; $i <= 7; $i++)
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
					</div>
					<div class="div9cadre div10cadre taille">
						<form method="post" action="traitement_ajouts_de_sympathie.php" class="form">
							<label>Ajout par code sympathie</label><br/>
							<input type="input" name="code_s" placeholder="Code sympathie" class="inputajtcode"/><br/>
							<div class="deplacementrecherchersorties">
								<input type="submit" name="ajouterparcode" value="Ajouter" class="bouton_gr"/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>