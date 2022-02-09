<?php
	require_once('Agent_Acc/modele/modele.php');
	require_once('Agent_Acc/vue/vue.php');

	function CtlListe($page){
		$liste_Etud = getListe_Etud();
		$liste_Service = getListe_Service();
		$liste_Agents = getListe_Agents();
		PageAvecListe($liste_Etud,$liste_Service,$liste_Agents,$page);
	}

	function CtlAjouter_Etud($numEtudiant,$nom,$prenom,$date,$adresse,$mail,$tel,$montantDiffere,$montantDiffereAutorise){
		if(!empty($numEtudiant) && !empty($nom) && !empty($prenom) && !empty($date) && !empty($adresse) && !empty($mail) && !empty($tel)) {
			$rep=ajouter_etud($numEtudiant,$nom,$prenom,$date,$adresse,$mail,$tel,$montantDiffere,$montantDiffereAutorise);
			if($rep == "1"){
				CtlListe('Agent_Acc/vue/gabarit_etudiant.php');
				echo "l'étudiant à bien été rajouté !";
			}

			else {
				CtlListe('Agent_Acc/vue/gabarit_etudiant.php');
				echo "le numéro d'étudiant associé a déjà été enregistré !";
			}
		}

		else{
			CtlListe('Agent_Acc/vue/gabarit_etudiant.php');
			echo "Certaines informations saisies ne sont pas du type demandé.";
		}	
	}

	
	function CtlAcceuil(){
		PageAcceuil();
	}

	function CtlRDV(){
		CtlListe('Agent_Acc/vue/gabarit_rdv.php');
	}

	function CtlPaiement(){
		PagePaiement();
	}

	function CtlErreur($erreur){
		throwErreur($erreur);
	}

	function CtlSynthese(){
		PageSynthese();
	}

	function CtlModifEtud($numEtudiant){
		getInfoEtud($numEtudiant);
	}

	function CtlUpdateEtud($numEtudiant,$nom,$prenom,$dateDeNaissance,$adresse,$mail,$numTel,$montantDiffere,$montantDiffereAutorise){
		$rep = UpdateEtud($numEtudiant,$nom,$prenom,$dateDeNaissance,$adresse,$mail,$numTel,$montantDiffere,$montantDiffereAutorise);
		if($rep == "1"){
			CtlListe('Agent_Acc/vue/gabarit_synthese.php');
			echo "les informations ont été mises à jour !";
		}

		else {
			CtlListe('Agent_Acc/vue/gabarit_synthese.php');
			echo "Impossible de modifier les informations de l'étudiant, veuillez réessayer.";
		}
	}

	function CtlVerifEtud($numEtudiant){
		$rep = VerifEtud($numEtudiant);
		
		if($rep == "0"){
			echo "Aucun profil étudiant correspondant au numéro saisi.";
		}

		else{
			CtlListePaiement($numEtudiant);
		}
	}


	function CtlListePaiement($numEtudiant){
		$HistoriqueDesPaiements = getListe_Paiements($numEtudiant);
		CheckBox_Paiements($HistoriqueDesPaiements, $numEtudiant);	
	}

	function CtlEncaisser($ligne, $numEtudiant){
		Encaisser($ligne, $numEtudiant);
	}

	function CtlDifferer($ligne, $numEtudiant){
		Differer($ligne, $numEtudiant);
	}

	function CtlSearchAdmin($numEtudiant, $date, $horaire, $service){
		if(!empty($numEtudiant) && !empty($date) && !empty($horaire) && !empty($service)){
			$admin_dispo = SearchAdmin($date, $horaire);
			CheckListAdmin($admin_dispo, $numEtudiant, $date, $horaire, $service);
		}

		else{
			echo "des informations sont incorrectes ou manquantes.";
		}
	}

	function CtlSearchEtud($nom_etud, $dateDeNaissance){
		if(!empty($nom_etud) && !empty($dateDeNaissance)){
			$etud = SearchEtud($nom_etud, $dateDeNaissance);

			if($etud == 0){
				CtlAcceuil();
				echo "aucun étudiant ne correspond aux informations saisies";
			}

			else{
				getInfoEtud($etud[0]);
			}
		}

		else{
			CtlAcceuil();
			echo "les informations saisies sont incorrectes ou incomplètes";
		}
		
	}

	function CtlCreateRDV($service, $date, $horaire, $etudiant, $admin, $Semaine){
		$verif = VerifRDV($admin, $date, $horaire);
		if($verif == 1){
			$horaire = 0;
			$liste_Staff = getListe_Agents();
        	$liste_Rdv = getListeRdv($admin);
			$Spec_Rdv = 'Aucun rendez-vous séléctioné !';
			$tableau_Staff = getTableauRdv($liste_Rdv,$Semaine,$admin,$etudiant,$service,$date);
			$retour = "<p class='erreur'> L'agent sélectionné n'est pas disponible à cette date </p>";
			AfficherPageRdv($tableau_Staff,$liste_Staff,$Spec_Rdv,$etudiant,$service,$Semaine,$horaire,$date,$retour);
		}
		
		else  {
			$nomService = $service;
			$infoservice = InfoService($service);
			$prix_service = $infoservice->prix;
			$id_service = $infoservice->idService;
			$rep = CreateRDV($id_service, $etudiant, $admin, $nomService, $prix_service, $date, $horaire);

			$result = '<div class="centrale">';
			$result .= "<fieldset>";
			
			if($rep){
				CtlRDV();
				$retour =  get_piece_service($id_service);
				$result .= "<p> Le RDV a été créé ! Veillez bien à apporter toutes les pièces si-dessous le jour J :";
				foreach ($retour as $ligne){
					$result .= "<br/>";
					$result .= " - ";
					$result .= get_piece($ligne->idPiece)[0];
				}
			}

			else {
				CtlRDV();
				$result .= "le Rdv n'a pas pu être créé. Veuillez réessayer";
			}

			$result .= "</fieldset>";
			$result .= "</div>";
			echo $result;
		}

		#manque la fonction permettant d'afficher toutes les pièces (justifictifs) à donner pour le service.
		#pour mettre un plafond il faut définir le solde à 0 aussi.
	}

	function CtlAcceuil_Planning($idStaff,$Semaine,$numEtudiant,$service,$jour){
		if(!empty($idStaff) && !empty($Semaine) && !empty($numEtudiant) && !empty($service)){
			$verif = VerifEtud($numEtudiant);
			if($verif == 1){
				$horaire = 0;
				$liste_Staff = getListe_Agents();
        		$liste_Rdv = getListeRdv($idStaff);
				$Spec_Rdv = 'Aucun rendez-vous séléctioné !';
				$tableau_Staff = getTableauRdv($liste_Rdv,$Semaine,$idStaff,$numEtudiant,$service,$jour);
				$retour = "";
        		AfficherPageRdv($tableau_Staff,$liste_Staff,$Spec_Rdv,$numEtudiant,$service,$Semaine,$horaire,$jour,$retour);
			}

			else {
				CtlRDV();
				echo "l'étudiant n'existe pas !";
			}
		}

		else{
			CtlRDV();
			echo "les informations saisies sont incorrectes ou incomplètes";
		}
    }

    function CtlAcceuil_Steak($idStaff,$Semaine,$idRDV,$Type_Rdv,$numEtudiant,$service,$horaire,$jour){
		$liste_Staff = getListe_Agents();
		$liste_Rdv = getListeRdv($idStaff);
		if($Type_Rdv == "Libre"){
			$idRDV = 0;
		}

		$Spec_Rdv = AfficherSteak($idRDV,$idStaff,$numEtudiant,$service,$horaire,$jour,$Semaine);
		$retour = "";
		$tableau_Staff = getTableauRdv($liste_Rdv,$Semaine,$idStaff,$numEtudiant,$service,$jour);
        AfficherPageRdv($tableau_Staff,$liste_Staff,$Spec_Rdv,$numEtudiant,$service,$Semaine,$horaire,$jour,$retour);
    }