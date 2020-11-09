<?php 
session_start();
include('verificationid.php');
include('mysql.php');
if(!isset($_SESSION['message']))
{
	$_SESSION['message'] = 0; 
}
if($_SESSION['message'] == 0)
{
	$_SESSION['envoye'] = "";
}elseif($_SESSION['message'] == 105)
{
	$_SESSION['envoye'] = "Vous n'avez pas cliqué sur le bouton de confirmation.";
}
if($_SESSION['message'] >= 101 AND $_SESSION['message'] <= 104 )
{
	echo $_SESSION['envoye'];
}
if($_SESSION['choixa'] == 1)
{
	$abo = "<iframe src='https://www.payfacile.com/benkoma/si/abonnement-partage-durant-7-jours' width='100%' height='680' frameborder='no'></iframe>";
}elseif($_SESSION['choixa'] == 2)
{
	$abo = "<iframe src='https://www.payfacile.com/benkoma/si/abonnement-partage-1-mois' width='100%' height='680' frameborder='no'></iframe>";
}else
{
	header('Location: abonnement.php');
}
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Confirmation abonnement - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div8abo">
					<div class="div9cadre div10cadre">
						<h2>Dernier pas !</h2>
					</div>
					<div class="div9cadre div10cadre">
						<p>
							<?php echo $abo; ?>
						</p>
						<a href="abonnement.php" class="ainscription taille">Annuler la transaction</a>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>