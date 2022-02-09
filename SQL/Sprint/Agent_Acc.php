<?php
	
	require_once('Agent_Acc/controleur/controleur.php');

	try 
	{ 
		if (isset($_POST['save_etud'])){
			$numEtudiant = $_POST['numEtudiant'];
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$date = $_POST['date'];
			$adresse = $_POST['adresse'];
			$mail = $_POST['mail'];
			$tel = $_POST['tel'];
			$montantDiffere = $_POST['montantDiffere'];
			$montantDiffereMax = $_POST['montantDiffereMax'];
			CtlAjouter_Etud($numEtudiant,$nom,$prenom,$date,$adresse,$mail,$tel,$montantDiffere,$montantDiffereMax);
		}

		else if (isset($_POST['get_synth_etud'])){
			$numEtudiant = $_POST['liste_etud'];
			CtlModifEtud($numEtudiant);
		}

		else if (isset($_POST['save_modif_etud'])){
			$numEtudiant = $_POST['numEtudiant'];
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$dateDeNaissance = $_POST['dateDeNaissance'];
			$adresse = $_POST['adresse'];
			$mail = $_POST['mail'];
			$numTel = $_POST['numTel'];
			$montantDiffere = $_POST['montantDiffere'];
			$montantDiffereAutorise = $_POST['montantDiffereAutorise'];
			CtlUpdateEtud($numEtudiant,$nom,$prenom,$dateDeNaissance,$adresse,$mail,$numTel,$montantDiffere,$montantDiffereAutorise);
		}

		else if (isset($_POST['Acces_Paiements'])){
			$numEtudiant = $_POST['numEtudiant_PAYMENT'];
			CtlVerifEtud($numEtudiant);
		}

		else if (isset($_POST['encaisser'])){
			$numEtudiant = $_POST['numEtudiant'];
			foreach ($_POST['checkbox'] as $ligne){
				CtlEncaisser($ligne, $numEtudiant);
			}
			CtlListePaiement($numEtudiant);
		}

		else if (isset($_POST['differé'])){
			$numEtudiant = $_POST['numEtudiant'];
			foreach ($_POST['checkbox'] as $ligne){
				CtlDifferer($ligne, $numEtudiant);
			}
			CtlListePaiement($numEtudiant);
		}

		else if (isset($_POST['acceuil'])){
			CtlAcceuil();
		}

		else if (isset($_POST['rdv'])){
			CtlRDV();
		}

		else if (isset($_POST['étudiant'])){
			CtlListe('gabarit_etudiant.php');
		}

		else if (isset($_POST['paiement'])){
			CtlPaiement();
		}

		else if (isset($_POST['synthèse'])){
			CtlListe('gabarit_synthese.php');
		}

		else if (isset($_POST['search_admin'])){
			$Etudiant = $_POST['numEtudiant'];
			$date = $_POST['date'];
			$heure = $_POST['horaire'];
			$service = $_POST['liste_service'];
			CtlSearchAdmin($Etudiant, $date, $heure, $service);
		}

		else if (isset($_POST['search_etud'])){
			$nom_etud = $_POST['nom_etud'];
			$dateDeNaissance = $_POST['date'];
			CtlSearchEtud($nom_etud, $dateDeNaissance);
		}
		
		else if (isset($_POST['deconnexion'])){
			require_once('../../Connexion/connexion.php');
		}

		else if (isset($_POST['Maj_Planning'])){
            $MembreStaff = $_POST["liste_staff"];
			$LaSemaine = $_POST["week"];
			$numEtudiant = $_POST['numEtudiant'];
			$service = $_POST['liste_service'] ;
			$jour = 0;
            CtlAcceuil_Planning($MembreStaff,$LaSemaine,$numEtudiant,$service,$jour);
		}
		
		else if (isset($_POST['SteakRDV'])){
			$MembreStaff = $_POST["idStaff"];
            $Semaine = $_POST["week"];
			$TypeRDV = $_POST["Type"];
			$idRDV = $_POST["idRDV"];
			$numEtudiant = $_POST['numEtudiant'];
			$service = $_POST['service'] ;
			$heure = $_POST['horaire'] ;
			$jour = $_POST['jour'] ;
			CtlAcceuil_Steak($MembreStaff,$Semaine,$idRDV,$TypeRDV,$numEtudiant,$service,$heure,$jour);
		}
		
		else if (isset($_POST['lockC'])){
			$service = $_POST["service"];
			$numEtudiant = $_POST["numEtudiant"];
			$date = $_POST["jour"];
			$semaine = $_POST["week"];
			$horaire = $_POST["heure"];
			$admin = $_POST["idStaff"];
			CtlCreateRDV($service, $date, $horaire, $numEtudiant, $admin, $semaine);
		}

		else {
			CtlAcceuil();
		}
	}
	
	catch(Exception $e){
		$msg = $e->getMessage();
		CtlErreur($msg); 
	}
	
