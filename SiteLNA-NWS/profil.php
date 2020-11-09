<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('navphoto.php');
include('changement_abonnement.php'); 
$req_abo_1 = $bdd->prepare('SELECT abonnement_en_cours FROM inscrits WHERE id = ?');
$req_abo_1->execute(array($_SESSION['id']));
$donnees_abo_1 = $req_abo_1->fetch();
$longabo = strlen($donnees_abo_1['abonnement_en_cours']);
if($longabo == 10)
{
	$limitation = 6;
}elseif($longabo == 8)
{
	$limitation = 4;
}elseif($longabo == 12)
{
	$limitation = 4;
}elseif($longabo == 7)
{
	$limitation = 2;
}
$req9 = $bdd->prepare('SELECT id_sortie FROM inscrits_sortie WHERE id_membre = ? AND valeur_membre = ?');
$req9->execute(array($_SESSION['id'], 2));
$donnees9 = $req9->fetch(); 
$p = 0;
if(isset($donnees9['id_sortie']))
{
	do
	{
		$req10 = $bdd->prepare('SELECT valeur_sortie, lieu FROM sortie WHERE id_sortie = ?');
		$req10->execute(array($donnees9['id_sortie']));
		$donnees10 = $req10->fetch();
		if($donnees10['valeur_sortie'] == 0)
		{
			if($donnees10['lieu'] == 2)
			{
				$p++;
			}
		}
	}while($donnees9 = $req9->fetch());
}else
{
	$p = 0;
}
$req11 = $bdd->prepare('SELECT id_sortie FROM inscrits_sortie WHERE id_membre = ? AND valeur_membre = ?');
$req11->execute(array($_SESSION['id'], 2));
$donnees11 = $req11->fetch(); 
$pl = 0;
if(isset($donnees11['id_sortie']))
{
	do
	{
		$req12 = $bdd->prepare('SELECT id_membre_createur, lieu, valeur_sortie FROM sortie WHERE id_sortie = ?');
		$req12->execute(array($donnees11['id_sortie']));
		$donnees12 = $req12->fetch();
		if($donnees12['valeur_sortie'] == 0)
		{
			if($donnees12['id_membre_createur'] ==! $_SESSION['id'])
			{
				if($donnees12['lieu'] == 1)
				{
					$pl++;
				}
			}
		}
	}while($donnees11 = $req11->fetch());
}else
{
	$pl = 0;
}
$req13 = $bdd->prepare('SELECT id_sortie FROM inscrits_sortie WHERE id_membre = ? AND valeur_membre = ?');
$req13->execute(array($_SESSION['id'], 1));
$donnees13 = $req13->fetch(); 
$f = 0;
$me = 0;
if(isset($donnees13['id_sortie']))
{
	do
	{
		$req14 = $bdd->prepare('SELECT id_membre_createur, valeur_sortie, lieu FROM sortie WHERE id_sortie = ?');
		$req14->execute(array($donnees13['id_sortie']));
		$donnees14 = $req14->fetch();
		if($donnees14['valeur_sortie'] == 0)
		{
			if($_SESSION['id'] !== $donnees14['id_membre_createur'])
			{
				if($donnees14['lieu'] == 2)
				{
					$f++;
				}
			}else
			{
				$me++;
			}
		}
	}while($donnees13 = $req13->fetch());
}else
{
	$f = 0;
}
$req15 = $bdd->prepare('SELECT id_sortie FROM inscrits_sortie WHERE id_membre = ? AND valeur_membre = ?');
$req15->execute(array($_SESSION['id'], 1));
$donnees15 = $req15->fetch(); 
$fl = 0;
if(isset($donnees15['id_sortie']))
{
	do
	{
		$req16 = $bdd->prepare('SELECT id_membre_createur, valeur_sortie, lieu FROM sortie WHERE id_sortie = ?');
		$req16->execute(array($donnees15['id_sortie']));
		$donnees16 = $req16->fetch();
		if($donnees16['valeur_sortie'] == 0)
		{
			if($_SESSION['id'] !== $donnees16['id_membre_createur'])
			{
				if($donnees16['lieu'] == 1)
				{
					$fl++;
				}
			}
		}
	}while($donnees15 = $req15->fetch());
}else
{
	$fl = 0;
}
$t = time() - 60 * 60 * 24 * 7;
$req17 = $bdd->prepare('SELECT id_membre_2 FROM conversations WHERE id_membre_1 = ? AND timestamp_conversation > ? AND vu = ?');
$req17->execute(array($_SESSION['id'], $t, 2));
$donnees17 = $req17->fetch();
$m = 0;
$ml = 0;
if(isset($donnees17['id_membre_2']))
{
	do
	{
		$req18 = $bdd->prepare('SELECT l FROM inscrits WHERE id = ?');
		$req18->execute(array($donnees17['id_membre_2'],));
		$donnees18 = $req18->fetch();
		if($donnees18['l'] == 2)
		{
			$m++;
		}elseif($donnees18['l'] == 1)
		{
			$ml++;
		}
	}while($donnees17 = $req17->fetch());
}else
{
	$m = 0;
	$ml = 0;
}
$s = 0; 
$req19 = $bdd->prepare('SELECT COUNT(id_membre_d) as nbr_demandeur FROM sympathie WHERE id_membre_s = ? AND valeur_s = ?');
$req19->execute(array($_SESSION['id'], 1));
$donnees19 = $req19->fetch();
$s = $donnees19['nbr_demandeur'];

