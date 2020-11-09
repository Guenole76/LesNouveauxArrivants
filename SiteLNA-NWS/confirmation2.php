<?php
session_start();
include('mysql.php');
$code = $_GET['code'];
if(isset($code))
{
	if(preg_match("#^[a-z0-9]+$#i", $code))
	{
		$req = $bdd->prepare('SELECT valeur_inscrit FROM inscrits WHERE code_inscrit = ?');
		$req->execute(array($code));
		$donnees = $req->fetch();
		if($donnees['valeur_inscrit'] == 2)
		{	
			$req2 = $bdd->prepare('UPDATE inscrits SET code_inscrit = ?, valeur_inscrit = ? WHERE code_inscrit = ?');
			$req2->execute(array(1, 1, $code));
		}else
		{
			$_SESSION['message1000'] = "Vous êtes déjà inscrit";
			header('Location: index.php');
		}
	}else
	{
		$_SESSION['message1001'] = "Mauvaise clef";
		header('Location: index.php');
	}
}else
{
	$_SESSION['message1001'] = "Vous n'avez pas la clef" ;
	header('Location: index.php');
}
include("choixcss.php");
if($choix == 1)
{
	$header = "headerc";
	$logo = "logoheaderc";
	$srclogo = "logowelcomealamaison.png";
	$navheader = "navheaderc";
	$ulheader = "ulheaderc";
	$liheader = "liheaderc";
	$aheader = "aheaderc";
	$section = "sectioncgu";
	$div = "pconfirmation";
	$div10 = "div9cadre";
	$div12 = "div11cadre";
}elseif($choix == 2)
{
	$header = "headerc";
	$logo = "logoheaderc";
	$srclogo = "logowelcomealamaison.png";
	$navheader = "navheaderc";
	$ulheader = "ulheaderc";
	$liheader = "liheaderc";
	$aheader = "aheaderc";
	$section = "sectioncgu";
	$div = "pconfirmation";
	$div10 = "div9cadre";
	$div12 = "div11cadre";
}elseif($choix == 3)
{
	$header = "headercf";
	$logo = "logoheadercf";
	$srclogo = "logowelcomealamaisonf.png";
	$navheader = "navheadercf";
	$ulheader = "ulheadercf";
	$liheader = "liheadercf";
	$aheader = "aheadercf";
	$section = "sectioncguf";
	$div = "pconfirmationf";
	$div10 = "div9cadref";
	$div12 = "div11cadref";
}else
{
	$header = "headerc";
	$logo = "logoheaderc";
	$srclogo = "logowelcomealamaison.png";
	$navheader = "navheaderc";
	$ulheader = "ulheaderc";
	$liheader = "liheaderc";
	$aheader = "aheaderc";
	$section = "sectioncgu";
	$div = "pconfirmation";
	$div10 = "div9cadre";
	$div12 = "div11cadre";
}
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Confirmation de la création du compte - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="<?php echo $section; ?>">
			<div class="<?php echo $div; ?>">
				<div class="<?php echo $div10. " " .$div12; ?> taille">
					Vous compte est désormais valide.
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>