<?php
session_start();
include('verificationid.php');
include('mysql.php');
if(isset($_POST['page']))
{
	$_SESSION['page_gr3'] = $_POST['page'];
}
if(!isset($_SESSION['page_gr3']))
{
	$_SESSION['page_gr3'] = 1; 
}
$limite = ($_SESSION['page_gr3'] - 1) * 40;
$_SESSION['gr'] = 3;
if(!isset($_SESSION['relation_gr']))
{
	$_SESSION['relation_gr'] = 0;
}
if(!isset($_SESSION['lieu_gr']))
{
	$_SESSION['lieu_gr'] = 0;
}
if(!isset($_SESSION['da_gr']))
{
	$_SESSION['da_gr'] = 0;
}
if(!isset($_SESSION['ds_gr']))
{
	$_SESSION['ds_gr'] = 0;
}
if(!isset($_SESSION['surnom2_gr']))
{
	$_SESSION['surnom2_gr'] = "";
}
if(!isset($_SESSION['surnom1_gr']))
{
	$_SESSION['surnom1_gr'] = "";
}
if(!isset($_SESSION['surnom3_gr']))
{
	$_SESSION['surnom3_gr'] = "";
}
$req1 = $bdd->prepare('SELECT abonnement_en_cours FROM inscrits WHERE id = ?');
$req1->execute(array($_SESSION['id']));
$donnees1 = $req1->fetch();
$longabo = strlen($donnees1['abonnement_en_cours']);
if($longabo == 8)
{
	$limitation = 0;
}elseif($longabo == 7)
{
	$limitation = 1;
}else
{
	$limitation = 0;
}
if($_SESSION['relation_gr'] == 0)
{
	if($_SESSION['da_gr'] == 0)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						if(!preg_match("#^[ ]*$#", $_SESSION['surnom3_gr']))
						{
							$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
							FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
							WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND rel.surnom3 LIKE "%' .$_SESSION['surnom3_gr']. '%" AND rel.validations3 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
							$req2->execute(array($_SESSION['id'], $_SESSION['gr'], 1));
							$donnees2 = $req2->fetch();
							$req3_2 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.surnom3 s3, rel.validations3 vds3, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
							FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
							WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND rel.surnom3 LIKE "%' .$_SESSION['surnom3_gr']. '%" AND rel.validations3 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
							$req3_2->execute(array($_SESSION['id'], $_SESSION['gr'], 1));
							$donnees3_2 = $req3_2->fetch();
						}else
						{
							$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
							FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
							WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
							$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
							$donnees2 = $req2->fetch();
							$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
							FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
							WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
							$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
							$donnees3 = $req3->fetch();
						}
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}elseif($_SESSION['da_gr'] == 1)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}elseif($_SESSION['da_gr'] == 2)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}
}elseif($_SESSION['relation_gr'] == 1)
{
	if($_SESSION['da_gr'] == 0)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}elseif($_SESSION['da_gr'] == 1)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}elseif($_SESSION['da_gr'] == 2)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}
}elseif($_SESSION['relation_gr'] == 2)
{
	if($_SESSION['da_gr'] == 0)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}elseif($_SESSION['da_gr'] == 1)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}elseif($_SESSION['da_gr'] == 2)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}
}elseif($_SESSION['relation_gr'] == 3)
{
	if($_SESSION['da_gr'] == 0)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}elseif($_SESSION['da_gr'] == 1)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}elseif($_SESSION['da_gr'] == 2)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}
}elseif($_SESSION['relation_gr'] == 4)
{
	if($_SESSION['da_gr'] == 0)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}elseif($_SESSION['da_gr'] == 1)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}elseif($_SESSION['da_gr'] == 2)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}
}elseif($_SESSION['relation_gr'] == 5)
{
	if($_SESSION['da_gr'] == 0)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY rel.id_relation LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}elseif($_SESSION['da_gr'] == 1)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn DESC, ins.jdn DESC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}elseif($_SESSION['da_gr'] == 2)
	{
		if($_SESSION['ds_gr'] == 0)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 1)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie DESC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}elseif($_SESSION['ds_gr'] == 2)
		{
			if($_SESSION['lieu_gr'] == 0)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 1)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}elseif($_SESSION['lieu_gr'] == 2)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}else
				{
					if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}else
					{
						$req2 = $bdd->prepare('SELECT ins.surnom1 s1, ins.surnom2 s2, ins.jdn jdn, ins.mdn mdn, ins.l l, ins.nom_l nom_l
						FROM inscrits AS ins LEFT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req2->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees2 = $req2->fetch();
						$req3 = $bdd->prepare('SELECT rel.id_membre_2 id_membre_2, rel.points_de_relation pdr, rel.t_sympathie t_s, rel.glacage glacage, rel.groupe_relationnel gr, rel.protection prot
						FROM inscrits AS ins RIGHT JOIN relations AS rel ON ins.id = rel.id_membre_2
						WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? ORDER BY ins.mdn ASC, ins.jdn ASC, rel.t_sympathie ASC LIMIT ' .$limite. ', 40');
						$req3->execute(array($_SESSION['id'], $_SESSION['gr'], $_SESSION['lieu_gr']));
						$donnees3 = $req3->fetch();
					}
				}
			}
		}
	}
}
date_default_timezone_set('UTC');
$n = 1;
$timestamp_actuel = time();
$jour_actuel = date("j", $timestamp_actuel);
$mois_actuel = date("n", $timestamp_actuel);
$annee_actuel = date("Y", $timestamp_actuel);

