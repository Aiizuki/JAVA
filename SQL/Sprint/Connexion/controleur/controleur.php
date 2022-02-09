<?php
	require_once('Connexion\modele\modele.php');
	require_once('Connexion\vue\vue.php');
	
	function Ctlr_connexion($login,$pwd)
	{
		if (!empty($login) && !empty($pwd))
		{
			$login_pwd = get_login_pwd();
			foreach($login_pwd as $ligne)
			{
				if($ligne->login == $login)
				{
					if($ligne->pwd == $pwd)
					{
						if($ligne->idLogs == 1)
						{
							require_once('Directeur.php');
						}
						elseif($ligne->idLogs == 2)
						{
							require_once('Agent_Admin.php');
						}
						elseif($ligne->idLogs == 3)
						{
							require_once('Agent_Acc.php');
						}
					}
					else 
					{
						throw new Exception("login ou mot de passe incorects");
					}
				}				
			}
		}
		else
		{
			throw new Exception("login ou mot de passe manquants");
		}
	}
	
	
	function Ctlr_aff_acceuil()
	{
		aff_acceuil();
	}
	
	function CtlrErreur($msg)
	{
		afficherErreur($msg);
	}
