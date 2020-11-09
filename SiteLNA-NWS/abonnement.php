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
}elseif($_SESSION['message'] == 101)
{
	$_SESSION['envoye'] = "Vous n'avez pas cliqué sur le bouton prendre l'abonnement.";
}elseif($_SESSION['message'] == 102)
{
	$_SESSION['envoye'] = "Veuillez choisir un abonnement, pour continuer.";
}elseif($_SESSION['message'] == 103)
{
	$_SESSION['envoye'] = "Veuillez choisir une durée pour votre abonnement.";
}elseif($_SESSION['message'] == 104)
{
	$_SESSION['envoye'] = "Il y a un problème au niveau du choix de l'abonnement, recommencer, contactez-nous si le problème persiste.";
}
include('mysql.php');
include('navphoto.php');
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Abonnement - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="div9cadre div12cadre">
				<?php 
					if($_SESSION['message'] >= 101 AND $_SESSION['message'] <= 104 )
					{
						echo $_SESSION['envoye']. "<br/>";
					}
				?>
				<h2 style="text-align: center; ">Choix d'abonnement</h2>
				<table>
					<tr>
						<td rowspan="27">
							Avantages
						</td>
						<td colspan="3" style="text-align: center; ">
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
							Echanges<br/>
						</td>
						<td>
							Partage<br/> 
						</td>
					</tr>
					
					<tr>
						<td>
							Création et gestion de sorties
						</td>
						<td>
							Illimité
						</td>
						<td>
							Illimité
						</td>
					</tr>
					<tr>
						<td>
							Possibilité de co-organiser une sortie
						</td>
						<td>
							Effective
						</td>
						<td>
							Effective
						</td>
					</tr>
					<tr>
						<td>
							Emission de l'e-mail journalier d'annonce de sorties 
						</td>
						<td>
							Effective
						</td>
						<td>
							Effective
						</td>
					</tr>
					<tr>
						<td>
							Utilisation de la messagerie instantanée
						</td>
						<td>
							Illimité
						</td>
						<td>
							Illimité
						</td>
					</tr>
					<tr>
						<td>
							Fonctions de sympathie
						</td>
						<td>
							Toutes utilisables
						</td>
						<td>
							Toutes utilisables
						</td>
					</tr>
					<tr>
						<td>
							Préserver/Recommander une relation
						</td>
						<td>
							Possible
						</td>
						<td>
							Possible
						</td>
					</tr>
					<tr>
						<td>
							Sauvegarde des choix relationnels si changement d'abonnement
						</td>
						<td>
							Effective
						</td>
						<td>
							Effective
						</td>
					</tr>
					<tr>
						<td>
							Date d'anniversaire des relations
						</td>
						<td>
							Visible
						</td>
						<td>
							Visible
						</td>
					</tr>
					<tr>
						<td>
							Date de sympathie des relations
						</td>
						<td>
							Visible
						</td>
						<td>
							Visible
						</td>
					</tr>
					<tr>
						<td>
							Niveau 
						</td>
						<td>
							Effectif
						</td>
						<td>
							Effectif
						</td>
					</tr>
					<tr>
						<td>
							Possibilité de faire une demande 
						</td>
						<td>
							Effective
						</td>
						<td>
							Effective
						</td>
					</tr>
					<tr>
						<td>
							Possibilité de faire une proposition 
						</td>
						<td>
							Effective en abonnement Partage
						</td>
						<td>
							Effective
						</td>
					</tr>
					<tr>
						<td>
							Possibilité de faire une demande de sympathie via la page de présentation de votre profil  
						</td>
						<td>
							Effective en abonnement Partage, si vous êtes un lieu  
						</td>
						<td>
							Effective, si vous êtes un lieu
						</td>
					</tr>
					<tr>
						<td>
							Nombre de groupe relationnel (GR)
						</td>
						<td>
							2 (Les Appelés ♣, Les Intrus ♠)
						</td>
						<td>
							4 (️Les Appelés ♣, Les Elus ♥️, Les Prosches ♦, Les Intrus ♠)
						</td>
					</tr>
					<tr>
						<td>
							Possibilité de donner des surnoms personnels
						</td>
						<td>
							Aux Intrus ♠ uniquement
						</td>
						<td>
							Aux Elus ♥️, aux Prosches ♦, et aux Intrus ♠
						</td>
					</tr>
					<tr>
						<td>
							Nombre de membres recommandés
						</td>
						<td>
							15 max/groupe relationnel (5 hommes, 5 femmes, 5 lieux max)
						</td>
						<td> 
							30 max/groupe relationnel (10 hommes, 10 femmes, 10 lieux max)
						</td>
					</tr>
					<tr>
						<td>
							Possibilité de glacer une relation 
						</td>
						<td>
							Effective en abonnement Partage
						</td>
						<td>
							Effective
						</td>
					</tr>
					<tr>
						<td>
							Fonction d'invitation d'une qualité<br/> (homme-femme-lieu)
						</td>
						<td>
							Utilisable en abonnement Partage
						</td>
						<td>
							Utilisable
						</td>
					</tr>
					<tr>
						<td>
							Fonction d'invitation aléatoire sur les Appelés
						</td>
						<td>
							Utilisable en abonnement Partage
						</td>
						<td>
							Utilisable
						</td>
					</tr>
					<tr>
						<td>
							Possibilité de devenir un lieu
						</td>
						<td>
							Effective en abonnement Partage
						</td>
						<td>
							Effective
						</td>
					</tr>
					<tr>
						<td>
							Choix des pseudonymes
						</td>
						<td>
							Parmi la liste des pseudonymes proposée
						</td>
						<td>
							Parmi la liste des pseudonymes proposée
						</td>
					</tr>
					<tr>
						<td>
							Choix du nom de lieu
						</td>
						<td>
							Choix personnel en abonnement Partage
						</td>
						<td>
							Choix personnel
						</td>
					</tr>
					<tr>
						<td>
							Choix des photos de profil
						</td>
						<td>
							Parmi la liste des photos proposée
						</td>
						<td>
							Parmi la liste des photos proposée
						</td>
					</tr>
					<tr>
						<td>
							Choix de la photo de lieu
						</td>
						<td>
							Choix personnel en abonnement Partage
						</td>
						<td>
							Choix personnel
						</td>
					</tr>
					<tr>
						<td>
							Création de rencontres types
						</td>
						<td>
							Possible en abonnement Partage
						</td>
						<td>
							Possible, et visible, si lieu
						</td>
					</tr>
				</table>
			</div>
			<div class="div9cadre div12cadre ">
				<table style="margin: auto; text-align: center;">
					<tr>
						<td rowspan="3">
						</td>
						<td colspan="2" style="text-align: center;">
							Tarifs (TTC)
						</td>
					</tr>
					<tr>
						<td>
							Partage (7 jours)
						</td>
						<td >
							Partage (1 mois)
						</td>
					</tr>
					<tr>
						<td>
							9,99 €
						</td>
						<td>
							25,99 €
						</td>
					</tr>
				</table>
			</div>
			<div class="div9cadre div11cadre div12cadre">
				<h2 class="div8abo">Choix de l'abonnement</h2>
				<div class="div8abo">
					<form method="post" action="traitementabonnement.php">
						<select name="choixa" class="selectsorties">
							<option value="">Choisir</option>
							<option value="1">"Partage" sept jours (9,99€ TTC)</option>
							<option value="2">"Partage" un mois (25,99€ TTC)</option>
						</select><br/>
						<input type="submit" name="valider" value="S'abonner" class="boutoninscription"/>
					</form>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>