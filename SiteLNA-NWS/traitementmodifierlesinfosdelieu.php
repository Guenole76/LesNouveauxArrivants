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
if(!preg_match("#^[ ]*$#", $_POST['nom_l']))
{
	$lienvalider++;
	$_POST['nom_l'] = htmlspecialchars($_POST['nom_l'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_l']))
	{
		$_SESSION['message2'] = "";
		$validation++;
	}else
	{
		$_SESSION['message2'] = "Votre nom de lieu ne peut être composé des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['condition_r']))
{
	$lienvalider++;
	$_POST['condition_r'] = htmlspecialchars($_POST['condition_r'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['condition_r']))
	{
		$_SESSION['message3'] = "";
		$validation++;
	}else
	{
		$_SESSION['message3'] = "Vos conditions contiennent des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['nom_r1']))
{
	$lienvalider++;
	$_POST['nom_r1'] = htmlspecialchars($_POST['nom_r1'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r1']))
	{
		$_SESSION['message4'] = "";
		$validation++;
	}else
	{
		$_SESSION['message4'] = "Le nom de la rencontre 1 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r1']))
{
	$lienvalider++;
	$_POST['lieu_r1'] = htmlspecialchars($_POST['lieu_r1'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r1']))
	{
		$_SESSION['message5'] = "";
		$validation++;
	}else
	{
		$_SESSION['message5'] = "Le lieu de la rencontre 1 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r1']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r1']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r1']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r1']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r1']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nom_r2']))
{
	$lienvalider++;
	$_POST['nom_r2'] = htmlspecialchars($_POST['nom_r2'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r2']))
	{
		$_SESSION['message6'] = "";
		$validation++;
	}else
	{
		$_SESSION['message6'] = "Le nom de la rencontre 2 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r2']))
{
	$lienvalider++;
	$_POST['lieu_r2'] = htmlspecialchars($_POST['lieu_r2'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r2']))
	{
		$_SESSION['message7'] = "";
		$validation++;
	}else
	{
		$_SESSION['message7'] = "Le lieu de la rencontre 2 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r2']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r2']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r2']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r2']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r2']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nom_r3']))
{
	$lienvalider++;
	$_POST['nom_r3'] = htmlspecialchars($_POST['nom_r3'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r3']))
	{
		$_SESSION['message8'] = "";
		$validation++;
	}else
	{
		$_SESSION['message8'] = "Le nom de la rencontre 3 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r3']))
{
	$lienvalider++;
	$_POST['lieu_r3'] = htmlspecialchars($_POST['lieu_r3'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r3']))
	{
		$_SESSION['message9'] = "";
		$validation++;
	}else
	{
		$_SESSION['message9'] = "Le lieu de la rencontre 3 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r3']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r3']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r3']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r3']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r3']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nom_r4']))
{
	$lienvalider++;
	$_POST['nom_r4'] = htmlspecialchars($_POST['nom_r4'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r4']))
	{
		$_SESSION['message10'] = "";
		$validation++;
	}else
	{
		$_SESSION['message10'] = "Le nom de la rencontre 4 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r4']))
{
	$lienvalider++;
	$_POST['lieu_r4'] = htmlspecialchars($_POST['lieu_r4'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r4']))
	{
		$_SESSION['message11'] = "";
		$validation++;
	}else
	{
		$_SESSION['message11'] = "Le lieu de la rencontre 4 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r4']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r4']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r4']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r4']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r4']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nom_r5']))
{
	$lienvalider++;
	$_POST['nom_r5'] = htmlspecialchars($_POST['nom_r5'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r5']))
	{
		$_SESSION['message12'] = "";
		$validation++;
	}else
	{
		$_SESSION['message12'] = "Le nom de la rencontre 5 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r5']))
{
	$lienvalider++;
	$_POST['lieu_r5'] = htmlspecialchars($_POST['lieu_r5'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r5']))
	{
		$_SESSION['message13'] = "";
		$validation++;
	}else
	{
		$_SESSION['message13'] = "Le lieu de la rencontre 5 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r5']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r5']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r5']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r5']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r5']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nom_r6']))
{
	$lienvalider++;
	$_POST['nom_r6'] = htmlspecialchars($_POST['nom_r6'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r6']))
	{
		$_SESSION['message14'] = "";
		$validation++;
	}else
	{
		$_SESSION['message14'] = "Le nom de la rencontre 6 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r6']))
{
	$lienvalider++;
	$_POST['lieu_r6'] = htmlspecialchars($_POST['lieu_r6'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r6']))
	{
		$_SESSION['message15'] = "";
		$validation++;
	}else
	{
		$_SESSION['message15'] = "Le lieu de la rencontre 6 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r6']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r6']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r6']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r6']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r6']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nom_r7']))
{
	$lienvalider++;
	$_POST['nom_r7'] = htmlspecialchars($_POST['nom_r7'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r7']))
	{
		$_SESSION['message16'] = "";
		$validation++;
	}else
	{
		$_SESSION['message16'] = "Le nom de la rencontre 7 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r7']))
{
	$lienvalider++;
	$_POST['lieu_r7'] = htmlspecialchars($_POST['lieu_r7'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r7']))
	{
		$_SESSION['message17'] = "";
		$validation++;
	}else
	{
		$_SESSION['message17'] = "Le lieu de la rencontre 7 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r7']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r7']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r7']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r7']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r7']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nom_r8']))
{
	$lienvalider++;
	$_POST['nom_r8'] = htmlspecialchars($_POST['nom_r8'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r8']))
	{
		$_SESSION['message18'] = "";
		$validation++;
	}else
	{
		$_SESSION['message18'] = "Le nom de la rencontre 8 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r8']))
{
	$lienvalider++;
	$_POST['lieu_r8'] = htmlspecialchars($_POST['lieu_r8'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r8']))
	{
		$_SESSION['message19'] = "";
		$validation++;
	}else
	{
		$_SESSION['message19'] = "Le lieu de la rencontre 8 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r8']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r8']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r8']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r8']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r8']))
{
	$lienvalider++;
	$validation++;
}if(!preg_match("#^[ ]*$#", $_POST['nom_r9']))
{
	$lienvalider++;
	$_POST['nom_r9'] = htmlspecialchars($_POST['nom_r9'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r9']))
	{
		$_SESSION['message20'] = "";
		$validation++;
	}else
	{
		$_SESSION['message20'] = "Le nom de la rencontre 9 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r9']))
{
	$lienvalider++;
	$_POST['lieu_r9'] = htmlspecialchars($_POST['lieu_r9'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r9']))
	{
		$_SESSION['message21'] = "";
		$validation++;
	}else
	{
		$_SESSION['message21'] = "Le lieu de la rencontre 9 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r9']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r9']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r9']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r9']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r9']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nom_r10']))
{
	$lienvalider++;
	$_POST['nom_r10'] = htmlspecialchars($_POST['nom_r10'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r10']))
	{
		$_SESSION['message22'] = "";
		$validation++;
	}else
	{
		$_SESSION['message22'] = "Le nom de la rencontre 10 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r10']))
{
	$lienvalider++;
	$_POST['lieu_r10'] = htmlspecialchars($_POST['lieu_r10'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r10']))
	{
		$_SESSION['message23'] = "";
		$validation++;
	}else
	{
		$_SESSION['message23'] = "Le lieu de la rencontre 10 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r10']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r10']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r10']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r10']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r10']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nom_r11']))
{
	$lienvalider++;
	$_POST['nom_r11'] = htmlspecialchars($_POST['nom_r11'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r11']))
	{
		$_SESSION['message24'] = "";
		$validation++;
	}else
	{
		$_SESSION['message24'] = "Le nom de la rencontre 11 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r11']))
{
	$lienvalider++;
	$_POST['lieu_r11'] = htmlspecialchars($_POST['lieu_r11'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r11']))
	{
		$_SESSION['message25'] = "";
		$validation++;
	}else
	{
		$_SESSION['message25'] = "Le lieu de la rencontre 11 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r11']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r11']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r11']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r11']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r11']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nom_r12']))
{
	$lienvalider++;
	$_POST['nom_r12'] = htmlspecialchars($_POST['nom_r12'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r12']))
	{
		$_SESSION['message26'] = "";
		$validation++;
	}else
	{
		$_SESSION['message26'] = "Le nom de la rencontre 12 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r12']))
{
	$lienvalider++;
	$_POST['lieu_r12'] = htmlspecialchars($_POST['lieu_r12'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r12']))
	{
		$_SESSION['message27'] = "";
		$validation++;
	}else
	{
		$_SESSION['message27'] = "Le lieu de la rencontre 12 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r12']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r12']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r12']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r12']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r12']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nom_r13']))
{
	$lienvalider++;
	$_POST['nom_r13'] = htmlspecialchars($_POST['nom_r13'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r13']))
	{
		$_SESSION['message28'] = "";
		$validation++;
	}else
	{
		$_SESSION['message28'] = "Le nom de la rencontre 13 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r13']))
{
	$lienvalider++;
	$_POST['lieu_r13'] = htmlspecialchars($_POST['lieu_r13'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r13']))
	{
		$_SESSION['message29'] = "";
		$validation++;
	}else
	{
		$_SESSION['message29'] = "Le lieu de la rencontre 13 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r13']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r13']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r13']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r13']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r13']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['nom_r14']))
{
	$lienvalider++;
	$_POST['nom_r14'] = htmlspecialchars($_POST['nom_r14'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['nom_r14']))
	{
		$_SESSION['message30'] = "";
		$validation++;
	}else
	{
		$_SESSION['message30'] = "Le nom de la rencontre 14 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['lieu_r14']))
{
	$lienvalider++;
	$_POST['lieu_r14'] = htmlspecialchars($_POST['lieu_r14'], ENT_NOQUOTES);
	if(preg_match($expression_r, $_POST['lieu_r14']))
	{
		$_SESSION['message31'] = "";
		$validation++;
	}else
	{
		$_SESSION['message31'] = "Le lieu de la rencontre 14 contient des caractères interdits";
	}	
}
if(!preg_match("#^[ ]*$#", $_POST['jour_r14']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['heure_r14']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['minute_r14']))
{
	$lienvalider++;
	$validation++;
}
if(!preg_match("#^[ ]*$#", $_POST['duree_r14']))
{
	$lienvalider++;
	$validation++;
}
if(isset($_POST['validite_r14']))
{
	$lienvalider++;
	$validation++;
}
if($lienvalider == $validation)
{
	if(!preg_match("#^[ ]*$#", $_POST['nom_l']))
	{
		$req1 = $bdd->prepare('UPDATE inscrits SET nom_l = ? WHERE id = ?');
		$req1->execute(array($_POST['nom_l'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['condition_r']))
	{
		$req2 = $bdd->prepare('UPDATE rencontre SET condition_r = ? WHERE id_l = ?');
		$req2->execute(array($_POST['condition_r'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r1']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r1 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r1'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r1']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r1 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r1'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r1']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r1 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r1'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r1']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r1 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r1'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r1']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r1 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r1'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r1']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r1 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r1'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r1']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r1 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r1'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r2']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r2 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r2'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r2']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r2 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r2'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r2']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r2 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r2'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r2']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r2 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r2'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r2']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r2 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r2'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r2']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r2 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r2'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r2']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r2 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r2'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r3']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r3 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r3'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r3']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r3 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r3'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r3']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r3 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r3'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r3']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r3 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r3'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r3']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r3 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r3'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r3']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r3 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r3'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r3']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r3 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r3'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r4']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r4 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r4'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r4']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r4 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r4'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r4']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r4 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r4'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r4']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r4 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r4'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r4']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r4 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r4'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r4']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r4 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r4'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r4']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r4 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r4'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r5']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r5 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r5'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r5']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r5 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r5'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r5']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r5 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r5'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r5']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r5 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r5'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r5']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r5 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r5'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r5']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r5 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r5'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r5']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r5 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r5'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r6']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r6 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r6'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r6']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r6 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r6'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r6']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r6 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r6'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r6']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r6 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r6'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r6']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r6 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r6'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r6']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r6 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r6'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r6']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r6 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r6'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r7']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r7 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r7'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r7']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r7 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r7'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r7']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r7 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r7'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r7']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r7 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r7'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r7']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r7 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r7'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r7']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r7 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r7'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r7']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r7 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r7'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r8']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r8 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r8'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r8']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r8 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r8'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r8']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r8 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r8'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r8']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r8 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r8'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r8']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r8 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r8'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r8']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r8 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r8'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r8']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r8 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r8'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r9']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r9 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r9'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r9']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r9 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r9'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r9']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r9 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r9'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r9']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r9 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r9'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r9']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r9 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r9'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r9']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r9 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r9'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r9']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r9 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r9'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r10']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r10 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r10'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r10']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r10 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r10'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r10']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r10 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r10'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r10']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r10 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r10'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r10']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r10 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r10'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r10']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r10 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r10'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r10']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r10 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r10'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r11']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r11 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r11'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r11']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r11 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r11'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r11']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r11 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r11'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r11']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r11 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r11'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r11']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r11 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r11'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r11']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r11 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r11'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r11']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r11 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r11'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r12']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r12 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r12'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r12']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r12 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r12'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r12']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r12 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r12'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r12']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r12 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r12'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r12']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r12 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r12'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r12']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r12 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r12'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r12']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r12 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r12'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r13']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r13 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r13'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r13']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r13 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r13'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r13']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r13 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r13'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r13']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r13 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r13'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r13']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r13 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r13'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r13']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r13 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r13'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r13']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r13 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r13'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['nom_r14']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET nom_r14 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['nom_r14'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['lieu_r14']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET lieu_r14 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['lieu_r14'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['jour_r14']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET jour_r14 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['jour_r14'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['heure_r14']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET heure_r14 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['heure_r14'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['minute_r14']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET minute_r14 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['minute_r14'], $_SESSION['id']));
	}
	if(!preg_match("#^[ ]*$#", $_POST['duree_r14']))
	{
		$req3 = $bdd->prepare('UPDATE rencontre SET duree_r14 = ? WHERE id_l = ?');
		$req3->execute(array($_POST['duree_r14'], $_SESSION['id']));
	}
	if(isset($_POST['validite_r14']))
	{
		$req4 = $bdd->prepare('UPDATE rencontre SET validite_r14 = ? WHERE id_l = ?');
		$req4->execute(array($_POST['validite_r14'], $_SESSION['id']));
	}
	header('Location: modifierlesinfosdelieu.php');
}else
{
	header('Location: modifierlesinfosdelieu.php');
}
?>