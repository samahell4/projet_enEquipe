<?php
try
{
	$bdd = new PDO('mysql:host=localhost; dbname=gasypedia', 'root', '');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
?>