<?php
session_start();
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Aide relations - Les Nouveaux Arrivants</title>
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
					<h2 class="div11cadre">L'aide pour les relations</h2>	
					<?php include("navaide.php"); ?>
				</div>
				<div class="div9cadre div12cadre taille">
					<p>
						Vous trouverez au milieu de l'en-tête, entre les liens "Profil" et "Conversations", le lien "Relations".<br/>
						Cliquez sur ce lien pour aller sur une page de recommandations de relations.
					</p>
					<p>
						Une fois le lien "Relations" cliqué, vous arriverez sur la page de recommandations du groupe relationnel 1. Vous pourrez voir qu'ils existent trois types de relations : <br/>
						- les relations concernées par une demande de sympathie<br/>
						- les relations qui sont dans l'un de vos groupes relationnels<br/>
						- les relations qui vous sont recommandées par des membres de vos groupes relationnels<br/> 
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Les relations concernées par une demande de sympathie</h4>
					<p>
						Si vous avez cliqué sur le lien "Relations", vous pouvez voir qu'il y a un tableau à gauche de votre écran d'ordinateur.
						Les 4 premiers liens de ce tableau sont liés aux demandes de sympathie, il y a : <br/>
						- les propositions de sympathie<br/>
						- la réserve de sympathie<br/>
						- vos demandes de sympathie<br/>
						- ajouts de sympathie<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Les propositions de sympathie</h4>
					<p>
						Les propositions de sympathie est la page rassemblant l'ensemble des propositions venant d'autres membres du site à faire partie d'un de vos groupes relationnels, et réciproquement.
					</p>
					<p>
						Une proposition est composée de 4 éléments :<br/>
						- le nom du membre qui fait la proposition<br/>
						- le bouton "Accepter"<br/>
						- le bouton "En réserve"<br/>
						- le bouton "Supprimer"<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Le nom du membre qui fait la proposition</h4>
					<p>
						Le nom du membre qui fait la proposition permet de distinguer les propositions entre elles. De plus, le profil du membre vous sera présenté si vous cliquez sur son nom.
					</p>
					<h4>Le bouton "Accepter"</h4>
					<p>
						Le bouton "Accepter", permet de répondre favorablement à la proposition. En cliquant sur ce bouton, le membre qui vous a fait la proposition deviendra une de vos relations du groupe relationnel 1, et réciproquement. 
					</p>
					<h4>Le bouton "En réserve"</h4>
					<p>
						Le bouton "En réserve" permet de repousser la réponse finale à la proposition de sympathie. La proposition est mise "en réserve" jusqu'à acceptation ou refus.  
					</p>
					<h4>Le bouton "Supprimer"</h4>
					<p>
						Le bouton "Supprimer" permet de donner une réponse défavorable à la proposition de sympathie. La proposition est tout simplement supprimée.
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>La réserve de sympathie</h4>
					<p>
						La réserve de sympathie est la page rassemblant l'ensemble des propositions dont la réponse finale a été reportée.
					</p>
					<p>
						Une proposition en réserve est composée de 3 éléments :<br/>
						- le nom du membre qui a fait la proposition<br/>
						- le bouton "Accepter"<br/>
						- le bouton "Supprimer"<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Le nom du membre qui a fait la proposition</h4>
					<p>
						Le nom du membre qui a fait la proposition permet de distinguer les propositions en réserve entre elles. De plus, le profil du membre vous sera présenté si vous cliquez sur son nom.
					</p>
					<h4>Le bouton "Accepter"</h4>
					<p>
						Le bouton "Accepter", permet de répondre favorablement à la proposition en réserve. En cliquant sur ce bouton, le membre qui vous a fait la proposition deviendra une de vos relations du groupe relationnel 1, et réciproquement. 
					</p>
					<h4>Le bouton "Supprimer"</h4>
					<p>
						Le bouton "Supprimer" permet de donner une réponse défavorable à la proposition de sympathie en réserve. La proposition est tout simplement supprimée.
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Vos demandes de sympathie</h4>
					<p>
						Vos demandes de sympathie est la page rassemblant l'ensemble de vos propositions de sympathie personnelles.  
					</p>
					<p>
						Vos demandes de sympathie sont composées de 2 éléments :<br/>
						- Le nom du membre à qui vous faites la demande de sympathie<br/>
						- Le bouton "Retirer la demande"<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Le nom du membre à qui vous faites la demandes de sympathie</h4>
					<p>
						Le nom du membre à qui vous faites une demande de sympathie permet de distinguer vos demandes entre elles. De plus, le profil du membre vous sera présenté si vous cliquez sur son nom. 
					</p>
					<h4>Le bouton "Retirer la demande"</h4>
					<p>
						Le bouton "Retirer la demande" permet de supprimer les demandes de sympathie qui vous voulez annuler.
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Ajouts de sympathie</h4>
					<p>
						Cette page permet de faire une demande de sympathie, via le code sympathie se trouvant dans <a href="informationspersonnelles.php" class="aaide">les informations personnelles</a> de chaque membre.
					</p>
					<p>
						Il suffit d'entrer le code du membre avec qui vous souhaiter faire une demande de sympathie. 
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Les relations qui sont dans l'un de vos groupes relationnels</h4>
					<p>
						Si vous avez cliqué sur le lien "Relations", vous pouvez voir qu'il y a un tableau à gauche de votre écran d'ordinateur.
						Les 4 liens à mi-hauteurs de ce tableau sont liés aux groupes relationnels, il y a : <br/>
						- le groupe relationnel 1 | Les Appelés<br/>
						- le groupe relationnel 2 | Les Elus<br/>
						- le groupe relationnel 3 ou Pro | Les Prosches<br/>
						- le groupe relationnel 4 | Les Intrus<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Ce que les groupes relationnels ont en commun</h4>
					<p>
						Sur chaque groupe relationnel, vous pourrez voir certaines informations concernant vos relations.
						Par exemple les mois et jour d'anniversaire de vos relations sont visibles. <br/>
						De plus, vous pouvez voir aussi la date de sympathie, qui est la date où vous avez, 
						soit rencontré votre relation pour la première fois grâce au site, soit la date où vous avez sympathisée. <br/>
						Et pour finir, les groupes relationnels ont en commun certains outils de tri. Comme outils de tri en commun, il y a :<br/>
						- le tri en fonction du nombre de fois où vous avez rencontré le membre (tri "Relation")<br/>
						- le tri par qualité, lieu ou individu <br/>
						- le tri par date d'anniversaire, plus ou moins éloignée <br/>
						- le tri par date de sympathie, plus ou moins éloignée<br/>
						- le tri par le surnom 1<br/>
						- le tri par le surnom 2 <br/>
					</p>	
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Ce qui différencie les groupes relationnels</h4>
					<p>
						Le groupe relationnel 1 se distingue par le fait que chaque proposition de sympathie
						ayant reçu une réponse favorable crée une relation dans le groupe relationnel 1. 
					</p>
					<p>
						Les groupes relationnels 2 et 3 ont la particularité d'être utilisable qu'en <a href="abonnement.php" class="aaide">abonnement</a>.
					</p>
					<p>
						Le groupe relationnel 4 se distingue par le fait que les membres qui en font partie ne sont pas récommandés, ni invitables.
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Les options des groupes relationnels</h4>
					<p>
						Lorsque vous verrez une relation sur l'un de vos groupes,
						vous pourrez voir avec son nom d'utilisateur de chiffre (2,4, etc...), et des mots (oui, non).	
					</p>
					<p>
						Ces éléments sont liés aux groupes relationnels pour ajuster leurs recommandations :<br/>
						- 1/2 = Relation préservée/recommandée, cette option vous permet de conserver une relation dans le même groupe relationnel,
						tout en empêchant que cette relation soit recommandée aux autres membres du même groupe.<br/>
						2, la relation est recommandée à tout le groupe relationnel dans lequel vous l'avez mise.<br/>
						1, la relation fait partie de votre groupe relationnel, mais n'est recommandée à aucun autre membre du groupe relationnel auquel elle appartient, la relation est préservée.<br/>
						- Oui = Source de recommandations, cette option vous permet de sélectionner les relations qui seront à la base de vos recommandations.<br/>
						Si oui, alors le membre est pris en compte pour vous recommander d'autres membres qu'il fréquente. <br/>
						Si non, alors, la relation est dite "glacée", le membre n'est pas pris en compte pour vous recommander les autres membres qu'il fréquente, vous aurez des recommandations provenant d'autres membres, des membres "Oui", des membres "chauds".<br/> 
						- 2/3/4, 1/3/4, etc...,cette option sert à distinguer les relations et donc les recommandations de chaque groupe relationnel. 
						Chaque groupe relationnel a un nom. Ces noms a été donné pour vous aider à catégoriser vos relations :<br/>
							- Les Appelés, sont les connaissances<br/>
							- Les Elus, sont les amis de longue date <br/>
							- Les Prosches, sont les professionnels avec lesquels vous vous sentez proche<br/>
							- Les Intrus, sont les personnes qui ne vous correspondent pas<br/>
						- Surnom Personnel, le surnom personnel n'est effectif qu'avec les groupes relationnels 2, 3, et 4 (gratuitement pour ce dernier)<br/>
					</p>
					<p>
						Certaines options ne sont disponibles qu'après avoir pris un <a href="abonnement.php" class="aaide" >abonnement</a>.
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Les relations qui vous sont recommandées par des membres de vos groupes relationnels</h4>
					<p>
						Si vous avez cliqué sur le lien "Relations", vous pouvez voir qu'il y a un tableau à gauche de votre écran d'ordinateur.
						Les 3 liens en bas de ce tableau sont liés aux recommandations de vos groupes relationnels, il y a : <br/>
						- les recommandations du groupe relationnel 1<br/>
						- les recommandations du groupe relationnel 2<br/>
						- les recommandations du groupe relationnel Pro<br/>
					</p>
				</div>
				<div class="div9cadre div12cadre taille">
					<h4>Equivalence des recommadations</h4>
					<p>
						Les pages de recommandations ont toutes le même fonctionnement,
						elles vous recommandent des membres du site à partir de vos relations "chaudes", c'est-à-dire non glacées.<br/>
						L'unique différence étant que la page de recommandations de votre groupe relationnel 1 prendra en compte vos Appelés, 
						la page de recommandations de votre groupe relationnel 2 prendre en compte vos Elus,
						et la page de recommandations de votre groupe relationnel Pro prendre en compte vos Prosches.<br/>
						Bien sûr, il faut que ceux-ci soient "chauds".
					</p>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>