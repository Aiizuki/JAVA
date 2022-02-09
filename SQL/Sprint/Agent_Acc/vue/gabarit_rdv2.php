<!DOCTYPE html>

<html lang="fr">

<head>
    <title> Prendre un RDV </title>
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
        <fieldset>
        <form id="search_etud" action="./Agent_Acc.php" method="post">
                <legend> Selectionner un créneau : </legend>
                <p>  <input type="date" name="week" id="camp-week" value="2020-12-28" min="2020-12-28" step="7"> </p>
                <p>
                <?php
                echo $lad;
                ?>
                </p>
        </form>
        </fieldset>

        <fieldset>
        <div class="colonne1">
            <table name = 'planning'>
            <tr>
                <td colspan="8" class="Jours"> Emploi du temps</td>
                </tr>
            <tr>
                <td class="Heure"> </td>
                <td class="Jours"> Lundi</td>
                <td class="Jours"> Mardi</td>
                <td class="Jours"> Mercredi</td>
                <td class="Jours"> Jeudi</td>
                <td class="Jours"> Vendredi</td>
                <td class="Jours"> Samedi</td>
                <td class="Jours"> Dimanche</td>
            </tr>
            <?php echo $Planning;?>
            </table>
        </div>

        <div class ="colonne2">
        <fieldset>
        <legend> Informations </legend>
        <?php
        echo $LesSpecDuRdv ;
        ?>
        </fieldset>
        </div>

        <div class ="colonne3">
        <fieldset>
            <legend> Retour </legend>
            <?php
            echo $Erreur;
            ?>
        </fieldset>
        </div>
        </fieldset>


    </div>

</body>
</html>