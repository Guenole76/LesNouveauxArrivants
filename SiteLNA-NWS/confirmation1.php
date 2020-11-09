<?php 
session_start();
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
		<title>Confirmation e-mail - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headernc.php"); ?>
		<section class="<?php echo $section; ?>">
			<div class="<?php echo $div; ?>">
				<div class="<?php echo $div10. " " .$div12; ?> taille">
					Vous allez recevoir un e-mail de confirmation, veuillez donc vérifier vos e-mails.<br/>
					Si après plusieurs minutes d'attentes, vous n'avez toujours pas reçu d'e-mail.<br/>
					Cliquez sur le bouton "Envoyez".<br/>
					Pensez à vérifier vos spams, s'il vous plaît.<br/>
					<form method="post" action="envoieemail.php" class="form">
					<input type="submit" value="Envoyer" name="valider" class="boutoninscription" style="margin-top: 10px;"/>
					</form>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>