<?php
	require_once('Connexion\modele\connect.php');
	
	
	//		CONNEXION A LA BDD
	function getConnectDir()
	{
		$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connexion->query('SET NAMES UTF8');
		return $connexion;
	}
	
	
	
	
	
	
	/*                                                                                RECUPERATION DES DONNEES DES TABLES                                                                           */
	
	
	
	//		RECUPERATION DES DONNEES DE 'STAFF'
	
	function get_employe()
	{
		$connexion=getConnectDir();
		$requete="SELECT * FROM employé";
		$resultat=$connexion->query($requete); 
		$resultat->setFetchMode(PDO::FETCH_OBJ);
		$employe=$resultat->fetchall(); 
		$resultat->closeCursor();
		return $employe; 
	}
	
	
	
	//
	
	function get_logs()
	{
		$connexion=getConnectDir();
		$requete="SELECT * FROM logs";
		$resultat=$connexion->query($requete); 
		$resultat->setFetchMode(PDO::FETCH_OBJ);
		$logs=$resultat->fetchall(); 
		$resultat->closeCursor();
		return $logs; 
	}
	
	
	
	//		RECUPERATION DES DONNEES DE 'SERVICE'
	
	function get_service()
	{
		$connexion=getConnectDir();
		$requete="SELECT * FROM service";
		$resultat=$connexion->query($requete); 
		$resultat->setFetchMode(PDO::FETCH_OBJ);
		$service=$resultat->fetchall(); 
		$resultat->closeCursor();
		return $service; 
	}
	
	
	
	//		RECUPERATION DES DONNEES DE 'PIECE'
	
	function get_piece()
	{
		$connexion=getConnectDir();
		$requete="SELECT * FROM piece";
		$resultat=$connexion->query($requete); 
		$resultat->setFetchMode(PDO::FETCH_OBJ);
		$piece=$resultat->fetchall(); 
		$resultat->closeCursor();
		return $piece; 
	}
	
	
	
	//		RECUPERATION DES DONNEES DE 'APPARTIENT'
	
	function get_piece_service()
	{
		$connexion=getConnectDir();
		$requete="SELECT * FROM appartient";
		$resultat=$connexion->query($requete); 
		$resultat->setFetchMode(PDO::FETCH_OBJ);
		$piece_service=$resultat->fetchall(); 
		$resultat->closeCursor();
		return $piece_service; 
	}
	
	
	
	//
	
	function get_rdv()
	{
		$connexion=getConnectDir();
		$requete="SELECT DISTINCT * FROM rdv";
		$resultat=$connexion->query($requete); 
		$resultat->setFetchMode(PDO::FETCH_OBJ);
		$nb_rdv=$resultat->fetchall(); 
		$resultat->closeCursor();
		return $nb_rdv; 
	}
	
	
	
	//
	
	function get_etudiant()
	{
		$connexion=getConnectDir();
		$requete="SELECT * FROM etudiant";
		$resultat=$connexion->query($requete); 
		$resultat->setFetchMode(PDO::FETCH_OBJ);
		$etudiant=$resultat->fetchall(); 
		$resultat->closeCursor();
		return $etudiant; 
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*                                                                             FONCTION STAFF                                                                                                   */
	
	
	
	//		AJOUT D'UN MEMBRE DU STAFF
	
	function add_staff($nom_staff,$prenom_staff,$role_staff)
	{
		$connexion=getConnectDir();
		
		$requete=" INSERT INTO employé Values (NULL,'$nom_staff','$prenom_staff','$role_staff')";
		$resultat=$connexion->query($requete);
		$resultat->closeCursor();
		
	}
	
	
	
	//		MODIFICATION D'UN MEMBRE DU STAFF
	
	function modif_staff($id_staff,$nom_staff,$prenom_staff,$role_staff)
	{
		$connexion=getConnectDir();
		$requete=" UPDATE employé SET Nom = '$nom_staff', Prénom = '$prenom_staff' , Rôle = '$role_staff' WHERE idEmployé = $id_staff ";
		$resultat=$connexion->query($requete);
		$resultat->closeCursor();
	}



	//			SUPPRESSION D'UN MEMBRE DU STAFF
	
	function suppr_staff($id_staff)
	{
		$connexion=getConnectDir();
		$requete=" DELETE FROM employé WHERE idEmployé = $id_staff ";
		$resultat=$connexion->query($requete);
		$resultat->closeCursor();
	}

	//		MODIFICATION D'UN LOGS
	
	function modif_logs($id_logs, $login, $pwd,$role)
	{
		$connexion=getConnectDir();
		$requete=" UPDATE logs SET login = '$login', pwd = '$pwd', Role = '$role' WHERE idLogs = $id_logs ";
		$resultat=$connexion->query($requete);
		$resultat->closeCursor();
	}

	//			SUPPRESSION D'UN LOGS
	
	function suppr_logs($id_logs)
	{
		$connexion=getConnectDir();
		$requete=" DELETE FROM logs WHERE idLogs = $id_logs ";
		$resultat=$connexion->query($requete);
		$resultat->closeCursor();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*                                                                             FONCTION SERVICE                                                                                             */
	
	
	
	//		AJOUT D'UN SERVICE
	
	function add_service($nom_service,$prix_service)
	{
		$connexion=getConnectDir();
		$requete=" INSERT INTO service Values (0,$prix_service,'$nom_service')";
		$resultat=$connexion->query($requete);
		$resultat->closeCursor();
	}
	
	
	
	//		MODIFICATION D'UN SERVICE
	
	function modif_service($id_service,$nom_service,$prix_service)
	{
		$connexion=getConnectDir();
		$requete=" UPDATE service SET prix = '$prix_service', nom = '$nom_service' WHERE idService = $id_service ";
		$resultat=$connexion->query($requete);
		$resultat->closeCursor();
	}
	
	
	
	//		SUPPRESSION D'UN SERVICE
	
	function suppr_service($id_service)
	{
		$connexion=getConnectDir();
		$requete=" DELETE FROM service WHERE idService = $id_service ";
		$resultat=$connexion->query($requete);
		$resultat->closeCursor();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*                                                                                      FONCTION PIECE                                                                                  */
	
	
	
	//		AJOUT D'UNE NOUVELLE PIECE 
	
	function add_piece($id_piece,$nom_piece)
	{
		$connexion=getConnectDir();
		
		// creation d'une nouvelle piece
		$requete=" INSERT INTO piece Values ($id_piece,'$nom_piece')";
		$resultat=$connexion->query($requete);
		$resultat->closeCursor();
		
		/* ajout de la piece dans la liste des pieces du service
		$service = get_service();
		
		if(!empty($id_service_piece))
		{
			foreach ($service as $ligne)
			{
				if ($ligne->idService == $id_service_piece)
				{
					$requete2 = " INSERT INTO appartient Values ($id_piece,$id_service_piece)";
					$resultat2=$connexion->query($requete2);
					$resultat2->closeCursor();
				}
			}
		}*/
	}
	
	
	//		MODIFICATION D'UNE PIECE
	
	function modif_piece($id_piece,$nom_piece)
	{
		$connexion=getConnectDir();
		
		// modification du nom de la piece
		$requete=" UPDATE piece SET nom = '$nom_piece' WHERE idPiece = $id_piece ";
		$resultat=$connexion->query($requete);
		$resultat->closeCursor();
	}
	
	
	//		SUPPRESSION D'UNE PIECE
	
	function suppr_piece($id_piece)
	{
		$connexion=getConnectDir();
		
		// suppression de la piece dans la liste des pieces pour les services la necessitant
		$requete2=" DELETE FROM appartient WHERE idPiece = $id_piece ";
		$resultat2=$connexion->query($requete2);
		$resultat2->closeCursor();
		
		// suppression de la piece
		$requete=" DELETE FROM piece WHERE idPiece = $id_piece ";
		$resultat=$connexion->query($requete);
		$resultat->closeCursor();
	}
	
	
	
	//		AFFECTER UNE PIECE A UN SERVICE
	
	function Affecter_Piece($id_piece,$id_service)
	{
		$connexion=getConnectDir();
		
		// suppression de la piece dans la liste des pieces du service
		$requete2=" INSERT INTO appartient Values ($id_piece,$id_service)";
		$resultat2=$connexion->query($requete2);
		$resultat2->closeCursor();
	}


	//		SUPPRESSION D'UNE AFFECTATION
	
	function suppr_affecter_piece($id_piece,$id_service)
	{
		$connexion=getConnectDir();
		
		// suppression de la piece dans la liste des pieces du service
		$requete2=" DELETE FROM appartient WHERE idPiece = $id_piece AND idService = $id_service";
		$resultat2=$connexion->query($requete2);
		$resultat2->closeCursor();
	}