<?php
session_start();
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Aide sortie - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php 
		if(isset($_SESSION['id']))
		{
			include("headerc.php");
		}else
		{
			include("headernc.php");
		}
		?>
		<section class="sectionaide">
			<div class="paide">
				<div class="div9cadre div12cadre">
					<h2 class="div11cadre">L'aide pour la sortie</h2>
					<?php include("navaide.php"); ?>
				</div>
				<div class="div9cadre div12cadre taille">
					<p>
						Vous trouverez à gauche de l'en-tête, entre le logo du site et le lien "Profil", le lien "Sorties".<br/>
						Cliquez sur ce lien pour aller sur la page de présentation de la liste des sorties que vous organisez.
					</p>
					<p>
						Une fois le lien "Profil" cliqué, vous arriverez sur la page donnant la liste des sorties que vous organisez.
						Vous pourrez voir à gauche une liste de 6 liens : <br/>
						- le lien sorties publiques<br/>
						- le lien sorties organisées par vous<br/>
						- le lien sorties en tant qu'invité<br/>
						- le lien sorties des lieux<br/> 
						- le lien liste des demandes<br/>
						- le lien liste des propositions<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Les liens "sorties"</h4>
					<p>
						Les liens "sorties" sont les liens qui vous permettront d'accéder à des sorties :<br/>
						- les sorties publiques sont les sorties proposées par les utilisateurs du site accessibles à l'ensemble des membres.<br/> 
						- les sorties organisées par vous sont les sorties où vous êtes le créateur de la sortie.
						Les sorties où vous êtes co-organisateur ne sont pas prises en compte.<br/>
						- les sorties en tant qu'invité sont les sorties où vous êtes invité par une de vos relations non lieu.<br/>
						- les sorties des lieux sont les sorties où vous êtes invité par une de vos relations lieu.<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Accès, présentation et options d'une sortie</h4>
					<p>
						Si une sortie est listée, sur une des pages de lien sortie, alors vous pourrez accéder à la présentation de cette sortie,
						en cliquant sur le bouton "Afficher la sortie". 
					</p>
					<p>
						Une fois sur la page de présentation de la sortie, vous pourrez voir plusieurs informations, commençons par la droite :<br/>
						- le résumé de la sortie, à droite de votre écran d'ordinateur, composé des informations clefs, et du profil du créateurde la sortie<br/>
						- En dessous du résumé, la description de la sortie ainsi que la liste des participants<br/>
						- Ensuite, en dessous de la liste des participants, les boîtes, qui sont un outil de gestion de groupe, pour gérer les passagers d'une voiture, attribuer des tâches, etc...<br/>
						- Puis, en dessous des boîtes, les commentaires, qui permettent de donner des informations supplémentaires</br>
					</p>
					<p>
						Ensuite, à gauche de la page de présentation de la sortie, il y a les options suivantes :<br/>
						- l'option les invités qui vous permettra d'inviter des Appelés, des Elus, ou des Prosches.
						D'inviter les membres qui vous sont recommandés. Et choisir des co-organisateur, si vous le souhaiter<br/>
						- l'option modifier la sortie qui vous permet de modifier les informations importantes
						(date, heure, nombre de participants, etc...) de vos sorties<br/>
						- l'option retirer des inscrits qui permet de retirer un participant de vos sorties<br/>
						- l'option supprimer la sortie qui permet d'annuler la sortie<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Page de présentation d'un profil</h4>
					<p>
						Sur une page de présentation d'une sortie, vous pouvez apercevoir le nom du créateuir de la sortie, les noms des participants, et les noms des invités.<br/>
						En cliquant sur leur nom, leur page de profil vous sera présentée. Sur cette page, vous pourrez voir une des photos de profil du membre en question, mais aussi l'un de ses surnoms, et son niveau relationnel.<br/>
						Vous pourrez connaître aussi son département et sa ville de référence, et commencer une discussion.<br/>
						Si le membre est un lieu, alors vous pourrez lui faire une demande de symapthie, et visualiser ses conditions et ses propositions de rencontre.<br/>
						Enfin, si le membre est un élu ou un prosche ou un intrus, alors vous pourrez lui attribuer un surnom personnel que vous seul saurez.<br/>
						Une option pour mettre un membre dans le groupe des Intrus apparaît si celui-ci ne fait partie d'aucun de vos groupes relationnels.
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Les liens "liste"</h4>
					<p>
						Les liens liste sont les liens qui vous permettront d'accèder aux demandes et propositions de sorties des membres.
						Vous pourrez vous aussi faire vos propres demandes.<br/>
						Il y a donc 4 possibilités :<br/>
						- la liste de vos demandes personnelles<br/>
						- la liste des demandes des utilisateurs<br/>
						- la liste de vos propositions personnelles<br/>
						- la liste des propositions des utilisateurs<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>La liste de vos demandes personnelles</h4>
					<p>
						Cette liste rassemble l'ensemble de vos demandes de sorties personnelles pour lesquels vous n'avez pas encore reçu de proposition satisfaisante.
					</p>
					<h4>La liste des demandes des utilisateurs</h4>
					<p>
						Cette liste rassemble l'ensemble des demandes des utilisateurs qui n'ont pas encore reçu de proposition satisfaisant les demandeurs à l'origine de celles-ci.
					</p>
					<h4>La liste de vos propositions personnelles</h4>
					<p>
						Cette liste rassemble l'ensemble des propositions que vous avez émises pour satisfaire une ou plusieurs demandes provenant des utilisateurs.
					</p>
					<h4>La liste des propositions des utilisateurs</h4>
					<p>
						Cette liste rassemble l'ensemble des propositions émises par des utilisateurs pour satisfaire une ou plusieurs de vos demandes personnelles.
					</p>
					<p>
						Faire une proposition n'est possible qu'avec un <a href="abonnement.php" class="aaide">abonnement</a>.
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Présentation de la demande et de la proposition</h4>
					<p>
						Si une demande existe, et qu'elle s'affiche sur votre écran, alors elle s'affichera certainement avec le bouton "Afficher la demande".
						En cliquant sur ce bouton, la demande vous sera présenter.<br/>
						Vous pourrez alors voir les informations clefs de la demande, et ces particularités.<br/>
						Si vous êtes le créateur de la demande alors des options pour modifier ou supprimer votre demande seront accessibles.
					</p>
					<p>
						De même pour une proposition. Vous aurez en plus la proposition qui s'affichera.
					</p>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>