<?php 
session_start();
include('mysql.php');
$aemp = 0; 
if(isset($_POST['connexion']))
{
	if(!preg_match("#^[ ]*$#", $_POST['caem']))
	{
		$_POST['caem'] = htmlspecialchars($_POST['caem']);
		if(!preg_match("#^[ ]*$#", $_POST['cmdp']))
		{
			$_POST['cmdp'] = htmlspecialchars($_POST['cmdp']);
			if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['caem']))
			{
				if(preg_match("#^([≈√‰‡†¿¾½¼°℗®©¡~™•§µ%=^¨@&¤\|\[\]\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*[a-zàáâäçèéêëœìíîïñòóôöùúûü0-9]*[≈√‰‡†¿¾½¼°℗®©¡~™•\|\[\]§µ%=^¨¤@&\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*){8,45}$#i", $_POST['cmdp']))
				{
					$reponse = $bdd->prepare('SELECT id, cmdp, code_inscrit, valeur_inscrit FROM inscrits WHERE caem = ?');
					$reponse->execute(array($_POST['caem']));
					$donnees = $reponse->fetch();
					if(isset($donnees['cmdp']))
					{
						if($donnees['cmdp'] == $_POST['cmdp'])
						{
							if($donnees['valeur_inscrit'] == 1)
							{
								$_SESSION['message'] = 0;
								$_SESSION['id'] = $donnees['id'];
								header('Location: profil.php');
							}else
							{
								$_SESSION['message1002'] = "Veuillez cliquer sur le lien envoyé à votre adresse email"; 
								$lien = "https://www.lesnouveauxarrivants.fr/confirmation2.php?code=".$donnees['code_inscrit'];
								$to = $_POST['caem'];
								$subject = "E-mail pour activer votre compte";
								$message = "Veuillez cliquer sur le lien ci-dessous, pour activer votre compte. ".$lien."";
								$message = wordwrap($message, 70, "\r\n", true);
								mail($to, $subject, $message, 'De: Les Nouveaux Arrivants');
								header('Location: index.php');
							}
						}else
						{
							$_SESSION['message'] = 30;
							header('Location: index.php');

						}
					}else
					{
						$_SESSION['message'] = 29;
						header('Location: index.php');
					}
				}else
				{
					$_SESSION['message'] = 28;
					header('Location: index.php');
				}
			}else
			{
				$_SESSION['message'] = 27;
				header('Location: index.php');
			}
		}else
		{
			$_SESSION['message'] = 26;
			header('Location: index.php');
		}
	}else
	{
		$_SESSION['message'] = 25;
		header('Location: index.php');
	}
}else
{
	$_SESSION['message'] = 24;
	header('Location: index.php');
}

?>