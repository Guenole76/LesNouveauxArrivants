<?php 
session_start();
include('expression_r.php');
if(isset($_POST['rechercher']))
{
	$_SESSION['page'] = 1;
	if(!preg_match("#^[ ]*$#", $_POST['lrelation']))
	{
		$_SESSION['relation_gr'] = $_POST['lrelation'];
	}else
	{
		$_SESSION['relation_gr'] = 0;
	}
	if(!preg_match("#^[ ]*$#", $_POST['llieu']))
	{
		$_SESSION['lieu_gr'] = $_POST['llieu'];
	}else
	{
		$_SESSION['lieu_gr'] = 0;
	}
	if(!preg_match("#^[ ]*$#", $_POST['lda']))
	{
		$_SESSION['da_gr'] = $_POST['lda'];
	}else
	{
		$_SESSION['da_gr'] = 0;
	}
	if(!preg_match("#^[ ]*$#", $_POST['lds']))
	{
		$_SESSION['ds_gr'] = $_POST['lds'];
	}else
	{
		$_SESSION['ds_gr'] = 0;
	}
	if(!preg_match("#^[ ]*$#", $_POST['surnom2']))
	{
		$_POST['surnom2'] = htmlspecialchars($_POST['surnom2'], ENT_NOQUOTES);
		if(preg_match($expression_r, $_POST['surnom2']))
		{
			$_SESSION['surnom2_gr'] = $_POST['surnom2'];
		}else
		{
			$_SESSION['surnom2_gr'] = "";
		}
	}else
	{
		$_SESSION['surnom2_gr'] = "";
	}
	if(!preg_match("#^[ ]*$#", $_POST['surnom1']))
	{
		$_POST['surnom1'] = htmlspecialchars($_POST['surnom1'], ENT_NOQUOTES);
		if(preg_match($expression_r, $_POST['surnom1']))
		{
			$_SESSION['surnom1_gr'] = $_POST['surnom1'];
		}else
		{
			$_SESSION['surnom1_gr'] = "";
		}
	}else
	{
		$_SESSION['surnom1_gr'] = "";
	}
	if(!preg_match("#^[ ]*$#", $_POST['surnom3']))
	{
		$_POST['surnom3'] = htmlspecialchars($_POST['surnom3'], ENT_NOQUOTES);
		if(preg_match($expression_r, $_POST['surnom3']))
		{
			$_SESSION['surnom3_gr'] = $_POST['surnom3'];
		}else
		{
			$_SESSION['surnom3_gr'] = "";
		}
	}else
	{
		$_SESSION['surnom3_gr'] = "";
	}
	if($_POST['gr'] == 1)
	{
		$_SESSION['gr'] = $_POST['gr'];
		header('Location: groupe_relationnel_1.php');
	}elseif($_POST['gr'] == 2)
	{
		$_SESSION['gr'] = $_POST['gr'];
		header('Location: groupe_relationnel_2.php');
	}elseif($_POST['gr'] == 3)
	{
		$_SESSION['gr'] = $_POST['gr'];
		header('Location: groupe_relationnel_pro.php');
	}elseif($_POST['gr'] == 4)
	{
		$_SESSION['gr'] = $_POST['gr'];
		header('Location: groupe_des_intrus.php');
	}
}else
{
	$_SESSION['relation_gr'] = 0;
	$_SESSION['lieu_gr'] = 0;
	$_SESSION['da_gr'] = 0;
	$_SESSION['ds_gr'] = 0;
	$_SESSION['surnom1_gr'] = "";
	$_SESSION['surnom2_gr'] = "";
	$_SESSION['surnom3_gr'] = "";
	if($_POST['gr'] == 1)
	{
		header('Location: groupe_relationnel_1.php');
	}elseif($_POST['gr'] == 2)
	{
		header('Location: groupe_relationnel_2.php');
	}elseif($_POST['gr'] == 3)
	{
		header('Location: groupe_relationnel_pro.php');
	}elseif($_POST['gr'] == 4)
	{
		header('Location: groupe_des_intrus.php');
	}
}
?>