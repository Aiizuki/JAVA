<?php
	require_once('Directeur\controleur\controleur.php');
	
	try 
	{
/*                                                             AFFICHAGE PAGE PRINCIPALES                                                     */



		//		AFFICHAGE PAGE STAFF
		if (isset($_POST['login_pwd']))
		{
			Ctlr_aff_logpwd();
		}
		
		//		AFFICHAGE PAGE SERVICE
		elseif (isset($_POST['services']))
		{
			Ctlr_aff_service();
		}
		
		//		AFFICHAGE PAGE PIECE
		elseif (isset($_POST['pieces']))
		{
			Ctlr_aff_piece();
		}
		
		//		
		elseif (isset($_POST['stat_acceuil']))
		{
			Ctlr_aff_stat_acceuil();
		}
		
		
		elseif(isset($_POST['stats']))
		{
			$date_une = $_POST['date_une'];
			$date_deux = $_POST['date_deux'];
			
			Ctlr_aff_stat($date_une,$date_deux);
		}
		
		
		
		elseif(isset($_POST['stats2']))
		{
			Ctlr_aff_stat2();
		}
		
		
		
		
		
		
		
		
		
		
/*                                                                STAFF                                                                   */


		
		
		//		AJOUTER STAFF
		elseif(isset($_POST['add_staff']))
		{
			$nom_staff = $_POST['nom_staff'];
			$prenom_staff = $_POST['prenom_staff'];
			$role_staff_str = $_POST['role_staff_str'];
			
			Ctlr_add_staff($nom_staff,$prenom_staff,$role_staff_str);
		}
		
		//		MODIFIER STAFF
		elseif(isset($_POST['modif_staff']))
		{
			$id_staff = $_POST['id_staff'];
			$nom_staff = $_POST['nom_staff'];
			$prenom_staff = $_POST['prenom_staff'];	
			$role_staff_str = $_POST['role_staff_str'];
			
			Ctlr_modif_staff($id_staff,$nom_staff,$prenom_staff,$role_staff_str);
		}

		//		MODIFIER LOGS
		elseif(isset($_POST['modif_logs'])){
			$id_logs = $_POST['id_logs'];
			$login_staff = $_POST['login_staff'];
			$pwd_staff = $_POST['pwd_staff'];
			$role_staff = $_POST['role_staff'];

			Ctlr_modif_logs($id_logs,$login_staff, $pwd_staff,$role_staff);
		}
		
		//		SUPPRIMER STAFF
		elseif(isset($_POST['suppr_staff']))
		{
			$id_staff = $_POST['id_staff'];
			
			Ctlr_suppr_staff($id_staff);
		}

		//		SUPPRIMER LOGS
		elseif(isset($_POST['suppr_logs']))
		{
			$id_logs = $_POST['id_logs'];
			
			Ctlr_suppr_logs($id_logs);
		}
		
		
		
		
		
		
		
		
		
		
		
/*                                                             SERVICE                                                                        */



		//		AJOUTER SERVICE
		elseif(isset($_POST['add_service']))
		{
			$nom_service = $_POST['nom_service'];
			$prix_service = $_POST['prix_service'];
			
			Ctlr_add_service($nom_service,$prix_service);
		}
		
		//		MODIFIER SERVICE
		elseif(isset($_POST['modif_service']))
		{
			$id_service = $_POST['id_service'];
			$nom_service = $_POST['nom_service'];
			$prix_service = $_POST['prix_service'];
			
			Ctlr_modif_service($id_service,$nom_service,$prix_service);
		}
		
		//		SUPPRIMER SERVICE
		elseif(isset($_POST['suppr_service']))
		{
			$id_service = $_POST['id_service'];
			
			Ctlr_suppr_service($id_service);
		}
		
		
		
		
		
		
		
		
		
		
		
/*                                                             PIECE                                                                           */



		//		AJOUTER PIECE
		elseif(isset($_POST['add_piece']))
		{
			$id_piece = $_POST['id_piece'];
			$nom_piece = $_POST['nom_piece'];
			
			Ctlr_add_piece($id_piece,$nom_piece);
		}
		
		//		MODIFIER PIECE
		elseif(isset($_POST['modif_piece']))
		{
			$id_piece = $_POST['id_piece'];
			$nom_piece = $_POST['nom_piece'];
			
			Ctlr_modif_piece($id_piece,$nom_piece);
		}
		
		//		SUPPRIMER PIECE
		elseif(isset($_POST['suppr_piece']))
		{
			$id_piece = $_POST['id_piece'];
			
			Ctlr_suppr_piece($id_piece);
		}
		
		//		AFFECTER UNE PIECE A UN SERVICE
		elseif(isset($_POST['affecter_piece']))
		{
			$id_piece = $_POST['piece'];
			$id_service = $_POST['id_service'];
			
			Ctlr_Affecter_Piece($id_piece,$id_service);
		}

		//		SUPPRIMER UNE AFFECTATION
		elseif(isset($_POST['suppr_affecter_piece']))
		{
			$id_piece = $_POST['piece'];
			$id_service = $_POST['id_service'];
			Ctlr_suppr_affecter_piece($id_piece,$id_service);
		}
		
		
		//		RETOUR PAGE ACCEUIL DIRECTEUR
		elseif(isset($_POST['retour_dir']))
		{
			Ctlr_aff_acceuil_dir();
		}
		
		//		RETOUR PAGE ACCEUIL STATS
		elseif(isset($_POST['retour_stat']))
		{
			Ctlr_aff_stat_acceuil();
		}
			
		//		DECONNEXION : RETOUR PAGE ACCEUIL CONNEXION
		elseif(isset($_POST['deco']))
		{
			Ctlr_deco();
		}
		
		//		AFFICHAGE PAGE ACCEUIL DIRECTEUR
		else
		{
			Ctlr_aff_acceuil_dir();
		}
	}
	
	
	//		GESTION ERREUR
	catch(Exception $e) 
	{
		$msg = $e->getMessage();
		CtlrErreurDir($msg); 
	}