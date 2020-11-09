<?php
session_start();
include('mysql.php');
if(isset($_POST['valider']))
{
	if(isset($_POST['nvcode']))
	{
		if(preg_match("#^([≈√‰‡†¿¾½¼°℗®©¡~™•§µ%=^¨@&¤\|\[\]\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*[a-zàáâäçèéêëœìíîïñòóôöùúûü0-9]*[≈√‰‡†¿¾½¼°℗®©¡~™•\|\[\]§µ%=^¨¤@&\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*){8,45}$#i", $_POST['nvcode']))
		{
			$req = $bdd->prepare('SELECT id FROM inscrits WHERE code_sympathie = ?');
			$req->execute(array($_POST['nvcode']));
			$donnees = $req->fetch();
			if($donnees['id'] > 0)
			{
				$_SESSION['message1'] = "Le code sympathie demandé est déjà utilisé";
				header('Location: modifierlecodesympathie.php');
			}else
			{
				if(preg_match("#^([≈√‰‡†¿¾½¼°℗®©¡~™•§µ%=^¨@&¤\|\[\]\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*[a-zàáâäçèéêëœìíîïñòóôöùúûü0-9]*[≈√‰‡†¿¾½¼°℗®©¡~™•\|\[\]§µ%=^¨¤@&\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*){8,45}$#i", $_POST['mdpcode']))
				{
					$req = $bdd->prepare('SELECT cmdp FROM inscrits WHERE id = ?');
					$req->execute(array($_SESSION['id']));
					$donnees = $req->fetch();
					if($donnees['cmdp'] == $_POST['mdpcode'])
					{
						$req = $bdd->prepare('UPDATE inscrits SET code_sympathie = ?  WHERE id = ?');
						$req->execute(array($_POST['nvcode'], $_SESSION['id']));
						$_SESSION['message'] = 0;
						header('Location: informationspersonnelles.php');
					}else
					{
						$_SESSION['message2'] = "Votre mot de passe est incorrecte";
						header('Location: modifierlecodesympathie.php');
					}
				}else
				{
					$_SESSION['message3'] = "Veuillez entrer votre mot de passe";
					header('Location: modifierlecodesympathie.php');
				}
			}
		}else
		{
			$_SESSION['message4'] = "Votre nouveau code sympathie contient des caractères interdits";
			header('Location: modifierlecodesympathie.php');
		}
	}else
	{
		$_SESSION['message5'] = "Veuillez entrer un nouveau code symapathie";
		header('Location: modifierlecodesympathie.php');
	}
}else
{
	$_SESSION['message6'] = "Vous n'avez pas cliqué que le bouton modifier le code";
	header('Location: modifierlecodesympathie.php');
}
?>