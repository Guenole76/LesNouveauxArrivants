<?php 
session_start();
include('verificationid.php');
include('verificationiddemandeur.php');
include('mysql.php');
include('navphoto.php');
include('lienauto.php');
$req1 = $bdd->prepare('SELECT * FROM demande WHERE id_demande = ?');
$req1->execute(array($_SESSION['id_demande']));
$donnees1 = $req1->fetch();
$datesortie = date('d/m/Y', $donnees1['date']);
$date = date('Y-m-d', time());
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Modifier la demande - Les Nouveaux Arrivants</title>
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
							Département de la sortie: <?php echo $donnees1['ddref']; ?> <br/>
							Ville de la sortie: <?php echo $donnees1['vdres']; ?> <br/>
							Date de la sortie: <?php echo $datesortie; ?> <br/>
							Heure de la sortie: <?php echo $donnees1['heure']. "h" .$donnees1['minute']; ?> <br/>
							Durée de la,sortie: <?php echo $donnees1['duree']; ?>h <br/> 
							Nombre de participants: <?php echo $donnees1['nbr_participants']; ?> <br/> 
							Tarif: <?php echo $donnees1['tarif']; ?>€/pers <br/> 
							Informations complémentaires<br/> <?php $description = wordwrap($donnees1['description'], 40, "\r\n", true); 
							$description2 = lienauto($description);
							echo $description2; ?> <br/>
						</p>
					</div>
					<div class="div9cadre div10cadre">
						<h2 class="taille">Modifier la demande</h2>
						<form method="post" action="traitementmodifierlademande.php">
							<label class="taille">Intitulé</label> <br/><input type="text" name="idemande" maxlength=30 class="input"/><br/>
							<div class="taille">Département de la sortie</div>
							<div>
							<select name="ddrefdemande" class="selectsorties">
								<?php include('departementdefrance.php'); ?>
							</select>
							<br/>
							</div>
							<label class="taille">Ville de la sortie</label><br/><input type="text" name="vdresdemande" maxlength=100 id="" placeholder="Ex: Havre, Orsay, etc..." class="input"/><br/>
							<label class="taille">Date de la sortie</label> <br/>
							<input type="date" min="<?php echo $date; ?>" name="ddemande" class="input"/><br/>
							<label class="taille">Heure de la sortie</label><br/>
							<select name="hdemande" class="selectsorties">
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
							<select name="mdemande" class="selectsorties">
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
							<label class="taille">Nombre de participants</label><br/>
							<input type="number" min=0 name="nbrpdemande" class="input"/><br/>
							<label class="taille">Durée de la sortie</label><br/>
							<input type="number" min=0 name="dureedemande" class="input"/><br/>
							<label class="taille">Tarif de la sortie</label><br/>
							<input type="number" min=0 name="tarifdemande" class="input"/><br/>
							<label class="taille">Informations complémentaires</label><br/>
							<textarea name="icdemande" rows=7 cols=40 placeholder="Informations complémentaires" class="textareames"><?php echo $description; ?></textarea><br/>
							<input type="radio" name="s_pdemande" value="1" id="privee" class="radiomodlesinfos"/><label for="privee" class="labelmodlesinfos">Sortie privée</label>
							<input type="radio" name="s_pdemande" value="2" id="publique" class="radiomodlesinfos"/><label for="publique" class="labelmodlesinfos">Sortie publique</label><br/>
							<input type="submit" name="valider" value="Modifier la demande" class="boutonamais s_p_margin"/>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>