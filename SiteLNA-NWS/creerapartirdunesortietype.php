<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('lienauto.php');
if(isset($_POST['id_sortie_type']))
{
	$idstc = $_POST['id_sortie_type'];
	$_SESSION['idstc'] = $_POST['id_sortie_type'];
}elseif(isset($_SESSION['idstc']))
{
	$idstc = $_SESSION['idstc'];
}else
{
	header('Location: choixdesortietype.php');
}
$date = date('Y-m-d', time());
$req1 = $bdd->prepare('SELECT * FROM sortietype WHERE id_sortie_type = ?');
$req1->execute(array($idstc));
$donnees1 = $req1->fetch();
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Création d'une sortie à partir de votre sortie type - Les Nouveaux Arrivants</title>
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
						<h2 class="taille">Informations sur la sortie type utilisée</h2>
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
						<h2 class="taille">Créer une sortie à partir de votre sortie type</h2>
						<form method="post" action="traitementcreerapartirdunesortietype.php">
							<label class="taille">Date de la sortie</label> <br/>
							<input type="date" min="<?php echo $date; ?>" name="dsortie" class="input"/><br/>
							<label class="taille">Heure de la sortie</label><br/>
							<select name="hsortie" class="selectsorties">
								<option value="" selected>Heure</option>
								<?php for($heure = 0; $heure <= 9; $heure++)
								{
									echo '<option value="0'. $heure .'">0'. $heure .'</option>';
								} 
								?>
								<?php for($heure = 10; $heure <= 23; $heure++)
								{
									echo '<option value="'. $heure .'">'. $heure .'</option>';
								} 
								?>
							</select>
							<select name="msortie" class="selectsorties">
								<option value="" selected>Minutes</option>
								<?php for($minute = 0; $minute <= 9; $minute++)
								{
									echo '<option value="0'. $minute .'">0'. $minute .'</option>';
								} 
								?>
								<?php for($minute = 10; $minute <= 59; $minute++)
								{
									echo '<option value="'. $minute .'">'. $minute .'</option>';
								} 
								?>
							</select><br/>
							<input type="submit" name="valider" value="Créer la sortie" class="boutonamais s_p_margin"/>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>