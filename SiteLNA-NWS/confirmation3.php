<?php  
session_start();
include('verificationid.php');
include('mysql.php');
include('navphoto.php');
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
		<title>Confirmation de la nouvelle adresse e-mail 1 - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="<?php echo $section; ?>">
			<div class="<?php echo $div; ?>">
				<div class="<?php echo $div10. " " .$div12; ?> taille">
					<h2>Confirmation de votre nouvelle adresse e-mail</h2>
					<p>
						Veuillez cliquer sur le lien, qui se trouve dans l'e-mail, que nous venons de vous envoyer.<br/>
						Si après plusieurs minutes d'attentes, vous n'avez toujours pas reçu d'e-mail.<br/>
						Cliquez sur le bouton "Envoyer".<br/>
						Pensez à vérifier vos spams, s'il vous plaît.<br/>
					</p>
				</div>
			</div>
		</section>
		<form method="post" action="envoieemail.php">
			<input type="submit" value="Envoyer" name="valider" class="boutoninscription"/>
		</form>
		<?php include("footer.php"); ?>
	</body>
</html>