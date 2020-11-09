<?php 
session_start(); 
include('verificationid.php');
if(!isset($_SESSION['message']))
{
	$_SESSION['message'] = 0; 
}
if($_SESSION['message'] == 0)
{
	$_SESSION['envoye'] = "";
}elseif($_SESSION['message'] == 91)
{
	$_SESSION['envoye'] = "Vous n'avez pas cliqué sur le bouton modifier la photo.";
}elseif($_SESSION['message'] == 92)
{
	$_SESSION['envoye'] = "L'extension de votre photo n'est pas autorisée.";
}elseif($_SESSION['message'] == 93)
{
	$_SESSION['envoye'] = "Votre photo dépasse la taille maximale autorisée en octets.";
}elseif($_SESSION['message'] == 94)
{
	$_SESSION['envoye'] = "Veuillez réessayer, s'il vous plaît. Si le problème persiste, contactez-nous avec le formulaire de contact mis à votre disposition.";
}
if($_SESSION['message'] >= 91 AND $_SESSION['message'] <= 94 )
{
	echo $_SESSION['envoye'];
}
include('mysql.php');
include('navphoto.php');
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Modifier la photo de lieu - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionmodlaphoto">
			<div class="pmodlaphoto">
				<div class="div1profil">
					<div class="div9cadre div11cadre div12cadre">
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
							if($_SESSION['message'] >= 91 AND $_SESSION['message'] <= 94 )
							{
								echo $_SESSION['envoye'];
							}
						?>
						<h2>Modifier la photo de profil</h2>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							<form method="post" action="traitementmodifiervotrephotodelieu.php" enctype="multipart/form-data">
								<label>Choississez votre photo de profil (3 Mo maximum) : </label><br/>
								<input type="hidden" name="MAX_FILE_SIZE" value="3000000"/>
								<input type="file" name="avatar"/>
								<input type="submit" name="valider" value="Modifier la photo" class="boutonmodlaphoto"/><br/>
								<input type="submit" name="valider2" value="Mettre la photo de base" class="boutonmodlaphoto"/>
							</form>
						</p>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>