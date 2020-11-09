<?php 
session_start();
include('mysql.php');
$aemp = 0;
function random_str($nbr) {
    $str = "";
    $chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSUTVWXYZ0123456789";
    $nb_chars = strlen($chaine);

    for($i=0; $i<$nbr; $i++)
    {
        $str .= $chaine[ rand(0, ($nb_chars-1)) ];
    }

    return $str;
}
$code = random_str(16);
if(isset($_POST['valider']))
{
	if(!preg_match("#^[ ]*$#", $_POST['naem']))
	{
		$_POST['naem'] = htmlspecialchars($_POST['naem']);
		if(!preg_match("#^[ ]*$#", $_POST['cnaem']))
		{
			$_POST['cnaem'] = htmlspecialchars($_POST['cnaem']);
			if(!preg_match("#^[ ]*$#", $_POST['mdp']))
			{
				$_POST['mdp'] = htmlspecialchars($_POST['mdp']);
				if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['naem']))
				{
					if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['cnaem']))
					{
						if(preg_match("#^[a-zA-Z0-9]{8,16}$#", $_POST['mdp']))
						{
							if($_POST['naem'] == $_POST['cnaem'])
							{
								$req = $bdd->prepare('SELECT cmdp FROM inscrits WHERE id = ?');
								$req->execute(array($_SESSION['id']));
								$donnees = $req->fetch();
								if($donnees['cmdp'] == $_POST['mdp'])
								{
									$req2 = $bdd->prepare('SELECT caem FROM inscrits WHERE id = ?');
									$req2->prepare(array($_SESSION['id']));
									$donnees2 = $req2->fetch();
									$_SESSION['caem'] = $donnees2['caem'];
									if($donnees['caem'] == $_POST['cnaem'])
									{
										$_SESSION['message'] = 52;
										header('Location: modifierladresseemail.php');
									}else
									{
										$req3 = $bdd->prepare('SELECT caem FROM inscrits WHERE caem = ?');
										$req3->prepare(array($_POST['cnaem']));
										$donnees3 = $req3->fetch();
										if(isset($donnees3['caem']))
										{
											$_SESSION['cnaem'] = $_POST['cnaem'];
											$_SESSION['message'] = 0;
											$req2 = $bdd->prepare('UPDATE inscrits SET code_inscrit = ? WHERE id = ?');
											$req2->execute(array($code, $_SESSION['id']));
											$lien = "https://www.lesnouveauxarrivants.fr/confirmation4.php?code=".$code;
											$to = $_SESSION['cnaem'];
											$subject = "E-mail pour valider votre changement d'adresse e-mail.";
											$message = "Veuillez cliquer sur le lien ci-dessous, pour valider votre changement d'adresse e-mail: ".$lien."";
											$message = wordwrap($message, 70, "\r\n");
											mail($to, $subject, $message, 'De: Les Nouveaux Arrivants');
											$reponse->closeCursor();
											header('Location: confirmation3.php');
										
										}
									}
								}else
								{
									$_SESSION['message'] = 51;
									header('Location: modifierladresseemail.php');
								}
							}else
							{
								$_SESSION['message'] = 50;
								header('Location: modifierladresseemail.php');
							}
						}else
						{
							$_SESSION['message'] = 49;
							header('Location: modifierladresseemail.php');
						}
					}else
					{
						$_SESSION['message'] = 48;
						header('Location: modifierladresseemail.php');
					}
				}else
				{
					$_SESSION['message'] = 47;
					header('Location: modifierladresseemail.php');
				}
			}else
			{
				$_SESSION['message'] = 46;
				header('Location: modifierladresseemail.php');
			}
		}else
		{
			$_SESSION['message'] = 45;
			header('Location: modifierladresseemail.php');
		}
	}else
	{
		$_SESSION['message'] = 44;
		header('Location: modifierladresseemail.php');
	}
}else
{
	$_SESSION['message'] = 43;
	header('Location: modifierladresseemail.php');
}
?>