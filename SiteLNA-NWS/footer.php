<footer class="footer">
	<p>
		<ul class="ulfooter">
			<li class="lifooter"><a href="aide.php" class="afooter">Aide</a></li>
			<li class="lifooter"><a href="cgu.php" class="afooter">CGU</a></li>
			<li class="lifooter"><a href="cgv.php" class="afooter">CGV</a></li>
			<li class="lifooter"><a href="confidentialite.php" class="afooter">PDC</a></li>
			<li class="lifooter"><a href="contact.php" class="afooter">Contact</a></li>
		</ul>
			<?php 
			if(isset($utc))
			{
				if($utc == 1)
				{
					
				}else
				{
					date_default_timezone_set('UTC');
				}
			}else
			{
				date_default_timezone_set('UTC');
			}
				$creation = date('Y', time());
				if($creation > 2020)
				{
					$date_de_creation = "2020-" .$creation; 
				}else
				{
					$date_de_creation = 2020;
				}
			?>
		<span class="spanfooter">Les Nouveaux Arrivants © <?php echo $date_de_creation; ?></span>
	</p>
</footer>