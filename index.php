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
<title>Mini wiki</title>
</head>

<body>

<div class="container" align="center">
	<p>
		<h2> <span class="label label-success">Bienvenu <?php echo($nom) ; ?> !</span></h2>
	</p>
<div style="align: center;" id="results"></div>
<?php
		$req = $bdd->query('SELECT * FROM articles ORDER BY id_article DESC');
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
		</div>
	</div>

</div>
</div>



<?php
	include_once('footer.php');
?>

</body>
</html>
