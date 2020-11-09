<?php 
session_start();
?>
<!DOCTYPE>
<html>
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117441699-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-117441699-1');
		</script>

		<?php include("head.php"); ?>
		<meta name="robots" content="noindex">
		<title>CGV - Les Nouveaux Arrivants</title>
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
		<section class="sectioncgv">
			<div class="pcgv">
				<div class="div9cadre">
					<h2>Conditions Générales de Vente (prestation de service membre CP)</h2>
					<h3>1) DEFINITIONS</h3>
					<p>
						CGV : les présentes conditions générales de vente applicables aux comptes CP.<br/>
						CGU : les conditions générales d’utilisation que tous membres (professionnels ou non) du site s’engage à respecter.<br/>
						Site Lesnouveauxarrivants ou le Site : le site web de la société Benkoma disponible notamment à  l'adresse "www.lesnouveauxarrivants.com".<br/>
						Benkoma : société propriétaire de la marque et du site Lesnouveauxarrivants.<br/>
						Compte E ou Membre E : personne physique ou morale ayant ouvert un compte membre (inscription gratuite) sur le site.<br/>
						Membre CP : personne physique ou morale ayant souscrit à l’utilisation d’un compte Membre avec un abonnement Partage sur le site.<br/>
						Contrat d'Abonnement ou Abonnement ou Forfait : ensemble contractuel constitué par les présentes CGV.<br/>
						Fiche : document créé par un membre et rendu disponible sur le site afin que les autres membres puissent profiter
						de ses caractéristiques particulières sur le site.<br/>
					</p>
					<h3>2) OBJET</h3>
					<p>
						Les présentes CGV ont pour objet de définir les conditions dans lesquelles les personnes physiques ou morales peuvent bénéficier des services 
						membre CP fournis par Benkoma sur le site Lesnouveauxarrivants.
					</p>
					<h3>3) ACCEPTATION DES CONDITIONS</h3>
					<p>
						Par le fait de créér ou d’accepter la mutation d’un membre E en membre CP, 
						le client accepte sans réserve les présentes CGV, ainsi que les CGU dont il reconnaît avoir pris connaissance.
					</p>
					<p>
						Ces CGV sont seules applicables.
						Le client est censé en avoir pris connaissance, en avoir accepté toutes les clauses et renoncer à se prévaloir de ses conditions d’achat.
					</p>
					<p>
						Ces CGV peuvent faire l’objet de modifications. Le client sera informé de toute modification impactante via l’email par lequel Benkoma 
						est habituellement
						en contact avec lui. Les conditions applicables sont celles en vigueur au moment de la mutation en membre CP ou de son renouvellement,
						telles qu'elles figurent sur les CGV du site.
					</p>
					<p>
						Tout usage du service membre CP après l'entrée en vigueur des modifications du contrat d'abonnement, vaut acceptation par le client
						du nouveau contrat d'abonnement.
						Les CGV figurant en ligne sur le site prévalent sur toute version imprimée de date antérieure.
					</p>
					<h3>4) LE SERVICE MEMBRE CP</h3>
					<p>
						Le service CP permet aux membres d'utiliser des fonctionnalités supplémentaires (comme l'accès aux groupes relationnels 2 et 3, 
						un nombre plus élevé de membres recommandés, etc...) en fonction de leur abonnement, par rapport aux membres E.
					</p>
					<h3>5) ABONNEMENT AU SERVICE : MEMBRE CP</h3>
					<p>
						Les membres CP ayant un abonnement Partage règlent ponctuellement leur abonnement.<br/>
					</p>
					<p>
						A son terme, l’abonnement pour les membres CP ayant un abonnement Partage est tacitement renouvelé et le compte Membre CP redevient un compte E si celui-ci n'est pas renouvelé par son abonné.
					</p>
					<p>
						Chaque abonnement est valable aux conditions applicables à ce moment dans les CGV.
						Comme l'indique la loi, la résiliation d’un abonnement commencé ne peut pas donner lieu à remboursement :
						<ul>
							<li>Le droit de rétractation dans le commerce à distance.</li>
							<li>Le droit de rétractation s'applique aux prestations de services à l'exception des contrats de fourniture de services
							si l'exécution a commencé avec l'accord du consommateur avant la fin du délai de 7 jours ouvrables.</li>
						</ul>
					</p>
					<p>
						Benkoma se réserve le droit de suspendre ses obligations ou de résilier l’abonnement de plein droit, sans délai, sans indemnisation et sans formalité, dans les cas suivants :
						<ul>
							<li>Tricherie ou tentative de tricherie du Membre CP</li>
							<li>Non respect des CGU.</li>
							<li>En cas de force majeure.</li>
							<li>En cas de résiliation du contrat aux torts du client.</li>
						</ul>
					</p>
					<h3>6) PROPRIETE</h3>
					<p>
					Benkoma demeure seule propriétaire des noms, logos, marques ou tout autre signe distinctif lui appartenant, notamment la marque Lesnouveauxarrivants.
					Le client s'engage à respecter et à faire respecter les droits de propriété intellectuelle de Benkoma.
					</p>
					<h3>7) PRIX</h3>
					<p>
						Les prix des abonnements au service membre CP sont pour l'abonnement Partage de 9,99 euros pour 3 jours,
						26,99 euros pour un mois, 65,99 euros pour 3 mois, et 219,99 euros pour une année, et s’entendent TVA comprise.
					</p>
					<p>
						Les prix de Benkoma ne visent que la fourniture de prestations de services décrites dans les CGV.
					</p>
					<p>
						Benkoma se réserve le droit de modifier ses prix à tout moment. Et, les membres CP recevront un email les informant du changement des tarifs.  
					</p>
					<h3>9) PAIEMENT</h3>
					<p>
						Le prix de l’abonnement au service membre CP est payable à la commande pour les membres CP ayant un abonnement Partage.
					</p>
					<p>
						Toute réclamation relative à une facture pourra être transmise par écrit, au siège social de Benkoma, ou par mail, à l'adresse azertyui0000000@gmail.com dans les huit jours calendaires après sa réception.
						A l’expiration de ce délai plus aucune réclamation ne sera recevable.
					</p>
					<h3>10) RESPONSABILITE</h3>
					<p>
						La prestation de services crée uniquement des obligations de moyen pour Benkoma, à l’exclusion expresse de toute obligation de résultat.
					</p>
					<p>
						Benkoma ne saurait être tenue pour responsable de l’inexécution du contrat en cas de force majeure, 
						de perturbations ou interruption de l’accès à son site pour des raisons techniques notamment de maintenance ou toute autre raison.
					</p>
					<p>
						Benkoma livre uniquement des services membre CP en ligne et n’est pas responsable de la livraison des 
						réseaux de communication et du matériel qui permet l’accès aux banques de données.
					</p>
					<p>
						Benkoma ne saurait être déclarée responsable d'une quelconque difficulté de transmission ou, plus généralement, 
						de toute perturbation du réseau. Toutefois Benkoma travaillera pour le maintien de la qualité de ses services. Le client reconnaît que Benkoma a satisfait à la totalité de ses obligations de conseil
						et d'information concernant les caractéristiques essentielles du service membre CP.
					</p>
					<p>
						Benkoma n'assume en aucun cas la responsabilité des dommages indirects causés par l'utilisation du service membre CP
						et ne sera pas tenue de réparer ces dommages indirects tels que préjudice financier ou commercial, perte de clientèle ou de parts,
						trouble commercial quelconque, augmentation des coûts et autres frais généraux, perte de bénéfice, perte d'image de marque,
						perte de données, de fichiers ou de programmes informatiques quelconques qui pourraient résulter de difficultés
						dans l'exécution du service "membre CP" et des présentes CGV. Est assimilée à un dommage indirect et en conséquence n'ouvre pas droit à réparation, 
						toute action dirigée contre le client par un tiers. Toutefois Benkoma travaillera pour améliorer la qualité de ses services.
					</p>
					<p>
						Le client crée sous sa responsabilité des fiches sorties et met en œuvre tout ce qui est nécessaire pour que le déroulement de
						ces sorties se passe le mieux possible.
					</p>
					<p>
						Le client s’engage de manière non limitative à obtenir les autorisations et à acquitter les droits éventuels sur les textes,
						photos, illustrations et en général sur toute œuvre utilisée sur ses "fiches sorties" et son compte membre CP.
					</p>
					<p>
						En tout état de cause, il est entendu que dans l'hypothèse où la responsabilité de Benkoma était engagée,
						celle-ci ne pourra dépasser le montant payé par le client au titre de l'abonnement en cours.
					</p>
					<h3>11) CONFIDENTIALITE</h3>
					<p>
						Tant le client que Benkoma s'engagent à ne pas divulguer à des personnes tierces, des informations confidentielles,
						non limités aux codes d'accès et mots de passe, informations financières, aux données de facturation et au service.
					</p>
					<h3>12) DIVERS</h3>
					<p>
						a) Force majeure : Dans un premier temps, les cas de force majeure suspendront l'exécution du contrat d'abonnement.
						Si les cas de force majeure ont une durée d'existence supérieure à 2 semaines, le contrat d'abonnement sera résilié automatiquement,
						sauf accord contraire des parties. De façon expresse, sont considérés comme cas de force majeure ou cas fortuits,
						ceux habituellement retenus par la jurisprudence des cours et tribunaux français.
					</p>
					<p>
						b) Nullité : Si une ou plusieurs stipulations des présentes conditions générales sont tenues pour non valides ou déclarées
						telles en application d'une loi, d'un règlement ou à la suite d'une décision définitive d'une juridiction compétente,
						les autres stipulations garderont toute leur force et leur portée.
					</p>
					<p>
						c) Tolérance : Les parties conviennent réciproquement que le fait pour l'une ou l'autre des parties de tolérer une situation, 
						n'a pas pour effet d'accorder à l'autre partie des droits acquis. De plus, une telle tolérance ne peut être interprétée comme
						une renonciation à faire valoir les droits en cause.
					</p>
					<p>
						d) Loi applicable : Les présentes conditions générales sont régies par la loi française, que ce soit pour les règles de fond comme pour les règles de forme.
					</p>
					<p>
						e) Litiges : En cas de difficulté pour l'exécution des présentes conditions générales, les parties décident de se soumettre 
						préalablement à une procédure amiable. A ce titre, toute partie qui souhaiterait mettre en jeu ladite procédure et ce, préalablement
						à la saisie d'un tribunal compétent devra le notifier à l'autre partie, par lettre recommandée avec accusé de réception en laissant 
						un délai de quinze jours à l'autre partie pour répondre. En cas de conciliation, les parties s'engagent à signer un accord transactionnel et confidentiel.
					</p>
					<p>
						EN CAS DE LITIGE ET, APRES RECHERCHE INFRUCTUEUSE D'UNE SOLUTION AMIABLE, COMPETENCE EXPRESSE EST ATTRIBUEE AUX TRIBUNAUX DE ROUEN NONOBSTANT
						PLURALITE DE DEFENDEUR OU APPEL EN GARANTIE, MEME POUR LES PROCEDURES D'URGENCE OU LES PROCEDURES CONSERVATOIRES, EN REFERE OU PAR REQUETE.
					</p>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>