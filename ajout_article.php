<?php

	include_once('connexion_bdd.php');

// on teste l'existance de nos variables et si elles ne sont pas vides
	if ((isset($_POST['categorie']) && !empty($_POST['categorie'])) && (isset($_POST['titre']) && !empty($_POST['titre'])) &&(isset($_POST['content']) && !empty($_POST['content'])) &&(isset($_POST['nom_image']) && !empty($_POST['nom_image'])) &&(isset($_POST['description']) && !empty($_POST['description'])))
	{	
			$categorie = mysql_escape_string($_POST['categorie']);
			$titre = mysql_escape_string($_POST['titre']);
			$contenu = mysql_escape_string($_POST['content']);
			$date = $_POST['date'];
			$image = mysql_escape_string($_POST['nom_image']);
			$description = mysql_escape_string($_POST['description']);
			$nom = mysql_escape_string($_POST['pseudo']);
			
			$req = $bdd->prepare('INSERT INTO articles(categories, titre, contenu, auteur, date_post, image, des_image) VALUES(?, ?, ?, ?, ?, ?, ?)');
			$req->execute(array($categorie, $titre, $contenu, $nom, $date, $image, $description)) or die(' Erreur SQL!'.$req.'<br/>'.mysql_error());
				//header('Location: articles.php');
	}
	else
	{
		$erreur = ' Veuillez remplir tous les champs ';
	}

		?>