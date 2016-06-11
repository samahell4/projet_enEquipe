<!DOCTYPE html>

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
				<h3 align="center">Resultat de votre recherche sur " <span style="color : #333;"><?php echo utf8_encode(safe($_GET['q'])) ; ?> " </span></h3>
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
sleep(5);
	//connexion à la base de données 
	define('DB_NAME','gasypedia');
	define('DB_USER','root');
	define('DB_PASSWORD','');
	define('DB_HOST','localhost');
	 
	$link=mysql_connect(DB_HOST , DB_USER , DB_PASSWORD );
	mysql_select_db(DB_NAME ,$link);
 
	//recherche des résultats dans la base de données
	$result = mysql_query('SELECT * FROM articles WHERE categories LIKE \''.safe($_GET['q']).'%\' OR titre LIKE \''.safe($_GET['q']).'%\' OR auteur LIKE \''.safe($_GET['q']).'%\' ORDER BY categories');
	 
	// affichage d'un message "pas de résultats"
	if(mysql_num_rows($result) == 0)
		{
?>
			<h3 style="text-align:center; margin:10px 0;"> Pas de r&eacute;sultats pour cette recherche</h3>
<?php
		}
		else
		{
		// parcours et affichage des résultats
		while($post = mysql_fetch_object($result))
		{
?>
			<tr>
				<td><?php echo utf8_encode($post->categories); ?></td>
				<td><?php echo utf8_encode($post->titre); ?></td>
				<td><?php echo utf8_encode($post->auteur); ?></td>
				<td><?php echo utf8_encode($post->date_post); ?></td>
				<td><a href="details.php?id=<?php echo $post->id_article; ?>">d&eacute;tails...</a></td>
			</tr>
<?php
		}
		}	
 
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

	include_once('footer.php');
}
?>

			</tbody>
		</table>
	</div>
</div>
</body>
</html>
