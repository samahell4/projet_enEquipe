<!DOCTYPE html>

<?php
	include_once('connexion_bdd.php');
	// Attente de php en 5sec pour ralentir un peu la requete
	sleep(5);

	if(((isset($_POST['login'])) && !empty($_POST['login'])) && ((isset($_POST['pass'])) && !empty($_POST['pass'])))
	{
		$req = $bdd->prepare('SELECT id_membre FROM membres WHERE pseudo = :username AND pass = :password');
		$req->execute(array('pseudo'=>$_POST['login'], 'mdp'=>sha1($_POST['pass'])));
		$resultat = $req->fetch();
		if (!resultat) 
		{
			$erreur = " Vos identifiants sont inexactes !";
		}
		else
		{
			session_start();
			$_SESSION['pseudo'] = $_POST['login'];
			header('Location: index.php');
			exit();
		}
	}
	else
	{
		$erreur = " Veuillez remplir tous les champs ! ";
	}
?>

<html>
<head>
<meta charset="utf-8" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
<link href="css/signin.css" rel="stylesheet">
<link rel="icon" href="images/icon.png" />
<title>Connexion_membre</title>
</head>

<body margin="0 auto">

<?php
	//include_once("header.php");

?>
<div class="container">
	<div class="jumbotron col-xs-10 col-md-8 col-lg-8">
		<form method="POST" action="connexion.php">
			<h3 align="center"><label>Se connecter</label></h3>
			<div class="form-group">
				<label for="pseudo">Votre identifiant : </label>
				<input id="pseudo" name="login" type="text" class="form-control" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>" />
			</div>
			<div class="form-group">
				<label for="motdp">Mot de passe : </label>
				<input id="motdp" name="pass" type="password" class="form-control" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>" />
			</div>

			<button class="btn btn-success" type="submit" id="connecter" >Se connecter&nbsp;&nbsp;<span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
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



</body>
</html>