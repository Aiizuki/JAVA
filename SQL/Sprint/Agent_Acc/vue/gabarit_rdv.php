<!DOCTYPE html>

<html lang="fr">

<head>
    <title> Créer un RDV </title>
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
    </header>

    <div class="centrale">
    <form id="set_rdv" action="./Agent_Acc.php" method="post">
    <fieldset>
        <legend> Créer un RDV </legend>
        <p> <label> Indiquez le numéro étudiant de la personne : </label>  
        <input type="text" name="numEtudiant" placeholder='ex: 2943089'/>
        </p>
        <p> <label> Service demandé : </label>
        <?php
        echo $ls;
        ?>
        </p>
        <p>
        <label> Sélection du créneau : </label>
        </p>
        <p>
        <input type="date" name="week" id="camp-week" value="2020-12-28" min="2020-12-28" step="7">
        </p>
        <p>
        <?php
        echo $la;
        ?>
        </p>
        <p> <input type="submit" value="Afficher le Planning" name="Maj_Planning"/> </p>
    </fieldset>
    </div>

</body>
</html>