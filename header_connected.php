<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="css/style.css" />
<link rel="icon" href="images/icon.png" />
<title>Mini wiki</title>



</head>
<body>

<div class="navbar navbar-default">
	 <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         <!-- <a class="navbar-brand" href="#"><img src="images/logo.png" /></a> -->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Accueil</a></li>
			<li class="dropdown">
				<a href="articles.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Articles <span class="caret"></span></a>
              	<ul class="dropdown-menu">
                	<li><a href="nouvel_article.php">Nouvelle article</a></li>
                	<li><a href="articles.php">Listes des articles</a></li>
                	<!--<li><a href="#">Something else here</a></li>
                	<li role="separator" class="divider"></li>
                	<li class="dropdown-header">Nav header</li>
                	<li><a href="#">Separated link</a></li>
                	<li><a href="#">One more separated link</a></li>-->
              	</ul>
			</li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <div class="input-group">
                <form class="ajax navbar-form navbar-right" action="ajax-search.php" method="get">
                    <input class="form-control" placeholder="Recherche..." type="text" name="q" id="q"/>
                    <span class="input-group-btn"><button class="btn btn-primary" type="submit" id="sub"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></span>
                </form>
              </div>
            </li>
          <li><a href="deconnexion.php">Se deconnecter</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
</div>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
  // détection de la saisie dans le champ de recherche
  $('#sub').submit(function()
  {
      $field = $(this);
      $('#results').html('');// on vide les resultats
      $('#ajax-loader').remove();// on retire le loader
     
      // on commence à traiter à partir du 2ème caractère saisie
      if( $field.val().length>1)
      {
        // on envoie la valeur recherché en GET au fichier de traitement
        $.ajax({
          type :'GET',// envoi des données en GET ou POST
          url :'ajax-search.php',// url du fichier de traitement
          data :'q='+$(this).val(),// données à envoyer en  GET ou POST
          success:function(data){// traitements JS à faire APRES le retour d'ajax-search.php
            $('#ajax-loader').remove();// on enleve le loader
            $('#results').html(data);// affichage des résultats dans le bloc
          }
        });
      }    
  });
});

</script>

</body>
</html>
