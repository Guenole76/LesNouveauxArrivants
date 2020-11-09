<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('verificationidcreateur2.php');
include('navphoto.php');
include('lienauto.php');
$req1 = $bdd->prepare('SELECT * FROM sortie WHERE id_sortie = ?');
$req1->execute(array($_SESSION['id_sortie']));
$donnees1 = $req1->fetch();
$datesortie = date('d/m/Y', $donnees1['date']);
$date = date('Y-m-d', time());
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Modifier la sortie - Les Nouveaux Arrivants</title>
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
						<h2 class="taille">Informations sur la sortie</h2>
					</div>
					<div class="div9cadre div10cadre taille">
						<p>
							<?php 
								if($donnees1['s_privative'] == 1)
								{
									echo "Sortie privée<br/>";
								}else
								{
									echo "Sortie publique<br/>";
								}
							?>
							Intitulé de la sortie: <?php echo $donnees1['intitule']; ?> <br/>
							Département de la sortie: <?php echo $donnees1['ddref_sortie']; ?> <br/>
							Ville de la sortie: <?php echo $donnees1['vdres_sortie']; ?> <br/>
							Date de la sortie: <?php echo $datesortie; ?> <br/>
							Heure de la sortie: <?php echo $donnees1['heure']. "h" .$donnees1['minute']; ?> <br/>
							Durée de la sortie: <?php echo $donnees1['duree']; ?>h <br/> 
							Nombre de participants maximum: <?php echo $donnees1['nbrparticipants']; ?> <br/>	
							Tarif: <?php echo $donnees1['tarif']; ?>€/pers. <br/>		
							Description de la sortie<br/> <?php $description = wordwrap($donnees1['description'], 40, "\r\n", true); 
							$description2 = lienauto($description);
							echo $description2; ?>				
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<h2 class="taille">Modifier la sortie</h2>
						<form method="post" action="traitementmodifierlasortie.php">
							<label class="taille">Intitulé de la sortie</label> <br/><input type="text" name="isortie" maxlength=30 class="input"/><br/>
							<div class="taille">Département de votre sortie</div>
							<div>
							<select name="ddrefsortie" class="selectsorties">
								<?php include('departementdefrance.php'); ?>
							</select>
							<br/>
							</div>
							<label class="taille">Ville de votre sortie</label><br/><input type="text" name="vdressortie" maxlength=100 id="" placeholder="Ex: Havre, Orsay, etc..." class="input"/><br/>
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
							<label class="taille">Nombre de participants maximum à la sortie</label><br/>
							<input type="number" min=0 name="nbrpsortie" class="input"/><br/>
							<label class="taille">Durée de la sortie</label><br/>
							<input type="number" min=0 name="dureesortie" class="input"/><br/>
							<label class="taille">Tarif de la sortie (en €/pers.)</label><br/>
							<input type="number" min=0 name="tarifsortie" class="input"/><br/>
							<label class="taille">Description de votre sortie</label><br/>
							<textarea name="descripsortie" rows=7 cols=40 placeholder="Description de la sortie" class="textareames"><?php echo $description; ?></textarea><br/>
							<input type="radio" name="s_psortie" value="1" id="privee" class="radiomodlesinfos"/><label for="privee" class="labelmodlesinfos">Sortie privée</label>
							<input type="radio" name="s_psortie" value="2" id="publique" class="radiomodlesinfos"/><label for="publique" class="labelmodlesinfos">Sortie publique</label><br/>
							<input type="submit" name="valider" value="Modifier votre sortie" class="boutonamais s_p_margin"/>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>