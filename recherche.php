<!DOCTYPE html>

<?php
sleep(5);
	include_once('connexion_bdd.php');
	include_once('verif_connected.php');
?>

<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<link rel="icon" href="images/icon.png" />
	<title>Resultat de la recherche</title>
</head>
	
<body>
<div class="container-fluid">
	<div>
		<table class="table table-bordered table-striped table-condensed">
			<caption>
				<h3 align="center">----- Resultat de la recherche -----</h3>
			</caption>
			<thead>
				<tr>
					<th>Cat&eacute;gories</th>
					<th>Titre</th>
					<th>Auteur</th>
					<th>Date de publication</th>
					<th>Voir les d&eacute;tails</th>
				</tr>
			</thead>
			<tbody>

<?php

if (isset($_POST['recherche'])) 
{

	$recherche = $_POST['recherche'];
	$recherche2 = mysql_escape_string($recherche);

	
	// Selection de tous les entrés contenues dans la table selon la condition de recherche
	$req = mysql_query('SELECT * FROM articles WHERE categories OR titre OR auteur LIKE \''.safe($_GET['recherche']).'%\' ORDER BY categories');
	if(mysql_num_rows($req) != 0)
		while ($donnees = mysql_fetch_object($req)) 
		{

?>
			<tr>
				<td><?php echo utf8_encode($post->categories); ?></td>
				<td><?php echo utf8_encode($post->titre); ?></td>
				<td><?php echo utf8_encode($post->auteur); ?></td>
				<td><?php echo utf8_encode($post->date_post); ?></td>
				<td><a href="details.php?id=<?php echo $donnees['id_article']; ?>">d&eacute;tails...</a></td>
			</tr>
	


<?php

		}

}
	else
	{
		echo "<h1> Aucun resultat correspondant </h1>";
	}

?> 
			</tbody>
		</table>
	</div>
</div>
<?php
	include_once('footer.php');

/*****
fonctions
*****/
function safe($var)
{
	$var = mysql_real_escape_string($var);
	$var = addcslashes($var,'%_');
	$var = trim($var);
	$var = htmlspecialchars($var);
	return $var;
}
?>

</body>
</html>