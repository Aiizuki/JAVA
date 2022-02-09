<?php
	require_once('Agent_Admin/controleur/controleur.php');
	
	try
	{
		if (isset($_POST['Maj_Planning'])){
			$idStaff = $_POST["idStaff"];
			$LaSemaine = $_POST["week"];
			$message = $_POST["message"];
			CtlrAcceuil_Planning($idStaff,$LaSemaine,$message);
		}

		if (isset($_POST['SteakRdv'])){
			$idStaff = $_POST["idStaff"];
			$Semaine = $_POST["week"];
			$SteakID = $_POST["SteakID"];
			$Jour = $_POST["day"];
			$Horraire = $_POST["heure"];
			CtlrAcceuil_Steak($idStaff,$Semaine,$SteakID,$Jour,$Horraire);
		}

		if(isset($_POST['SteakFormation'])){
			$idStaff = $_POST["idStaff"];
			$Semaine = $_POST["week"];
			$SteakID = $_POST["SteakID"];
			$Jour = $_POST["day"];
			$Horraire = $_POST["heure"];
			$Nomformation = $_POST["NomFormation"];
			CtlrAcceuilBloqueFormation($idStaff,$Semaine,$SteakID,$Jour,$Horraire,$Nomformation);
		}

		if(isset($_POST['SteakRdvActualisé'])){
			$idStaff = $_POST["idStaff"];
			$Semaine = $_POST["week"];
			$SteakID = $_POST["SteakID"];
			$Validité = $_POST["validation"];
			CtlrAcceuilActualiserRdv($idStaff,$Semaine,$SteakID,$Validité);
		}

		else{
			CtlrAcceuil();
		}
	}
	
	catch(Exception $e)
	{
		$msg = $e->getMessage();
		CtlrErreurAdmin($msg); 
	}
?>
