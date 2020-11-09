<?php
session_start();
include('mysql.php');
function random_str($nbr) {
    $str = $_SESSION['id'];
    $chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSUTVWXYZ0123456789";
    $nb_chars = strlen($chaine);

    for($i=0; $i<$nbr; $i++)
    {
        $str .= $chaine[ rand(0, ($nb_chars-1)) ];
    }

    return $str;
}
$code = random_str(9);
if(isset($_POST['valider']))
{
	if(preg_match("#^([≈√‰‡†¿¾½¼°℗®©¡~™•§µ%=^¨@&¤\|\[\]\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*[a-zàáâäçèéêëœìíîïñòóôöùúûü0-9]+[≈√‰‡†¿¾½¼°℗®©¡~™•\|\[\]§µ%=^¨¤@&\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*){8,45}$#i", $_POST['mdp']))
	{
		$req = $bdd->prepare('SELECT cmdp FROM inscrits WHERE id = ?');
		$req->execute(array($_SESSION['id']));
		$donnees = $req->fetch();
		if($donnees['cmdp'] == $_POST['mdp'])
		{
			$req = $bdd->prepare('UPDATE inscrits SET code_inscrit = ?, valeur_inscrit = ?  WHERE id = ?');
			$req->execute(array($code, 3, $_SESSION['id']));
			$_SESSION['message'] = 0;
			header('Location: deconnection.php');
		}else
		{
			$_SESSION['message1'] = "Votre mot de passe est incorrect";
			header('Location: disparaitre.php');
		}
	}else
	{
		$_SESSION['message2'] = "Veuillez entrer votre mot de passe";
		header('Location: disparaitre.php');
	}
}else
{
	$_SESSION['message3'] = "Vous n'avez pas cliqué que le bouton valider";
	header('Location: disparaitre.php');
}
?>