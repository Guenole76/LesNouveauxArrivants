<?php 
session_start();
include('mysql.php');
$aemp = 0;
if(isset($_POST['valider']))
{
	if(!preg_match("#^[ ]*$#", $_POST['nmdp']))
	{
		$_POST['nmdp'] = htmlspecialchars($_POST['nmdp']);
		if(!preg_match("#^[ ]*$#", $_POST['cnmdp']))
		{
			$_POST['cnmdp'] = htmlspecialchars($_POST['cnmdp']);
			if(!preg_match("#^[ ]*$#", $_POST['mdp']))
			{
				$_POST['mdp'] = htmlspecialchars($_POST['mdp']);
				if(preg_match("#^([≈√‰‡†¿¾½¼°℗®©¡~™•§µ%=^¨@&¤\|\[\]\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*[a-zàáâäçèéêëœìíîïñòóôöùúûü0-9]*[≈√‰‡†¿¾½¼°℗®©¡~™•\|\[\]§µ%=^¨¤@&\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*){8,45}$#i", $_POST['nmdp']))
				{
					if(preg_match("#^([≈√‰‡†¿¾½¼°℗®©¡~™•§µ%=^¨@&¤\|\[\]\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*[a-zàáâäçèéêëœìíîïñòóôöùúûü0-9]*[≈√‰‡†¿¾½¼°℗®©¡~™•\|\[\]§µ%=^¨¤@&\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*){8,45}$#i", $_POST['cnmdp']))
					{
						if(preg_match("#^([≈√‰‡†¿¾½¼°℗®©¡~™•§µ%=^¨@&¤\|\[\]\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*[a-zàáâäçèéêëœìíîïñòóôöùúûü0-9]*[≈√‰‡†¿¾½¼°℗®©¡~™•\|\[\]§µ%=^¨¤@&\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*){8,45}$#i", $_POST['mdp']))
						{
							if($_POST['nmdp'] == $_POST['cnmdp'])
							{
								$req = $bdd->prepare('SELECT cmdp FROM inscrits WHERE id = ?');
								$req->execute(array($_SESSION['id']));
								$donnees = $req->fetch();
								if($donnees['cmdp'] == $_POST['mdp'])
								{
									$req = $bdd->prepare('UPDATE inscrits SET cmdp = :lacmdp  WHERE id = :lid');
									$req->execute(array(
									'lacmdp' => $_POST['cnmdp'],
									'lid' => $_SESSION['id'],
									));
									$_SESSION['message'] = 0;
									header('Location: informationspersonnelles.php');
								}else
								{
									$_SESSION['message'] = 61;
									header('Location: modifierlemotdepasse.php');
								}
							}else
							{
								$_SESSION['message'] = 60;
								header('Location: modifierlemotdepasse.php');
							}
						}else
						{
							$_SESSION['message'] = 59;
							header('Location: modifierlemotdepasse.php');
						}
					}else
					{
						$_SESSION['message'] = 58;
						header('Location: modifierlemotdepasse.php');
					}
				}else
				{
					$_SESSION['message'] = 57;
					header('Location: modifierlemotdepasse.php');
				}
			}else
			{
				$_SESSION['message'] = 56;
				header('Location: modifierlemotdepasse.php');
			}
		}else
		{
			$_SESSION['message'] = 55;
			header('Location: modifierlemotdepasse.php');
		}
	}else
	{
		$_SESSION['message'] = 54;
		header('Location: modifierlemotdepasse.php');
	}
}else
{
	$_SESSION['message'] = 53;
	header('Location: modifierlemotdepasse.php');
}
?>