<?php
	require_once('Connexion\modele\connect.php');
	
	function getConnect()
	{
		$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connexion->query('SET NAMES UTF8');
		return $connexion;
	}
	
	function get_login_pwd()
	{
		$connexion=getConnect();
		
		$requete="SELECT * FROM logs";
		$resultat=$connexion->query($requete); 
		$resultat->setFetchMode(PDO::FETCH_OBJ);
		$login_pwd=$resultat->fetchall();
		$resultat->closeCursor();
		return $login_pwd; 
	}