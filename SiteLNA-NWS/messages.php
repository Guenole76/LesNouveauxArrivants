<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('navphoto.php');
include('lienauto.php');
$req1 = $bdd->prepare('SELECT surnom1, surnom2, l, nom_l FROM inscrits WHERE id = ?');
$req1->execute(array($_SESSION['id_inscrit']));
$donnees1 = $req1->fetch();
$_SESSION['l_inscrit'] = $donnees1['l']; 
$req1_2 = $bdd->prepare('SELECT surnom3, validations3, points_de_relation, groupe_relationnel FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
$req1_2->execute(array($_SESSION['id_inscrit'], $_SESSION['id']));
$donnees1_2 = $req1_2->fetch();
$req2 = $bdd->prepare('SELECT surnom1, surnom2, l, nom_l FROM inscrits WHERE id = ?');
$req2->execute(array($_SESSION['id']));
$donnees2 = $req2->fetch();
$_SESSION['l_utilisateur'] = $donnees2['l']; 
$req2_2 = $bdd->prepare('SELECT surnom3, validations3, points_de_relation, groupe_relationnel FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
$req2_2->execute(array($_SESSION['id'], $_SESSION['id_inscrit']));
$donnees2_2 = $req2_2->fetch();
if($donnees1_2['groupe_relationnel'] >= 2)
{
	if(!preg_match("#^[ ]*$#", $donnees1_2['surnom3']))
	{
		if($donnees1_2['validations3'] == 1)
		{
			$identite_utilisateur = $donnees1_2['surnom3'];
		}else
		{
			if($donnees2['l'] == 1)
			{
				$identite_utilisateur = $donnees2['nom_l'];
			}else
			{
				if($donnees1_2['points_de_relation'] >= 50)
				{
					$identite_utilisateur = $donnees2['surnom2'];
				}else
				{
					$identite_utilisateur = $donnees2['surnom1'];
				}
			}
		}
	}else
	{
		if($donnees2['l'] == 1)
		{
			$identite_utilisateur = $donnees2['nom_l'];
		}else
		{
			if($donnees1_2['points_de_relation'] >= 50)
			{
				$identite_utilisateur = $donnees2['surnom2'];
			}else
			{
				$identite_utilisateur = $donnees2['surnom1'];
			}
		}
	}
}else
{
	if($donnees2['l'] == 1)
	{
		$identite_utilisateur = $donnees2['nom_l'];
	}else
	{
		if($donnees1_2['points_de_relation'] >= 50)
		{
			$identite_utilisateur = $donnees2['surnom2'];
		}else
		{
			$identite_utilisateur = $donnees2['surnom1'];
		}
	}
}
if($donnees2_2['groupe_relationnel'] >= 2)
{
	if(!preg_match("#^[ ]*$#", $donnees2_2['surnom3']))
	{
		if($donnees2_2['validations3'] == 1)
		{
			$identite_inscrit = $donnees2_2['surnom3'];
		}else
		{
			if($donnees1['l'] == 1)
			{
				$identite_inscrit = $donnees1['nom_l'];
			}else
			{
				if($donnees2_2['points_de_relation'] >= 50)
				{
					$identite_inscrit = $donnees1['surnom2'];
				}else
				{
					$identite_inscrit = $donnees1['surnom1'];
				}
			}
		}
	}else
	{
		if($donnees1['l'] == 1)
		{
			$identite_inscrit = $donnees1['nom_l'];
		}else
		{
			if($donnees2_2['points_de_relation'] >= 50)
			{
				$identite_inscrit = $donnees1['surnom2'];
			}else
			{
				$identite_inscrit = $donnees1['surnom1'];
			}
		}
	}
}else
{
	if($donnees1['l'] == 1)
	{
		$identite_inscrit = $donnees1['nom_l'];
	}else
	{
		if($donnees2_2['points_de_relation'] >= 50)
		{
			$identite_inscrit = $donnees1['surnom2'];
		}else
		{
			$identite_inscrit = $donnees1['surnom1'];
		}
	}
}
$n = 1;
if(isset($_SESSION['id_conversation']))
{
	$req3 = $bdd->prepare('SELECT id_membre_message, message, timestamp_message FROM messages WHERE id_conversation = ? ORDER BY timestamp_message DESC LIMIT 0, 20');
	$req3->execute(array($_SESSION['id_conversation']));
	$donnees3 = $req3->fetch();
	if(isset($donnees3['timestamp_message']))
	{
		do
		{
			if($donnees3['id_membre_message'] == $_SESSION['id'])
			{
				$identite[$n] = $identite_utilisateur;
				$message[$n] = $donnees3['message'];
				$date_message[$n] = date('d/m/Y', $donnees3['timestamp_message']);
				$n++;
			}else
			{
				$identite[$n] = $identite_inscrit;
				$message[$n] = $donnees3['message'];
				$date_message[$n] = date('d/m/Y', $donnees3['timestamp_message']);
				$n++;
			}
		}while($donnees3 = $req3->fetch());
	}else
	{
		$reponse = "Il n'y a pas de message";
	}
}else
{
	$reponse = "Il n'y a pas de message";
}
$m = $n - 1;
$timestamp_1mois = time() - (60 * 60 * 24 * 30); 
$req4 = $bdd->prepare('DELETE FROM messages WHERE timestamp_message < ?');
$req4->execute(array($timestamp_1mois));
$req5 = $bdd->prepare('UPDATE conversations SET vu = ? WHERE id_membre_1 = ? AND id_membre_2 = ?');
$req5->execute(array(1, $_SESSION['id'], $_SESSION['id_inscrit']));
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Messages - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionmes">
			<div class="pmes">
				<div class="div1mes">
					<?php include("navconversations.php"); ?>
				</div>
				<div class="div2mes">
					<div class="div9cadre div10cadre">
						<?php
							for($i = 150; $i <= 152; $i++)
							{
								if(isset($_SESSION['message'.$i]))
									{
									if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
									{
										echo $_SESSION['message'.$i].'<br/>';
									}
								}
							}
							for($i = 150; $i <= 152; $i++)
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
						<h3 class="taille">Conversation avec <?php echo $identite_inscrit; ?></h3>
					</div>
					<div class='div9cadre div10cadre'>
						<p>
							<?php 
								if(isset($reponse))
								{
									echo $reponse;
								}else
								{
									for($i = $m; $i !== 0; $i--)
									{
										$message[$i] = wordwrap($message[$i], 42, "\r\n", true);
										$message[$i] = lienauto($message[$i]);
										echo $identite[$i]. " le " .$date_message[$i]. "<br/> " .$message[$i]. "<br/>";
									}
								}
							?>
						</p>
					</div>
					<div class='div9cadre div10cadre'>
						<form method="post" action="traitementmessages.php">
							<textarea name="message" rows=7 cols=40 placeholder="Entrer un message" class="textareames"></textarea><br/>
							<input type="submit" name="valider" value="Envoyer" class="boutonmes"/>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>