<?php 
session_start();
include('expression_r.php');
include('mysql.php');
$aemp = 0;
function random_str($nbr) {
    $str = "";
    $chaine = "abcdefghijklmnopqrstuvwxyABCDEFGHIJKLMNOPQRSUTVWXYZ0123456789";
    $nb_chars = strlen($chaine);

    for($i=0; $i<$nbr; $i++)
    {
        $str .= $chaine[ rand(0, ($nb_chars-1)) ];
    }

    return $str;
}
$code = random_str(15);
if(isset($_POST['valider']))
{
	if(isset($_POST['s']))
	{
		if(!preg_match("#^[ ]*$#", $_POST['surnom1']))
		{
			$_POST['surnom1'] = htmlspecialchars($_POST['surnom1'], ENT_NOQUOTES);
			if(!preg_match("#^[ ]*$#", $_POST['surnom2']))
			{
				$_POST['surnom2'] = htmlspecialchars($_POST['surnom2'], ENT_NOQUOTES);
				if(!preg_match("#^[ ]*$#", $_POST['photodep1']))
				{
					$_POST['photodep1'] = htmlspecialchars($_POST['photodep1'], ENT_NOQUOTES);
					if(!preg_match("#^[ ]*$#", $_POST['photodep2']))
					{
						$_POST['photodep2'] = htmlspecialchars($_POST['photodep2'], ENT_NOQUOTES);
						if(!preg_match("#^[ ]*$#", $_POST['aem']))
						{
							$_POST['aem'] = htmlspecialchars($_POST['aem'], ENT_NOQUOTES);
							if(!preg_match("#^[ ]*$#", $_POST['caem']))
							{
								$_POST['caem'] = htmlspecialchars($_POST['caem'], ENT_NOQUOTES);
								if(!preg_match("#^[ ]*$#", $_POST['mdp']))
								{
									$_POST['mdp'] = htmlspecialchars($_POST['mdp'], ENT_NOQUOTES);
									if(!preg_match("#^[ ]*$#", $_POST['cmdp']))
									{
										$_POST['cmdp'] = htmlspecialchars($_POST['cmdp'], ENT_NOQUOTES);
										if(preg_match($expression_r, $_POST['surnom1']))
										{
											if(preg_match($expression_r, $_POST['surnom2']))
											{
												if($_POST['surnom1'] !== $_POST['surnom2'])
												{
													$surnom1 =  $_POST['surnom1'];
													$surnom2 =  $_POST['surnom2'];
													if($_POST['photodep1'] == $_POST['photodep2'])
													{
														$_SESSION['message'] = 14;
														
													}else
													{	$photodep1 =  $_POST['photodep1'];
														$photodep2 =  $_POST['photodep2'];
														if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['aem']))
														{
															$_SESSION['aem'] = $_POST['aem'];
															if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['caem']))
															{
																if(preg_match("#^([≈√‰‡†¿¾½¼°℗®©¡~™•§µ%=^¨@&¤\|\[\]\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*[a-zàáâäçèéêëœìíîïñòóôöùúûü0-9]*[≈√‰‡†¿¾½¼°℗®©¡~™•\|\[\]§µ%=^¨¤@&\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*){8,45}$#i", $_POST['mdp']))
																{
																	if(preg_match("#^([≈√‰‡†¿¾½¼°℗®©¡~™•§µ%=^¨@&¤\|\[\]\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*[a-zàáâäçèéêëœìíîïñòóôöùúûü0-9]*[≈√‰‡†¿¾½¼°℗®©¡~™•\|\[\]§µ%=^¨¤@&\\\+\)\(\/?\.\!\r\n\*\#¥€\$£_,…;:\"’`'-]*){8,45}$#i", $_POST['cmdp']))
																	{
																		if($_POST['aem'] == $_POST['caem'])
																		{
																			$_SESSION['caem'] =  $_POST['caem'];
																			$_SESSION['aem'] =  $_POST['caem'];
																			if($_POST['mdp'] == $_POST['cmdp'])
																			{
																				$req = $bdd->prepare('SELECT caem FROM inscrits WHERE caem = ?');
																				$req->execute(array($_SESSION['caem']));
																				$donnees1 = $req->fetch();
																				if(isset($donnees1['caem']))
																				{
																					$_SESSION['message'] = 21;
																					header('Location: inscription.php');
																				}else
																				{
																					$req = $bdd->prepare('INSERT INTO inscrits (surnom1, surnom2, photodep1, photodep2, jdn, mdn, adn, ddref, vdres, caem, cmdp, s, l, nom_l, photo_l,
																					 abonnement_en_cours, nv_relationnel, code_sympathie, val_email_j, email_ins_s, email_ins_b, email_com_s, email_mes, email_prop, code_inscrit, valeur_inscrit)
																					 VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
																					 ?, ?, ?, ?, ?, ?, ?, ?, ?)');
																					$req->execute(array($_POST['surnom1'], $_POST['surnom2'], $_POST['photodep1'], $_POST['photodep2'], 14, "septembre", 2017, "Seine-Maritime",
																					"Rouen", $_POST['caem'], $_POST['cmdp'], $_POST['s'], 2, "", "liensansphoto.png", "Echanges", 0, "", 1, 1, 1, 1, 1, 1, $code, 2));
																					$_SESSION['message'] = 0;
																					$_SESSION['caem'] = $_POST['caem'];
																					$lien = "https://www.lesnouveauxarrivants.fr/confirmation2.php?code=".$code;
																					$to = $_POST['caem'];
																					$subject = "E-mail pour confirmer l'inscription";
																					$message = "Veuillez cliquer sur le lien ci-dessous, pour confirmer votre inscription. ".$lien."";
																					$message = wordwrap($message, 70, "\r\n", true);
																					mail($to, $subject, $message, 'De: Les Nouveaux Arrivants');
																					header('Location: confirmation1.php');
																				}
																			}else
																			{
																				$_SESSION['message'] = 20;
																				header('Location: inscription.php');
																			}
																		}else
																		{
																			$_SESSION['message'] = 19;
																			header('Location: inscription.php');
																		}
																	}else
																	{
																		$_SESSION['message'] = 18;
																		header('Location: inscription.php');
																	}
																}else
																{
																	$_SESSION['message'] = 17;
																	header('Location: inscription.php');
																}
															}else
															{
																$_SESSION['message'] = 16;
																header('Location: inscription.php');
															}
														}else
														{
															$_SESSION['message'] = 15;
															header('Location: inscription.php');
														}
													}		
												}else
												{
													$_SESSION['message'] = 13;
													header('Location: inscription.php');
												}
											}else
											{
												$_SESSION['message'] = 12;
												header('Location: inscription.php');
											}
										}else
										{
											$_SESSION['message'] = 11;
											header('Location: inscription.php');
										}
									}else
									{
										$_SESSION['message'] = 10;
										header('Location: inscription.php');
									}
								}else
								{
									$_SESSION['message'] = 9;
									header('Location: inscription.php');
								}
							}else
							{
								$_SESSION['message'] = 8;
								header('Location: inscription.php');
							}
						}else
						{
							$_SESSION['message'] = 7;
							header('Location: inscription.php');
						}
					}else
					{
						$_SESSION['message'] = 6;
						header('Location: inscription.php');
					}
				}else
				{
					$_SESSION['message'] = 5;
					header('Location: inscription.php');
				}
			}else
			{
				$_SESSION['message'] = 4;
				header('Location: inscription.php');
			}
		}else
		{
			$_SESSION['message'] = 3;
			header('Location: inscription.php');
		}
	}else
	{
		$_SESSION['message'] = 2;
		header('Location: inscription.php');
	} 
}else
{
	$_SESSION['message'] = 1; 
	header('Location: index.php');
}
?>