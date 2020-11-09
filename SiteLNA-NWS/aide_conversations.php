<?php
session_start();
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Aide conversations - Les Nouveaux Arrivants</title>
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
					<h2 class="div11cadre">L'aide pour les conversations</h2>
					<?php include("navaide.php"); ?>
				</div>
				<div class="div9cadre div12cadre taille">
					<p>
						Vous trouverez, tout à droite de l'en-tête, le lien "Conversations".<br/>
						Cliquez sur celui-ci pour aller sur la page qui vous montrera les conversations qui vous concernent.
					</p>
					<p>
						Une fois le lien "Conversations" cliqué, vous arriverez sur la page des conversations "amicales". Vous pourrez voir qu'ils existent trois types de conversations :<br/> 
						- les conversations "amicales"<br/>
						- les conversations avec des "lieux"<br/>
						- les conversations "bloquées"<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Les conversations amicales</h4>
					<p>
						Les conversations amicales sont les conversations que vous avez avec des membres du site qui ne sont pas des lieux, et à qui vous avez accordés le droit de vous envoyer des messages.
					</p>
					<h4>Les conversations avec des lieux</h4>
					<p>
						Les conversations avec des lieux sont les conversations que vous avez avec des membres du site qui sont des lieux, et à qui vous avez accordés le droit de vous envoyer des messages.
					</p>
					<h4>Les conversations bloquées</h4>
					<p>
						Les conversations bloquées sont les conversations que vous avez eues avec des membres du site quels qu'ils soient, et à qui vous avez décidés de retirer leur droit de vous envoyer des messages.
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<p>
					Quel que soit le type de la conversation, si une conversation existe, alors elle est composée de 3 éléments : <br/>
					- le nom du membre du site avec qui vous avez la discussion<br/>
					- le bouton "Voir"<br/>
					- le bouton "Bloquer/Débloquer"<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Le nom du membre du site</h4>
					<p>
						Le nombre du membre du site permet de savoir avec qui vous avez une conversation. En cliquant dessus, le profil de l'utilisateur vous sera présenté. 
					</p>
					<h4>Le bouton "Voir"</h4>
					<p>
						Le bouton "Voir" permet d'accèder à la conversation. Cliquer sur lui pour voir l'ensemble des messages envoyés par un membre en particulier datant de moins d'un mois. 
					</p>
					<h4>Le bouton "Bloquer/Débloquer"</h4>
					<p>
						Le bouton "Bloquer/Débloquer" permet d'empêcher ("Bloquer"), ou réautoriser ("Débloquer"), un membre à vous envoyer un message.
					</p>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>