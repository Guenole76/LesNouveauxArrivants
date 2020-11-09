<?php 
session_start();
include('mysql.php');		
$req_nb_inscrit = $bdd->prepare('SELECT COUNT(id) as nbi FROM inscrits WHERE valeur_inscrit = ?');
$req_nb_inscrit->execute(array(1));
$donnees_nb_inscrit = $req_nb_inscrit->fetch();
if($donnees_nb_inscrit['nbi'] == 0)
{
	$nbi = "0 membre";
	
}elseif($donnees_nb_inscrit['nbi'] == 1)
{
	$nbi = "1 membre";
}else
{
	$nbi = $donnees_nb_inscrit['nbi']. " membres";
}
if(!isset($_SESSION['message']))
{
	$_SESSION['message'] = 0; 
}
if($_SESSION['message'] == 0)
{
	$_SESSION['envoye'] = "";
}elseif($_SESSION['message'] == 1)
{
	$_SESSION['envoye'] = "Le bouton pour valider l'inscription n'a pas été cliqué.";
}elseif($_SESSION['message'] == 24)
{
	$_SESSION['envoye'] = "Le bouton Se connecter n'a pas été cliqué.";
}elseif($_SESSION['message'] == 25)
{
	$_SESSION['envoye'] = "L'adresse e-mail n'a pas été donnée.";
}elseif($_SESSION['message'] == 26)
{
	$_SESSION['envoye'] = "Le mot de passe n'a pas été donné.";
}elseif($_SESSION['message'] == 27)
{
	$_SESSION['envoye'] = "Votre adresse e-mail contient des caractères interdits.";
}elseif($_SESSION['message'] == 28)
{
	$_SESSION['envoye'] = "Votre mot de passe contient des caractères interdits.";
}elseif($_SESSION['message'] == 29)
{
	$_SESSION['envoye'] = "Votre adresse e-mail est incorrecte.";
}elseif($_SESSION['message'] == 30)
{
	$_SESSION['envoye'] = "Votre mot de passe est incorrecte.";
} 
$c = rand(1, 3);
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Le site pour se faire des amis - Les Nouveaux Arrivants</title>
		<meta name="description" content="Si tu souhaites faire de nouvelles rencontres à Rouen, alors Les Nouveaux Arrivants est fait pour toi !">
	</head>
	<body>
		<?php include("headernc.php"); ?>
		<section class="sectionindex" id="sectionindex">
			<div class="center taille fontfamily">
				<?php 
					if($_SESSION['message'] >= 24 AND $_SESSION['message'] <= 30 )
					{
						echo $_SESSION['envoye'];
					}
					if($_SESSION['message'] == 1)
					{
						echo $_SESSION['envoye'];
					}
					$_SESSION['message'] = 0;
					for($i = 156; $i <= 156; $i++)
					{
						if(isset($_SESSION['message'.$i]))
							{
							if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
							{
								echo $_SESSION['message'.$i].'<br/>';
							}
						}
					}
					for($i = 156; $i <= 156; $i++)
					{
						if(isset($_SESSION['message'.$i]))
							{
							if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
							{
								$_SESSION['message'.$i] = "";
							}
						}
					}
					for($i = 1000; $i <= 1002; $i++)
					{
						if(isset($_SESSION['message'.$i]))
							{
							if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
							{
								echo $_SESSION['message'.$i].'<br/>';
							}
						}
					}
					for($i = 1000; $i <= 1002; $i++)
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
			</div>
			<div id="divindex1">
					<img src="photos_accueil_lna/<?php echo $c;?>.jpg" alt="Faites des rencontres amicales avec Les Nouveaux Arrivants" title="Faites des rencontres amicales avec Les Nouveaux Arrivants"/>
			</div>
			<div class="pcgu" >
				<div class="div9cadre" id="divindex3">
					<p>
						<div id="divindex4" style="line-height: 180%;">
							<strong>
								Les Nouveaux Arrivants est le site qui vous permettra de faire de nouvelles rencontres amicales.<br/>
								Grâce à l'e-mail journalier qui annonce les prochaines sorties, vous pourrez prendre connaissance du
								nombre de sorties publiques ou privées, c'est-à-dire qui vous concernent, qui se dérouleront dans les prochaines 24h.<br/>
								Grâce aux fonctionnalités du site, vous pourrez gérer vos relations, et donc classer les utilisateurs avec qui vous avez sympathisés.<br/>
								Et enfin, vous pourrez rencontrer de nouveaux membres grâce aux recommandations émises à partir de vos relations.<br/> 
								Le site compte actuellement <?php echo $nbi; ?> !<br/>
								Inscrivez-vous !
							</strong>
						</div>
						<div>
							<a href="inscription.php" class="aindex taille">S'inscrire</a>
						</div>
					</p>
				</div>
				<div id="divindex1">
					<img src="rouen-ville-de-lancement.jpg" alt="Rouen, ville de lancement de Les Nouveaux Arrivants !" title="Rouen, ville de lancement de Les Nouveaux Arrivants !"/>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>