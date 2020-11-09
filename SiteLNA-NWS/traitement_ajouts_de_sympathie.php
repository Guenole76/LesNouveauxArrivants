<?php
session_start();
include('expression_r.php');
include('mysql.php');  
if(isset($_POST['ajouterparcode']))
{
	if(!preg_match("#^[ ]*$#", $_POST['code_s']))
	{
		$_POST['code_s'] = htmlspecialchars($_POST['code_s'], ENT_NOQUOTES);
		if(preg_match($expression_r, $_POST['code_s']))
		{
			$req_s = $bdd->prepare('SELECT id FROM inscrits WHERE code_sympathie = ?');
			$req_s->execute(array($_POST['code_s']));
			$donnees_s = $req_s->fetch();
			if(isset($donnees_s['id']))
			{
				if($_SESSION['id'] !== $donnees_s['id'])
				{
					$req_rel = $bdd->prepare('SELECT id_relation FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
					$req_rel->execute(array($_SESSION['id'], $donnees_s['id']));
					$donnees_rel = $req_rel->fetch();
					if(isset($donnees_rel['id_relation']))
					{
						$_SESSION['message1'] = "Vous avez déjà une relation avec cette personne.";
						header('Location: ajouts_de_sympathie.php');
					}else
					{
						$req_verif = $bdd->prepare('SELECT id_sympathie FROM sympathie WHERE id_membre_s = ?, id_membre_d = ?');
						$req_verif->execute(array($donnees_s['id'], $_SESSION['id']));
						$donnees_verif = $req_verif->fetch();
						if(isset($donnees_verif['id_sympathie']))
						{	
							$_SESSION['message1'] = "Vous avez déjà une demande en cours.";
							header('Location: ajouts_de_sympathie.php');
						}else
						{
							$req_ajt_code = $bdd->prepare('INSERT INTO sympathie (id_membre_s, id_membre_d, valeur_s) 
							VALUES(?, ?, ?)');
							$req_ajt_code->execute(array($donnees_s['id'], $_SESSION['id'], 1));
							$_SESSION['message1'] = "La demande sympathique est faite !";
							header('Location: ajouts_de_sympathie.php');
						}
					}
				}else
				{
					$_SESSION['message1'] = "Seuls les autres utilisateurs peuvent être ajoutés.";
					header('Location: ajouts_de_sympathie.php');
				}
			}else
			{
				$_SESSION['message1'] = "Ce code ne correspond à aucun utilisateur.";
				header('Location: ajouts_de_sympathie.php');
			}
		}else
		{
			$_SESSION['message1'] = "Votre code sympathique contient des caractères interdits.";
			header('Location: ajouts_de_sympathie.php');
		}	
	}else
	{
		$_SESSION['message1'] = "Veuillez entrer un code sympathique.";
		header('Location: ajouts_de_sympathie.php');
	}
}else
{
	$_SESSION['message1'] = "Vous n'avez pas cliqué sur le bouton d'ajout.";
	header('Location: ajouts_de_sympathie.php');
}
?>