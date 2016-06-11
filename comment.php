<?php
include_once('connexion_bdd.php');
//include_once('verif_connected.php');
if ((isset($_POST['comment']) && !empty($_POST['comment']))) 
	{
			$id_article = $_POST['id'];
		// on teste si les 2 mot de passes sont identiques
			$pseudo = mysql_escape_string($_POST['commenteur']);
			$comment = mysql_escape_string($_POST['comment']);
			$id_coment = mysql_escape_string($_POST['id_com']);
			$date_post = mysql_escape_string($_POST['date_post']);

			$req = $bdd->prepare('INSERT INTO commentaire(id_article_comment, commenteur, commentaire, date_comment) VALUES(?, ?, ?, ?)');
			$req->execute(array($id_coment, $pseudo, $comment, $date_post)) or die(' Erreur SQL!'.$req.'<br/>'.mysql_error());
			exit();
	}
?>