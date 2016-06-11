<!DOCTYPE html>

<?php
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
	<title>Liste-des-articles</title>
</head>
	
<body>
<div class="container-fluid">

	<div class="btn-group">
<button class="btn btn-info">Action</button>
<button class="btn btn-info dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><button>
<ul class="dropdown-menu">
<li><a href="#"><span class="glyphicon glyphicon-user"></span>Dompteurs</a></li>
<li><a href="#"><span class="glyphicon glyphiconpicture"></span> Zoos</a></li>
<li><a href="#"><span class="glyphicon glyphiconscreenshot"></span> Chasseurs</a></li>
<li class="divider"></li>
<li><a href="#"><span class="glyphicon glyphicon-listalt"></span> Autres témoignages</a></li>
</ul>
</div>

	<div>
		<table class="table table-bordered table-striped table-condensed">
			<caption>
				<h3 align="center">----- Liste des articles -----</h3>
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

	// Selection de tous les entrés contenues dans la table
	$req = $bdd->query('SELECT id_article, categories, titre, auteur, date_post FROM articles ORDER BY categories');
	while ($donnees = $req->fetch()) 
	{

?>

				<tr>
					<td><?php echo utf8_encode($donnees['categories']); ?></td>
					<td><?php echo utf8_encode($donnees['titre']); ?></td>
					<td><?php echo utf8_encode($donnees['auteur']); ?></td>
					<td><?php echo utf8_encode($donnees['date_post']); ?></td>
					<td><a href="details.php?id=<?php echo $donnees['id_article']; ?>">d&eacute;tails...</a></td>
				</tr>

<?php

	}

?> 
			</tbody>
		</table>
		
		<form class="col-lg-6">
			<legend>Légende</legend>
			<div class="form-group">
			<label for="texte">Text : </label>
			<input id="text" type="text" class="form-control">
			</div>
			<div class="form-group">
			<label for="textarea">Textarea : </label>
			<textarea id="textarea" type="textarea" class="form-control"></textarea>
			</div>
			<div class="form-group">
			<label for="select">Select : </label>
			<select id="select" class="form-control">
			<option>Option 1</option>
			<option>Option 2</option>
			<option>Option 3</option>
			</select>
			</div>
			<button>Envoyer</button>
		</form>
	</div>
		
</div>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
</body>
</html>