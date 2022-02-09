<?php

/*                                                                                  AFFICHAGE PAGE ACCEUIL DIRECTEUR                                                                               */


	function aff_acceuil_dir()
	{
		$contenu='
		<form method="post" action="Directeur.php">
			<p>
				<input type="submit" value="deconnexion" id="deco" name="deco">
			</p>
		<fieldset class="a">
			<p class="b">
				<input type="submit" value="Gestion des Employés / Logs" id="login_pwd" name="login_pwd">
			</p>
			<p class="b">
				<input type="submit" value="Gérer les services" id="services" name="services">
			</p>			
			<p class="b">
				<input type="submit" value="Gérer les pièces / Affectations " id="pieces" name="pieces">
			</p>
			<p class="b">
				<input type="submit" value="Voir les statistiques" id="stat_acceuil" name="stat_acceuil">
			</p>
		</fieldset>
		</form>';
		require_once('Directeur\vue\gabarit.php');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*                                                                            AFFICHAGE PAGE STAFF                                                                                           */
	
	
	function aff_logpwd()
	{
		$logs = get_logs();
		$employe = get_employe();
		
		$contenu ='
		<form method="post" action="Directeur.php">
			<p>
				<input type="submit" value="deconnexion" id="deco" name="deco">
			</p>
			<fieldset class = "Employés">
			<legend> Liste des employés </legend>
				<table>
					<tr>
						<th> ID_Employé </th>
						<th> Nom </th>
						<th> Prénom </th>
						<th> Rôle </th>
					</tr>';
		
		foreach ($logs as $ligne)
		{
			foreach ($employe as $ligne2)
			{
				if( $ligne->idLogs == $ligne2->Rôle)
				{
					$contenu = $contenu.'
					<tr>
						<td>'.$ligne2->idEmployé.'</td><td>'.$ligne2->Nom.'</td><td>'.$ligne2->Prénom.'</td>';
						
					if($ligne2->Rôle == 1)
					{
						$contenu = $contenu.'<td>directeur</td>';
					}
					elseif($ligne2->Rôle == 2)
					{
						$contenu = $contenu.'<td>agent administratif</td>';
					}
					elseif($ligne2->Rôle == 3)
					{
						$contenu = $contenu."<td>agent d'acceuil</td>";
					}
					else
					{
						$contenu = $contenu.'<td>'.$ligne2->Rôle.'</td>';
					}
					
					$contenu = $contenu.'</tr>';
				}
			}
		}
		$contenu = $contenu.'</table>';
		
		$contenu .= '
			<p>
				<label for="id_staff" >ID : </label>
				<input type="text" id="id_staff" name="id_staff">
			</p>
			<p>
				<label for="nom_staff" >NOM : </label>
				<input type="text" id="nom_staff" name="nom_staff">
			</p>
			<p>
				<label for="prenom_staff" >PRENOM : </label>
				<input type="text" id="prenom_staff" name="prenom_staff">
			</p>
			<p>
				<label for="role_staff_str" >ROLE : </label>
				<input type="text" id="role_staff_str" name="role_staff_str">
			</p>
			
			<p>
			<input type="submit" value="Ajouter le nouvel employé" id="add_staff" name="add_staff">
				<input type="submit" value="Modifier l\'employé" id="modif_staff" name="modif_staff">
				<input type="submit" value="Supprimer l\'employé" id="suppr_staff" name="suppr_staff">
			</p>
			</fieldset>
		</form>';


		$contenu .='
		<form method="post" action="Directeur.php">
			<fieldset class = "Logs">
			<legend> Table des logs </legend>
				<table>
					<tr>
						<th> ID_Logs </th>
						<th> Login </th>
						<th> Mot de passe </th>
						<th> Fonction </th>
					</tr>';

		foreach ($logs as $ligne)
			{
				$contenu = $contenu.'
				<tr>
				<td>'.$ligne->idLogs.'</td>
				<td>'.$ligne->login.'</td>
				<td>'.$ligne->pwd.'</td>
				<td>'.$ligne->Role.'</td>';
					
				$contenu = $contenu.'</tr>';
				
				
			}
			$contenu = $contenu.'</table>';

		$contenu .= '
			<p>
				<label for="id_staff" >ID : </label>
				<input type="text" id="id_logs" name="id_logs">
			</p>
			<p>
				<label for="login_staff" >LOGIN : </label>
				<input type="text" id="login_staff" name="login_staff">
			</p>
			<p>
				<label for="pwd_staff" >PWD : </label>
				<input type="text" id="pwd_staff" name="pwd_staff">
			</p>
			<p>
				<label for="role_staff" >FONCTION : </label>
				<input type="text" id="role_staff" name="role_staff">
			</p>
			
			<p>
				<input type="submit" value="Modifier" id="modif_logs" name="modif_logs">
				<input type="submit" value="Supprimer" id="suppr_logs" name="suppr_logs">
			</p>
			</fieldset>
			<p>
			<input type="submit" value="RETOUR" id="retour_dir" name="retour_dir">
			</p>
		</form>';


		require_once('Directeur\vue\gabarit.php');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*                                                                                        AFFICHAGE PAGE SERVICE                                                                          */
	
	
	function aff_service()
	{
		$service = get_service();
		
		$contenu = '
		<form method="post" action="Directeur.php">
			<p>
				<input type="submit" value="deconnexion" id="deco" name="deco">
			</p>
			<fieldset class="a">
				<table>
					<tr>
						<th>ID SERVICE</th>
						<th>NOM SERVICE</th>
						<th>PRIX SERVICE</th>
					</tr>';
		
		foreach ($service as $ligne)
		{
			$contenu = $contenu.'
			<tr>
				<td>'.$ligne->idService.'</td>
				<td>'.$ligne->nom.'</td>
				<td>'.$ligne->prix.'</td>
			</tr>';
		}
		$contenu = $contenu.'</table></fieldset><fieldset class="form"  class="a">
			<p>
				<label for="id_service" >ID : </label>
				<input type="text" id="id_service" name="id_service">
			</p>
			<p>
				<label for="nom_service" >NOM : </label>
				<input type="text" id="nom_service" name="nom_service">
			</p>
			<p>
				<label for="prix_service" >PRIX : </label>
				<input type="text" id="prix_service" name="prix_service">
			</p>
			
			<p>
				<input type="submit" value="AJOUTER" id="add_service" name="add_service">
				<input type="submit" value="MODIFIER" id="modif_service" name="modif_service">
				<input type="submit" value="SUPPRIMER" id="suppr_service" name="suppr_service">
			</p>
			</fieldset>
			<p>
				<input type="submit" value="RETOUR" id="retour_dir" name="retour_dir">
			</p>
		</form>';
		require_once('Directeur\vue\gabarit.php');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*                                                                                    AFFICHAGE PAGE PIECE                                                                                 */
	
	
	function aff_piece()
	{
		$piece = get_piece();
		$service = get_service();
		$piece_service = get_piece_service();
		
		$contenu = '
		
		<form method="post" action="Directeur.php">
			<p>
				<input type="submit" value="deconnexion" id="deco" name="deco">
			</p>';

		$contenu .= '<fieldset class = "services"><legend> Services </legend>';

		$contenu .= '
				<table>
				<tr>
					<th>ID SERVICE</th>
					<th>NOM SERVICE</th>
					<th>PRIX SERVICE</th>
				</tr>';
			
		foreach ($service as $ligne)
		{
			$contenu = $contenu.'
			<tr>
				<td>'.$ligne->idService.'</td>
				<td>'.$ligne->nom.'</td>
				<td>'.$ligne->prix.'</td>
			</tr>';
		}

		$contenu = $contenu.'</table></fieldset>';
		$contenu .= '<fieldset class = "piece"><legend> Pièce </legend>';

		$contenu = $contenu.'<table>
			<tr>
				<th>ID PIECE</th>
				<th>NOM PIECE</th>
			</tr>';
		

		foreach ($piece as $ligne)
		{
			$contenu = $contenu.'
			<tr>
				<td>'.$ligne->idPiece.'</td>
				<td>'.$ligne->nom.'</td>
			</tr>';
		}

		$contenu .= '</table>
			<p>
				<label for="id_piece" >ID PIECE : </label>
				<input type="text" id="id_piece" name="id_piece">
			</p>
			<p>
				<label for="nom_piece" >NOM PIECE : </label>
				<input type="text" id="nom_piece" name="nom_piece">
			</p>
			<p>
				<input type="submit" value="Ajouter une pièce" id="add_piece" name="add_piece">
				<input type="submit" value="Modifier la pièce" id="modif_piece" name="modif_piece">
				<input type="submit" value="Supprimer la pièce" id="suppr_piece" name="suppr_piece">				
			</p>
			</fieldset>
		</form>';

		$contenu .= '<form method="post" action="Directeur.php">';

		$contenu .= '<fieldset class = "affectation"><legend> Table D\'affectation pièce/service </legend>';

		$contenu = $contenu.'<table>
			<tr>
				<th>ID SERVICE</th>
				<th>NOM SERVICE</th>
				<th>ID PIECE</th>
				<th>NOM PIECE</th>
			</tr>';

		foreach ($piece as $ligne)
		{
			foreach ($service as $ligne2)
			{
				foreach ($piece_service as $ligne3)
				{
					if ( $ligne3->idService == $ligne2->idService && $ligne->idPiece == $ligne3->idPiece)
					{
						$contenu = $contenu.'
							<tr>
								<td>'.$ligne2->idService.'</td>
								<td>'.$ligne2->nom.'</td>
								<td>'.$ligne->idPiece.'</td>
								<td>'.$ligne->nom.'</td>
							</tr>';
					}
				}
				
			}
		}

		$contenu .= '</table>
			<p>
				<label for="piece" > ID PIECE : </label>
				<input type="text" id="piece" name="piece">
			</p>
			<p>
				<label for="id_service" >ID du service : </label>
				<input type="text" id="id_service" name="id_service">
			</p>
			<p>
				<input type="submit" value="Affecter" id="add_piece" name="affecter_piece">			
			</p>
			<p>
				<input type="submit" value="Supprimer l\'affectation" id="add_piece" name="suppr_affecter_piece">			
			</p>';
				
		$contenu = $contenu.'</table></fieldset>
			<p>
				<input type="submit" value="RETOUR" id="retour_dir" name="retour_dir">
			</p>
			</form>';


		require_once('Directeur\vue\gabarit.php');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*                                                       */
	
	
	function aff_stat_acceuil()
	{
		$contenu = '
		
		<form method="post" action="Directeur.php">
			<p>
				<input type="submit" value="deconnexion" id="deco" name="deco">
			</p>
			<fieldset class="a">
			<p>
				<label for="date_une" >DATE UNE : </label>
				<input type="date" id="date_une" name="date_une">
			</p>
			<p>
				<label for="date_deux" >DATE DEUX : </label>
				<input type="date" id="date_deux" name="date_deux">
			</p>
			
			<p>
				<input type="submit" value="VALIDER" id="stats" name="stats">
				<input type="reset" value="EFFACER">
			</p>
			</fieldset>
			<p>
				<input type="submit" value="RETOUR" id="retour_dir" name="retour_dir">
			</p>
		</form>';
		require_once('Directeur\vue\gabarit.php');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	function aff_stat($date_une,$date_deux)
	{
		$rdv = get_rdv();
		$etudiant = get_etudiant();
		$service = get_service();
		
		
		
		
		if ( (!empty($date_une) && !empty($date_deux)))
		{
			if( $date_deux > $date_une )
			{
				$contenu = '
		
				<form method="post" action="Directeur.php">
				<p>
					<input type="submit" value="deconnexion" id="deco" name="deco">
				</p>
		
				<fieldset>
					<p> NOMBRE DE RDV PRIS : ';
			
					$nb_rdv = 0;
			
					foreach ($rdv as $ligne)
					{
						if ( $ligne->date >= $date_une && $ligne->date <= $date_deux )
						{
							if($ligne->statut != 'formation' )
                            {
                                $nb_rdv++;
                            }
						}
					}
			
					$contenu = $contenu.$nb_rdv.'</p>
				</fieldset>
		
				<fieldset>
					<p> CHIFFRE D\'AFFAIRE : ';
			
						$chiffre_affaire = 0;
				
						foreach ($rdv as $ligne)
						{
							if ( $ligne->date >= $date_une && $ligne->date <= $date_deux )
							{
								if($ligne->statut == 'payé')
								{
									$chiffre_affaire = $chiffre_affaire + $ligne->prix;
								}
							}
						}
					
						$contenu = $contenu.$chiffre_affaire.' €</p>
					</p>
				</fieldset>
		
				<fieldset>
					<p> POURCENTAGE DE RDV AYANT ABOUTIT : ';
			
						$pourcentage_rdv_aboutit = 0;
						$nb_rdv_aboutit = 0;
				
						foreach ($rdv as $ligne)
						{
							if ( $ligne->date >= $date_une && $ligne->date <= $date_deux )
							{
								if($ligne->statut == 'payé' || $ligne->statut == 'en attente de paiement ' || $ligne->statut == 'En differé')
								{
									$nb_rdv_aboutit++;
								}
							}
						}
						
						if($nb_rdv != 0){
							$pourcentage_rdv_aboutit = $nb_rdv_aboutit / $nb_rdv * 100;
						}

						else {
							$pourcentage_rdv_aboutit = 0;
						}
				
						$contenu = $contenu.$pourcentage_rdv_aboutit.' %</p>
					</p>
				</fieldset>
		
				<fieldset>
					<p> POURCENTAGE D\'ETUDIANTS AYANT PRIS AU MOINS UN SERVICE : ';
			
						$nb_etudiant = 0;
						$nb_etudiant_rdv = 0;
						$pourcentage_etu_rdv = 0;
				
						$array = array('a');
				
						foreach ($etudiant as $ligne)
						{
							$nb_etudiant++;
					
							foreach ($rdv as $ligne2)
							{
								if ( $ligne2->date >= $date_une && $ligne2->date <= $date_deux )
								{	
									if(!(in_array($ligne->numEtudiant,$array)))
									{
										if(($ligne2->statut == 'payé' || $ligne2->statut == 'en attente de paiement ' || $ligne2->statut == 'En differé') && $ligne->numEtudiant == $ligne2->numEtudiant)
										{
											$nb_etudiant_rdv++;
											$array[] = $ligne->numEtudiant;
										}
									}
								}
							}
						}
				
						$pourcentage_etu_rdv = (int)($nb_etudiant_rdv / $nb_etudiant * 100);
					
						$contenu = $contenu.$pourcentage_etu_rdv.' %</p>
				
					</p>
				</fieldset>
		
					<p>
						<input type="submit" value="RETOUR" id="retour_stat" name="retour_stat">
					</p>
				</form>';
			}
			else
			{
				aff_stat_acceuil();
				echo 'dates non conformes';
			}
		}
		else
		{
			aff_stat_acceuil();
			echo 'dates manquante';
		}
		
		
		require_once('Directeur\vue\gabarit.php');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	
	
	
	
	function afficherErreurDir($erreur)
	{
		$contenu='<p class="err">'.$erreur.'</p><form method="post" action="Directeur.php"><p>
				<input type="submit" value="RETOUR" id="retour_dir" name="retour_dir">
			</p></form>';
		require_once('Directeur\vue\gabarit.php'); 
	}

