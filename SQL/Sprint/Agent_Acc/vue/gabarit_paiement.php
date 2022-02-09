<!DOCTYPE html>
<html lang="fr">

<head>
    <title> Paiements </title>
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
    <form id="set_rdv" action="./Agent_Acc.php" method="post">
    <fieldset>
        <p>
        <label>Veuillez rentrer le numéro de l'étudiant :</label>
        <input type="text" id="name" name="numEtudiant_PAYMENT" placeholder='ex: 2943089' required>
        </p>
        <p> <input type="submit" value="Valider" name="Acces_Paiements"/> </p>
    </fieldset>
    </form>
    </div>

</body>