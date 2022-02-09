<?php
	require_once('Connexion\controleur\controleur.php');
	
	try 
	{ 
		if (isset($_POST['connexion']))
		{
			$login=$_POST['login'];
			$pwd=$_POST['pwd'];
			Ctlr_connexion($login,$pwd);
		}
		else
		{
			Ctlr_aff_acceuil();
		}
	}
	
	catch(Exception $e) 
	{
		$msg = $e->getMessage();
		CtlrErreur($msg); 
	}
