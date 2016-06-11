<?php
	include_once('connexion_bdd.php');
	die('La reponse du serveur');
	$id = $_GET['id'];
	$req = $bdd->query('DELETE FROM commentaire WHERE id_article_comment ='.$id);
	$req2 = $bdd->query('DELETE FROM articles WHERE id_article=' .$id);
	header('Location: articles.php');
	exit();
?>