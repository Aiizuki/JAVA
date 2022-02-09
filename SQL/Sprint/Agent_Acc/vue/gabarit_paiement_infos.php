<head>
    <title> Historique des paiements </title>
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
    <form id="boutons_paiements" action="./Agent_Acc.php" method="post">
        <fielset>
            <p> <label> Identifiant de l'étudiant : </label> 
            <input type="text" name="numEtudiant" value="<?= $numEtudiant ?>" readonly/> </p>
            <?php
            echo $lp;
            ?>
        </fielset>
        <p> Si vous ne voyez pas de checkbox dans la colonne de gauche, c'est que le RDV entre l'étudiant et l'agent administratif n'a pas encore été validé par l'agent administratif. </p>

        <p> <input type="submit" value="Encaisser les paiements" name="encaisser"/> </p>
        <p> <input type="submit" value="Mettre en differé" name="differé"/> </p>
    </form>
    </div>