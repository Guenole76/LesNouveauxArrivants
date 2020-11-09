<?php
session_start();
include('verificationid.php');
include('mysql.php');
if(isset($_POST['page']))
{
	$_SESSION['page_rs'] = $_POST['page'];
}
if(!isset($_SESSION['page_rs']))
{
	$_SESSION['page_rs'] = 1; 
}
$limite = ($_SESSION['page_rs'] - 1) * 20;
$req1 = $bdd->prepare('SELECT id_membre_d FROM sympathie WHERE id_membre_s = ? AND valeur_s = ? ORDER BY id_sympathie DESC LIMIT ' .$limite. ', 20');
$req1->execute(array($_SESSION['id'], 2));
$donnees1 = $req1->fetch();
$n = 1;
if(isset($donnees1['id_membre_d']))
{ 
	do
	{
		$req2 = $bdd->prepare('SELECT surnom1, l, nom_l FROM inscrits WHERE id = ?');
		$req2->execute(array($donnees1['id_membre_d']));
		$donnees2 = $req2->fetch();
		$id_membre[$n] = $donnees1['id_membre_d'];	 
		if($donnees2['l'] == 1)
		{
			$surnom[$n] = $donnees2['nom_l'];
		}else
		{
			$surnom[$n] = $donnees2['surnom1'];
		}
		$n++;
	}while($donnees1 = $req1->fetch());
	$reserve = 1;
}else
{
	$reserve = "Il n'y a personne dans la réserve.";
}
$req3 = $bdd->prepare('SELECT COUNT(id_sympathie) as nbr_demandes FROM sympathie WHERE id_membre_s = ? AND valeur_s = ?');
$req3->execute(array($_SESSION['id'], 2));
$donnees3 = $req3->fetch();
if(!isset($donnees3['nbr_demandes']))
{
	$donnees3['nbr_demandes'] = 0;
}
$nbrpages = intval(($donnees3['nbr_demandes']/20)) + 1;
if($donnees3['nbr_demandes'] >= 20 )
{
	$nbr_demandes = 20;
}else
{
	$nbr_demandes = $donnees3['nbr_demandes'];
}
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Réserve de sympathie - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include('navrelations.php');?>
				</div>
				<div class="div2amais">
					<div class="div9cadre div10cadre taille">
						<h2>Réserve de sympathie</h2>
						<form method='post' action='traitement_prd.php' class='form'>
						<input type='submit' name='rejetertlr' value='Rejeter toute la réserve' class='boutonnom'/>
						</form>
					</div>
					<p style='text-align: center;'>
						<?php 
							if($reserve == 1)
							{
								for($i = 1; $i <= $nbr_demandes; $i++)
								{
									echo "<div class='div9cadre div10cadre'><form method='post' action='traitement_prd.php' class='form'>
									<input type='hidden' name='id_inscrit' value=" .$id_membre[$i]. " />
									<input type='submit' name='valider' value=\"" .$surnom[$i]. "\" class='boutonnom' />
									<input type='submit' name='accepter' value='Accepter' class='boutonnom'/>
									<input type='submit' name='supprimer' value='Supprimer' class='boutonnom'/>
									</form></div>";
								}
							}else
							{
								echo "<div class='div9cadre div10cadre'>" .$reserve. "</div>";
							}
						?>
					</p>
					<p>
						<div class='div9cadre div10cadre'>
							<form method="post" action="reserve_de_sympathie.php" class="form">
								<?php
									for($i = 1; $i <= $nbrpages; $i++)
									{
										echo "<input type='submit' name='page' value=" .$i. " class='boutonamais'/>";
									}
								?>
							</form>
						</div>
					</p>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>