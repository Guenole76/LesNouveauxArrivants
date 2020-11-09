<?php
session_start();
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Aide profil - Les Nouveaux Arrivants</title>
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
					<h2 class="div11cadre">L'aide pour le profil</h2>
					<?php include("navaide.php"); ?>
				</div>
				<div class="div9cadre div12cadre taille">
					<p>
						Vous trouverez au milieu de l'en-tête, entre les liens "Sorties" et "Relations", le lien "Profil".<br/>
						Cliquez sur ce lien pour aller sur la page de votre profil.
					</p>
					<p>
						Une fois le lien "Profil" cliqué, vous arriverez sur la page de récapitulation de votre profil. Vous pourrez voir qu'ils existent trois catégories sources d'informations : <br/>
						- votre tableau de bord<br/>
						- la présentation de votre photo, de votre nom, et de votre niveau relationnel<br/>
						- les options de profil<br/> 
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Votre tableau de bord</h4>
					<p>
						Si vous avez cliqué sur le lien "Profil", vous pouvez voir qu'il y a une série d'informations à droite de votre écran d'ordinateur.
						Cette série d'informations est composée de 12 compteurs : <br/>
						- le nombre d'événement que vous organisez<br/>
						- le nombre de sortie où vous irez prochainement<br/>
						- le nombre de sortie où vous irez prochainement proposée par des lieux<br/>
						- le nombre de vos demandes en attente<br/>
						- le nombre vos demandes exaucées non accomplies<br/>
						- le nombre de vos propositions personnelles<br/>
						- le nombre de proposition à vos demandes<br/>
						- le nombre d'invitation de vos relations<br/>
						- le nombre d'invitation de vos relations lieux<br/>
						- le nombre de messages amicaux non lus<br/>
						- le nombre de messages provenant des lieux non lus<br/>
						- le nombre de proposition de sympathie</br>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Le nombre d'événement que vous organisez</h4>
					<p>
						Ce compteur permet de comtabiliser l'ensemble des sorties à venir, dont vous êtes le créateur.
						Les sorties où vous êtes co-organisateur ne sont pas prises en compte.
					</p>
					<h4>Le nombre de sortie où vous irez prochainement</h4>
					<p>
						Ce compteur permet de comptabiliser l'ensemble des sorties proposées par vos relations non lieux,
						où vous vous êtes inscrit comme futur participant.
					</p>
					<h4>Le nombre de sortie où vous irez prochainement proposée par des lieux</h4>
					<p>
						Ce compteur permet de comptabiliser l'ensemble des sorties proposées par vos relations lieux,
						où vous vous êtes inscrit comme futur participant.
					</p>
					<h4>Le nombre de vos demandes en attente</h4>
					<p>
						Ce compteur permet de comptabiliser l'ensemble de vos demandes de sorties en attente 
						d'une bonne proposition provenant d'un membre du site.
					</p>
					<h4>Le nombre de vos demandes exaucées non accomplies</h4>
					<p>
						Ce compteur permet de comptabiliser l'ensemble de vos demandes de sorties transformées en sortie, après avoir accepté une proposition.
						Elles sont dites non accomplies, parce que ces sorties n'ont pas encore eu lieu. 
					</p>
					<h4>Le nombre de vos propositions personnelles</h4>
					<p>
						Ce compteur permet de comptabiliser l'ensemble de vos propositions aux demandes des autres membres du site, 
						qui n'ont pas reçues de réponse. Si le compteur diminue, cela signifie qu'au moins une proposition a reçu une réponse, 
						favorable ou défavorable. 
					</p>
					<h4>Le nombre de proposition à vos demandes</h4>
					<p>
						Ce compteur permet de comptabiliser l'ensemble des propositions faites à l'ensemble de vos demandes de sorties.   
					</p>
					<h4>Le nombre d'invitation de vos relations</h4>
					<p>
						Ce compteur permet de comptabiliser l'ensemble des sorties, de relations non lieux, où vous êtes invité
					</p>
					<h4>Le nombre d'invitation de vos relations lieux</h4>
					<p>
						Ce compteur permet de comptabiliser l'ensemble des sorties, de relations lieux, où vous êtes invité
					</p>
					<h4>Le nombre de messages amicaux non lus</h4>
					<p>
						Ce compteur permet de comptabiliser l'ensemble des messages provenant d'utilisateurs du site , non lieux, que vous n'avez pas lus.  
					</p>
					<h4>Le nombre de messages provenant des lieux non lus</h4>
					<p>
						Ce compteur permet de comtabiliser l'ensemble des messages provenant de lieux, que vous n'avez pas lus.
					</p>
					<h4>Le nombre de proposition de sympathie</h4>
					<p>
						Ce compteur permet de comptabiliser l'ensemble de proposition de sympathie qui vous sont faites. 
						Concrètement, ce compteur donne le nombre d'utilisateurs qui souhaitent sympathiser avec vous.
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>La présentation de votre photo, de votre nom, et de votre niveau relationnel</h4>
					<p>
						Si vous avez cliqué sur le lien "Profil", vous pouvez voir qu'il y a votre photo de profil, votre nom, et votre niveau relationnel, à gauche de votre écran d'ordinateur.
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Votre photo de profil</h4>
					<p>
						Vous pouvez avoir au maximum 3 photos de profil sur le site, la photo de profil 1 qui fait partie de la liste des photos imposées, 
						la photo de profil 2 qui fait aussi partie de la liste des photos imposées, et la photo de profil 3, ou photo de profil de lieu, que vous pouvez importer.
						Votre photo de profil 1 est visible par vous-même et toutes vos relations dites "naissantes" et/ou "amicales".<br/>
						Votre photo de profil 2 vous est invisible et seules vos relations dites "fortes", "parfaites", et/ou "éternelles" peuvent voir votre seconde photo de profil.<br/>
						Votre photo de profil 3, ou photo de lieu, est visible à l'ensemble des utilisateurs, vous compris, si vous êtes un lieu.
					</p>
					<h4>Votre nom d'utilisateur</h4>
					<p>
						Vous pouvez avoir au maximum 3 surnoms que vous maîtrisez sur le site, le surnom 1 qui fait partie de la liste des surnoms imposés,
						le surnom 2 qui fait aussi partie de la liste des surnoms imposés, et le surnom 3, ou surnom de lieu, qui ne vous est pas imposé.
						Votre surnom 1 est visible par vous-même et toutes vos relations dites "naissantes" et/ou "amicales".<br/>
						Votre surnom 2 vous est invisible et seules vos relations dites "fortes", "parfaites", et/ou "éternelles" peuvent voir votre second surnom.<br/>
						Votre surnom 3, ou surnom de lieu, est visible à l'ensemble des utilisateurs, vous compris, si vous êtes un lieu.<br/>
						Vos 3 surnoms sont dits "maîtrisés", parce que les autres membres du site peuvent vous attribuer des surnoms qu'eux seuls connaissent,
						et que vous ne choisissez pas.
					</p>
					<h4>Votre niveau relationnel</h4>
					<p>
						Le niveau relationnel est l'indicateur qui résume toute l'activité d'un membre du site. Il existe deux leviers pour augmenter son niveau relationnel :<br/>
						- faire de nouvelles rencontres<br/>
						- approfondir des relations<br/>
						Par conséquent, le niveau relationnel est l'élément à vérifier pour savoir si un utilisateur est expérimenté, 
						nouveau, ou peut-être un fake.
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Les options de profil</h4>
					<p>
						Si vous avez cliqué sur le lien "Profil", vous pouvez voir qu'il y a les options de profil, en bas à gauche de votre écran d'ordinateur.
						Ces options sont composées de 3 liens :<br/>
						- l'accueil de votre profil<br/>
						- l'abonnement<br/>
						- les informations personnelles<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>L'accueil de votre profil</h4>
					<p>
						Ce lien vous renverra au tableau de bord décrit plus haut.
					</p>
					<h4>L'abonnement</h4>
					<p>
						En cliquant sur ce lien, la page des abonnements vous apparaîtra.
						Vous pourrez alors vérifier les différences entre l'abonnement "Echanges" et l'abonnement "Partage". 
					</p>
					<h4>Les informations personnelles</h4>
					<p>
						En cliquant sur ce lien, la page de résumé de vos informations personnelles vous apparaîtra.
						Cette page est composée d'au maximum 8 éléments :<br/>
						- le résumé de vos abonnements<br/>
						- le résumé de vos informations personnelles de base<br/>
						- le résumé de vos informations de lieu<br/>
						- le résumé de vos rencontres types de lieu<br/>
						- le résumé de votre code de sympathie<br/>
						- le résumé de votre adresse e-mail<br/>
						- l'option de mot de passe<br/>
						- l'option disparition<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Le résumé de vos abonnements</h4>
					<p>
						Ce résumé vous permettra de savoir si un abonnement est actif sur votre compte, et jusqu'à quand.<br/>
						De plus, en cliquant sur le bouton "Voir les privilèges", vous serez directement envoyé sur la page des abonnements,
						et pourrez visualiser l'ensemble des avantages que procure l'abonnement "Partage". 
					</p>
					<h4>Le résumé de vos informations personnelles de base</h4>
					<p>
						Ce résumé vous permettra de voir en un coup d'oeil si vous êtes un lieu, quel est votre surnom 1, votre surnom 2, votre date de naissance,
						votre département de référence, votre ville de résidence, ainsi que votre sexe. <br/>
						De plus, en cliquant sur le bouton "Modifier vos informations et vos photos",
						vous serez directement envoyé sur la page contenant le formulaire de modification de vos informations personnelles.<br/>
						Sur cette page, il vous faudra cliquer sur "Modifier vos photos" pour accéder à la page de modification de vos photos de profil 1 et 2.
					</p>
					<h4>Le résumé de vos informations de lieu</h4>
					<p>
						Ce résumé vous permettra de visualiser rapidement votre nom de lieu, et les conditions à suivre pour vous rencontrer.<br/>
						De plus, en cliquant sur le bouton "Modifier vos informations de lieu", vous serez envoyé sur la page contenant le formulaire de 
						modification de vos informations de lieu.<br/>
						Sur cette page, il faudra cliquer sur "Modifier votre photo de lieu" pour accéder à la page de modification de votre photo de profil de lieu.
					</p>
					<h4>Le résumé de vos rencontres types de lieu</h4>
					<p>
						Ce résumé vous permettra d'apprendre quelles sont les rencontres effectives que vous proposez.<br/>
						La modification de celles-ci est possible en cliquant sur le bouton "Modifier votre informations de lieu", cité plus haut.
					</p>
					<h4>Le résumé de votre code de sympathie</h4>
					<p>
						Ce résumé mettra en avant votre code de sympathie.</br>
						Cliquez sur le bouton "Modifier vote code de sympathie", pour accéder au formulaire de modification de votre code sympathie.
					</p>
					<h4>Le résumé de votre adresse e-mail</h4>
					<p>
						Ce résumé mettra en avant votre adresse e-mail.<br/>
						Cliquez sur le bouton "Modifier votre adresse e-mail", pour accéder au formulaire de modification de votre adresse e-mail.
					</p>
					<h4>L'option de mot de passe</h4>
					<p>
							En cliquant sur le bouton "Modifier votre mot de passe", vous accèderez à la page contenant le formulaire permettant 
							de modifier votre mot de passe.
					</p>
					<h4>L'option disparition</h4>
					<p>
							En cliquant sur le bouton "Disparaître", vous accèderez à la page contenant le formulaire permettant 
							de vous faire disparaître du site.
					</p>
					<p>
						Certains de ces éléments ne sont accessibles qu'avec un abonnement <a href="abonnement.php" class="aaide">"Partage"</a>.
					</p>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>