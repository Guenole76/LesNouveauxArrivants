<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('navphoto.php');
if(isset($_POST['page']))
{
	$_SESSION['page'] = $_POST['page'];
}
if(!isset($_SESSION['page']))
{
	$_SESSION['page'] = 1; 
}
$limit = ($_SESSION['page'] - 1) * 10;
$req1 = $bdd->prepare('SELECT id_membre_2, timestamp_conversation FROM conversations WHERE id_membre_1 = ? AND situation_conversation = ?
 AND l = ? ORDER BY timestamp_conversation DESC LIMIT ' .$limit.', 10');
$req1->execute(array($_SESSION['id'], 1, 2));
$donnees1 = $req1->fetch();
$n = 1;
if(isset($donnees1['id_membre_2']))
{ 
	do
	{
		$req2 = $bdd->prepare('SELECT surnom1, surnom2 FROM inscrits WHERE id = ?');
		$req2->execute(array($donnees1['id_membre_2']));
		$donnees2 = $req2->fetch();
		$req2_2 = $bdd->prepare('SELECT surnom3, validations3, points_de_relation, groupe_relationnel FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req2_2->execute(array($_SESSION['id'], $donnees1['id_membre_2']));
		$donnees2_2 = $req2_2->fetch();
		if($donnees2_2['groupe_relationnel'] >= 2)
		{
			if(!preg_match("#^[ ]*$#", $donnees2_2['surnom3']))
			{
				if($donnees2_2['validations3'] == 1)
				{
					$id_membre[$n] = $donnees1['id_membre_2'];
					$timestamp_conversation[$n] = $donnees1['timestamp_conversation'];
					$surnom[$n] = $donnees2_2['surnom3'];
					$n++;
				}else
				{
					if($donnees2_2['point_de_relation'] >= 50)
					{
						$id_membre[$n] = $donnees1['id_membre_2'];
						$timestamp_conversation[$n] = $donnees1['timestamp_conversation'];
						$surnom[$n] = $donnees2['surnom2'];
						$n++;
					}else
					{
						$id_membre[$n] = $donnees1['id_membre_2'];
						$timestamp_conversation[$n] = $donnees1['timestamp_conversation'];
						$surnom[$n] = $donnees2['surnom1'];
						$n++;
					}
				}
			}else
			{
				if($donnees2_2['points_de_relation'] >= 50)
				{
					$id_membre[$n] = $donnees1['id_membre_2'];
					$timestamp_conversation[$n] = $donnees1['timestamp_conversation'];
					$surnom[$n] = $donnees2['surnom2'];
					$n++;
				}else
				{
					$id_membre[$n] = $donnees1['id_membre_2'];
					$timestamp_conversation[$n] = $donnees1['timestamp_conversation'];
					$surnom[$n] = $donnees2['surnom1'];
					$n++;
				}
			}
		}else
		{
			if($donnees2_2['points_de_relation'] >= 50)
			{
				$id_membre[$n] = $donnees1['id_membre_2'];
				$timestamp_conversation[$n] = $donnees1['timestamp_conversation'];
				$surnom[$n] = $donnees2['surnom2'];
				$n++;
			}else
			{
				$id_membre[$n] = $donnees1['id_membre_2'];
				$timestamp_conversation[$n] = $donnees1['timestamp_conversation'];
				$surnom[$n] = $donnees2['surnom1'];
				$n++;
			}
		}
	}while($donnees1 = $req1->fetch());
	$conversations = 1;
}else
{
	$conversations = "Il n'y a aucune conversation";
}

$req3 = $bdd->prepare('SELECT COUNT(id_conversation) as nbr_conversation FROM conversations WHERE id_membre_1 = ? AND situation_conversation = ?
 AND l = ?');
$req3->execute(array($_SESSION['id'], 1, 2));
$donnees3 = $req3->fetch();
if(!isset($donnees3['nbr_conversation']))
{
	$donnees3['nbr_conversation'] = 0;
}
$nbrpages = intval(($donnees3['nbr_conversation']/10)) + 1;
if($donnees3['nbr_conversation'] >= 10 )
{
	$nbr_conversation = 10;
}else
{
	$nbr_conversation = $donnees3['nbr_conversation'];
}
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Conversations - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionconv">
			<div class="pconv">
				<div class="div1conv">
					<?php include("navconversations.php"); ?>
				</div>
				<div class="div2conv">
					<div class="div9cadre div10cadre">
						<h2>Vos conversations amicales</h2>
						<h3><a href="conversationslieux.php" class="aconv">Voir les conversations avec des lieux</a></h3>
						<h3><a href="conversationsbloquees.php" class="aconv">Voir les conversations bloquées</a></h3>
					</div>
						<p style='text-align: center;'>
							<?php 
								if($conversations == 1)
								{
									for($i = 1; $i <= $nbr_conversation; $i++)
									{
										echo "<div class='div9cadre div10cadre'><form method='post' action='traitementconversations.php' class='form'>
										<input type='hidden' name='id_inscrit' value=" .$id_membre[$i]. " />
										<input type='submit' name='valider' value=\"" .$surnom[$i]. "\" class='boutonnom' />
										<input type='submit' name='voir' value='Voir' class='boutonnom'/>
										<input type='submit' name='bloquer' value='Bloquer' class='boutonnom'/>
										</form></div>";
									}
								}else
								{
									echo "<div class='div9cadre div10cadre'>" .$conversations. "</div>";
								}
							?>
						</p>
						<p>
							<div class='div9cadre div10cadre'>
								<form method="post" action="conversations.php" class="form">
								<?php
									for($i = 1; $i <= $nbrpages; $i++)
									{
										echo "<input type='submit' name='page' value=" .$i. " class='boutonconv'/>";
									}
								?>
								</form>
							</div>
						</p>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>