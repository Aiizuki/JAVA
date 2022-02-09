<!DOCTYPE html>
<html lang="fr">

<head>
    <title> Gérer les étudiants </title>
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
        <a href='connexion.php'> <input type="button" value="Déconnexion"/> </a>
    </ul>
    </form>
    </header>

    <div class="centrale";>
    <form id="addEtud" action="./Agent_Acc.php" method="post">
    <fieldset>
        <legend> Enregistrer un nouvel étudiant </legend>
        <p> <label> Numéro d'étudiant : </label> <input type="text" name="numEtudiant" placeholder="type: entier" required/> </p>
        <p> <label> Nom : </label> <input type="text" name="nom" placeholder="type: texte" required/> </p>
        <p> <label> Prénom : </label> <input type="text" name="prenom" placeholder="type: texte" required/> </p>
        <p> <label> Date de naissance : </label> <input type="date" name="date" required/> </p>
        <p> <label> Adresse : </label> <input type="text" name="adresse" placeholder="type: texte" required/> </p>
        <p> <label> Téléphone : </label> <input type="text" name="tel" placeholder="type: entier" required/> </p>
        <p> <label> Mail : </label> <input type="text" name="mail" placeholder="type: texte" required/> </p>
        <p> <label> Découvert : </label> <input type="text" name="montantDiffere" placeholder="Peut être laissé vide (type: entier)"/> </p>
        <p> <label> Découvert max autorisé : </label> <input type="text" name="montantDiffereMax" placeholder="Peut être laissé vide (type: entier)"/> </p>

        <p> <input type="submit" value="Enregistrer l'étudiant" name="save_etud"/> </p>
    </fieldset>
    </form>

    <form id="infoEtud" action="./Agent_Acc.php" method="post">
    <fieldset>
        <legend> Modifier un étudiant existant </legend>
        <p>
        <label> Sélectionnez un étudiant : </label>
        <?php
        echo $le;
        ?>
        </p>
        <p> <input type="submit" value="Modifier l'étudiant" name="get_synth_etud"/> </p>

    </fieldset>
    </form>
    </div>

</body>
</html>
