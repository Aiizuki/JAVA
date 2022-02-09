<?php
	require_once('Directeur\modele\modele.php');
	require_once('Directeur\vue\vue.php');
	
	
	
	/*                                                          CONTROLEUR AFFICHAGE                                                            */
	
	
	//		AFFICHAGE PAGE ACCEUIL DIRECTEUR
	function Ctlr_aff_acceuil_dir()
	{
		aff_acceuil_dir();
	}
	
	//		AFFICHAGE PAGE STAFF
	function Ctlr_aff_logpwd()
	{
		aff_logpwd();
	}
	
	//		AFFICHAGE PAGE SERVICE
	function Ctlr_aff_service()
	{
		aff_service();
	}
	
	//		AFFICHAGE PAGE PIECE
	function Ctlr_aff_piece()
	{
		aff_piece();
	}
	
	//		
	function Ctlr_aff_stat_acceuil()
	{
		aff_stat_acceuil();
	}
	
	//
	function Ctlr_aff_stat($date_une,$date_deux)
	{
		aff_stat($date_une,$date_deux);
	}
	
	
	
	
	
	function Ctlr_aff_stat2()
	{
		aff_stat2();
	}
	
	
	
	
	
	
	
	
	
	
	/*																   CONTROLEUR STAFF                                                         */
	
	
	
	//		AJOUTER STAFF
	function Ctlr_add_staff($nom_staff,$prenom_staff,$role_staff_str)
	{
		$role_staff=0;
		if (!empty($nom_staff) && !empty($prenom_staff))
		{
			if($role_staff_str == "directeur")
			{
				$role_staff = 1;
			}
			if($role_staff_str == "agent administratif")
			{
				$role_staff = 2;
			}
			if($role_staff_str == "agent d'acceuil")
			{
				$role_staff = 3;
			}
			add_staff($nom_staff,$prenom_staff,$role_staff);
		}
		else
		{
			Throw new Exception('informations manquantes');
		}
		aff_logpwd();
	}
	
	//		MODIFIER STAFF
	function Ctlr_modif_staff($id_staff,$nom_staff,$prenom_staff,$role_staff_str)
	{
		$role_staff=0;
		if (!empty($id_staff) && !empty($role_staff_str))
		{
			if($role_staff_str == "directeur")
			{
				$role_staff = 1;
			}
			if($role_staff_str == "agent administratif")
			{
				$role_staff = 2;
			}
			if($role_staff_str == "agent d'acceuil")
			{
				$role_staff = 3;
			}
			modif_staff($id_staff,$nom_staff,$prenom_staff,$role_staff);
		}
		else
		{
			Throw new Exception('informations manquantes');
		}
		aff_logpwd();
	}

	//		MODIFIER LOGS
	function Ctlr_modif_logs($id_logs,$login_staff,$pwd_staff,$role_staff)
	{
		if (!empty($id_logs) && !empty($login_staff) && !empty($pwd_staff) && !empty($role_staff))
		{
			modif_logs($id_logs,$login_staff,$pwd_staff,$role_staff);
		}
		else
		{
			Throw new Exception('informations manquantes');
		}
		aff_logpwd();
	}
	
	//		SUPPRIMER STAFF
	function Ctlr_suppr_staff($id_staff)
	{
		if (!empty($id_staff))
		{
			suppr_staff($id_staff);
		}
		else
		{
			Throw new Exception('informations manquantes');
		}
		aff_logpwd();
	}

	//		SUPPRIMER LOGS
	function Ctlr_suppr_logs($id_logs)
	{
		if (!empty($id_logs))
		{
			suppr_logs($id_logs);
		}
		else
		{
			Throw new Exception('informations manquantes');
		}
		aff_logpwd();
	}
	
	
	
	
	/*                                                       CONTROLEUR SERVICE																	*/
	
	
	
	//		AJOUTER SERVICE
	function Ctlr_add_service($nom_service,$prix_service)
	{
		if(!empty($nom_service) && !empty($prix_service))
		{
			add_service($nom_service,$prix_service);
		}
		else
		{
			Throw new Exception('informations manquantes');
		}
		aff_service();
	}
	
	//		MODIFIER SERVICE
	function Ctlr_modif_service($id_service,$nom_service,$prix_service)
	{
		if(!empty($id_service))
		{
			modif_service($id_service,$nom_service,$prix_service);
		}
		else
		{
			Throw new Exception('informations manquantes');
		}
		aff_service();
	}
	
	//		SUPPRIMER SERVICE
	function Ctlr_suppr_service($id_service)
	{
		if (!empty($id_service))
		{
			suppr_service($id_service);
		}
		else
		{
			Throw new Exception('informations manquantes');
		}
		aff_service();
	}
	
	
	
	
	
	
	
	/*                                                                  CONTROLEUR PIECE													*/
	
	
	
	//		AJOUTER PIECE
	function Ctlr_add_piece($id_piece,$nom_piece)
	{
		$service = get_service();
		
		if(!empty($id_piece) && !empty($nom_piece))
		{
			add_piece($id_piece,$nom_piece);
		}
		else
		{
			Throw new Exception('informations manquantes');
		}
		aff_piece();
	}
	
	//		MODIFIER PIECE
	function Ctlr_modif_piece($id_piece,$nom_piece)
	{
		$service = get_service();
		
		if(!empty($id_piece))
		{
			modif_piece($id_piece,$nom_piece);
		}
		else
		{
			Throw new Exception('informations manquantes');
		}
		aff_piece();
	}
	
	//		SUPPRIMER PIECE
	function Ctlr_suppr_piece($id_piece)
	{
		if (!empty($id_piece))
		{
			suppr_piece($id_piece);
		}
		else
		{
			Throw new Exception('informations manquantes');
		}
		aff_piece();
	}
	
	//		AFFECTER UNE PIECE A UN SERVICE
	function Ctlr_Affecter_Piece($id_piece,$id_service)
	{
		if (!empty($id_piece) && !empty($id_service))
		{
			Affecter_piece($id_piece,$id_service);
		}
		else
		{
			Throw new Exception('informations manquantes');
		}
		aff_piece();
	}

	//		SUPPRIMER UNE AFFECTATION
	function Ctlr_suppr_affecter_piece($id_piece,$id_service)
	{
		if (!empty($id_piece) && !empty($id_service))
		{
			suppr_affecter_piece($id_piece,$id_service);
		}
		else
		{
			Throw new Exception('informations manquantes');
		}
		aff_piece();
	}
	
	
	
	
	
	
	
	//		CONTROLEUR DECONNEXION
	function Ctlr_deco()
	{
		require_once('C:\wamp64\www\Sprint\connexion.php');
	}
	
	
	//		CONTROLEUR AFFICHAGE ERREUR
	function CtlrErreurDir($msg)
	{
		afficherErreurDir($msg);
	}
	
	
	
	
