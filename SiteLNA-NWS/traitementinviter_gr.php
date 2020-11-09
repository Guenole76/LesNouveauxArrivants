<?php 
session_start();
include('mysql.php');
include('expression_r.php');
$lienvalider = 0;
$validation = 0;
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
	if($_POST['gr'] == 1)
	{
		$_SESSION['gr'] = $_POST['gr'];
		header('Location: inviter_gr1.php');
	}elseif($_POST['gr'] == 2)
	{
		$_SESSION['gr'] = $_POST['gr'];
		header('Location: inviter_gr2.php');
	}elseif($_POST['gr'] == 3)
	{
		$_SESSION['gr'] = $_POST['gr'];
		header('Location: inviter_gr_pro.php');
	}
}elseif(isset($_POST['inviter']))
{
	if(isset($_SESSION['id']))
	{
		$lienvalider++;
		if(!preg_match("#^[ ]*$#", $_POST['nbrinvit']))
		{
			$_SESSION['message'] = "";
			$validation++;
		}
		$lienvalider++;
		if(!preg_match("#^[ ]*$#", $_POST['qualitemembre']))
		{
			$_SESSION['message'] = "";
			$validation++;
		}
		$lienvalider++;
		if(!preg_match("#^[ ]*$#", $_POST['ddref']))
		{
			$_SESSION['message'] = "";
			$validation++;
		}
		if($lienvalider == $validation)
		{
			if($_POST['qualitemembre'] == 4)
			{	
				if($_POST['ddref'] == 1)
				{
					$req = $bdd->prepare('SELECT COUNT(id_relation) as nbrr_gr1 FROM relations WHERE id_membre_1 = ? AND groupe_relationnel = ?');
					$req->execute(array($_SESSION['id'], 1));
					$donnees = $req->fetch();
					if($_POST['nbrinvit'] >= $donnees['nbrr_gr1'])
					{
						$nbrinvit = $donnees['nbrr_gr1'];
						$max = 1;
					}else
					{
						$nbrinvit = $_POST['nbrinvit'];
						$max = 0;
					}
					if($max == 1)
					{
						$req1 = $bdd->prepare('SELECT id_membre_2 idm2 FROM relations WHERE id_membre_1 = ? AND groupe_relationnel = ?');
						$req1->execute(array($_SESSION['id'], 1));
						$donnees1 = $req1->fetch();
						if(isset($donnees1['idm2']))
						{
							do
							{
								$req2 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req2->execute(array($_SESSION['id_sortie'], $donnees1['idm2'], 2, 2));
							}while($donnees1 = $req1->fetch());
							header('Location: inviter_gr1.php');
						}else
						{
							header('Location: inviter_gr1.php');
						}
					}else
					{
						$req3 = $bdd->prepare('SELECT id_membre_2 idm2 FROM relations WHERE id_membre_1 = ? AND groupe_relationnel = ?');
						$req3->execute(array($_SESSION['id'], 1));
						$donnees3 = $req3->fetch();
						$n = 1;
						if(isset($donnees3['idm2']))
						{
							do
							{
								$id[$n] = $donnees3['idm2'];
								$n++;
							}while($donnees3 = $req3->fetch());
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								if($i > 1)
								{
									$nbrr_gr1 = $donnees['nbrr_gr1'] - $i;
								}else
								{
									$nbrr_gr1 = $donnees['nbrr_gr1'];
								}
								$c = rand(1, $nbrr_gr1);
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$c], 2, 2));
								unset($id[$c]);
								$d = $c + 1;
								for($j = $d; $j <= $nbrr_gr1; $j++)
								{
									$k = $j - 1;
									$id[$k] = $id[$j];
								}
								
							}
							header('Location: inviter_gr1.php');
						}
					}else
					{
						header('Location: inviter_gr1.php');
					}
				}else
				{
					$req = $bdd->prepare('SELECT COUNT(rel.id_relation) as nbrr_gr1 FROM relations rel LEFT JOIN inscrits ins ON rel.id_membre_2 = ins.id
					WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.ddref = ?');
					$req->execute(array($_SESSION['id'], 1, $_POST['ddref']));
					$donnees = $req->fetch();
					if($_POST['nbrinvit'] >= $donnees['nbrr_gr1'])
					{
						$nbrinvit = $donnees['nbrr_gr1'];
						$max = 1;
					}else
					{
						$nbrinvit = $_POST['nbrinvit'];
						$max = 0;
					}
					if($max == 1)
					{
						$req1 = $bdd->prepare('SELECT rel.id_membre_2 idm2 FROM relations rel LEFT JOIN inscrits ins ON rel.id_membre_2 = ins.id 
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.ddref = ?');
						$req1->execute(array($_SESSION['id'], 1, $_POST['ddref']));
						$donnees1 = $req1->fetch();
						if(isset($donnees1['idm2']))
						{
							do
							{
								$req2 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req2->execute(array($_SESSION['id_sortie'], $donnees1['idm2'], 2, 2));
							}while($donnees1 = $req1->fetch());
							header('Location: inviter_gr1.php');
						}else
						{
							header('Location: inviter_gr1.php');
						}
					}else
					{
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 idm2 FROM relations rel LEFT JOIN inscrits ins ON rel.id_membre_2 = ins.id 
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.ddref = ?');
						$req3->execute(array($_SESSION['id'], 1, $_POST['ddref']));
						$donnees3 = $req3->fetch();
						$n = 1;
						if(isset($donnees3['idm2']))
						{
							do
							{
								$id[$n] = $donnees3['idm2'];
								$n++;
							}while($donnees3 = $req3->fetch());
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								if($i > 1)
								{
									$nbrr_gr1 = $donnees['nbrr_gr1'] - $i;
								}else
								{
									$nbrr_gr1 = $donnees['nbrr_gr1'];
								}
								$c = rand(1, $nbrr_gr1);
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$c], 2, 2));
								unset($id[$c]);
								$d = $c + 1;
								for($j = $d; $j <= $nbrr_gr1; $j++)
								{
									$k = $j - 1;
									$id[$k] = $id[$j];
								}
								
							}
							header('Location: inviter_gr1.php');
						}
					}else
					{
						header('Location: inviter_gr1.php');
					}
				}
			}elseif($_POST['qualitemembre'] == 1)
			{
				if($_POST['ddref'] == 1)
				{
					$req = $bdd->prepare('SELECT id_membre_2 idm2 FROM relations WHERE id_membre_1 = ? AND groupe_relationnel = ?');
					$req->execute(array($_SESSION['id'], 1));
					$donnees = $req->fetch();
					if(isset($donnees['idm2']))
					{
						$h = 0;
						$n = 1;
						do
						{
							$req1 = $bdd->prepare('SELECT s, l FROM inscrits WHERE id = ?');
							$req1->execute(array($donnees['idm2']));
							$donnees1 = $req1->fetch();
							if($donnees1['l'] == 2)
							{
								if(preg_match("#^h#i", $donnees1['s']))
								{
									$id[$n] = $donnees['idm2'];
									$h = $h + 1;
									$n = $n + 1;
								}
							}
						}while($donnees = $req->fetch());
						if($_POST['nbrinvit'] >= $h)
						{
							$nbrinvit = $h;
							$max = 1;
						}else
						{
							$nbrinvit = $_POST['nbrinvit'];
							$max = 0;
						}
						if($max == 1)
						{
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$i], 2, 2));
							}
							header('Location: inviter_gr1.php');
						}else
						{
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								if($i > 1)
								{
									$nbrrh_gr1 = $h - $i;
								}else
								{
									$nbrrh_gr1 = $h;
								}
								$c = rand(1, $nbrrh_gr1);
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$c], 2, 2));
								unset($id[$c]);
								$d = $c + 1;
								for($j = $d; $j <= $nbrrh_gr1; $j++)
								{
									$k = $j - 1;
									$id[$k] = $id[$j];
								}
								
							}
							header('Location: inviter_gr1.php');		
						}
					}
				}else
				{
					$req = $bdd->prepare('SELECT rel.id_membre_2 idm2 FROM relations rel LEFT JOIN inscrits ins ON rel.id_membre_2 = ins.id
					WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.ddref = ?');
					$req->execute(array($_SESSION['id'], 1, $_POST['ddref']));
					$donnees = $req->fetch();
					if(isset($donnees['idm2']))
					{
						$h = 0;
						$n = 1;
						do
						{
							$req1 = $bdd->prepare('SELECT s, l FROM inscrits WHERE id = ?');
							$req1->execute(array($donnees['idm2']));
							$donnees1 = $req1->fetch();
							if($donnees1['l'] == 2)
							{
								if(preg_match("#^h#i", $donnees1['s']))
								{
									$id[$n] = $donnees['idm2'];
									$h = $h + 1;
									$n = $n + 1;
								}
							}
						}while($donnees = $req->fetch());
						if($_POST['nbrinvit'] >= $h)
						{
							$nbrinvit = $h;
							$max = 1;
						}else
						{
							$nbrinvit = $_POST['nbrinvit'];
							$max = 0;
						}
						if($max == 1)
						{
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$i], 2, 2));
							}
							header('Location: inviter_gr1.php');
						}else
						{
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								if($i > 1)
								{
									$nbrrh_gr1 = $h - $i;
								}else
								{
									$nbrrh_gr1 = $h;
								}
								$c = rand(1, $nbrrh_gr1);
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$c], 2, 2));
								unset($id[$c]);
								$d = $c + 1;
								for($j = $d; $j <= $nbrrh_gr1; $j++)
								{
									$k = $j - 1;
									$id[$k] = $id[$j];
								}
								
							}
							header('Location: inviter_gr1.php');		
						}
					}
				}
			}elseif($_POST['qualitemembre'] == 2)
			{
				if($_POST['ddref'] == 1)
				{
					$req = $bdd->prepare('SELECT id_membre_2 idm2 FROM relations WHERE id_membre_1 = ? AND groupe_relationnel = ?');
					$req->execute(array($_SESSION['id'], 1));
					$donnees = $req->fetch();
					if(isset($donnees['idm2']))
					{
						$f = 0;
						$n = 1;
						do
						{
							$req1 = $bdd->prepare('SELECT s, l FROM inscrits WHERE id = ?');
							$req1->execute(array($donnees['idm2']));
							$donnees1 = $req1->fetch();
							if($donnees1['l'] == 2)
							{
								if(preg_match("#^f#i", $donnees1['s']))
								{
									$id[$n] = $donnees['idm2'];
									$f = $f + 1;
									$n = $n + 1;
								}
							}
						}while($donnees = $req->fetch());
						if($_POST['nbrinvit'] >= $f)
						{
							$nbrinvit = $f;
							$max = 1;
						}else
						{
							$nbrinvit = $_POST['nbrinvit'];
							$max = 0;
						}
						if($max == 1)
						{
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$i], 2, 2));
							}
							header('Location: inviter_gr1.php');	
						}else
						{
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								if($i > 1)
								{
									$nbrrf_gr1 = $f - $i;
								}else
								{
									$nbrrf_gr1 = $f;
								}
								$c = rand(1, $nbrrf_gr1);
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$c], 2, 2));
								unset($id[$c]);
								$d = $c + 1;
								for($j = $d; $j <= $nbrrf_gr1; $j++)
								{
									$k = $j - 1;
									$id[$k] = $id[$j];
								}
								header('Location: inviter_gr1.php');	
							}
						}
					}
				}else
				{
					$req = $bdd->prepare('SELECT rel.id_membre_2 idm2 FROM relations rel LEFT JOIN inscrits ins ON rel.id_membre_2 = ins.id
					WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.ddref = ?');
					$req->execute(array($_SESSION['id'], 1, $_POST['ddref']));
					$donnees = $req->fetch();
					if(isset($donnees['idm2']))
					{
						$f = 0;
						$n = 1;
						do
						{
							$req1 = $bdd->prepare('SELECT s, l FROM inscrits WHERE id = ?');
							$req1->execute(array($donnees['idm2']));
							$donnees1 = $req1->fetch();
							if($donnees1['l'] == 2)
							{
								if(preg_match("#^f#i", $donnees1['s']))
								{
									$id[$n] = $donnees['idm2'];
									$f = $f + 1;
									$n = $n + 1;
								}
							}
						}while($donnees = $req->fetch());
						if($_POST['nbrinvit'] >= $f)
						{
							$nbrinvit = $f;
							$max = 1;
						}else
						{
							$nbrinvit = $_POST['nbrinvit'];
							$max = 0;
						}
						if($max == 1)
						{
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$i], 2, 2));
							}
							header('Location: inviter_gr1.php');	
						}else
						{
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								if($i > 1)
								{
									$nbrrf_gr1 = $f - $i;
								}else
								{
									$nbrrf_gr1 = $f;
								}
								$c = rand(1, $nbrrf_gr1);
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$c], 2, 2));
								unset($id[$c]);
								$d = $c + 1;
								for($j = $d; $j <= $nbrrf_gr1; $j++)
								{
									$k = $j - 1;
									$id[$k] = $id[$j];
								}
								header('Location: inviter_gr1.php');	
							}
						}
					}
				}
			}elseif($_POST['qualitemembre'] == 3)
			{
				if($_POST['ddref'] == 1)
				{
					$req = $bdd->prepare('SELECT id_membre_2 idm2 FROM relations WHERE id_membre_1 = ? AND groupe_relationnel = ?');
					$req->execute(array($_SESSION['id'], 1));
					$donnees = $req->fetch();
					if(isset($donnees['idm2']))
					{
						$l = 0;
						$n = 1;
						do
						{
							$req1 = $bdd->prepare('SELECT s, l FROM inscrits WHERE id = ?');
							$req1->execute(array($donnees['idm2']));
							$donnees1 = $req1->fetch();
							if($donnees1['l'] == 1)
							{
								$id[$n] = $donnees['idm2'];
								$l = $l + 1;
								$n = $n + 1;
							}
						}while($donnees = $req->fetch());
						if($_POST['nbrinvit'] >= $l)
						{
							$nbrinvit = $l;
							$max = 1;
						}else
						{
							$nbrinvit = $_POST['nbrinvit'];
							$max = 0;
						}
						if($max == 1)
						{
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$i], 2, 2));
							}
							header('Location: inviter_gr1.php');	
						}else
						{
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								if($i > 1)
								{
									$nbrrl_gr1 = $l - $i;
								}else
								{
									$nbrrl_gr1 = $l;
								}
								$c = rand(1, $nbrrl_gr1);
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$c], 2, 2));
								unset($id[$c]);
								$d = $c + 1;
								for($j = $d; $j <= $nbrrl_gr1; $j++)
								{
									$k = $j - 1;
									$id[$k] = $id[$j];
								}
								header('Location: inviter_gr1.php');	
							}
						}
					}
				}else
				{
					$req = $bdd->prepare('SELECT rel.id_membre_2 idm2 FROM relations rel LEFT JOIN inscrits ins ON rel.id_membre_2 = ins.id
					WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.ddref = ?');
					$req->execute(array($_SESSION['id'], 1, $_POST['ddref']));
					$donnees = $req->fetch();
					if(isset($donnees['idm2']))
					{
						$l = 0;
						$n = 1;
						do
						{
							$req1 = $bdd->prepare('SELECT s, l FROM inscrits WHERE id = ?');
							$req1->execute(array($donnees['idm2']));
							$donnees1 = $req1->fetch();
							if($donnees1['l'] == 1)
							{
								$id[$n] = $donnees['idm2'];
								$l = $l + 1;
								$n = $n + 1;
							}
						}while($donnees = $req->fetch());
						if($_POST['nbrinvit'] >= $l)
						{
							$nbrinvit = $l;
							$max = 1;
						}else
						{
							$nbrinvit = $_POST['nbrinvit'];
							$max = 0;
						}
						if($max == 1)
						{
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$i], 2, 2));
							}
							header('Location: inviter_gr1.php');	
						}else
						{
							for($i = 1; $i <= $nbrinvit; $i++)
							{
								if($i > 1)
								{
									$nbrrl_gr1 = $l - $i;
								}else
								{
									$nbrrl_gr1 = $l;
								}
								$c = rand(1, $nbrrl_gr1);
								$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
								$req4->execute(array($_SESSION['id_sortie'], $id[$c], 2, 2));
								unset($id[$c]);
								$d = $c + 1;
								for($j = $d; $j <= $nbrrl_gr1; $j++)
								{
									$k = $j - 1;
									$id[$k] = $id[$j];
								}
								header('Location: inviter_gr1.php');	
							}
						}
					}
				}
			}
		}
	}else
	{
		if($_POST['gr'] == 1)
		{
			header('Location: inviter_gr1.php');
		}elseif($_POST['gr'] == 2)
		{
			header('Location: inviter_gr2.php');
		}elseif($_POST['gr'] == 3)
		{
			header('Location: inviter_gr_pro.php');
		}
	}
}elseif($_POST['ithomme'])
{
	$req = $bdd->prepare('SELECT id_membre_2 idm2 FROM relations WHERE id_membre_1 = ? AND groupe_relationnel = ?');
	$req->execute(array($_SESSION['id'], 2));
	$donnees = $req->fetch();
	if(isset($donnees['idm2']))
	{
		$h = 0;
		$n = 1;
		do
		{
			$req1 = $bdd->prepare('SELECT s, l FROM inscrits WHERE id = ?');
			$req1->execute(array($donnees['idm2']));
			$donnees1 = $req1->fetch();
			if($donnees1['l'] == 2)
			{
				if(preg_match("#^h#i", $donnees1['s']))
				{
					$id[$n] = $donnees['idm2'];
					$h = $h + 1;
					$n = $n + 1;
				}
			}
		}while($donnees = $req->fetch());
		for($i = 1; $i <= $h; $i++)
		{
			$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
			$req4->execute(array($_SESSION['id_sortie'], $id[$i], 2, 2));
		}
		header('Location: inviter_gr2.php');		
	}
}elseif($_POST['itfemme'])
{
	$req = $bdd->prepare('SELECT id_membre_2 idm2 FROM relations WHERE id_membre_1 = ? AND groupe_relationnel = ?');
	$req->execute(array($_SESSION['id'], 2));
	$donnees = $req->fetch();
	if(isset($donnees['idm2']))
	{
		$f = 0;
		$n = 1;
		do
		{
			$req1 = $bdd->prepare('SELECT s, l FROM inscrits WHERE id = ?');
			$req1->execute(array($donnees['idm2']));
			$donnees1 = $req1->fetch();
			if($donnees1['l'] == 2)
			{
				if(preg_match("#^f#i", $donnees1['s']))
				{
					$id[$n] = $donnees['idm2'];
					$f = $f + 1;
					$n = $n + 1;
				}
			}
		}while($donnees = $req->fetch());
		for($i = 1; $i <= $f; $i++)
		{
			$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
			$req4->execute(array($_SESSION['id_sortie'], $id[$i], 2, 2));
		}
		header('Location: inviter_gr2.php');		
	}
}elseif($_POST['itlieu'])
{
	$req = $bdd->prepare('SELECT id_membre_2 idm2 FROM relations WHERE id_membre_1 = ? AND groupe_relationnel = ?');
	$req->execute(array($_SESSION['id'], 2));
	$donnees = $req->fetch();
	if(isset($donnees['idm2']))
	{
		$l = 0;
		$n = 1;
		do
		{
			$req1 = $bdd->prepare('SELECT s, l FROM inscrits WHERE id = ?');
			$req1->execute(array($donnees['idm2']));
			$donnees1 = $req1->fetch();
			if($donnees1['l'] == 1)
			{
				$id[$n] = $donnees['idm2'];
				$l = $l + 1;
				$n = $n + 1;
			}
		}while($donnees = $req->fetch());
		for($i = 1; $i <= $l; $i++)
		{
			$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
			$req4->execute(array($_SESSION['id_sortie'], $id[$i], 2, 2));
		}
		header('Location: inviter_gr2.php');		
	}
}elseif($_POST['ithomme2'])
{
	$req = $bdd->prepare('SELECT id_membre_2 idm2 FROM relations WHERE id_membre_1 = ? AND groupe_relationnel = ?');
	$req->execute(array($_SESSION['id'], 3));
	$donnees = $req->fetch();
	if(isset($donnees['idm2']))
	{
		$h = 0;
		$n = 1;
		do
		{
			$req1 = $bdd->prepare('SELECT s, l FROM inscrits WHERE id = ?');
			$req1->execute(array($donnees['idm2']));
			$donnees1 = $req1->fetch();
			if($donnees1['l'] == 2)
			{
				if(preg_match("#^h#i", $donnees1['s']))
				{
					$id[$n] = $donnees['idm2'];
					$h = $h + 1;
					$n = $n + 1;
				}
			}
		}while($donnees = $req->fetch());
		for($i = 1; $i <= $h; $i++)
		{
			$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
			$req4->execute(array($_SESSION['id_sortie'], $id[$i], 2, 2));
		}
		header('Location: inviter_gr3.php');		
	}
}elseif($_POST['itfemme2'])
{
	$req = $bdd->prepare('SELECT id_membre_2 idm2 FROM relations WHERE id_membre_1 = ? AND groupe_relationnel = ?');
	$req->execute(array($_SESSION['id'], 3));
	$donnees = $req->fetch();
	if(isset($donnees['idm2']))
	{
		$f = 0;
		$n = 1;
		do
		{
			$req1 = $bdd->prepare('SELECT s, l FROM inscrits WHERE id = ?');
			$req1->execute(array($donnees['idm2']));
			$donnees1 = $req1->fetch();
			if($donnees1['l'] == 2)
			{
				if(preg_match("#^f#i", $donnees1['s']))
				{
					$id[$n] = $donnees['idm2'];
					$f = $f + 1;
					$n = $n + 1;
				}
			}
		}while($donnees = $req->fetch());
		for($i = 1; $i <= $f; $i++)
		{
			$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
			$req4->execute(array($_SESSION['id_sortie'], $id[$i], 2, 2));
		}
		header('Location: inviter_gr3.php');		
	}
}elseif($_POST['itlieu2'])
{
	$req = $bdd->prepare('SELECT id_membre_2 idm2 FROM relations WHERE id_membre_1 = ? AND groupe_relationnel = ?');
	$req->execute(array($_SESSION['id'], 3));
	$donnees = $req->fetch();
	if(isset($donnees['idm2']))
	{
		$l = 0;
		$n = 1;
		do
		{
			$req1 = $bdd->prepare('SELECT s, l FROM inscrits WHERE id = ?');
			$req1->execute(array($donnees['idm2']));
			$donnees1 = $req1->fetch();
			if($donnees1['l'] == 1)
			{
				$id[$n] = $donnees['idm2'];
				$l = $l + 1;
				$n = $n + 1;
			}
		}while($donnees = $req->fetch());
		for($i = 1; $i <= $l; $i++)
		{
			$req4 = $bdd->prepare('INSERT INTO inscrits_sortie (id_sortie, id_membre, valeur_co_orga, valeur_membre) VALUES (?, ?, ?, ?)');
			$req4->execute(array($_SESSION['id_sortie'], $id[$i], 2, 2));
		}
		header('Location: inviter_gr3.php');		
	}
}else
{
	$_SESSION['relation_gr'] = 0;
	$_SESSION['lieu_gr'] = 0;
	$_SESSION['da_gr'] = 0;
	$_SESSION['ds_gr'] = 0;
	$_SESSION['surnom1_gr'] = "";
	$_SESSION['surnom2_gr'] = "";
	if($_POST['gr'] == 1)
	{
		header('Location: inviter_gr1.php');
	}elseif($_POST['gr'] == 2)
	{
		header('Location: inviter_gr2.php');
	}elseif($_POST['gr'] == 3)
	{
		header('Location: inviter_gr_pro.php');
	}
}
?>