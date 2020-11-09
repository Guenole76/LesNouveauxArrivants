<?php 
session_start(); 
if(!isset($_SESSION['message']))
{
	$_SESSION['message'] = 0; 
}
if($_SESSION['message'] == 0)
{
	$_SESSION['envoye'] = "";
}elseif($_SESSION['message'] == 1)
{
	$_SESSION['envoye'] = "Veuillez cliquer sur le bouton de validation, après avoir entré les données.";
}elseif($_SESSION['message'] == 2)
{
	$_SESSION['envoye'] = "Veuillez nous donner les informations nécessaires concernant votre sexe.";
}elseif($_SESSION['message'] == 3)
{
	$_SESSION['envoye'] = "Veuillez choisir votre premier surnom.";
}elseif($_SESSION['message'] == 4)
{
	$_SESSION['envoye'] = "Veuillez choisir votre second surnom.";
}elseif($_SESSION['message'] == 5)
{
	$_SESSION['envoye'] = "Veuillez choisir votre première photo de profil.";
}elseif($_SESSION['message'] == 6)
{
	$_SESSION['envoye'] = "Veuillez choisir votre seconde photo de profil.";
}elseif($_SESSION['message'] == 7)
{
	$_SESSION['envoye'] = "Veuillez nous donner les informations nécessaires concernant votre adresse e-mail.";
}elseif($_SESSION['message'] == 8)
{
	$_SESSION['envoye'] = "Veuillez nous donner les informations nécessaires concernant votre confirmation d'adresse e-mail.";
}elseif($_SESSION['message'] == 9)
{
	$_SESSION['envoye'] = "Veuillez nous donner les informations nécessaires concernant votre mot de passe.";
}elseif($_SESSION['message'] == 10)
{
	$_SESSION['envoye'] = "Veuillez nous donner les informations nécessaires concernant votre confirmation de mot de passe.";
}elseif($_SESSION['message'] == 11)
{
	$_SESSION['envoye'] = "Votre premier surnom ne doit pas comporter de caractères spéciaux, hormis ' et - .";
}elseif($_SESSION['message'] == 12)
{
	$_SESSION['envoye'] = "Votre second surnom ne doit pas comporter de caractères spéciaux, hormis ' et - .";
}elseif($_SESSION['message'] == 13)
{
	$_SESSION['envoye'] = "Votre premier surnom et votre second surnom ne doivent pas être identiques.";
}elseif($_SESSION['message'] == 14)
{
	$_SESSION['envoye'] = "Vos deux photos de profil ne doivent pas être identiques.";
}elseif($_SESSION['message'] == 15)
{
	$_SESSION['envoye'] = "Votre adresse mail contient des caractères interdits.";
}elseif($_SESSION['message'] == 16)
{
	$_SESSION['envoye'] = "Votre confirmation d'adresse mail contient des caractères interdits.";
}elseif($_SESSION['message'] == 17)
{
	$_SESSION['envoye'] = 'Votre mot de passe ne peut comporter les caractères suivantes : " ", "<", ">", "{" et "}", et doit comprendre entre 8 et 45 caractères.';
}elseif($_SESSION['message'] == 18)
{
	$_SESSION['envoye'] = 'Votre mot de passe de confirmation ne peut comporter les caractères suivantes : " ", "<", ">", "{" et "}", et doit comprendre entre 8 et 45 caractères.';
}elseif($_SESSION['message'] == 19)
{
	$_SESSION['envoye'] = "Les adresses e-mails que vous avez saisies doivent être les mêmes.";
}elseif($_SESSION['message'] == 20)
{
	$_SESSION['envoye'] = "Les mots de passe que vous avez saisies doivent être les mêmes.";
}elseif($_SESSION['message'] == 21)
{
	$_SESSION['envoye'] = "L'adresse e-mail que vous avez saisie est déjà utilisée.";
}
if(isset($_SESSION['surnom1']))
{
	$surnom1 = $_SESSION['surnom1']; 
}else
{
	$surnom1 = "";
}
if(isset($_SESSION['surnom2']))
{
	$surnom2 = $_SESSION['surnom2']; 
}else
{
	$surnom2 = "";
}
if(isset($_SESSION['vdres']))
{
	$vdres = $_SESSION['vdres']; 
}else
{
	$vdres = "";
}
if(isset($_SESSION['aem']))
{
	$aem = $_SESSION['aem']; 
}else
{
	$aem = "";
}
if(isset($_SESSION['caem']))
{
	$caem = $_SESSION['caem']; 
}else
{
	$caem = "";
}
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Inscription - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headernc.php"); ?>
		<section class="sectioninscription">
			<div class="phraseinscription">
				<?php
					if($_SESSION['message'] >= 1 AND $_SESSION['message'] <= 21 )
					{
						echo $_SESSION['envoye'];
						$_SESSION['message'] = "";
					}
				?>
			</div>
			<h2 id="tinscription">Inscription</h2>
			<form method="post" action="traitementinscription.php">
				<div class="pinscription">
					<div class="div9cadre3">
						<label for="surnom1" class="labelinscription">Surnom 1</label><br/>
						<select name="surnom1" class="selectinscription">
							<?php include('listesurnoms.php'); ?>
						</select>
						<label for="surnom2" class="labelinscription">Surnom 2 (différent du surnom 1)</label><br/>
						<select name="surnom2" class="selectinscription">
							<?php include('listesurnoms.php'); ?>
						</select>
					</div>
				</div>
				<div class="photoinscription">
					<img class="photoinscription2" src="listephotosdeprofil/lalibellule.JPG" alt="La Libellule" title="La Libellule"/>
					<img class="photoinscription2" src="listephotosdeprofil/lecouple.JPG" alt="Le Couple" title="Le Couple"/>
					<img class="photoinscription2" src="listephotosdeprofil/lefeu.jPG" alt="Le Feu" title="Le Feu"/>
					<img class="photoinscription2" src="listephotosdeprofil/lesmoutons.JPG" alt="Les Moutons" title="Les Moutons"/>
					<img class="photoinscription2" src="listephotosdeprofil/loiseau.JPG" alt="L'Oiseau" title="L'Oiseau"/>
				</div>
				<div class="photoinscription">
					<img class="photoinscription2" src="listephotosdeprofil/maindanslesable.JPG" alt="La Main dans le sable" title="La Main dans le sable"/>
					<img class="photoinscription2" src="listephotosdeprofil/nuiteclairee.JPG" alt="La Nuit élairée" title="La Nuit éclairée"/>
					<img class="photoinscription2" src="listephotosdeprofil/patrouillefrancaise.JPG" alt="La Patrouille de France" title="La Patrouille de France"/>
					<img class="photoinscription2" src="listephotosdeprofil/tourjeannedarc.JPG" alt="La Tour Jeanne d'Arc" title="La Tour Jeanne d'Arc"/>
					<img class="photoinscription2" src="listephotosdeprofil/troisverres.JPG" alt="Les Trois verres" title="Les Trois verres"/>
				</div>
				<div class="pinscription">
					<div class="div9cadre3">
						<label for="photodep1" class="labelinscription">Photo de profil 1</label><br/>
						<select name="photodep1" class="selectinscription">
							<?php include('listephotodep.php'); ?>
						</select>
						<label for="photodep2" class="labelinscription">Photo de profil 2 (différente de la photo 1)</label><br/>
						<select name="photodep2" class="selectinscription">
							<?php include('listephotodep.php'); ?>
						</select>
						<label for="email" class="labelinscription">Adresse e-mail</label><br/><input type="email" name="aem" id="email" placeholder="Ex: xyz@hotmail.fr" value="<?php echo $aem ?>" class="inputinscription"/><br/>
						<label for="cemail" class="labelinscription">Confirmation de l'adresse e-mail</label><br/><input type="email" name="caem" id="ceamail" value="<?php echo $caem; ?>" class="inputinscription"/>
					</div>
				</div>
				<div class="phraseinscription">
				Le mot de passe ne peut comporter les caractères suivantes :<br/> " ", "<", ">", "{" et "}".<br/>De plus, il doit comprendre entre 8 et 45 caractères.
				</div>
				<div class="pinscription">
					<div class="div9cadre3">
						<label for="mdp" class="labelinscription">Mot de passe</label><br/><input type="password" name="mdp" id="mdp" maxlength=45 class="inputinscription"/><br/>
						<label for="cmdp" class="labelinscription">Confirmation du mot de passe</label><br/><input type="password" name="cmdp" id="cmdp" maxlength=45 class="inputinscription"/><br/>
						<input type="radio" name="s" value="homme" id="homme" class="radioinscription"/><label for="homme" class="labelinscription radioinscription">Homme</label>
						<input type="radio" name="s" value="femme" id="femme" class="radioinscription"/><label for="femme" class="labelinscription radioinscription">Femme</label><br/>
					</div>
				</div>
				<div class="phraseinscription">
				En cliquant sur le bouton "Envoyer", vous acceptez les Conditions Générales d'Utilisation, ou <a href="cgu.php" class="ainscription">CGU</a>.
				</div>
				<div class="pinscription">
					<div class="div9cadre3">
						<div class="envoyerannuler">
						<input type="submit" name="valider" value="Envoyer" class="boutoninscription"/>
						<a href="index.php" class="ainscription">Annuler</a>
						</div>
					</div>
				</div>
			</form>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>