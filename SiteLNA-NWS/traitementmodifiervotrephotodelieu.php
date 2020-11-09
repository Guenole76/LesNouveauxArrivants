<?php 
session_start();
include('mysql.php');
//$fichier = basename($_FILES['avatar']['name']); //récupère nom du fichier
$taille_maxi = 3000000; //3Mo
$taille = filesize($_FILES['avatar']['tmp_name']); // récupère taille du fichier
$extensions = array('.png', '.PNG', '.gif', '.GIF', '.jpg', '.JPG', '.jpeg', '.JPEG');
$extension = strrchr($_FILES['avatar']['name'], '.');
function NomDeLaPhoto()
{
	for($i = 1; $i <= 10; $i++)
	{
		$lettresetchiffres[$i] = $i - 1 ;
	}
	$lettresetchiffres[11] = "a"; $lettresetchiffres[12] = "b"; $lettresetchiffres[13] = "c"; $lettresetchiffres[14] = "d"; $lettresetchiffres[15] = "e"; $lettresetchiffres[16] = "f"; $lettresetchiffres[17] = "g";
	$lettresetchiffres[18] = "h"; $lettresetchiffres[19] = "i"; $lettresetchiffres[20] = "j"; $lettresetchiffres[21] = "k"; $lettresetchiffres[22] = "l"; $lettresetchiffres[23] = "m"; $lettresetchiffres[24] = "n";
	$lettresetchiffres[25] = "o"; $lettresetchiffres[26] = "p"; $lettresetchiffres[27] = "q"; $lettresetchiffres[28] = "r"; $lettresetchiffres[29] = "s"; $lettresetchiffres[30] = "t"; $lettresetchiffres[31] = "u";
	$lettresetchiffres[32] = "v"; $lettresetchiffres[33] = "w"; $lettresetchiffres[34] = "x"; $lettresetchiffres[35] = "y"; $lettresetchiffres[36] = "z";
	$lettresetchiffres[37] = "A"; $lettresetchiffres[38] = "B"; $lettresetchiffres[39] = "C"; $lettresetchiffres[40] = "D"; $lettresetchiffres[41] = "E"; $lettresetchiffres[42] = "F"; $lettresetchiffres[43] = "G";
	$lettresetchiffres[44] = "H"; $lettresetchiffres[45] = "I"; $lettresetchiffres[46] = "J"; $lettresetchiffres[47] = "K"; $lettresetchiffres[48] = "L"; $lettresetchiffres[49] = "M"; $lettresetchiffres[50] = "N";
	$lettresetchiffres[51] = "O"; $lettresetchiffres[52] = "P"; $lettresetchiffres[53] = "Q"; $lettresetchiffres[54] = "R"; $lettresetchiffres[55] = "S"; $lettresetchiffres[56] = "T"; $lettresetchiffres[57] = "U";
	$lettresetchiffres[58] = "V"; $lettresetchiffres[59] = "W"; $lettresetchiffres[60] = "X"; $lettresetchiffres[61] = "Y"; $lettresetchiffres[62] = "Z";
	for($e = 1; $e <= 8; $e++)
	{
		$rand = rand(1,62);
		$element[$e] = $lettresetchiffres[$rand];
	}
	$nomdelaphoto = $element[1]; $nomdelaphoto .= $element[2];
	$nomdelaphoto .= $element[3]; $nomdelaphoto .= $element[4];
	$nomdelaphoto .= $element[5]; $nomdelaphoto .= $element[6];
	$nomdelaphoto .= $element[7]; $nomdelaphoto .= $element[8];
	return $nomdelaphoto;
}
if(isset($_POST['valider']))
{
	if(in_array($extension, $extensions))
	{
		if($taille <= $taille_maxi)
		{
			$req1 = $bdd->query('SELECT photo_l FROM inscrits');
			while($donnees1 = $req1->fetch())
			{
				$nomdelaphoto = NomDeLaPhoto();
				$req2 = $bdd->prepare('SELECT photo_l FROM inscrits WHERE photo_l = ?');
				$req2->execute(array($nomdelaphoto));
				$donnees2 = $req2->fetch();
				if(!isset($donnees2['lien_photo']))
				{
					$nomdelaphoto .= $extension; 
					$dossier = 'dossierphotosdeslieux/';
					$req1->closeCursor();
					if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $nomdelaphoto))
					{
						$req3 = $bdd->prepare('UPDATE inscrits SET photo_l = ? WHERE id = ?');
						$req3->execute(array($nomdelaphoto, $_SESSION['id']));
						$req4 = $bdd->prepare('INSERT INTO photos_lieux(id_photo, id_membre) VALUES(?,?)');
						$req4->execute(array($nomdelaphoto, $_SESSION['id']));
						$_SESSION['message'] = 0;
						header('Location: informationspersonnelles.php');
					}else
					{
						$_SESSION['message'] = 94;
						header('Location: modifiervotrephotodelieu.php');
					}
				}
			}
		}else
		{
			$_SESSION['message'] = 93;
			header('Location: modifiervotrephotodelieu.php');
		}
	}else
	{
		$_SESSION['message'] = 92;
		header('Location: modifiervotrephotodelieu.php');
	}
}elseif(isset($_POST['valider2']))
{
	$req5 = $bdd->prepare('UPDATE inscrits SET photo_l = ? WHERE id = ?');
	$req5->execute(array("lieusansphoto.png", $_SESSION['id']));
	$_SESSION['message'] = 0;
	header('Location: informationspersonnelles.php');
}else
{
	$_SESSION['message'] = 91;
	header('Location: modifiervotrephotodelieu.php');
}
?> 