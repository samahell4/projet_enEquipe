<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="icon" href="images/icon.png" />
<title>Mini wiki</title>


</head>

<body>

<!--debut du formulaire-->
<form class="ajax" action="search.php" method="get">
  <p>
    <label for="q">Rechercher un article</label>
    <input type="text" name="q" id="q"/>
  </p>
</form>
<!--fin du formulaire-->
 
<!--preparation de l'affichage des resultats-->



<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
  // détection de la saisie dans le champ de recherche
  $('#q').keyup(function()
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
          beforeSend:function()
          {// traitements JS à faire AVANT l'envoi
            $field.after('<img src="images/ajax-loader.gif" alt="loader" id="ajax-loader" />');// ajout d'un loader pour signifier l'action
          }, 
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