if(isset($donnees2['s1']))
{
	do
	{
		if($donnees2['l'] == 1)
		{
			$lieu[$n] = 1;
			$surnom[$n] = $donnees2['nom_l'];
		}else
		{
			$lieu[$n] = 2;
			$surnom2[$n] = $donnees2['s2'];
			$surnom1[$n] = $donnees2['s1'];
		}
		$jdn[$n] = $donnees2['jdn'];
		if(preg_match("#^Janvier$#", $donnees2['mdn']))
		{
			$mdn[$n] = 1;
		}elseif(preg_match("#^Février$#", $donnees2['mdn']))
		{
			$mdn[$n] = 2;
		}elseif(preg_match("#^Mars$#", $donnees2['mdn']))
		{
			$mdn[$n] = 3;
		}elseif(preg_match("#^Avril$#", $donnees2['mdn']))
		{
			$mdn[$n] = 4;
		}elseif(preg_match("#^Mai$#", $donnees2['mdn']))
		{
			$mdn[$n] = 5;
		}elseif(preg_match("#^Juin$#", $donnees2['mdn']))
		{
			$mdn[$n] = 6;
		}elseif(preg_match("#^Juillet$#", $donnees2['mdn']))
		{
			$mdn[$n] = 7;
		}elseif(preg_match("#^Août$#", $donnees2['mdn']))
		{
			$mdn[$n] = 8;
		}elseif(preg_match("#^Septembre$#", $donnees2['mdn']))
		{
			$mdn[$n] = 9;
		}elseif(preg_match("#^Octobre$#", $donnees2['mdn']))
		{
			$mdn[$n] = 10;
		}elseif(preg_match("#^Novembre$#", $donnees2['mdn']))
		{
			$mdn[$n] = 11;
		}elseif(preg_match("#^Décembre$#", $donnees2['mdn']))
		{
			$mdn[$n] = 12;
		}
		if($mdn[$n] > $mois_actuel)
		{
			$timestamp_attente[$n] = ($mdn[$n] - $mois_actuel)*(60*60*24*30.5) + ($jdn[$n] - $jour_actuel)*(60*60*24);
		}elseif($mdn[$n] == $mois_actuel)
		{
			if($jdn[$n] > $jour_actuel)
			{
				$timestamp_attente[$n] = ($jdn[$n] - $jour_actuel)*(60*60*24);
			}elseif($jdn[$n] == $jour_actuel)
			{
				$timestamp_attente[$n] = 0;
			}elseif($jdn[$n] < $jour_actuel)
			{
				$timestamp_attente[$n] = (366 - ($jour_actuel - $jdn[$n]))*60*60*24;
			}
		}elseif($mdn[$n] < $mois_actuel)
		{
			$timestamp_attente[$n] = (12 - ($mois_actuel - $mdn[$n]))*60*60*24*30.5 + ($jour_actuel - $jdn[$n])*60*60*24;
		}
		$n++;
	}while($donnees2 = $req2->fetch());
}else
{
	$relations = "Vous n'avez pas de relations.";
}
$m = 1;
if(isset($donnees3['id_membre_2']))
{
	do
	{
		$id_membre[$m] = $donnees3['id_membre_2'];
		$req3_3 = $bdd->prepare('SELECT surnom3 s3, validations3 vds3
		FROM relations WHERE id_membre_1 = ? AND id_membre_2 = ?');
		$req3_3->execute(array($_SESSION['id'], $donnees3['id_membre_2']));
		$donnees3_3 = $req3_3->fetch();
		if($lieu[$m] == 1)
		{
			if(isset($donnees3_3['s3']))
			{
				if($donnees3_3['vds3'] == 1)
				{
					$surnom[$m] = $donnees3_3['s3'];
					$c = 1;
				}else
				{
					$surnom[$m] = $surnom[$m];
					$c = 1;
				}
			}else
			{
				$surnom[$m] = $surnom[$m];
				$c = 1;
			}
		}else
		{
			if($donnees3['pdr'] >= 50)
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					if(isset($donnees3_3['s3']))
					{
						if($donnees3_3['vds3'] == 1)
						{
							unset($id_membre[$m]);
							$c = 0;
						}else
						{
							$surnom[$m] = $surnom2[$m];
							$c = 1;
						}
					}else
					{
						$surnom[$m] = $surnom2[$m];
						$c = 1;
					}
				}elseif(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
				{
					unset($id_membre[$m]);
					$c = 0;
				}else
				{
					if(isset($donnees3_3['s3']))
					{
						if($donnees3_3['vds3'] == 1)
						{
							$surnom[$m] = $donnees3_3['s3'];
							$c = 1;
						}else
						{
							$surnom[$m] = $surnom2[$m];
							$c = 1;
						}
					}else
					{
						$surnom[$m] = $surnom2[$m];
						$c = 1;
					}
				}
			}else
			{
				if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
				{
					if(isset($donnees3_3['s3']))
					{
						if($donnees3_3['vds3'] == 1)
						{
							unset($id_membre[$m]);
							$c = 0;
						}else
						{
							$surnom[$m] = $surnom1[$m];
							$c = 1;
						}
					}else
					{
						$surnom[$m] = $surnom1[$m];
						$c = 1;
					}
				}elseif(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
				{
					unset($id_membre[$m]);
					$c = 0;
				}else
				{
					if(isset($donnees3_3['s3']))
					{
						if($donnees3_3['vds3'] == 1)
						{
							$surnom[$m] = $donnees3_3['s3'];
							$c = 1;
						}else
						{
							$surnom[$m] = $surnom1[$m];
							$c = 1;
						}
					}else
					{
						$surnom[$m] = $surnom1[$m];
						$c = 1;
					}
				}
			}
		}
		if($c == 1)
		{
			if($donnees3['glacage'] == 1)
			{
				$glacage[$m] = "Oui";
			}else
			{
				$glacage[$m] = "Non";
			}
			$timestamp_sympathie[$m] = $donnees3['t_s'];
			$groupe_relationnel[$m] = $donnees3['gr'];
			$protection[$m] = $donnees3['prot'];
		}
		$m++;
	}while($donnees3 = $req3->fetch());
}elseif(isset($donnees3_2['s3']))
{
	do
	{
		$id_membre[$m] = $donnees3_2['id_membre_2'];
		$surnom[$m] = $donnees3_2['s3'];
		$c = 1;
		if($c == 1)
		{
			if($donnees3_2['glacage'] == 1)
			{
				$glacage[$m] = "Oui";
			}else
			{
				$glacage[$m] = "Non";
			}
			$timestamp_sympathie[$m] = $donnees3_2['t_s'];
			$groupe_relationnel[$m] = $donnees3_2['gr'];
			$protection[$m] = $donnees3_2['prot'];
		}
		$m++;
	}while($donnees3_2 = $req3_2->fetch());
}else
{
	$relations = "Vous n'avez pas de relations.";
}
$o = 1;
if($m == $n)
{
	if(isset($surnom))
	{
		if($_SESSION['da_gr'] == 2)
		{
			array_multisort($timestamp_attente, SORT_DESC, SORT_STRING, $surnom, SORT_STRING, $jdn, SORT_STRING, $mdn, SORT_STRING, $id_membre, SORT_STRING, $glacage, SORT_STRING, $groupe_relationnel, SORT_STRING, $protection, SORT_STRING, $timestamp_sympathie);
			$n = $n - 1;
			$o = 0;
		}elseif($_SESSION['da_gr'] == 1)
		{
			array_multisort($timestamp_attente, SORT_ASC, SORT_STRING, $surnom, SORT_STRING, $jdn, SORT_STRING, $mdn, SORT_STRING, $id_membre, SORT_STRING, $glacage, SORT_STRING, $groupe_relationnel, SORT_STRING, $protection, SORT_STRING, $timestamp_sympathie);
			$n = $n - 1;
			$o = 0;
		}elseif($_SESSION['ds_gr'] == 1)
		{
			array_multisort($timestamp_sympathie, SORT_DESC, SORT_STRING, $surnom, SORT_STRING, $jdn, SORT_STRING, $mdn, SORT_STRING, $id_membre, SORT_STRING, $glacage, SORT_STRING, $groupe_relationnel, SORT_STRING, $protection);
			$n = $n - 1;
			$o = 0;
		}elseif($_SESSION['ds_gr'] == 2)
		{
			array_multisort($timestamp_sympathie, SORT_ASC, SORT_STRING, $surnom, SORT_STRING, $jdn, SORT_STRING, $mdn, SORT_STRING, $id_membre, SORT_STRING, $glacage, SORT_STRING, $groupe_relationnel, SORT_STRING, $protection);
			$n = $n - 1;
			$o = 0;
		}
	}
	$relations = 1;
}
if($_SESSION['relation_gr'] == 1)
{
	if($_SESSION['lieu_gr'] == 0)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}
		}
	}elseif($_SESSION['lieu_gr'] == 1)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ?');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}
	}elseif($_SESSION['lieu_gr'] == 2)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 24 AND ins.l = ?');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}
	}
}elseif($_SESSION['relation_gr'] == 2)
{
	if($_SESSION['lieu_gr'] == 0)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}
		}
	}elseif($_SESSION['lieu_gr'] == 1)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ?');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}
	}elseif($_SESSION['lieu_gr'] == 2)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 25 AND 49 AND ins.l = ?');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}
	}
}elseif($_SESSION['relation_gr'] == 3)
{
	if($_SESSION['lieu_gr'] == 0)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}
		}
	}elseif($_SESSION['lieu_gr'] == 1)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ?');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}
	}elseif($_SESSION['lieu_gr'] == 2)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 50 AND 74 AND ins.l = ?');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}
	}
}elseif($_SESSION['relation_gr'] == 4)
{
	if($_SESSION['lieu_gr'] == 0)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}
		}
	}elseif($_SESSION['lieu_gr'] == 1)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ?');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}
	}elseif($_SESSION['lieu_gr'] == 2)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 75 AND 99 AND ins.l = ?');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}
	}
}elseif($_SESSION['relation_gr'] == 5)
{
	if($_SESSION['lieu_gr'] == 0)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}		 
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}
		}
	}elseif($_SESSION['lieu_gr'] == 1)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ?');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}
	}elseif($_SESSION['lieu_gr'] == 2)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 100 AND 100 AND ins.l = ?');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}
	}
}elseif(!preg_match("#^[ ]*$#", $_SESSION['surnom3_gr']))
{
	$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations
	FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
	WHERE rel.id_membre_1 = ? AND rel.groupe_relationnel = ? AND rel.surnom3 LIKE "%' .$_SESSION['surnom3_gr']. '%" AND validations3 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2');
	$req7->execute(array($_SESSION['id'], $_SESSION['gr'], 1));
	$donnees7 = $req7->fetch();
}else
{
	if($_SESSION['lieu_gr'] == 0)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}		 
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100');
				$req7->execute(array($_SESSION['id']));
				$donnees7 = $req7->fetch();
			}
		}
	}elseif($_SESSION['lieu_gr'] == 1)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ?');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}
	}elseif($_SESSION['lieu_gr'] == 2)
	{
		if(!preg_match("#^[ ]*$#", $_SESSION['surnom2_gr']))
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%" AND ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND
				ins.surnom2 LIKE "%' .$_SESSION['surnom2_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}else
		{
			if(!preg_match("#^[ ]*$#", $_SESSION['surnom1_gr']))
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ? AND
				ins.surnom1 LIKE "%' .$_SESSION['surnom1_gr']. '%"');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}else
			{
				$req7 = $bdd->prepare('SELECT COUNT(rel.id_membre_2) nbr_relations 
				FROM inscrits ins RIGHT JOIN relations rel ON ins.id = rel.id_membre_2
				WHERE rel.id_membre_1 = ? AND ins.valeur_inscrit BETWEEN 1 AND 2 AND rel.points_de_relation BETWEEN 10 AND 100 AND ins.l = ?');
				$req7->execute(array($_SESSION['id'], $_SESSION['lieu_gr']));
				$donnees7 = $req7->fetch();
			}
		}
	}
}
if(!isset($donnees7['nbr_relations']))
{
	$donnees7['nbr_relations'] = 0;
}
$nbrpages = intval(($donnees7['nbr_relations']/40)) + 1;
$n = $n - 1;
?>
<!DOCTYPE>
<html>
	<head>
		<?php include("head.php"); ?>
		<title>Groupe relationnel Pro - Les Nouveaux Arrivants</title>
	</head>
	<body>
		<?php include("headerc.php"); ?>
		<section class="sectionamais">
			<div class="pamais">
				<div class="div1amais">
					<?php include('navrelations.php');?>
				</div>
				<div class="div2amais">
					<div class="div9cadre div10cadre taille">
						<h2>Groupe relationnel Pro</h2>
						<h3>Les Prosches ♦</h3>
						<form method="post" action="traitement_gr.php" class="form">
							<div class="div2_gr">
								<select name="lrelation" class="select_gr">
									<?php include("listerelation.php");?>
								</select>
								<select name="llieu" class="select_gr">
									<?php include("listelieu.php");?>
								</select>
								<select name="lda" class="select_gr">
									<?php include("listeda.php");?>
								</select><br/>
								<select name="lds" class="select_gr">
									<?php include("listeds.php");?>
								</select>
								<input type="hidden" name="gr" value=3 />
								<input type="text" name="surnom1" placeholder="Surnom 1" maxlength=100 class="input_gr"/>
								<input type="text" name="surnom2" placeholder="Surnom 2" maxlength=100 class="input_gr"/><br/>
								<input type="text" name="surnom3" placeholder="Surnom Personnel" maxlength=100 class="input_gr"/><br/>
								<div class="deplacementrecherchersorties">
									<input type="submit" name="rechercher" value="Rechercher" class="bouton_gr"/>
								</div>
							</div>
						</form>
						1/2 = Relation préservée/recommandée<br/>
						Oui = Source de recommandations<br/>
						1/2/4 = Envoyer dans le groupe relationnel 1/2/4
					</div>
					<?php 
						if($relations == 1)
						{
							if($limitation == 0)
							{
								for($i = $o; $i <= $n; $i++)
								{
									if(isset($id_membre[$i]))
									{
										$t_s = date("j/n/Y", $timestamp_sympathie[$i]);
										echo "<div class='div3relations div9cadre div10cadre'><form method='post' action='traitementrelations.php' class='form'>
										<input type='hidden' name='gr' value=3 />
										<input type='hidden' name='id_membre' value=" .$id_membre[$i]. " />
										<label>Anniversaire le " .$jdn[$i]. "/" .$mdn[$i]. "</label><br/>
										<input type='submit' name='valider' value=\"" .$surnom[$i]. "\" class='boutonnom boutonnom2'/><br/>
										<input type='submit' name='protection' value='" .$protection[$i]. "' class='boutonnom'/>									
										<input type='submit' name='groupe_relationnel' value='1' class='boutonnom'/>
										<input type='submit' name='groupe_relationnel' value='4' class='boutonnom'/><br/>
										<label>Sympathie le " .$t_s. "</label>
										</form></div>";
									}
								}
							}elseif($limitation == 1)
							{
								for($i = $o; $i <= $n; $i++)
								{
									if(isset($id_membre[$i]))
									{
										$t_s = date("j/n/Y", $timestamp_sympathie[$i]);
										echo "<div class='div3relations div9cadre div10cadre'><form method='post' action='traitementrelations.php' class='form'>
										<input type='hidden' name='gr' value=3 />
										<input type='hidden' name='id_membre' value=" .$id_membre[$i]. " />
										<label>Anniversaire le " .$jdn[$i]. "/" .$mdn[$i]. "</label><br/>
										<input type='submit' name='valider' value=\"" .$surnom[$i]. "\" class='boutonnom boutonnom2'/><br/>
										<input type='submit' name='protection' value='" .$protection[$i]. "' class='boutonnom'/>
										<input type='submit' name='glacage' value='" .$glacage[$i]. "' class='boutonnom'/>
										<input type='submit' name='groupe_relationnel' value='1' class='boutonnom'/>
										<input type='submit' name='groupe_relationnel' value='2' class='boutonnom'/>
										<input type='submit' name='groupe_relationnel' value='4' class='boutonnom'/><br/>
										<label>Sympathie le " .$t_s. "</label>
										</form></div>";
									}
								}
							}else
							{
								for($i = $o; $i <= $n; $i++)
								{
									if(isset($id_membre[$i]))
									{
										$t_s = date("j/n/Y", $timestamp_sympathie[$i]);
										echo "<div class='div3relations div9cadre div10cadre'><form method='post' action='traitementrelations.php' class='form'>
										<input type='hidden' name='gr' value=3 />
										<input type='hidden' name='id_membre' value=" .$id_membre[$i]. " />
										<label>Anniversaire le " .$jdn[$i]. "/" .$mdn[$i]. "</label><br/>
										<input type='submit' name='valider' value=\"" .$surnom[$i]. "\" class='boutonnom boutonnom2'/><br/>
										<input type='submit' name='protection' value='" .$protection[$i]. "' class='boutonnom'/>									
										<input type='submit' name='groupe_relationnel' value='1' class='boutonnom'/>
										<input type='submit' name='groupe_relationnel' value='4' class='boutonnom'/><br/>
										<label>Sympathie le " .$t_s. "</label>
										</form></div>";
									}
								}
							}
						}else
						{
							echo "<div class='div9cadre div10cadre'>" .$relations. "</div>";
						}
					?>
					<div class="div9cadre div10cadre div11cadre">
						<form method="post" action="groupe_relationnel_pro.php" class="form">
							<?php
								for($i = 1; $i <= $nbrpages; $i++)
								{
									echo "<input type='submit' name='page' value=" .$i. " class='boutonamais'/>";
								}
							?>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php include("footer.php"); ?>
	</body>
</html>