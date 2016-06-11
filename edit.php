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
		//include_once('left_sidebar.php');
		include_once('header_connected.php');
	}

	
?>


<?php
	include_once('connexion_bdd.php');
		$id = $_GET['id'];

		if ((isset($_POST['categorie']) && !empty($_POST['categorie'])) && (isset($_POST['titre']) && !empty($_POST['titre'])) &&(isset($_POST['contenu']) && !empty($_POST['contenu'])) &&(isset($_POST['date']) && !empty($_POST['date'])) &&(isset($_POST['description']) && !empty($_POST['description'])))
	{

			$pseudo = mysql_escape_string($_POST['pseudo']);
			$cat = mysql_escape_string(sha1($_POST['categorie']));
			$contenu = mysql_escape_string(sha1($_POST['contenu']));
			$date = mysql_escape_string(sha1($_POST['date']));
			$description = mysql_escape_string(sha1($_POST['description']));
			$titre = mysql_escape_string(sha1($_POST['titre']));

			$req = $bdd->prepare('UPDATE articles SET (categories= :categ, titre= :titl, contenu= :content, auteur= :aut, date_post= :datepost, des_image= :descript) WHERE id_article =' .$id);
			$req->execute(array('categ'=>$cat, 'titl'=>$titre, 'content'=>$contenu, 'aut'=>$pseudo, 'datepost'=>$date, 'descript'=>$description)) or die(' Erreur SQL!'.$req.'<br/>'.mysql_error());

			header('Location: articles.php');
			exit();
	}
	else
	{
		$erreur = ' Veuillez remplir tous les champs ';
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
<?php
	$req = $bdd->query('SELECT * FROM articles WHERE id_article = ' .$id);
	while ($affichage = $req->fetch()) 
	{
?>
<div class="container">
	<div class="jumbotron col-xs-10 col-md-8 col-lg-8">
		<form id="my_form" method="POST" action="edit.php?id=<?php echo $id;?>" enctype="multipart/form-data">
			<h3 align="center"><label>Editer l' article</label></h3>
			<div class="form-group">
				<input id="pseudo" type="hidden" class="form-control" name="pseudo" value="<?php echo utf8_encode(($nom)); ?>" />
			</div>
			<div class="form-group">
				<input id="identif" type="hidden" class="form-control" name="identif" value="<?php echo $affichage['id_article']; ?>" />
			</div>
			<div class="form-group">
				<label for="categorie"> Cat&eacute;gorie *: </label>
				<input id="categorie" type="text" class="form-control" name="categorie" value="<?php echo $affichage['categories']; ?>" />
			</div>
			<div class="form-group">
				<label for="titre">Titre * : </label>
				<input id="titre" type="text" class="form-control" name="titre" value="<?php echo $affichage['titre']; ?>" />
			</div>
			<div class="form-group">
				<label for="content">Contenu * : </label>
				<textarea id="content" class="form-control" name="content"><?php echo $affichage['contenu']; ?></textarea>
			</div>

			<div class="form-group">
				<label for="date">Date * : </label>
				<input id="date" type="text" class="form-control" name="date" placeholder=" Format &agrave; respecter : aaaa-mm-jj " value="<?php echo $affichage['date_post']; ?>" />
			</div>
			<div class="hidden" id="image_preview">
			</div>
			<div class="form-group">
				<label for="description">Description de l'image * : </label>
				<input id="description" type="text" class="form-control" name="description" value="<?php echo $affichage['des_image']; ?>" />
			</div>		
<?php 
}
 ?>

			<button class="btn btn-success" type="submit">Poster l' article&nbsp;&nbsp;<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></button>
		
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
<!--<script type="text/javascript">
	
	$(function(){
		$('#my_form').on('submit', function(e){
			// On empêche d'abord le navigateur de soumettre le formulaire
			e.preventDefault();

			var $form = $(this);
			var formdata = (window.FormData) ? new FormData($form[0]) : null;
			var data = (formdata !== null) ? formdata : $form.serialize();

			$ajax({

				url: $form.attr('action'),
				type: $form.attr('method'),
				dataType: 'json', // Le retour attendu
				data: data,
				success: function(response){
					// La repponse du serveur
				}

			});
		});
	});

</script>-->



</body>
</html>
