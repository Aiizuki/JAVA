<?php

function AfficherRDV($rdv){
    $contenu = '';
    foreach($rdv as $ligne){
        $contenu.='<p> Liste des RDV à venir :'.$ligne->date.'à'.$ligne->horaire.'</p>';
    }
    require_once('Agent_Acc/vue/gabarit_rdv.php');
}

function throwErreur($erreur){
    $contenu='<p>'.$erreur.'</p> </br> <p><a href="Agent_Acc.php"/> Revenir au menu </a></p></br>';
    require_once('Agent_Acc/vue/gabarit_acceuil.php');
}


function PageAcceuil(){
    require_once('Agent_Acc/vue/gabarit_acceuil.php');
}

function PagePaiement(){
    require_once('Agent_Acc/vue/gabarit_paiement.php');
}

function PageAvecListe($liste_Etud,$liste_Service,$liste_Agents,$page){
    $le =  "<select name='liste_etud' autocomplete='on' >";
    $ls = "<select name='liste_service' autocomplete='on'>";
    $la = "<select name='liste_staff' autocomplete='on'>";

    foreach ($liste_Etud as $ligne){
        $le .= "<option value='$ligne->numEtudiant'> $ligne->numEtudiant  $ligne->nom  $ligne->prenom </option>";
    }

    foreach ($liste_Service as $ligne){
        $ls .= "<option> $ligne->nom </option>";  
    }

    foreach ($liste_Agents as $ligne){
        $la .= "<option value='$ligne->idEmployé'> $ligne->Nom  $ligne->Prénom </option>";
    }


    $le .= "</select>";
    $ls .= "</select>";
    $la .= "</select>";
    
    require_once($page);
}

function CheckBox_Paiements($HistoriqueDesPaiements, $numEtudiant){
    $lp = "<table border='1' cellpadding='15' cellspacing='10'>";
    $lp .= "<tr>";
    $lp .= "<td class = 'Index'> </td>";
    $lp .= "<td class = 'Index'> Service </td>";
    $lp .= "<td class = 'Index'> Prix </td>";
    $lp .= "<td class = 'Index'> Statut Paiement </td>";
    $lp .= "</tr>";
    foreach ($HistoriqueDesPaiements as $ligne){
        $lp .= "<tr>";
        $lp .= "<td>";
        if($ligne->statut == "en attente de paiement " || $ligne->statut == "En differé"){
            $lp .= "<input type='checkbox' name='checkbox[]' value='$ligne->idRDV'>";
        }
        $lp .= "</td>";
        $lp .= "<td>";
        $lp .= "<label> $ligne->nomService </label>";
        $lp .= "</td>";
        $lp .= "<td>";
        $lp .= "<label> $ligne->prix </label>";
        $lp .= "</td>";
        $lp .= "<td>";
        $lp .= "<label> $ligne->statut </label>";
        $lp .= "</td>";
        $lp .= "</tr>";
    }
    $lp .= "</table>";
    $numEtudiant = $numEtudiant;
    require_once('Agent_Acc/vue/gabarit_paiement_infos.php');
}

function getInfoEtud($numEtudiant){
    if ($numEtudiant == '0'){
        $l = "<form id='err' action='Agent_Acc.php' method='post'>";
        $l .= "<p> Aucun étudiant n'a été trouvé";
        $l .= "<p> <input type='submit' value='Retour' name='back'/> </p>";
        $l .= "</form>";
        echo $l;
    }

    else {
        $contact = getEtud($numEtudiant);
        require_once('Agent_Acc/vue/gabarit_modifEtud.php');
    }
}

function AfficherSteak($Steak,$idStaff,$numEtudiant,$service,$horaire,$jour,$semaine)
    {
        if ($Steak == 0){
            $SteakCuit = "<form id='lock_creneau' action='Agent_Acc.php' method='post'>";
            $SteakCuit .= "<p> Libre </p>";
            $SteakCuit .= "<p> <input type='hidden' value='$idStaff' name='idStaff'/> </p>";
            $SteakCuit .= "<p> <input type='hidden' value='$numEtudiant' name='numEtudiant'/> </p>";
            $SteakCuit .= "<p> <input type='hidden' value='$service' name='service'/> </p>";
            $SteakCuit .= "<p> <input type='hidden' value='$horaire' name='heure'/> </p>";
            $SteakCuit .= "<p> <input type='hidden' value='$jour' name='jour'/> </p>";
            $SteakCuit .= "<p> <input type='hidden' value='$semaine' name='week'/> </p>";
            $SteakCuit .= "<p> <input type='submit' value='Sélectionner ce créneau' name='lockC'/> </p>";
            $SteakCuit .= "</form>";
        }

        else {
            $LeSteak = getSteak($Steak);
            $SteakCuit = "<form id='lock_creneau' action='Agent_Acc.php' method='post'>";
            $SteakCuit .= "<p> <label> Raison de l'indisponibilité : </label>";
            if($LeSteak->statut != "formation" && !empty($LeSteak->statut)){
                $SteakCuit .= "RDV";
            }

            else {
                $SteakCuit .= "Formation";
            }
            $SteakCuit .= "<p> <input type='hidden' value='$idStaff' name='idStaff'/> </p>";
            $SteakCuit .= "<p> <input type='hidden' value='$numEtudiant' name='numEtudiant'/> </p>";
            $SteakCuit .= "<p> <input type='hidden' value='$service' name='service'/> </p>";
            $SteakCuit .= "<p> <input type='hidden' value='$horaire' name='heure'/> </p>";
            $SteakCuit .= "<p> <input type='hidden' value='$jour' name='jour'/> </p>";
            $SteakCuit .= "<p> <input type='hidden' value='$semaine' name='week'/> </p>";
            $SteakCuit .= "<p> <input type='submit' value='Sélectionner ce créneau' name='lockC'/> </p>";
            $SteakCuit .= "</form>";
        }
        return $SteakCuit ;
    }


function AfficherPageRdv($tableau_Staff,$liste_Staff,$Spec_Rdv,$numEtudiant,$service,$Semaine,$horaire,$jour,$retour)
    {
        $lad = "<form id='infosDate' action='Agent_Acc.php' method='post'>";
        $lad .= "<p> <input type='hidden' value='$numEtudiant' name='numEtudiant'/> </p>";
        $lad .= "<p> <input type='hidden' value='$service' name='liste_service'/> </p>";
        $lad .= "<p> <input type='hidden' value='$jour' name='date'/> </p>";
        if ($horaire != 0){
            $lad .= "<p> <input type='hidden' value='$horaire' name='horaire'/> </p>";
        }
        else {
            $lad .= "<p> <input type='hidden' value='0' name='horaire'/> </p>";
        }
        $lad .= "<select name='liste_staff' autocomplete='on'>";
        foreach ($liste_Staff as $ligne){
        $lad .= "<option value='$ligne->idEmployé'> $ligne->Nom            $ligne->Prénom </option>";
        }
        $lad .= "</select>";
        $lad .= "<p> <input type='submit' value='Voir' name='Maj_Planning'/> </p>";
        $lad .= "</form>";
        if($retour){
            $Erreur = $retour;
        }

        else {
            $Erreur ="";
        }
        $Planning = $tableau_Staff;
        $LesSpecDuRdv = $Spec_Rdv;
        require_once('Agent_Acc/vue/gabarit_rdv2.php');
    }

