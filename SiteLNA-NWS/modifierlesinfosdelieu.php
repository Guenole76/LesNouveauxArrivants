<?php 
session_start(); 
include('verificationid.php');
include('mysql.php');
$req = $bdd->prepare('SELECT nom_l FROM inscrits WHERE id = ?');
$req->execute(array($_SESSION['id']));
$donnees = $req->fetch();
$req1 = $bdd->prepare('SELECT condition_r FROM rencontre WHERE id_l = ?');
$req1->execute(array($_SESSION['id']));
$donnees1 = $req1->fetch();
include('navphoto.php');
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Modifier les informations de votre lieu - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionmodlesinfos">
			<div class="pmodlesinfos">
				<div class="div1profil">
					<div class="div9cadre div11cadre div12cadre">
						<?php echo $photo; ?>
						<?php 
							if($donneesphoto['l'] == 1)
							{
								$titre = $donneesphoto['nom_l'];
							}else
							{
								$titre = $donneesphoto['prenom'] ." ". $donneesphoto['nom'];
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
							for($i = 1; $i <= 10; $i++)
							{
								if(isset($_SESSION['message'.$i]))
									{
									if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
									{
										echo $_SESSION['message'.$i].'<br/>';
									}
								}
							}
							for($i = 1; $i <= 10; $i++)
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
						<h2>Modifier les informations de votre lieu</h2>
					</div>
					<div class="div9cadre div10cadre">
						<a href="modifiervotrephotodelieu.php" class="amodlesinfos2">Modifier votre photo de lieu</a> 
					</div>
					<div class="div9cadre div10cadre">
						<p>
							<form method="post" action="traitementmodifierlesinfosdelieu.php">
								<label for="nom_l" class="labelmodlesinfos taille">Votre nom de lieu</label><br/><input type="text" name="nom_l" maxlength=50 id="nom_l"  
								value="<?php echo $donnees['nom_l']; ?>" class="inputmodlesinfos"/><br/>
								<label for="condition_r" class="labelmodlesinfos taille">Vos conditions</label><br/>
								<textarea name="condition_r" rows=10 cols=50 placeholder="La pluie, le beau temps, le nombre de participants, etc..." class="textareames"><?php echo $donnees1['condition_r']; ?></textarea><br/>
								<div class="envoyermodlesinfos" style="margin-top: 10px;margin-bottom:20px;">
									<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
									<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
								</div>
								<div class="div9cadre3 div10cadre">
									<label for="nom_r1" class="labelmodlesinfos taille">Nom de la rencontre type 1</label><br/><input type="text" name="nom_r1" maxlength=50 id="nom_r1" placeholder="Marche, Visite, Café, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label for="lieu_r1" class="labelmodlesinfos taille">Lieu de la rencontre type 1</label><br/><input type="text" name="lieu_r1" maxlength=50 id="lieu_r1" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 1</label><br/>
									<select name="jour_r1" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 1 </label><br/>
									<select name="heure_r1" class="selectsorties">
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
									<select name="minute_r1" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 1 (en h)</label><br/>
									<input type="number" min=0 name="duree_r1" class="input"/><br/>
									<div style="margin-top: 20px;">
										<input type="radio" name="validite_r1" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r1" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div>
								<div class="div9cadre3 div10cadre">
									<label for="nom_r2" class="labelmodlesinfos taille">Nom de la rencontre type 2</label><br/><input type="text" name="nom_r2" maxlength=50 id="nom_r2" placeholder="Marche, Visite, Café, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label for="lieu_r2" class="labelmodlesinfos taille">Lieu de la rencontre type 2</label><br/><input type="text" name="lieu_r2" maxlength=50 id="lieu_r2" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 2</label><br/>
									<select name="jour_r2" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 2 </label><br/>
									<select name="heure_r2" class="selectsorties">
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
									<select name="minute_r2" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 2 (en h)</label><br/>
									<input type="number" min=0 name="duree_r2" class="input"/><br/>
									<div style="margin-top: 20px;">
										<input type="radio" name="validite_r2" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r2" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div>
								<div class="div9cadre3 div10cadre">
									<label for="nom_r3" class="labelmodlesinfos taille">Nom de la rencontre type 3</label><br/><input type="text" name="nom_r3" maxlength=50 id="nom_r3" placeholder="Marche, Visite, Café, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label for="lieu_r3" class="labelmodlesinfos taille">Lieu de la rencontre type 3</label><br/><input type="text" name="lieu_r3" maxlength=50 id="lieu_r3" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 3</label><br/>
									<select name="jour_r3" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 3 </label><br/>
									<select name="heure_r3" class="selectsorties">
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
									<select name="minute_r3" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 3 (en h)</label><br/>
									<input type="number" min=0 name="duree_r3" class="input"/><br/>
									<div style="margin-top: 20px;">
										<input type="radio" name="validite_r3" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r3" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div>
								<div class="div9cadre3 div10cadre">
									<label for="nom_r4" class="labelmodlesinfos taille">Nom de la rencontre type 4</label><br/><input type="text" name="nom_r4" maxlength=50 id="nom_r4" placeholder="Marche, Visite, Café, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label for="nom_r4" class="labelmodlesinfos taille">Lieu de la rencontre type 4</label><br/><input type="text" name="lieu_r4" maxlength=50 id="lieu_r4" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 4</label><br/>
									<select name="jour_r4" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 4 </label><br/>
									<select name="heure_r4" class="selectsorties">
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
									<select name="minute_r4" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 4 (en h)</label><br/>
									<input type="number" min=0 name="duree_r4" class="input"/><br/>
									<div style="margin-top: 20px;">
										<input type="radio" name="validite_r4" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r4" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div>
								<div class="div9cadre3 div10cadre">
									<label for="nom_r5" class="labelmodlesinfos taille">Nom de la rencontre type 5</label><br/><input type="text" name="nom_r5" maxlength=50 id="nom_r5" placeholder="Marche, Visite, Café, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label for="lieu_r5" class="labelmodlesinfos taille">Lieu de la rencontre type 5</label><br/><input type="text" name="lieu_r5" maxlength=50 id="lieu_r5" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 5</label><br/>
									<select name="jour_r5" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 5 </label><br/>
									<select name="heure_r5" class="selectsorties">
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
									<select name="minute_r5" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 5 (en h)</label><br/>
									<input type="number" min=0 name="duree_r5" class="input"/><br/>
									<div style="margin-top: 20px;">
										<input type="radio" name="validite_r5" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r5" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div>
								<div class="div9cadre3 div10cadre">
									<label for="nom_r6" class="labelmodlesinfos taille">Nom de la rencontre type 6</label><br/><input type="text" name="nom_r6" maxlength=50 id="nom_r6" placeholder="Marche, Visite, Café, etc..."  
									value="" class="inputmodlesinfos"/><br/>
									<label for="lieu_r6" class="labelmodlesinfos taille">Lieu de la rencontre type 6</label><br/><input type="text" name="lieu_r6" maxlength=50 id="lieu_r6" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 6</label><br/>
									<select name="jour_r6" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 6</label><br/>
									<select name="heure_r6" class="selectsorties">
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
									<select name="minute_r6" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 6 (en h)</label><br/>
									<input type="number" min=0 name="duree_r6" class="input"/><br/>
									<div style="margin-top: 20px;">
										<input type="radio" name="validite_r6" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r6" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div>
								<div class="div9cadre3 div10cadre">
									<label for="nom_r7" class="labelmodlesinfos taille">Nom de la rencontre type 7</label><br/><input type="text" name="nom_r7" maxlength=50 id="nom_r7" placeholder="Marche, Visite, Café, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label for="lieu_r7" class="labelmodlesinfos taille">Lieu de la rencontre type 7</label><br/><input type="text" name="lieu_r7" maxlength=50 id="lieu_r7" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 7</label><br/>
									<select name="jour_r7" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 7 </label><br/>
									<select name="heure_r7" class="selectsorties">
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
									<select name="minute_r7" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 7 (en h)</label><br/>
									<input type="number" min=0 name="duree_r7" class="input"/><br/>
									<div style="margin-top: 20px;">
										<input type="radio" name="validite_r7" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r7" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div>
								<div class="div9cadre3 div10cadre">
									<label for="nom_r8" class="labelmodlesinfos taille">Nom de la rencontre type 8</label><br/><input type="text" name="nom_r8" maxlength=50 id="nom_r8" placeholder="Marche, Visite, Café, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label for="lieu_r8" class="labelmodlesinfos taille">Lieu de la rencontre type 8</label><br/><input type="text" name="lieu_r8" maxlength=50 id="lieu_r8" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 8</label><br/>
									<select name="jour_r8" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 8</label><br/>
									<select name="heure_r8" class="selectsorties">
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
									<select name="minute_r8" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 8 (en h)</label><br/>
									<input type="number" min=0 name="duree_r8" class="input"/><br/>
									<div style="margin-top: 20px;">
										<input type="radio" name="validite_r8" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r8" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div>
								<div class="div9cadre3 div10cadre">
									<label for="nom_r9" class="labelmodlesinfos taille">Nom de la rencontre type 9</label><br/><input type="text" name="nom_r9" maxlength=50 id="nom_r9" placeholder="Marche, Visite, Café, etc..."  
									value="" class="inputmodlesinfos"/><br/>
									<label for="lieu_r9" class="labelmodlesinfos taille">Lieu de la rencontre type 9</label><br/><input type="text" name="lieu_r9" maxlength=50 id="lieu_r9" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 9</label><br/>
									<select name="heure_r9" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 9</label><br/>
									<select name="heure_r9" class="selectsorties">
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
									<select name="minute_r9" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 9 (en h)</label><br/>
									<input type="number" min=0 name="duree_r9" class="input"/><br/>
									<div style="margin-top: 20px;">
										<input type="radio" name="validite_r9" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r9" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div>
								<div class="div9cadre3 div10cadre">
									<label for="nom_r10" class="labelmodlesinfos taille">Nom de la rencontre type 10</label><br/><input type="text" name="nom_r10" maxlength=50 id="nom_r10" placeholder="Marche, Visite, Café, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label for="lieu_r10" class="labelmodlesinfos taille">Lieu de la rencontre type 10</label><br/><input type="text" name="lieu_r10" maxlength=50 id="lieu_r10" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 10</label><br/>
									<select name="jour_r10" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 10</label><br/>
									<select name="heure_r10" class="selectsorties">
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
									<select name="minute_r10" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 10 (en h)</label><br/>
									<input type="number" min=0 name="duree_r10" class="input"/><br/>
									<div style="margin-top: 20px;">
										<input type="radio" name="validite_r10" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r10" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div><div class="div9cadre3 div10cadre">
									<label for="nom_r11" class="labelmodlesinfos taille">Nom de la rencontre type 11</label><br/><input type="text" name="nom_r11" maxlength=50 id="nom_r11" placeholder="Marche, Visite, Café, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label for="lieu_r11" class="labelmodlesinfos taille">Lieu de la rencontre type 11</label><br/><input type="text" name="lieu_r11" maxlength=50 id="lieu_r11" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 11</label><br/>
									<select name="jour_r11" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 11</label><br/>
									<select name="heure_r11" class="selectsorties">
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
									<select name="minute_r11" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 11 (en h)</label><br/>
									<input type="number" min=0 name="duree_r11" class="input"/><br/>
									<div style="margin-top: 20px;">
										<input type="radio" name="validite_r11" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r11" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div>
								<div class="div9cadre3 div10cadre">
									<label for="nom_r12" class="labelmodlesinfos taille">Nom de la rencontre type 12</label><br/><input type="text" name="nom_r12" maxlength=50 id="nom_r12" placeholder="Marche, Visite, Café, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label for="lieu_r12" class="labelmodlesinfos taille">Lieu de la rencontre type 12</label><br/><input type="text" name="lieu_r12" maxlength=50 id="lieu_r12" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 12</label><br/>
									<select name="jour_r12" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 12</label><br/>
									<select name="heure_r12" class="selectsorties">
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
									<select name="minute_r12" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 12 (en h)</label><br/>
									<input type="number" min=0 name="duree_r12" class="input"/><br/>
									<div style="margin-top: 20px;">
										<input type="radio" name="validite_r12" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r12" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div>
								<div class="div9cadre3 div10cadre">
									<label for="nom_r13" class="labelmodlesinfos taille">Nom de la rencontre type 13</label><br/><input type="text" name="nom_r13" maxlength=50 id="nom_r13" placeholder="Marche, Visite, Café, etc..."  
									value="" class="inputmodlesinfos"/><br/>
									<label for="lieu_r13" class="labelmodlesinfos taille">Lieu de la rencontre type 13</label><br/><input type="text" name="lieu_r13" maxlength=50 id="lieu_r13" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 13</label><br/>
									<select name="jour_r13" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 13</label><br/>
									<select name="heure_r13" class="selectsorties">
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
									<select name="minute_r13" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 13 (en h)</label><br/>
									<input type="number" min=0 name="duree_r13" class="input"/><br/><div style="margin-top: 20px;">
										<input type="radio" name="validite_r13" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r13" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div>
								<div class="div9cadre3 div10cadre">
									<label for="nom_r14" class="labelmodlesinfos taille">Nom de la rencontre type 14</label><br/><input type="text" name="nom_r14" maxlength=50 id="nom_r14" placeholder="Marche, Visite, Café, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label for="lieu_r14" class="labelmodlesinfos taille">Lieu de la rencontre type 14</label><br/><input type="text" name="lieu_r14" maxlength=50 id="lieu_r14" placeholder="Sur les quais, En centre-ville, Au jardin, etc..." 
									value="" class="inputmodlesinfos"/><br/>
									<label class="taille">Jour de la rencontre type 14</label><br/>
									<select name="jour_r14" class="selectsorties">
										<option value="" selected>Jour</option>
										<option value="Lundi">Lundi</option>
										<option value="Mardi">Mardi</option>
										<option value="Mercredi">Mercredi</option>
										<option value="Jeudi">Jeudi</option>
										<option value="Vendredi">Vendredi</option>
										<option value="Samedi">Samedi</option>
										<option value="Dimanche">Dimanche</option>
									</select><br/>
									<label class="taille">Heure de la rencontre type 14</label><br/>
									<select name="heure_r14" class="selectsorties">
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
									<select name="minute_r14" class="selectsorties">
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
									<label class="taille">Durée de la rencontre type 14 (en h)</label><br/>
									<input type="number" min=0 name="duree_r14" class="input"/><br/>
									<div style="margin-top: 20px;">
										<input type="radio" name="validite_r14" value="1" id="effective" class="radiomodlesinfos"/>
										<label for="effective" class="labelmodlesinfos">Effective</label>
										<input type="radio" name="validite_r14" value="2" id="noneffective" class="radiomodlesinfos"/>
										<label for="noneffective" class="labelmodlesinfos">Non effective</label><br/>
									</div>
									<div class="envoyermodlesinfos" style="margin-top: 20px;">
										<input type="submit" name="valider" value="Modifier" class="boutonmodlesinfos"/>
										<a href="informationspersonnelles.php" class="amodlesinfos">Annuler</a> 
									</div>
								</div>
							</form>
						</p>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>