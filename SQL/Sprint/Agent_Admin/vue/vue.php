<?php

	function AfficherErreurAdmin($erreur)
	{
		$contenu='<p>'.$erreur.'</p>';
		require_once('Agent_Admin/vue/gabarit_de_base.php'); 
	}

	function PageAcceuil($liste_Staff){
		$ld = $liste_Staff;
		require_once('Agent_Admin/vue/gabarit_acceuil_administrateur.php');
	}

	function AfficherPageRdv($tableau_Staff,$liste_Staff,$Spec_Rdv)
	{
		$ld = "<select name='idStaff' autocomplete='on'>";
    	foreach ($liste_Staff as $ligne){
        $ld .= "<option value=($ligne->idEmployé)> $ligne->Nom            $ligne->Prénom </option>";
    	}
    	$ld .= "</select>";
    	$Planning = $tableau_Staff;
    	$LesSpecDuRdv = $Spec_Rdv;
    	require_once('Agent_Admin/vue/gabarit_acceuil_administrateur.php');
	}

	function AfficherSteak($Steak,$semaine_Rdv)
	{
		$LeSteak = getSteak($Steak);
		if($LeSteak->statut == 'en attente de paiement ' ){
			$SteakCuit = "Motif : Rendez-Vous élève";
			$SteakCuit .= "<br/> Horaire : ";
			$SteakCuit .= $LeSteak->heure;
			$SteakCuit .= "h";
			$SteakCuit .= "<br/> Objet du RdV : ";
			$SteakCuit .= $LeSteak->nomService;
			$SteakCuit .= "<br/> Prix : ";
			$SteakCuit .= $LeSteak->prix;
			$SteakCuit .= "<br/> Numéro de l'étudiant : ";
			$SteakCuit .= $LeSteak->numEtudiant;
			$SteakCuit .="<br/> Rendez-Vous déjà validé !";
		}
		else if($LeSteak->statut == 'en attente de paiement'){
			$LeEtudiant = $LeSteak->numEtudiant;
			$LesPieces ='';
			$LeEtudiant = getEtudiant($LeEtudiant);
			$LePiece = get_piece_service($LeSteak->idService);
			foreach ($LePiece as $ligne) {
				$LesPieces .= '-';
				$LesPieces .= get_piece($ligne->idPiece)[0];
				$LesPieces .= '<br/>';
			}
			$SteakCuit = "Motif : Rendez-Vous élève";
			$SteakCuit .= "<br/> Horaire : ";
			$SteakCuit .= $LeSteak->heure;
			$SteakCuit .= "h";
			$SteakCuit .= "<br/> Objet du RdV : ";
			$SteakCuit .= $LeSteak->nomService;
			$SteakCuit .= "<br/> Prix : ";
			$SteakCuit .= $LeSteak->prix;
			$SteakCuit .= "<fieldset class=\"ResumeEtudiant\"> <legend> Résumé de l'Etudiant </legend> Numéro de l'étudiant : ";
			$SteakCuit .= $LeSteak->numEtudiant;
			$SteakCuit .="<br/> Nom : ";
			$SteakCuit .= $LeEtudiant->nom;
			$SteakCuit .= " ";
			$SteakCuit .= $LeEtudiant->prenom;
			$SteakCuit .= "<br/> Date de naissance : ";
			$SteakCuit .= $LeEtudiant->dateDeNaissance;
			$SteakCuit .= "<br/> Adresse : ";
			$SteakCuit .= $LeEtudiant->adresse;
			$SteakCuit .= "<br/> Numéro de téléphone : ";
			$SteakCuit .= $LeEtudiant->numTel;
			$SteakCuit .= "<br/> Mail : ";
			$SteakCuit .= $LeEtudiant->mail;
			$SteakCuit .= "</fieldset><fieldset><legend>Pièces necessaire au RdV</legend>";
			$SteakCuit .= $LesPieces;
			$SteakCuit .= "</fieldset>";
			$SteakCuit .= "<form id=\"SteakRdvActualisé\" method=\"post\"><input type=radio name=\"validation\" value=\"oui\">Service accepté</input>
			<br/><input type=radio name=\"validation\" value=\"non\" checked>Service refusé</input>
			<br/><input type=hidden name=\"idStaff\" value=\"";
			$SteakCuit .= $LeSteak->idStaff;
			$SteakCuit .= "\"><input type=hidden name=\"week\" value=\"";
			$SteakCuit .= $semaine_Rdv;
			$SteakCuit .= "\"><input type=hidden name=\"SteakID\" value=\"";
			$SteakCuit .= $LeSteak->idRDV;
			$SteakCuit .= "\"><input type=submit name=\"SteakRdvActualisé\" value=\"Valider le RDV\">
			</form>";
		}
		else{
			$SteakCuit = "Motif : Formation";
			$SteakCuit .= "<br/>Horaire : ";
			$SteakCuit .= $LeSteak->heure;
			$SteakCuit .= "h";
			$SteakCuit .= "<br/> Sujet de la formation : ";
			$SteakCuit .= $LeSteak->nomService;
		}
		return $SteakCuit ;
	}

	function HacherViande($LeStaff,$week,$SteakID,$day,$heure){
		$Steak = "<p> Horraire libre, vous pouvez bloquer une formation si dessous </br>";
		$Steak .='<form id="SteakFormation" action ="Agent_Admin.php" method="post">';
		$Steak .="Nom de la formation : ";
		$Steak .='<input type="text" placeholder="Tapez Ici" name="NomFormation"/>';
		$Steak .='<input type="hidden" value="';
		$Steak .=$LeStaff->idEmployé;
		$Steak .='" name="idStaff"><input type="hidden" value="';
		$Steak .=$week;
		$Steak .='" name="week"><input type="hidden" value="';
		$Steak .=$SteakID;
		$Steak .='" name="SteakID"><input type="hidden" value="';
		$Steak .=$day;
		$Steak .='" name="day"><input type="hidden" value="';
		$Steak .=$heure;
		$Steak .='" name="heure">';
		$Steak .="</br> Agent auquel la formation seras assigné : ";
		$Steak .=$LeStaff->Nom;
		$Steak .=" ";
		$Steak .=$LeStaff->Prénom;
		$Steak .='</br></br> <input type="submit" value ="Valider la formation" name="SteakFormation"></form></p>';
		return $Steak;
	}
	
	?>
