<!DOCTYPE html>

<?php
	include_once('connexion_bdd.php');

	session_start();

	if (!isset($_SESSION['pseudo'])) 
	{
 		header('Location: connexion.php');
	}
	else
	{
		$nom = $_SESSION['pseudo'];
		include_once('header_connected.php');
	}

			$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
			$extension_upload = strtolower(substr(strrchr($_FILES['image']['name'],'.'),1));
			if (in_array($extension_upload,$extensions_valides)) 
			{
				$message = "Extension valide";
				$nom_img = "{$_FILES['image']['name']}.{$extension_upload}";
				$upload = "upload/{$_FILES['image']['name']}.{$extension_upload}";
				$resultat = move_uploaded_file($_FILES['image']['tmp_name'],$upload);
			} else 
			{
				$message = "Extension non valide";
			}
?>

<html>
<head>
<meta charset="utf-8" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
<link href="css/signin.css" rel="stylesheet">
<link rel="icon" href="images/icon.png" />
<title>Ajouter article</title>
</head>

<body margin="0 auto">

<div class="container">

	<div class="jumbotron col-xs-10 col-md-8 col-lg-8">
	
	<h3 align="center"><label>Ajouter une nouvelle article</label></h3>
	
			<form id="form1" action="nouvel_article.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="image">Image (JPG, PNG, GIF) * : </label>
				<input id="image" type="file" class="form-control" name="image"/>
			</div>
			<button class="btn btn-danger" type="submit">Uploader l'image &nbsp;<span class="glyphicon glyphicon-upload" aria-hidden="true"></span></button>
			<p>
				<?php
					if (isset($message)) 
					{
						echo "<br />";
						echo('<span class="alert alert-info" role="alert">' .$message. '</span>');
					}
				?>
			</p>
		</form><br/>
				
		<form id="my_form" action="ajout_article.php" method="post">
		
			<div class="form-group">
				<input id="nom_image" type="text" class="form-control" name="nom_image" value="<?php echo $nom_img; ?>"/>
			</div>
		
				<div class="form-group">
				<label for="description">Description de l'image * : </label>
				<input id="description" type="text" class="form-control" name="description" value="<?php if (isset($_POST['description'])) echo utf8_encode(htmlentities(trim($_POST['description']))); ?>" />
			</div>

			<div class="form-group">
				<input id="pseudo" type="hidden" class="form-control" name="pseudo" value="<?php echo utf8_encode(($nom)); ?>" />
			</div>
			<div class="form-group">
				<label for="categorie"> Cat&eacute;gorie *: </label>
				<input id="categorie" type="text" class="form-control" name="categorie" value="<?php if (isset($_POST['categorie'])) echo utf8_encode(htmlentities(trim($_POST['categorie']))); ?>" />
			</div>
			<div class="form-group">
				<label for="titre">Titre * : </label>
				<input id="titre" type="text" class="form-control" name="titre" value="<?php if (isset($_POST['titre'])) echo utf8_encode(htmlentities(trim($_POST['titre']))); ?>" />
			</div>
			<div class="form-group">
				<label for="content">Contenu * : </label>
				<textarea id="content" class="form-control" name="content"><?php if (isset($_POST['content'])) echo utf8_decode(mysql_escape_string(htmlentities(trim($_POST['content'])))); ?></textarea>
			</div>

			<div class="form-group">
				<input id="date" type="hidden" class="form-control" name="date" value="<?php echo date("Y-m-d"); ?>" />
			</div>
			
			<button class="btn btn-success" type="submit" id="poster">Poster l' article&nbsp;&nbsp;<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></button>
		
			<p>
				<br/>
				<span class="label label-info"> Les champs contenant * sont obligatoires, merci de les remplir!
				</span>
			</p>
			<p>
				<?php
					if (isset($erreur)) 
					{
						echo "<br />";
						echo('<span class="alert alert-danger" role="alert">' .$erreur. '</span>');
					}
				?>
			</p>
		</form>
		
	</div>
</div>

<script type="text/javascript" src="js/jquery.js"></script>
<!--  Script permettant l'envoi du formulaire par AJAX avec le scipt php contenu dans ajout_article.php		-->
<script type="text/javascript">
	$(document).ready(function(){
		// Après soumission du formulaire
		$('#poster').on('click', function(e){
			e.preventDefault();
			var $this = $('#my_form') //Le formulaire
			// Recuperation des valeurs
			var pseudo = $('#pseudo').val();
			var img = $('#nom_image').val();
			var descript = $('#description').val();
			var categ = $('#categorie').val();
			var title = $('#titre').val();
			var date_p = $('#date').val();
			var contenu = $('#content').val();
			
			$ajax({
				url: $this.attr('action'),
				type: $this.attr('method'),
				data: $this.serialize();
				success: function()
				{
					alert('Bien envouyé');
				}
				error: function()
				{
					alert('Non envoyé');
				}
				});
				return false;
		});
		});
</script>

</body>
</html>
