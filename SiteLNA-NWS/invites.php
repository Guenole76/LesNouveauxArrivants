<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('navphoto.php');
if(isset($_POST['page']))
{
	$_SESSION['page_i'] = $_POST['page'];
}
if(!isset($_SESSION['page_i']))
{
	$_SESSION['page_i'] = 1; 
}
$limite = ($_SESSION['page_i'] - 1) * 40;
$req_id_createur = $bdd->prepare('SELECT id_membre_createur FROM sortie WHERE id_sortie = ?');
$req_id_createur->execute(array($_SESSION['id_sortie']));
$donnees_id_createur = $req_id_createur->fetch();
$req_id_co_orga = $bdd->prepare('SELECT valeur_co_orga FROM inscrits_sortie WHERE id_sortie = ? AND id_membre = ?');
$req_id_co_orga->execute(array($_SESSION['id_sortie'], $_SESSION['id']));
$donnees_id_co_orga = $req_id_co_orga->fetch();
$req1 = $bdd->prepare('SELECT id_membre idm FROM inscrits_sortie WHERE id_sortie = ? AND valeur_membre = ? ORDER BY id_inscrit ASC LIMIT ' .$limite. ', 40');
$req1->execute(array($_SESSION['id_sortie'], 2));
$donnees1 = $req1->fetch();
$n = 1;
if(isset($donnees1['idm']))
{
	do
	{
		if($donnees1['idm'] !== $_SESSION['id'])
		{
			$req2 = $bdd->prepare('SELECT surnom1 s1, surnom2 s2, l, nom_l FROM inscrits WHERE id = ?');
			$req2->execute(array($donnees1['idm']));
			$donnees2 = $req2->fetch();
			$req3 = $bdd->prepare('SELECT valeur_co_orga FROM inscrits_sortie WHERE id_sortie = ? AND id_membre = ?');
			$req3->execute(array($_SESSION['id_sortie'], $donnees1['idm']));
			$donnees3 = $req3->fetch();
			$req4 = $bdd->prepare('SELECT surnom3 s3, validations3 vds3, points_de_relation pdr, groupe_relationnel gr
			FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
			$req4->execute(array($_SESSION['id'], $donnees1['idm']));
			$donnees4 = $req4->fetch();
			if(isset($donnees4['s3']))
			{
				if($donnees4['gr'] >= 2)
				{
					if($donnees4['vds3'] == 1)
					{
						$id_membre[$n] = $donnees1['idm'];
						$co_orga[$n] = $donnees3['valeur_co_orga'];
						$surnom[$n] = $donnees4['s3'];
					}else
					{
						if($donnees2['l'] == 1)
						{
							$id_membre[$n] = $donnees1['idm'];
							$co_orga[$n] = $donnees3['valeur_co_orga'];
							$surnom[$n] = $donnees2['nom_l'];
						}else
						{
							if($donnees4['pdr'] >= 50)
							{
								$id_membre[$n] = $donnees1['idm'];
								$co_orga[$n] = $donnees3['valeur_co_orga'];
								$surnom[$n] = $donnees2['s2'];
							}else
							{
								$id_membre[$n] = $donnees1['idm'];
								$co_orga[$n] = $donnees3['valeur_co_orga'];
								$surnom[$n] = $donnees2['s1'];
							}
						}
					}
				}else
				{
					if($donnees2['l'] == 1)
					{
						$id_membre[$n] = $donnees1['idm'];
						$co_orga[$n] = $donnees3['valeur_co_orga'];
						$surnom[$n] = $donnees2['nom_l'];
					}else
					{
						if($donnees4['pdr'] >= 50)
						{
							$id_membre[$n] = $donnees1['idm'];
							$co_orga[$n] = $donnees3['valeur_co_orga'];
							$surnom[$n] = $donnees2['s2'];
						}else
						{
							$id_membre[$n] = $donnees1['idm'];
							$co_orga[$n] = $donnees3['valeur_co_orga'];
							$surnom[$n] = $donnees2['s1'];
						}
					}
				}
			}else
			{
				if($donnees2['l'] == 1)
				{
					$id_membre[$n] = $donnees1['idm'];
					$co_orga[$n] = $donnees3['valeur_co_orga'];
					$surnom[$n] = $donnees2['nom_l'];
				}else
				{
					if($donnees4['pdr'] >= 50)
					{
						$id_membre[$n] = $donnees1['idm'];
						$co_orga[$n] = $donnees3['valeur_co_orga'];
						$surnom[$n] = $donnees2['s2'];
					}else
					{
						$id_membre[$n] = $donnees1['idm'];
						$co_orga[$n] = $donnees3['valeur_co_orga'];
						$surnom[$n] = $donnees2['s1'];
					}
				}
			}
		}else
		{
			$req5 = $bdd->prepare('SELECT surnom1 s1, surnom2 s2, l, nom_l FROM inscrits WHERE id = ?');
			$req5->execute(array($donnees1['idm']));
			$donnees5 = $req5->fetch();
			$id_membre[$n] = $donnees1['idm'];
			$co_orga[$n] = $donnees_id_co_orga['valeur_co_orga'];
			if($donnees5['l'] == 1)
			{
				$surnom[$n] = $donnees5['nom_l'];
			}else
			{
				$surnom[$n] = $donnees5['s1'];	
			}
		}
	$n++;
	}while($donnees1 = $req1->fetch());
	$invites = 1;
}else
{
	$invites = "Il n'y a  pas d'invités.";
}
$req6 = $bdd->prepare('SELECT COUNT(id_membre) nbri FROM inscrits_sortie WHERE id_sortie = ? AND valeur_membre = ?');
$req6->execute(array($_SESSION['id_sortie'], 2));
$donnees6 = $req6->fetch();					
if(!isset($donnees6['nbri']))
{
	$donnees6['nbri'] = 0;
}
$nbrpages = intval(($donnees6['nbri']/40)) + 1;
$n = $n - 1;
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Inviter-invités - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include("navvoirlasortie.php"); ?>
					<?php 
						if($donnees_id_createur['id_membre_createur'] == $_SESSION['id'])
						{
							include("navinviteslien.php");
							include("navinvites.php");
						}elseif($donnees_id_co_orga['valeur_co_orga'] == 1)
						{
							include("navinviteslien.php");
							include("navinvites.php");
						}else
						{
							include("navinviteslien.php");
						}
					?>
				</div>
				<div class="div2amais">
					<?php 
						if($invites == 1)
						{
							if($donnees_id_createur['id_membre_createur'] == $_SESSION['id'])
							{
								echo '<div class="div9cadre div10cadre">
										<h2>Les co-organisateurs</h2></div>';
								for($i = 1; $i <= $n; $i++)
								{
									if($co_orga[$i] == 1)
									{
										echo "<div class='div7presen div9cadre div10cadre'><form method='post' action='traitementinvites.php' class='form'>
										<input type='hidden' name='invitation' value=0 />
										<input type='hidden' name='id_membre' value=" .$id_membre[$i]. " />
										<input type='submit' name='valider' value='" .$surnom[$i]. "' class='boutonnom'/>
										<input type='submit' name='co_orga2' value='X' class='boutonnom'/>
										</form></div>";
									}
								}
								echo '<div class="div9cadre div10cadre">
										<h2>Les invités</h2></div>';
								for($i = 1; $i <= $n; $i++)
								{
									if($co_orga[$i] > 1)
									{
										echo "<div class='div7presen div9cadre div10cadre'><form method='post' action='traitementinvites.php' class='form'>
										<input type='hidden' name='invitation' value=0 />
										<input type='hidden' name='id_membre' value=" .$id_membre[$i]. " />
										<input type='submit' name='valider' value='" .$surnom[$i]. "' class='boutonnom'/>
										<input type='submit' name='co_orga1' value='Co' class='boutonnom'/>
										<input type='submit' name='retirer' value='X' class='boutonnom'/>
										</form></div>";
									}
								}
							}else
							{
								echo '<div class="div9cadre div10cadre">
										<h2>Les co-organisateurs</h2></div>';
								for($i = 1; $i <= $n; $i++)
								{
									if($co_orga[$i] == 1)
									{
										echo "<div class='div7presen div9cadre div10cadre'><form method='post' action='traitementinvites.php' class='form'>
										<input type='hidden' name='invitation' value=0 />
										<input type='hidden' name='id_membre' value=" .$id_membre[$i]. " />
										<input type='submit' name='valider' value='" .$surnom[$i]. "' class='boutonnom'/>
										</form></div>";
									}
								}
								echo '<div class="div9cadre div10cadre">
										<h2>Les invités</h2></div>';
								for($i = 1; $i <= $n; $i++)
								{
									if($co_orga[$i] > 1)
									{
										echo "<div class='div7presen div9cadre div10cadre'><form method='post' action='traitementinvites.php' class='form'>
										<input type='hidden' name='invitation' value=0 />
										<input type='hidden' name='id_membre' value=" .$id_membre[$i]. " />
										<input type='submit' name='valider' value='" .$surnom[$i]. "' class='boutonnom'/>
										</form></div>";
									}
								}
							}
						}else
						{
							echo "<div class='div9cadre div10cadre'>" .$invites. "</div>";
						}
					?>
					<div class="div9cadre div10cadre div11cadre">
						<form method="post" action="invites.php"  class="form">
						<?php
							for($i = 1; $i <= $nbrpages; $i++)
							{
								echo "<input type='submit' name='page' value=" .$i. " class='boutonamais'/>";
							}
						?>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>