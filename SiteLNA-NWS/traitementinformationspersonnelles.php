<?php 
session_start();
if(isset($_POST['mphoto']))
{
	header('Location: modifierlaphoto.php');
}elseif(isset($_POST['minfos']))
{
	header('Location: modifierlesinformations.php');
}elseif(isset($_POST['minfos_l']))
{
	header('Location: modifierlesinfosdelieu.php');
}elseif(isset($_POST['mcs']))
{
	header('Location: modifierlecodesympathie.php');
}elseif(isset($_POST['maem']))
{
	header('Location: modifierladresseemail.php');
}elseif(isset($_POST['mgdm']))
{
	header('Location: modifierlagestiondesemails.php');
}elseif(isset($_POST['mmdp']))
{
	header('Location: modifierlemotdepasse.php');
}elseif(isset($_POST['d']))
{
	header('Location: disparaitre.php');
}else
{
	header('Location: informationspersonnelles.php');
}
?>