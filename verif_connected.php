<?php
	session_start();

	if (!isset($_SESSION['pseudo'])) 
	{
 		$nom = "anonyme";
 		include_once("header_non_connected.php");
	}
	else
	{
		$nom = htmlentities(trim($_SESSION['pseudo']));
		//include_once('left_sidebar.php');
		include_once("header_connected.php");
	}
?>