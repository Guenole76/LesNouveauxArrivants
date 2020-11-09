<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('lienauto.php');
if(isset($_POST['id_sortie_type']))
{
	$idst = $_POST['id_sortie_type'];
	$_SESSION['idst'] = $_POST['id_sortie_type'];
}elseif(isset($_SESSION['idst']))
{
	$idst = $_SESSION['idst'];
}else
{
	header('Location: listesortiestype.php');
}
$req1 = $bdd->prepare('SELECT * FROM sortietype WHERE id_sortie_type = ?');
$req1->execute(array($idst));
$donnees1 = $req1->fetch();
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Modifier votre sortie type - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navprofil.php"); ?>
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
						<h2 class="taille">Informations sur votre sortie type</h2>
					</div>
					<div class="div9cadre div10cadre taille">
						<p>
							<?php 
								if($donnees1['s_privative'] == 1)
								{
									echo "Sortie type privée<br/>";
								}else
								{
									echo "Sortie type publique<br/>";
								}
							?>
							Intitulé de la sortie type: <?php echo $donnees1['intitule']; ?> <br/>
							Département de la sortie type: <?php echo $donnees1['ddref_sortie_type']; ?> <br/>
							Ville de la sortie type: <?php echo $donnees1['vdres_sortie_type']; ?> <br/>
							Durée de la sortie: <?php echo $donnees1['duree']; ?>h <br/> 
							Nombre de participants maximum: <?php echo $donnees1['nbrparticipants']; ?> <br/>	
							Tarif: <?php echo $donnees1['tarif']; ?>€/pers. <br/>		
							Description de la sortie<br/> <?php $description = wordwrap($donnees1['description'], 40, "\r\n", true); 
							$description2 = lienauto($description);
							echo $description2; ?>				
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<h2 class="taille">Modifier votre sortie type</h2>
						<form method="post" action="traitementmodifierunesortietype.php">
							<label class="taille">Intitulé de votre sortie type</label> <br/><input type="text" name="isortietype" maxlength=30 class="input"/><br/>
							<div class="taille">Département de votre sortie type</div>
							<div>
							<select name="ddrefsortietype" class="selectsorties">
								<?php include('departementdefrance.php'); ?>
							</select>
							<br/>
							</div>
							<label class="taille">Ville de votre sortie type</label><br/><input type="text" name="vdressortietype" maxlength=100 id="" placeholder="Ex: Havre, Orsay, etc..." class="input"/><br/>
							<label class="taille">Nombre de participants maximum à votre sortie type</label><br/>
							<input type="number" min=0 name="nbrpsortietype" class="input"/><br/>
							<label class="taille">Durée de votre sortie type</label><br/>
							<input type="number" min=0 name="dureesortietype" class="input"/><br/>
							<label class="taille">Tarif de votre sortie type (en €/pers.)</label><br/>
							<input type="number" min=0 name="tarifsortietype" class="input"/><br/>
							<label class="taille">Description de votre sortie type</label><br/>
							<textarea name="descripsortietype" rows=7 cols=40 placeholder="Description de votre sortie type" class="textareames"><?php echo $description; ?></textarea><br/>
							<input type="radio" name="s_psortietype" value="1" id="privee" class="radiomodlesinfos"/><label for="privee" class="labelmodlesinfos">Sortie type privée</label>
							<input type="radio" name="s_psortietype" value="2" id="publique" class="radiomodlesinfos"/><label for="publique" class="labelmodlesinfos">Sortie type publique</label><br/>
							<input type="submit" name="valider" value="Modifier votre sortie type" class="boutonamais s_p_margin"/>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>