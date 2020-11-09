<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('navphoto.php');
$date = date('Y-m-d');
?>

<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Faire une demande - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navsortie.php"); ?>
					<?php include("nav_demande.php"); ?>
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
										$_SESSION['message'.$i] = "";
									}
								}
							}
						?>
						<h2>Faire une demande</h2>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							<form method="post" action="traitement_faire_une_demande.php">
								<label class="taille">Intitulé de la sortie</label><br/> <input type="text" name="isortie" maxlength=30 class="input"/><br/>
								<div class="taille">Département de la sortie</div>
								<select name="ddrefsortie" class="selectsorties">
									<?php include('departementdefrance.php'); ?>
								</select>
								<br/>
								<label for="vdres" class="taille">Ville de la sortie</label><br/><input type="text" name="vdressortie" maxlength=100 id="vdres" placeholder="Ex: Havre, Orsay, etc..." class="input"/><br/>
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
								<label class="taille">Nombre de participants</label><br/>
								<input type="number" min=0 name="nbrpsortie" class="input"/><br/>
								<label class="taille">Durée de la sortie en heure</label><br/>
								<input type="number" min=0 name="duree" class="input"/><br/>
								<label class="taille">Tarif par personne (en €)</label><br/>
								<input type="number" min=0 name="tarif" class="input"/><br/>
								<label class="taille">Informations complémentaires</label><br/>
								<textarea name="descripsortie" rows=7 cols=40 placeholder="Informations complémentaires" class="textareames"></textarea><br/>
								<input type="radio" name="s_p" value="1" id="privee" class="radiomodlesinfos"/><label for="privee" class="labelmodlesinfos">Sortie privée</label>
								<input type="radio" name="s_p" value="2" id="publique" class="radiomodlesinfos"/><label for="publique" class="labelmodlesinfos">Sortie publique</label><br/>
								<input type="submit" name="valider" value="Faire votre demande" class="boutonamais s_p_margin"/>
							</form>
						</p>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>