<?php
	require_once('Connexion/modele/connect.php');
	
	function getConnectAcc()
	# cette fonction initialise la connection à notre base de données
	{
		$connexion=new PDO('mysql:host='.'localhost'.';dbname='.'Sprint','root','');
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connexion->query('SET NAMES UTF8');
		return $connexion;
	}

	function getListe_Etud(){
	# cette fonction permet de sélectionner toute la table étudiant et dans la transformer en liste
		$conn=getConnectAcc();
		$requete = "SELECT * FROM Etudiant";
		$result = $conn->query($requete);
		$result->setFetchMode(PDO::FETCH_OBJ);
		$liste_Etud = $result->fetchall();
		$result->closeCursor();
		return $liste_Etud;
	}

	function getListe_Service(){
		# cette fonction permet de sélectionner toute la table service et dans la transformer en liste
			$conn=getConnectAcc();
			$requete = "SELECT nom FROM Service";
			$result = $conn->query($requete);
			$result->setFetchMode(PDO::FETCH_OBJ);
			$liste_Service = $result->fetchall();
			$result->closeCursor();
			return $liste_Service;
		}

	function ajouter_etud($numEtudiant,$nom,$prenom,$date,$adresse,$mail,$tel,$montantDiffere,$montantDiffereAutorise){
		$conn=getConnectAcc();
		$sql= $conn->prepare("SELECT * FROM Etudiant WHERE numEtudiant=?");
		$sql->execute([$numEtudiant]);
		$verif=$sql->fetch();
		if($verif){
			$rep = "0";
		}

		else{
			if(empty($montantDiffereAutorise)){
				if(empty($montantDiffere)){
					$requete="INSERT INTO Etudiant VALUES ('$numEtudiant', '$nom', '$prenom', '$date', '$adresse', '$tel', '$mail', NULL, NULL)";
					$rep = "1";	
				}

				else {
					$montantDiffereAutorise = $montantDiffere;
					$requete="INSERT INTO Etudiant VALUES ('$numEtudiant', '$nom', '$prenom', '$date', '$adresse', '$tel', '$mail', $montantDiffereAutorise, $montantDiffere)";
					$rep = "1";
				}
			}

			else if (empty($montantDiffere)){
				if(empty($montantDiffereAutorise)){
					$requete="INSERT INTO Etudiant VALUES ('$numEtudiant', '$nom', '$prenom', '$date', '$adresse', '$tel', '$mail', NULL, NULL)";
					$rep = "1";
				}

				else {
					$montantDiffere = 0;
					$requete="INSERT INTO Etudiant VALUES ('$numEtudiant', '$nom', '$prenom', '$date', '$adresse', '$tel', '$mail', $montantDiffereAutorise, $montantDiffere)";
					$rep = "1";
				}
			}


			else {
				$requete="INSERT INTO Etudiant VALUES ('$numEtudiant', '$nom', '$prenom', '$date', '$adresse', '$tel', '$mail', $montantDiffereAutorise, $montantDiffere)";
				$rep = "1";
			}

			if($rep == 1){
				$result=$conn->query($requete);
				$result->closeCursor();
			}
		}

		return $rep;
	}

	function getNumEtud($numEtudiant){
		$sql = $conn->prepare("SELECT * FROM Etudiant WHERE numEtudiant=?");
		$sql->execute([$numEtudiant]);
		$rep = $sql->fetchall();
		return $rep;
	}

	function getEtud($numEtudiant){
		$conn = getConnectAcc();
		$sql = $conn->prepare("SELECT * FROM Etudiant WHERE numEtudiant=?");
		$sql->execute([$numEtudiant]);
		$rep = $sql->fetch();
		return $rep;
	}

	

	function UpdateEtud($numEtudiant,$nom,$prenom,$dateDeNaissance,$adresse,$mail,$numTel,$montantDiffere,$montantDiffereAutorise){
		$conn = getConnectAcc();
		$rep = 0;

        $requete = $conn->prepare('UPDATE Etudiant SET nom = :nom, prenom = :prenom, dateDeNaissance = :dateDeNaissance, adresse = :adresse, mail = :mail, numTel = :numTel, montantDiffere = :montantDiffere, montantDiffereAutorise = :montantDiffereAutorise WHERE numEtudiant = :numEtudiant');
        $requete->execute(array('nom'=>$nom, 'prenom'=>$prenom, 'dateDeNaissance'=>$dateDeNaissance, 'adresse'=>$adresse, 'mail'=>$mail, 'numTel'=>$numTel, 'montantDiffere'=>$montantDiffere, 'montantDiffereAutorise'=>$montantDiffereAutorise, 'numEtudiant'=>$numEtudiant));
		
		$rep = 1;
		return $rep;
				
        
    }
	
	function VerifEtud($numEtudiant){
		$conn = getConnectAcc();
		$sql= $conn->prepare("SELECT numEtudiant FROM Etudiant WHERE numEtudiant=?");
		$sql->execute([$numEtudiant]);
		$verif=$sql->fetch();
		
		if($verif){
			$rep = "1";
		}

		else{
			$rep = "0";
		}

		return $rep;

		
	}

	function VerifRDV($admin, $jour, $heure){
		$conn=getConnectAcc();
		$heure = $heure * 10000;
        $requete = ("SELECT * FROM RDV WHERE idStaff=$admin AND date='$jour' AND horaire='$heure'");
        $result = $conn->query($requete);
        $result->setFetchMode(PDO::FETCH_OBJ);
        $Rdv = $result->fetch();
        $result->closeCursor();
		
		if($Rdv){
			$rep = "1";
		}

		else{
			$rep = "0";
		}

		return $rep;

		
	}

	function getListe_Paiements($numEtudiant){
		# cette fonction permet de sélectionner toute RDV, de ne conserver que ceux qui concernent l'étudiant sélectionné et dont le statut est différent de "payé", et les envois dans mon vue (afin de les transformer en checklist)
			$conn=getConnectAcc();
			$requete = "select nomService, prix, statut, idRDV from RDV where numEtudiant = '$numEtudiant' and statut != 'payé'";
			$result = $conn->query($requete);
			$result->setFetchMode(PDO::FETCH_OBJ);
			$liste_Etud = $result->fetchall();
			$result->closeCursor();
			return $liste_Etud;
		}

	function Differer($ligne, $numEtudiant){
		$conn = getConnectAcc();
		$requete = $conn->prepare('update RDV set statut  = :statut WHERE idRDV = :id and numEtudiant = :numEtudiant');
		$sql= $conn->prepare("select statut from RDV where numEtudiant = :numEtudiant and idRDV = :id");
		$sql->execute(array('numEtudiant'=>$numEtudiant, 'id'=>$ligne,));
		$verif=$sql->fetch();
		$statutPaiement = $verif[0];
		if($statutPaiement != "En differé"){
			$sql2 = $conn->prepare("select montantDiffere, montantDiffereAutorise from Etudiant where numEtudiant = ?");
			$sql3 = $conn->prepare("select prix from RDV where idRDV = ? and numEtudiant = ?");
			$sql3->execute([$ligne, $numEtudiant]);
			$x = $sql3->fetch();
			$prixService = $x[0];  # $x sert de mémoire temporaire pour récupérer une seule valeur de l'Array retourné par sql2 et sql3
			$sql2->execute([$numEtudiant]);
			$x = $sql2->fetch();
			$SoldeMAX = $x[1];
			$Solde = $x[0];
			$NewSolde = $Solde + $prixService;
			# $sql2, une fois exécutée, retourne un tableau avec montantDiffere en indice 0 et montantDiffereAutorise en indice 1.
			if ($NewSolde <= $SoldeMAX){
				$requete->execute(array(
					'id'=>$ligne,
					'numEtudiant'=>$numEtudiant,
					'statut'=>'En differé',
				   ));
				   $sql4 = $conn->prepare('UPDATE Etudiant SET montantDiffere = :montantDiffere WHERE numEtudiant = :numEtudiant');
				   $sql4->execute(array('montantDiffere'=>$NewSolde, 'numEtudiant'=>$numEtudiant));
			}

			else if ($NewSolde > $SoldeMAX){
				echo "Plafond dépassé, transaction impossible";
			}

			else {echo "comprends pas";};
		}
		
	}

	function Encaisser($ligne, $numEtudiant){
		$conn = getConnectAcc();
		$requete = $conn->prepare('update RDV set statut  = :statut WHERE idRDV = :id and numEtudiant = :numEtudiant');
		$sql = "SELECT prix FROM RDV WHERE idRDV = '$ligne' AND numEtudiant = '$numEtudiant'";
		$sql2 = "SELECT montantDiffere FROM Etudiant WHERE numEtudiant = '$numEtudiant'";
		$sql3 = "SELECT statut FROM RDV WHERE idRDV = '$ligne' and numEtudiant = '$numEtudiant'";
		$result = $conn->query($sql);
		$result2 = $conn->query($sql2);
		$result3 = $conn->query($sql3);
		$rep = $result->fetch();
		$rep2 = $result2->fetch();
		$rep3 = $result3->fetch();
		$result -> closeCursor();
		$result2 -> closeCursor();
		$result3 -> closeCursor();
		
		
		$newSolde = ($rep2[0]) - ($rep[0]);

		if($rep3[0] == "En differé"){
			$requete2 = $conn->prepare('UPDATE Etudiant SET montantDiffere = :solde');
			$requete2->execute(array('solde'=>$newSolde));
		}

		$requete->execute(array(
                 'id'=>$ligne,
				 'numEtudiant'=>$numEtudiant,
				 'statut'=>'payé',
				));
		
	}

	function SearchAdmin($dateRDV, $horaire){

		$conn = getConnectAcc();
		$requete = "SELECT idEmployé, Nom, Prénom FROM Employé WHERE idEmployé NOT IN (SELECT idStaff FROM RDV WHERE date = '$dateRDV' AND horaire = '$horaire') AND Rôle = 2";
		$result = $conn->query($requete);
		$result->setFetchMode(PDO::FETCH_OBJ);
		$rep = $result->fetchall();
		$result -> closeCursor();
		
		if ($rep){
			return $rep;
		}

		else{
			$rep =0;
			return $rep;
		}
	}

	function SearchEtud($nom_etud, $dateDeNaissance){
		$conn = getConnectAcc();

		$requete = "SELECT numEtudiant FROM Etudiant WHERE nom = '$nom_etud' AND dateDeNaissance = '$dateDeNaissance'";
		$result = $conn->query($requete);
	
		$rep = $result->fetch();
		$result -> closeCursor();

		if ($rep){
			return $rep;
		}

		else {
			return 0;
		}


	}

	function InfoService($nom_service){
		$conn = getConnectAcc();
		$requete = "SELECT idService, prix FROM Service WHERE nom = '$nom_service'";
		$result = $conn->query($requete);
		$result->setFetchMode(PDO::FETCH_OBJ);
		$rep = $result->fetch();
		$result -> closeCursor();
		return $rep;
	}

	function CreateRDV($id_service, $etudiant, $admin, $nomService, $prix_service, $date, $horaire){
		$conn = getConnectAcc();
		$horaire = $horaire * 10000;
		$requete = "INSERT INTO RDV VALUES (NULL, '$id_service', '$etudiant', '$admin','$nomService', '$prix_service', '$date', '$horaire', 'en attente de paiement')";
		$result = $conn->query($requete);
		$result->setFetchMode(PDO::FETCH_OBJ);
		$result -> closeCursor();
		return 1;
	}

	function getTableauRdv($liste_Rdv,$semaine_Rdv,$idStaff,$numEtudiant,$service){
        $Planning = "";
        $diff1Day = new DateInterval('P1D');
        for ($Heure = 8; $Heure <= 20; $Heure++) {
            $Planning .= "<tr>";
			$diffDay = new DateTime($semaine_Rdv);
			$Planning .="<td>";
			$Planning .= "$Heure";
			$Planning .= "h";
			$Planning .="</td>";
            for ($ChaqueJour = 0; $ChaqueJour <= 6; $ChaqueJour++) {
				$Planning .="<td>";
				$balise = 1;
                foreach ($liste_Rdv as $ligne) {
					$LaVraieDate = new DateTime($ligne->date);
                    if (($Heure == $ligne->heure) && ($LaVraieDate->format('Y-m-d') == $diffDay->format('Y-m-d'))){
						$Planning .= '<form id="SteakRdv" action ="Agent_Acc.php" method="post">';
                        $Planning .= '<input type="hidden" value="';
                        $Planning .= $idStaff;
						$Planning .= '" name="idStaff">';
						$Planning .= '<input type="hidden" value="';
						$Planning .= $numEtudiant;
						$Planning .= '" name="numEtudiant">';
						$Planning .= '<input type="hidden" value="';
                        $Planning .= $service;
						$Planning .= '" name="service">';
						$Planning .= '<input type="hidden" value="';
						$Planning .= $semaine_Rdv;
						$Planning .= '" name="week">';
						$Planning .= '<input type="hidden" value="';
						$Planning .= $diffDay->format('Y-m-d');
						$Planning .= '" name="jour">';
						$Planning .= '<input type="hidden" value="';
                    	$Planning .= $ligne->idRDV;
						$Planning .= '" name="idRDV">';
						$Planning .= '<input type="hidden" value="';
                    	$Planning .= $ligne->heure;
                    	$Planning .= '" name="horaire">';
						$Planning .='<input type="hidden" value="';
						if(!empty($ligne->statut) && $ligne->statut != "formation"){
							$Planning .= 'RDV';
						}

						else {
							$Planning .= 'Formation';
						}
						$Planning .= '" name="Type">';
						$balise = 0;
                    }
                    else{
						$Planning .='';
					}
				}
				if($balise == 1){
					$Planning .= '<form id="SteakRdv" action ="Agent_Acc.php" method="post">';
					$Planning .= '<input type="hidden" value="';
                    $Planning .=$idStaff;
					$Planning .='" name="idStaff">';
					$Planning .= '<input type="hidden" value="';
					$Planning .= $numEtudiant;
					$Planning .= '" name="numEtudiant">';
					$Planning .= '<input type="hidden" value="';
                    $Planning .=  $service;
					$Planning .= '" name="service">';
					$Planning .= '<input type="hidden" value="';
					$Planning .= $semaine_Rdv;
					$Planning .= '" name="week">';
					$Planning .= '<input type="hidden" value="';
                    $Planning .= $diffDay->format('Y-m-d');
					$Planning .= '" name="jour">';
					$Planning .= '<input type="hidden" value="';
					if(!empty($ligne)){
						$Planning .= $ligne->idRDV;
					}
					else{
						$Planning .= " ";
					}
					$Planning .= '" name="idRDV">';
					$Planning .= '<input type="hidden" value="';
					$Planning .= $Heure;
                    $Planning .= '" name="horaire">';
					$Planning .= '<input type="hidden" value="';
					$Planning .= 'Libre';
					$Planning .= '" name="Type">';
					$Planning .='<input type="submit" class="BoutonDispo" name = "SteakRDV">';
					$Planning .= '</form>';
				}
				else {
					$Planning .= '<input type="submit" class="BoutonIndispo" name = "SteakRDV">';
					$Planning .= '</form>';
				}
                $Planning .="</td>";
            date_add($diffDay,$diff1Day);
            }
            $Planning .= "</tr>";
        }
        return $Planning;
	}
	
	function getSteak($Steak){
        $conn=getConnectAcc();
        $requete = ("SELECT idRDV, idService, numEtudiant, nomService, prix, date, HOUR(horaire) AS heure,statut FROM rdv WHERE idRDV=$Steak");
        $result = $conn->query($requete);
        $result->setFetchMode(PDO::FETCH_OBJ);
        $SteakRdv = $result->fetch();
        $result->closeCursor();
        return $SteakRdv;
	}
	
	function getListeRdv($cible){
        $conn=getConnectAcc();
        $requete = ("SELECT idRDV, idService, numEtudiant, nomService, prix, date, HOUR(horaire) AS heure,statut FROM rdv WHERE idStaff=$cible");
        $result = $conn->query($requete);
        $result->setFetchMode(PDO::FETCH_OBJ);
        $ListeRdv = $result->fetchall();
        $result->closeCursor();
        return $ListeRdv;
	}

    function getListe_Agents(){
        $conn=getConnectAcc();
        $requete = ("SELECT idEmployé, Nom, Prénom FROM employé WHERE Rôle=2 ");
        $result = $conn->query($requete);
        $result->setFetchMode(PDO::FETCH_OBJ);
		$liste_Staff = $result->fetchall();
        $result->closeCursor();
        return $liste_Staff;
	}
	
	function get_piece_service($service)
    {
        $connexion=getConnectAcc();
        $requete="SELECT idPiece FROM appartient WHERE idService = $service";
        $resultat=$connexion->query($requete); 
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        $piece_service=$resultat->fetchall(); 
        $resultat->closeCursor();
        return $piece_service; 
	}
	
	function get_piece($piece)
    {
        $connexion=getConnectAcc();
        $requete="SELECT nom FROM piece WHERE idPiece = $piece";
        $resultat=$connexion->query($requete); 
        $piece=$resultat->fetch(); 
        $resultat->closeCursor();
        return $piece;
    }

