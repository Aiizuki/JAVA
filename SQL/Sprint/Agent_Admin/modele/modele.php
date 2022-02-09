<?php
	require_once('Connexion/modele/connect.php');
	
	function getConnectAdmin()
	{
		$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connexion->query('SET NAMES UTF8');
		return $connexion;
	}
	
	function getLeStaff($cible){
		$conn=getConnectAdmin();
		$requete = ("SELECT Nom,Prénom,idEmployé FROM employé WHERE idEmployé=$cible");
		$result = $conn->query($requete);
		$result->setFetchMode(PDO::FETCH_OBJ);
		$LeStaff = $result->fetch();
		$result->closeCursor();
		return $LeStaff;
	}

	function get_piece_service($service)
    {
        $connexion=getConnectAdmin();
        $requete="SELECT idPiece FROM appartient WHERE idService = $service";
        $resultat=$connexion->query($requete); 
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        $piece_service=$resultat->fetchall(); 
        $resultat->closeCursor();
        return $piece_service; 
    }

    function get_piece($piece)
    {
        $connexion=getConnectAdmin();
        $requete="SELECT nom FROM piece WHERE idPiece = $piece";
        $resultat=$connexion->query($requete); 
        $piece=$resultat->fetch(); 
        $resultat->closeCursor();
        return $piece;
    }

	function setBloqueFormation($nomService,$day,$horraire,$idStaff){
		$conn=getConnectAdmin();
		$horraire=$horraire*10000;
		$requete = "INSERT INTO RDV VALUES (NULL, NULL, NULL, '$idStaff','$nomService', NULL, '$day', '$horraire', 'formation')";
		$result = $conn->query($requete);
	}

	function setRdvActualiser($SteakID,$Validité){
		$conn=getConnectAdmin();
		if($Validité =='oui'){
			$requete = "UPDATE rdv SET statut = 'en attente de paiement ' WHERE idRDV=$SteakID";
		}
		else{
			$requete = "DELETE FROM rdv WHERE idRDV=$SteakID";
		}
		$result = $conn->query($requete);

	}

	function getListe_Etud()
	{
		$conn=getConnectAdmin();
		$requete = "SELECT * FROM Etudiant";
		$result = $conn->query($requete);
  		$result->setFetchMode(PDO::FETCH_OBJ);
  		$liste_Etud = $result->fetchall();
  		$result->closeCursor();
  		return $liste_Etud;
	}
	function getEtudiant($cible){
		$conn=getConnectAdmin();
		$requete = ("SELECT * FROM etudiant WHERE numEtudiant=$cible");
		$result = $conn->query($requete);
		$result->setFetchMode(PDO::FETCH_OBJ);
		$LeEtudiant = $result->fetch();
		$result->closeCursor();
		return $LeEtudiant;
	}

	function getListe_Staff()
	{
		$conn=getConnectAdmin();
		$requete = ("SELECT idEmployé, Nom, Prenom FROM employé");
		$result = $conn->query($requete);
  		$result->setFetchMode(PDO::FETCH_OBJ);
  		$liste_Staff = $result->fetchall();
  		$result->closeCursor();
  		return $liste_Staff;
	}

	function getListe_Staff_Administratif(){
		$conn=getConnectAdmin();
		$requete = ("SELECT idEmployé, Nom, Prénom FROM employé WHERE Rôle=2 ");
		$result = $conn->query($requete);
		$result->setFetchMode(PDO::FETCH_OBJ);
		$liste_Staff = $result->fetchall();
		$result->closeCursor();
		return $liste_Staff;
	}

	function getListeRdv($cible){
		$conn=getConnectAdmin();
		$requete = ("SELECT idRDV, idService, numEtudiant, nomService, prix, date, HOUR(horaire) AS heure,statut FROM rdv WHERE idStaff=$cible");
		$result = $conn->query($requete);
		$result->setFetchMode(PDO::FETCH_OBJ);
		$ListeRdv = $result->fetchall();
		$result->closeCursor();
		return $ListeRdv;
	}

	function getSteak($Steak){
		$conn=getConnectAdmin();
		$requete = ("SELECT idRDV, idService, numEtudiant, nomService, prix, date, HOUR(horaire) AS heure,idStaff,statut FROM rdv WHERE idRDV=$Steak");
		$result = $conn->query($requete);
		$result->setFetchMode(PDO::FETCH_OBJ);
		$SteakRdv = $result->fetch();
		$result->closeCursor();
		return $SteakRdv;
	}

	function getTableauRdv($liste_Rdv,$semaine_Rdv,$idStaff){
		$Planning = "";
		$diff1Day = new DateInterval('P1D');
		for ($Heure = 8; $Heure <= 20; $Heure++) {
			$Planning .= "<tr>";
			$Planning .="<td>";
			$Planning .= "$Heure";
			$Planning .= "h";
			$Planning .="</td>";
			$diffDay = new DateTime($semaine_Rdv);
			for ($ChaqueJour = 0; $ChaqueJour <= 6; $ChaqueJour++) {
				$Planning .="<td>";
				$remplis = 0;
				foreach ($liste_Rdv as $ligne) {
					$LaVraieDate = new DateTime($ligne->date);
					if (($Heure == $ligne->heure) && ($LaVraieDate->format('Y-m-d') == $diffDay->format('Y-m-d'))){
						if($ligne->statut != "formation"){
							$Planning .='<form id="SteakRdv" class="bouttons" action ="Agent_Admin.php" method="post"> 
							<input type="hidden" value="';
							$Planning .=$idStaff;
							$Planning .='" name="idStaff"> <input type="hidden" value="';
							$Planning .=$semaine_Rdv;
							$Planning .='" name="week"> <input type="hidden" value="';
							$Planning .=$ligne->idRDV;
							$Planning .='" name="SteakID"> <input type="hidden" value="';
							$Planning .=$diffDay->format('Y-m-d');
							$Planning .='" name="day"> <input type="hidden" value="';
							$Planning .=$Heure;
							$Planning .='" name="heure">
							<input type="hidden" value="" name="message"> 
							<input type="submit" class="LeBoutton" value="';
							$Planning .="rendez-vous \n élève \n";
							$Planning .=$ligne->heure;
							$Planning .=" h";
							$Planning .= '" name="SteakRdv"/></form>';
							$remplis = 1;
						}
						else if($ligne->statut == "formation"){
							{
							$Planning .='<form id="SteakRdv" class="bouttons" action ="Agent_Admin.php" method="post"> 
							<input type="hidden" value="';
							$Planning .=$idStaff;
							$Planning .='" name="idStaff"> <input type="hidden" value="';
							$Planning .=$semaine_Rdv;
							$Planning .='" name="week"><input type="hidden" value="';
							$Planning .=$ligne->idRDV;
							$Planning .='" name="SteakID"> <input type="hidden" value="';
							$Planning .=$diffDay->format('Y-m-d');
							$Planning .='" name="day"> <input type="hidden" value="';
							$Planning .=$Heure;
							$Planning .='" name="heure">
							<input type="hidden" value="" name="message">
							<input type="submit" class="LeBoutton" value="';
							$Planning .="formation \n";
							$Planning .=$ligne->nomService;
							$Planning .="\n";
							$Planning .=$ligne->heure;
							$Planning .=" h";
							$Planning .= '" name="SteakRdv"/></form>';
							$remplis = 1;
						}
						}
					}
					else{
						$Planning .="";
					}
				}
				if ($remplis == 0){
					$Planning .= '<form id="SteakRdv" class="bouttons" action ="Agent_Admin.php" method="post"><input type="hidden" value="';
					$Planning .=$idStaff;
					$Planning .='" name="idStaff"> <input type="hidden" value="';
					$Planning .=$semaine_Rdv;
					$Planning .='" name="week"> <input type ="hidden" value="';
					$Planning .=$diffDay->format('Y-m-d');
					$Planning .='" name="day"> <input type ="hidden" value="';
					$Planning .=$Heure;
					$Planning .='" name="heure"><input type="hidden" value="-1" name="SteakID"><input type="submit" class="LeBoutton" value="" name="SteakRdv"/></form>';
				}
				$Planning .="</td>";
				$Marqueur = 0;
			date_add($diffDay,$diff1Day);
			}
			$Planning .= "</tr>";
		}
		return $Planning;
	}