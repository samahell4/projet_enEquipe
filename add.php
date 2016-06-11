<?php

include_once('connexion_bdd.php');
	$pseudo = mysql_escape_string($_POST['commenteur']);
	$comment = mysql_escape_string($_POST['comment']);
	$id_coment = mysql_escape_string($_POST['id_com']);
	$date_post = mysql_escape_string($_POST['date_post']);

	$req = $bdd->prepare('INSERT INTO commentaire(id_article_comment, commenteur, commentaire, date_comment) VALUES(?, ?, ?, ?)');
	$req->execute(array($id_coment, $pseudo, $comment, $date_post)) or die(' Erreur SQL!'.$req.'<br/>'.mysql_error());
	header('Location: details.php?id=');
	exit();
?>
