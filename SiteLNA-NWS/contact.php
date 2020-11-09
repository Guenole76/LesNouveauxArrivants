<?php 
session_start();
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Contact - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php 
		if(isset($_SESSION['id']))
		{
			include("headerc.php");
		}else
		{
			include("headernc.php");
		}
		?>
		<section class="sectioncgu">
			<div class="pcgu">
				<div class="div9cadre div10cadre">
					<?php 
						for($i = 152; $i <= 156; $i++)
						{
							if(isset($_SESSION['message'.$i]))
								{
								if(!preg_match("#^[ ]*$#", $_SESSION['message'.$i]))
								{
									echo $_SESSION['message'.$i].'<br/>';
								}
							}
						}
					?>
					<h2>Contact</h2>
					<form method="post" action="traitementcontact.php">
						<input type="text" name="aem" placeholder="Votre adresse e-mail" class="input"><br/>
						<input type="text" name="sujet" required minlength=1 placeholder="Sujet du message" class="input"><br/>
						<textarea name="messagec" rows=14 cols=80 placeholder="Votre message" class="textareames"></textarea><br/>
						<input type="submit" name="valider" value="Envoyer" class="boutonamais"/>
					</form>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>