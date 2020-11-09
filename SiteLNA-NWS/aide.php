<?php
session_start();
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Aide - Les Nouveaux Arrivants</title>
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
					<h2 class="div11cadre">Accueil aide</h2>
					<?php include("navaide.php"); ?>
				</div>
				<div class="div9cadre div12cadre taille">
					<h3>Sorties</h3>
					<p>
						L'aide sur les sorties contient des informations permettant de créer, gérer, des sorties avec des lieux ou des relations.<br/>
						Mais aussi, l'aide permet d'obtenir des infos sur les demandes et les propositions de sortie.<br/>
						<a href="aide_sortie.php" class="aaide">Voir les aides concernant les sorties</a>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h3>Profil</h3>
					<p>
						L'aide sur le profil contient des informations, permettant de connaître les caractéristiques de
						votre profil, et de les changer, au travers du lien "Informations personnelles", "Abonnement", etc...</br>
						<a href="aide_profil.php" class="aaide">Voir les aides pour le profil</a>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h3>Relations</h3>
					<p>
						L'aide sur les relations contient des informations permettant de gérer vos relations.<br/> 
						<a href="aide_relations.php" class="aaide">Voir les aides sur les relations</a>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h3>Conversations</h3>
					<p>
						L'aide sur les conversations contient des informations permettant de gérer vos conversations.<br/> 
						<a href="aide_conversations.php" class="aaide">Voir les aides concernant les conversations</a>
					</p>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>