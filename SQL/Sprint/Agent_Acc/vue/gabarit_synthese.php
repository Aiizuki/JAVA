<!DOCTYPE html>

<html lang="fr">

<head>
    <title> Synthèses </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Agent_Acc/vue/Style/style.css">
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

    <div class="centrale">


    <form id="actu-rdv" action="./Agent_Acc.php" method="post">
    <fieldset>
        <legend> Rechercher un étudiant : </legend>
        <p>
        <label> Indiquez le nom de l'étudiant : </label>
        <input type="text" name="nom_etud" placeholder='EN MAJUSCULES' required>
        </p>
        <p>
        <label> Indiquez la date de naissance de l'étudiant : </label>
        <input type="date" name="date" required>
        </p>
        <p> <input type="submit" value="Rechercher l'étudiant" name="search_etud"/> </p>
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