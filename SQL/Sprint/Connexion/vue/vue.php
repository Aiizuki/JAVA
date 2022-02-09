<?php
	function aff_acceuil()
	{
		$contenu='';
		require_once('Connexion\vue\gabarit.php');
	}
	
	function afficherErreur($erreur)
	{
		$contenu='<p>'.$erreur.'</p>';
		require_once('Connexion\vue\gabarit.php'); 
	}