$req20 = $bdd->prepare('SELECT COUNT(id_demande) as nbr_d_perso FROM demande WHERE id_demandeur = ? AND valeur_demande = ?');
$req20->execute(array($_SESSION['id'], 1));
$donnees20 = $req20->fetch(); 
$nbrd1 = $donnees20['nbr_d_perso'];

$req21 = $bdd->prepare('SELECT COUNT(id_demande) as nbr_d_exau FROM demande WHERE id_demandeur = ? AND valeur_demande = ?');
$req21->execute(array($_SESSION['id'], 2));
$donnees21 = $req21->fetch(); 
$nbrd2 = $donnees21['nbr_d_exau'];

$req22 = $bdd->prepare('SELECT COUNT(id_proposition) as nbr_p_perso FROM proposition WHERE id_repondant = ? AND valeur_proposition = ?');
$req22->execute(array($_SESSION['id'], 1));
$donnees22 = $req22->fetch(); 
$nbrp1 = $donnees22['nbr_p_perso'];

$req23 = $bdd->prepare('SELECT COUNT(id_proposition) as nbr_p_autre FROM proposition WHERE id_demandeur = ? AND valeur_proposition = ?');
$req23->execute(array($_SESSION['id'], 1));
$donnees23 = $req23->fetch(); 
$nbrp2 = $donnees23['nbr_p_autre'];
?>

<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Profil - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionprofil">
			<div class="pprofil">
				<div class="div1profil">
					<div class="div11cadre div9cadre div12cadre">
						<?php echo $photo; ?>
						<?php 
							if($donneesphoto['l'] == 1)
							{
								$titre = $donneesphoto['nom_l'];
							}else
							{
								$titre = $donneesphoto['surnom1'];
							}
						?>
						<?php echo $titre. "<br/>";  ?>
						<?php echo "Niveau " .$donneesphoto['nv_relationnel']; ?>
					</div>
					<?php include("navprofil.php"); ?>
				</div>
				<div class="div2profil">
				<?php 
						for($i = 1010; $i <= 1010; $i++)
						{
							if(isset($_SESSION['message'.$i]))
								{
								if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
								{
									echo "<div class='div9cadre div10cadre'>" .$_SESSION['message'.$i]. "<br/></div>";
								}
							}
						}
						for($i = 1010; $i <= 1010; $i++)
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
					<div class="div9cadre div10cadre">
						<a href="creationdesortie.php" class="ainscription">Proposer une sortie</a>
					</div>
					<div class="div9cadre div10cadre">
						<?php 
							echo "Evénements que vous organisez: ".$me;
						?>
					</div>
					<div class="div9cadre div10cadre">
						<?php 
							echo "Futures participations avec des relations: " .$f. " | Futures participations avec un lieu : " .$fl;
						?>
					</div>
					<div class="div9cadre div10cadre">
						<?php 
							echo "Demandes en attente: " .$nbrd1. " | Demandes éxaucées non accomplies: " .$nbrd2;
						?>
					</div>
					<div class="div9cadre div10cadre">
						<?php 
							echo "Propositions personnelles: " .$nbrp1. " | Propositions à vos demandes : " .$nbrp2;
						?>
					</div>
					<div class="div9cadre div10cadre">
						<?php 
							echo "Invitations des relations: " .$p. " | Invitations des lieux: " .$pl;
						?>
					</div>
					<div class="div9cadre div10cadre">
						<?php 
							echo "Messages amicaux: " .$m. " | Messages lieux: " .$ml;
						?>
					</div>
					<div class="div9cadre div10cadre">
						<?php 
							echo "Sympathiser: " .$s ;
						?>
					</div>
					<div class="div9cadre div10cadre">
						<a href="creationdesortie.php" class="ainscription">Proposer une sortie</a>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>