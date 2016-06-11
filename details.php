<!DOCTYPE html>

<?php
	include_once('connexion_bdd.php');
	include_once('verif_connected.php');
?>

<html>
<head>
<meta charset="utf-8" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="css/style.css" />
<link rel="icon" href="images/icon.png" />
<title>D&eacute;tails de l'article</title>
</head>

<body>
	<?php
		$id = $_GET['id'];

		// Selection de tous les entrés contenues dans la table
		$req = $bdd->query('SELECT * FROM articles WHERE id_article=' .$id);
		$donnes = $req->fetch();
	?>

<div class="container-fluid">
	<div class="panel panel-success">
		<div class="panel-heading"  align="center">
			<h3 class="panel-title"><?php echo utf8_encode($donnes['titre']) ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; <?php echo utf8_encode($donnes['date_post']); ?></h3>
		</div>

		<div class="panel-body">
			<h4 align="center" style="color:#333">Dans la cat&eacute;gorie : --- <?php echo utf8_encode($donnes['categories']); ?></h4>
			<div class="col-xs-3 col-md-3 col-lg-2">
				<img src="upload/<?php echo($donnes['image']); ?>" class="img-thumbnail">
				<small class="pull-center"><?php echo utf8_encode($donnes['des_image']); ?></small><br>
			</div>
			
			<blockquote>
				<?php
					echo utf8_encode($donnes['contenu']);
				?><br/><br/>
				<small class="pull-right">Post&eacute; par : <?php echo utf8_encode($donnes['auteur']); ?></small><br>
			</blockquote>
				<div class="pull-right">
					<a href="edit.php?id=<?php echo $_GET['id']?>"><button class="btn btn-default">Editer&nbsp; &nbsp;<span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>
				</div>
		</div>
	</div>


<div class="jumbotron col-xs-11 col-md-11 col-lg-11" id="commentaire">

<?php

	define('DB_NAME','gasypedia');
	define('DB_USER','root');
	define('DB_PASSWORD','');
	define('DB_HOST','localhost');
	 
	$link=mysql_connect(DB_HOST , DB_USER , DB_PASSWORD );
	mysql_select_db(DB_NAME ,$link);

	$id = $_GET['id'];
		// Selection de tous les entrés contenues dans la table
	$result = mysql_query('SELECT * FROM commentaire WHERE id_article_comment ='.$id) or die(mysql_error());
	
	if(mysql_num_rows($result) > 0)
	{
		// parcours et affichage des résultats
		while($comment = mysql_fetch_object($result))
		{
?>
<div class=" col-xs-10 col-md-8 col-lg-8" id="commentaire">
	<div>
		<blockquote>
		<img src="images/avatar.png ?>" class="img-thumbnail"><small><?php echo utf8_encode($comment->commenteur); ?></small><br/>
			<?php
				echo utf8_encode($comment->commentaire);
			?>
		<br>

		<small class="pull-right"> Le : <?php echo utf8_encode($comment->date_comment); ?></small>

		</blockquote>
	</div>
</div>
<br>
<br>

<?php
		}
	}
	else
	{
?>

<script type="text/javascript">
	document.getElementById('commentaire').style.display = 'none';
</script>


<?php
		
	}

if ((isset($_POST['comment']) && !empty($_POST['comment']))) 
	{
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
</div>

    <form class="jumbotron col-xs-10 col-md-8 col-lg-8" action="" method="post" id="mon_form">
		<div class="form-group">
			<label for="comment" >Laisser un commentaire : </label>
			<textarea id="comment" class="form-control" name="comment"></textarea>
		</div>
		<div class="form-group">
			<input id="commenteur" type="hidden" class="form-control" name="commenteur" value="<?php echo utf8_encode(($nom)); ?>" />
		</div>
		<div class="form-group">
			<input id="date_post" type="hidden" class="form-control" name="date_post" value="<?php echo date('Y-m-d')?>" />
		</div>
		<div class="form-group">
			<input id="id_com" type="hidden" class="form-control" name="id_com" value="<?php echo $_GET['id']; ?>" />
		</div>
        <div class="pull-right">
       		<span class="input-group-btn"><button class="btn btn-default" type="submit" id="envoie">Commenter&nbsp; &nbsp;<span class="glyphicon glyphicon-comment" aria-hidden="true"></span></button></span>
    	</div>
    </form>

</div>

<?php	include_once('footer.php'); ?>
<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
(function($){
	$(document).ready(function(){
		$('#my_form').on('submit', function(e){
			e.preventDefault();
			var $form = $(this);
			$.post($form.attr('action'),$form.serializeArray())
				.done(function(data, text, jqxhr){
					$rep = $(jqxhr.responsetext);
					$('#commentaire').prepend($rep);
					$rep.hide().fadeIn();
			})
			.fail(function(jqxhr){
				alert(jqxhr.responseText);
			})
			.always(function(){
				$form.find('button').text('Commenter');
		});
});
})jQuery);
</script>

</body>
</html>