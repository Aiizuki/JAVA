<?php
	require_once('Agent_Admin/modele/modele.php');
	require_once('Agent_Admin/vue/vue.php');
	
	function CtlrListeEtud(){
    $liste_Etud = getListe_Etud();
    AfficherListeEtud($liste_Etud);
	}

	function CtlrAcceuil(){
		$liste_Staff = getListe_Staff_Administratif();
		$liste_Rdv = getListeRdv(2);
		$idStaff = 1;
		$Semaine = '2020-12-28';
		$Spec_Rdv = 'Aucun horraire séléctioné !';
		$tableau_Staff = '<tr><td colspan=8>Aucun agent séléctionné</td></tr>';
		AfficherPageRdv($tableau_Staff,$liste_Staff,$Spec_Rdv);
	}

	function CtlrAcceuil_Planning($idStaff,$Semaine,$message){
		$liste_Staff = getListe_Staff_Administratif();
		$liste_Rdv = getListeRdv($idStaff);
		if($message == ''){
			$Spec_Rdv = 'Aucun horraire séléctioné !';
		}
		else{
			$Spec_Rdv = $message;
		}
		$tableau_Staff = getTableauRdv($liste_Rdv,$Semaine,$idStaff);
		AfficherPageRdv($tableau_Staff,$liste_Staff,$Spec_Rdv);
	}

	function CtlrAcceuil_Steak($idStaff,$Semaine,$SteakID,$Jour,$Horraire){
		if($SteakID == -1){
			$LeStaff = getLeStaff($idStaff);
			$Spec_Rdv = HacherViande($LeStaff,$Semaine,$SteakID,$Jour,$Horraire);
		}
		else{
			$Spec_Rdv = AfficherSteak($SteakID,$Semaine);
		}
		$liste_Staff = getListe_Staff_Administratif();
		$liste_Rdv = getListeRdv($idStaff);
		$tableau_Staff = getTableauRdv($liste_Rdv,$Semaine,$idStaff);
		AfficherPageRdv($tableau_Staff,$liste_Staff,$Spec_Rdv);
	}

	function CtlrAcceuilBloqueFormation($idStaff,$Semaine,$SteakID,$Jour,$Horraire,$Nomformation){
		setBloqueFormation($Nomformation,$Jour,$Horraire,$idStaff);
		$liste_Staff = getListe_Staff_Administratif();
		$Spec_Rdv = 'Un créneaux viens d\'être bloqué !';
		$liste_Rdv = getListeRdv($idStaff);
		$tableau_Staff = getTableauRdv($liste_Rdv,$Semaine,$idStaff);
		AfficherPageRdv($tableau_Staff,$liste_Staff,$Spec_Rdv);
	}

	function CtlrAcceuilActualiserRdv($idStaff,$Semaine,$SteakID,$Validité){
		setRdvActualiser($SteakID,$Validité);
		$liste_Staff = getListe_Staff_Administratif();
		$Spec_Rdv = 'Le Rdv à été actualisé !';
		$liste_Rdv = getListeRdv($idStaff);
		$tableau_Staff = getTableauRdv($liste_Rdv,$Semaine,$idStaff);
		AfficherPageRdv($tableau_Staff,$liste_Staff,$Spec_Rdv);
	}

	function CtlrListeStaff()
	{
    $liste_Staff = getListe_Staff();
    AfficherPageRdv($liste_Staff);
	}
	
	function CtlrErreurAdmin($erreur)
	{
		AfficherErreurAdmin($erreur);
	}
