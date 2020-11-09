<?php 
session_start();
include('verificationid.php');
include('mysql.php');
$req = $bdd->prepare('SELECT val_email_j, email_ins_s, email_ins_b, email_com_s, email_mes, email_prop FROM inscrits WHERE id = ?');
$req->execute(array($_SESSION['id']));
$donnees = $req->fetch();
if($donnees['val_email_j'] == 1)
{
	$valj = "Accepté";
}else
{
	$valj = "Refusé";
}
if($donnees['email_ins_s'] == 1)
{
	$eis = "Accepté";
}else
{
	$eis = "Refusé";
}
if($donnees['email_ins_b'] == 1)
{
	$eib = "Accepté";
}else
{
	$eib = "Refusé";
}
if($donnees['email_com_s'] == 1)
{
	$ecs = "Accepté";
}else
{
	$ecs = "Refusé";
}
if($donnees['email_mes'] == 1)
{
	$em = "Accepté";
}else
{
	$em = "Refusé";
}
if($donnees['email_prop'] == 1)
{
	$ep = "Accepté";
}else
{
	$ep = "Refusé";
}
include('navphoto.php');
include('lienauto.php');
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Informations personnelles - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectioninfosperso">
			<div class="pinfosperso">
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
						<h2>Gestion des emails</h2>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							E-mail journalier (<?php echo $valj; ?>)
							<form method="post" action="traitementmodifierlagestiondesemails.php">
							<input type='hidden' name='emailnum' value=1 />
							<input type="submit" name="change" value="Modifier l'autorisation" class="boutoninfosperso"/>
							</form>
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							E-mail après inscription à l'une de vos sorties (<?php echo $eis; ?>)
							<form method="post" action="traitementmodifierlagestiondesemails.php">
							<input type='hidden' name='emailnum' value=2 />
							<input type="submit" name="change" value="Modifier l'autorisation" class="boutoninfosperso"/>
							</form>
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							E-mail après inscription à l'une des boîtes de vos sorties (<?php echo $eib; ?>)
							<form method="post" action="traitementmodifierlagestiondesemails.php">
							<input type='hidden' name='emailnum' value=3 />
							<input type="submit" name="change" value="Modifier l'autorisation" class="boutoninfosperso"/>
							</form>
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							E-mail après émission d'un commentaire sur l'une de vos sorties (<?php echo $ecs; ?>)
							<form method="post" action="traitementmodifierlagestiondesemails.php">
							<input type='hidden' name='emailnum' value=4 />
							<input type="submit" name="change" value="Modifier l'autorisation" class="boutoninfosperso"/>
							</form>
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							E-mail après réception d'un message privé provenant d'un membre (<?php echo $em; ?>)
							<form method="post" action="traitementmodifierlagestiondesemails.php">
							<input type='hidden' name='emailnum' value=5 />
							<input type="submit" name="change" value="Modifier l'autorisation" class="boutoninfosperso"/>
							</form>
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							E-mail après réception d'une proposition provenant d'un membre (<?php echo $ep; ?>)
							<form method="post" action="traitementmodifierlagestiondesemails.php">
							<input type='hidden' name='emailnum' value=6 />
							<input type="submit" name="change" value="Modifier l'autorisation" class="boutoninfosperso"/>
							</form>
						</p>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>