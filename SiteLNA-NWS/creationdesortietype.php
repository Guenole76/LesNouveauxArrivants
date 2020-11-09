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
		<title>Créer une sortie type - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navprofil.php"); ?>
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
									}
								}
							}
						?>
						<h2>Créer une sortie type</h2>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							<form method="post" action="traitementcreationdesortietype.php">
								<label class="taille">Intitulé de la sortie type</label><br/> <input type="text" name="isortietype" maxlength=30 class="input"/><br/>
								<div class="taille">Département de la sortie type</div>
								<select name="ddrefsortietype" class="selectsorties">
									<?php include('departementdefrance.php'); ?>
								</select>
								<br/>
								<label for="vdres" class="taille">Ville de la sortie type</label><br/><input type="text" name="vdressortietype" maxlength=100 id="vdres" placeholder="Ex: Havre, Orsay, etc..." class="input"/><br/>
								<label class="taille">Durée de la sortie type (en h)</label><br/>
								<input type="number" min=0 name="dureetype" class="input"/><br/>
								<label class="taille">Nombre de participants maximum</label><br/>
								<input type="number" min=0 name="nbrpsortietype" class="input"/><br/>
								<label class="taille">Tarif de la sortie type (en €/pers.)</label><br/>
								<input type="number" min=0 name="tariftype" class="input"/><br/>
								<label class="taille">Description de la sortie type</label><br/>
								<textarea name="descripsortietype" rows=7 cols=40 placeholder="Description de la sortie type" class="textareames"></textarea><br/>
								<input type="radio" name="s_ptype" value="1" id="privee" class="radiomodlesinfos"/><label for="privee" class="labelmodlesinfos">Sortie type privée</label>
								<input type="radio" name="s_ptype" value="2" id="publique" class="radiomodlesinfos"/><label for="publique" class="labelmodlesinfos">Sortie type publique</label><br/>
								<input type="submit" name="valider" value="Créer la sortie type" class="boutonamais s_p_margin"/>
							</form>
						</p>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>