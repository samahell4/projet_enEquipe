<?php
	session_start();

	// sleep de 5s
	sleep(5);

	// Suppression des variables de session et de la session
	session_unset();
	session_destroy();
	// Suppression des cookies de connexion automatique
	setcookie('pseudo', '');
	setcookie('mdp', '');
	// Redirection du visiteur vers le page d'acceuil
	header('Location: index.php');
?>