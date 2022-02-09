<!DOCTYPE html>
<html lang="fr">

<head>
    <title> Modifier un étudiant </title>
    <charset="utf-8">
    <link rel='stylesheet' href="Agent_Acc/vue/Style/style.css"/>
</head>

<body>

    <header>
    <form id="nav" action="./Agent_Acc.php" method="post">
    <ul>
        <li><input type="submit" value="Acceuil" name="acceuil"/></li>
        <li><input type="submit" value="Créer un RDV" name="rdv"/></li>
        <li><input type="submit" value="Gérer les étudiants" name="étudiant"/></li>
        <li><input type="submit" value="Consulter les sythèses" name="synthèse"/>
        <li><input type="submit" value="Gérer les paiements" name="paiement"/></li>
        <li><a href='connexion.php'> <input type="button" value="Déconnexion"/> </a></li>
    </ul>
    </form>
    </header>

    <div class="centrale";>
    <form id="actu-rdv" action="./Agent_Acc.php" method="post">
    <fieldset>
        <legend> Informations de l'étudiant </legend>
        <p> 
        <label> Numéro d'étudiant : </label> 
        <input type="text" name="numEtudiant" value="<?= $contact['numEtudiant']; ?>" readonly/> 
        </p>
        <p> 
        <label> Nom : </label> 
        <input type="text" name="nom" value="<?= $contact['nom']; ?>"/> 
        </p>
        <p> 
        <label> Prénom : </label> 
        <input type="text" name="prenom" value="<?= $contact['prenom']; ?>"/> 
        </p>
        <p> 
        <label> Date de naissance : </label> 
        <input type="date" name="dateDeNaissance" value="<?= $contact['dateDeNaissance']; ?>"/> 
        </p>
        <p> 
        <label> Adresse : </label> 
        <input type="text" name="adresse" value="<?= $contact['adresse']; ?>"/> 
        </p>
        <p> 
        <label> Téléphone : </label> 
        <input type="text" name="numTel" value="<?= $contact['numTel']; ?>"/> 
        </p>
        <p> 
        <label> Mail : </label> 
        <input type="text" name="mail" value="<?= $contact['mail']; ?>"/> 
        </p>
        <p> 
        <label> Montant differé : </label> 
        <input type="text" name="montantDiffere" value="<?= $contact['montantDiffere']; ?>"/> 
        </p>
        <p> 
        <label> Limite de Montant differé : </label> 
        <input type="text" name="montantDiffereAutorise" value="<?= $contact['montantDiffereAutorise']; ?>"/> 
        </p>

        <p> <input type="submit" value="Enregistrer les modifications" name="save_modif_etud"/> </p>
    </fieldset>
    </form>
    </div>
</body>
</html>

    