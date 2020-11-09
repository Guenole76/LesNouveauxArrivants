<?php 
session_start();
include('verificationid.php');
include('mysql.php');
include('navphoto.php');
if($_SESSION['validation'] == 1)
{
	if(isset($_SESSION['choixa']))
	{
		if($_SESSION['choixa'] == 1)
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET validation_abo = ? WHERE id_membre = ?');
			$req1->execute(array(1, $_SESSION['id']));
		}elseif($_SESSION['choixa'] == 2)
		{
			$req1 = $bdd->prepare('UPDATE inscrits SET validation_abo = ? WHERE id_membre = ?');
			$req1->execute(array(2, $_SESSION['id']));
		}else
		{
			header('Location: abonnement.php');
		}
	}else
	{
		header('Location: abonnement.php');
	}
}else
{
	header('Location: confirmationabonnement.php');
}
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Validation de l'achat - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div8abo">
					<div class="div9cadre div10cadre taille">
						<h2>Validation de l'achat</h2>
						<p>
							Un e-mail composé d'un lien va vous être envoyé à l'adresse que vous avez entrée. <br/>
							Cliquez sur celui-ci pour commencer à profiter de votre abonnement.
						</p>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>