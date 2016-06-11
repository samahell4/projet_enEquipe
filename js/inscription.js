$(document).ready(function(){
$("#envoi").click(function{
$.post(
'../inscrit.php', // Un script PHP que l'on va créer juste après
{

	login : $("#pseudo").val(); // Nous récupérons la valeur de nos input que l'on fait passer à connexion.php
	password : $("#motdp").val();
	password2 : $("#confirm").val();
},
function(data)
{
	if(data == 'Success')
	{
		// Le membre est connecté. Ajoutons lui un message dans la page HTML.
		$("#resultat").html("<p>Vous vous êtes inscrit avec succès !</p>");
	}
	else
	{
		// Le membre n'a pas été connecté. (data vaut ici "failed")
		$("#resultat").html("<p>Erreur lors de l'inscription'...</p>");
	}
},
'text'
);
});
});