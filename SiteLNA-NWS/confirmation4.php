<?php 
session_start();
include('verificationid.php');
include("mysql.php");
include('navphoto.php');
$code = $_GET['code'];
if(isset($code))
{
	$req = $bdd->prepare('SELECT code_inscrit FROM inscrits WHERE id = ?');
	$req->execute(array($_SESSION['id']));
	$donnees = $req->fetch();
	if($code == $donnees['code_inscrit'])
	{	
		if(isset($_SESSION['cnaem']))
		{
			$reponse = $bdd->prepare('SELECT caem FROM inscrits WHERE caem = ?');
			$reponse->execute(array($_SESSION['cnaem']))
			$donnees2 = $reponse->fetch();
			if(isset($donnees2['caem']))
			{
				$message = "Cette adresse e-mail est déjà utilisée.";
			}else
			{
				$req = $bdd->prepare('UPDATE inscrits SET caem = ?, code_inscrit = ? WHERE id = ?');
				$req->execute(array($_SESSION['cnaem'], 1, $_SESSION['id']));
				$message = "Votre adresse e-mail est désormais modifié.";
			}
		}else
		{
			$message = "Nouvelle adresse inexistante"; 
		}
	}else
	{
		$message = "Mauvais code";
	}
}else
{
	$message = "Code inexistant";
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
		<title>Confirmation de la nouvelle adresse e-mail 2 - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="<?php echo $section; ?>">
			<div class="<?php echo $div; ?>">
				<div class="<?php echo $div10. " " .$div12; ?> taille">
					<h2>Confirmation de votre nouvelle adresse e-mail</h2>
					<p>
						<?php echo $message; ?>
					</p>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>