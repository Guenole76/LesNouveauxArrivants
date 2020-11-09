<?php 
session_start();
include('expression_r.php');
include('mysql.php');
$validation = 0; 
$lienvalider = 0; 
if(isset($_POST['valider']))
{
	$_SESSION['message1'] = "";
}else
{
	$_SESSION['message1'] = "Vous n'avez pas cliqué sur le bouton de modification.";
	header('Location: modifierlesinformations.php');
}
if(!preg_match("#^[ ]*$#", $_POST['surnom1']))
{
	$_SESSION['message2'] = "";
	$lienvalider++;
	$validation++; 
}
if(!preg_match("#^[ ]*$#", $_POST['surnom2']))
{
	$_SESSION['message3'] = "";
	$lienvalider++;
	$validation++; 
}
if(!preg_match("#^[ ]*$#", $_POST['surnom1']))
{
	if(!preg_match("#^[ ]*$#", $_POST['surnom2']))
	{
		if($_POST['surnom1'] == $_POST['surnom2'])
		{
			$lienvalider++;
			$_SESSION['message11'] = "Vos deux surnoms sont identiques11";
		}else
		{
			$lienvalider++;
			$validation++;
			$_SESSION['message11'] = "";
		}
	}
}
if(!preg_match("#^[ ]*$#", $_POST['jdn']))
{
	$_SESSION['message4'] = "";
	$lienvalider++;
	$validation++; 
}
if(!preg_match("#^[ ]*$#", $_POST['mdn']))
{
	$_SESSION['message5'] = "";
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['adn']))
{
	$_SESSION['message6'] = "";
	$lienvalider++;
	$validation++; 
}
if(!preg_match("#^[ ]*$#", $_POST['ddref']))
{
	$_SESSION['message7'] = "";
	$lienvalider++;
	$validation++; 
}
if(!preg_match("#^[ ]*$#", $_POST['vdres']))
{
	$lienvalider++;
	$_POST['vdres'] = htmlspecialchars($_POST['vdres'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['vdres']))
	{
		$_SESSION['message8'] = "";
		$validation++;
	}else
	{
		$_SESSION['message8'] = "Votre ville de résidence contient des caractères interdits";
	}	
}
if(isset($_POST['s']))
{
	$_SESSION['message9'] = "";
	$lienvalider++;
	$validation++; 
}
if(isset($_POST['l']))
{
	$_SESSION['message10'] = "";
	$lienvalider++;
	$validation++; 
}
if($lienvalider == $validation)
{
	if(!preg_match("#^[ ]*$#", $_POST['surnom1']))
	{
		$req1_2 = $bdd->prepare('SELECT surnom2 FROM inscrits WHERE id = ?');
		$req1_2->execute(array($_SESSION['id']));
		$donnees1_2 = $req1_2->fetch();
		if($_POST['surnom1'] == $donnees1_2['surnom2'])
		{
			$_SESSION['message12'] = "Vos deux surnoms sont identiques";	
		}else
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET surnom1 = ? WHERE id = ?');
			$req1->execute(array($_POST['surnom1'], $_SESSION['id']));
		}
	}
	if(!preg_match("#^[ ]*$#", $_POST['surnom2']))
	{
		$req2_2 = $bdd->prepare('SELECT surnom1 FROM inscrits WHERE id = ?');
		$req2_2->execute(array($_SESSION['id']));
		$donnees2_2 = $req2_2->fetch();
		if($_POST['surnom2'] == $donnees2_2['surnom1'])
		{
			$_SESSION['message13'] = "Vos deux surnoms sont identiques";	
		}else
		{
			$req2 = $bdd->prepare('UPDATE inscrits SET surnom2 = ? WHERE id = ?');
			$req2->execute(array($_POST['surnom2'], $_SESSION['id']));
		}
	}
	if(!preg_match("#^[ ]*$#", $_POST['jdn']))
	{
		$req3 = $bdd->prepare('UPDATE inscrits SET jdn = ? WHERE id = ?');
		$req3->execute(array($_POST['jdn'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['mdn']))
	{
		$req4 = $bdd->prepare('UPDATE inscrits SET mdn = ? WHERE id = ?');
		$req4->execute(array($_POST['mdn'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['adn']))
	{
		$req5 = $bdd->prepare('UPDATE inscrits SET adn = ? WHERE id = ?');
		$req5->execute(array($_POST['adn'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['ddref']))
	{
		$req6 = $bdd->prepare('UPDATE inscrits SET ddref = ? WHERE id = ?');
		$req6->execute(array($_POST['ddref'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['vdres']))
	{
		$req7 = $bdd->prepare('UPDATE inscrits SET vdres = ? WHERE id = ?');
		$req7->execute(array($_POST['vdres'], $_SESSION['id']));
	}
	if(isset($_POST['s']))
	{
		$req8 = $bdd->prepare('UPDATE inscrits SET s = ? WHERE id = ?');
		$req8->execute(array($_POST['s'], $_SESSION['id']));
	}
	if(isset($_POST['l']))
	{
		$req9_2 = $bdd->prepare('SELECT abonnement_en_cours FROM inscrits WHERE id = ?');
		$req9_2->execute(array($_SESSION['id']));
		$donnees9_2 = $req9_2->fetch();
		$longabo = strlen($donnees9_2['abonnement_en_cours']);
		if($longabo == 7)
		{
			$req9 = $bdd->prepare('UPDATE inscrits SET l = ? WHERE id = ?');
			$req9->execute(array($_POST['l'], $_SESSION['id']));
			$req10 = $bdd->prepare('UPDATE conversations SET l = ? WHERE id_membre_2 = ?');
			$req10->execute(array($_POST['l'], $_SESSION['id']));
			$req11 = $bdd->prepare('UPDATE sortie SET lieu = ? WHERE id_membre_createur = ?');
			$req11->execute(array($_POST['l'], $_SESSION['id']));
			if($_POST['l'] == 1)
			{
				$req9_3 = $bdd->prepare('SELECT id_rencontre FROM rencontre WHERE id_l = ?');
				$req9_3->execute(array($_SESSION['id']));
				$donnees9_3 = $req9_3->fetch();
				if(isset($donnees9_3['id_rencontre']))
				{
					$req12 = $bdd->prepare('UPDATE rencontre SET validite_r1 = ? AND validite_r2 = ? AND validite_r3 = ? AND validite_r4 = ? AND
					validite_r5 = ? AND validite_r6 = ? AND validite_r7 = ? AND validite_r8 = ? AND validite_r9 = ? AND validite_r10 = ? AND
					validite_r11 = ? AND validite_r12 = ? AND validite_r13 = ? AND validite_r14 = ? WHERE id_l = ?');
					$req12->execute(array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, $_SESSION['id']));
				}else
				{
					$req = $bdd->prepare('INSERT INTO rencontre (id_l, valeur_l)
					 VALUES(?, ?)');
					$req->execute(array($_SESSION['id'], $_POST['l']));
				}
			}
		}else
		{
			if($_POST['l'] == 1)
			{
				$_SESSION['message14'] = "La possibilité de devenir un lieu n'est effective qu'en abonnement Partage <br/><a href='abonnement.php' class='amodlesinfos2'>Abonnement</a>";	
			}else
			{
				$req9 = $bdd->prepare('UPDATE inscrits SET l = ? WHERE id = ?');
				$req9->execute(array($_POST['l'], $_SESSION['id']));
				$req10 = $bdd->prepare('UPDATE conversations SET l = ? WHERE id_membre_2 = ?');
				$req10->execute(array($_POST['l'], $_SESSION['id']));
				$req11 = $bdd->prepare('UPDATE sortie SET lieu = ? WHERE id_membre_createur = ?');
				$req11->execute(array($_POST['l'], $_SESSION['id']));
			}
				
		}
		
	}
	header('Location: modifierlesinformations.php');
}else
{
	header('Location: modifierlesinformations.php');
}
?>