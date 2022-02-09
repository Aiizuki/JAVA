<!DOCTYPE html>
<html lang="fr">

<head>
    <title> Acceuil Agent Administrateur </title>
    <meta charset="utf-8">
    <link rel="stylesheet"  href="Agent_Admin/vue/style/style.css">
</head>
    
<body>
    <p> Vous êtes sur la page d'acceuil <br/>
    <a href='./connexion.php'><input type="button" value="Se déconnecter"></a>
</p>
    <div style="overflow-x:auto;overflow-y:auto">
        <fieldset class="colonne1">
            <div class="colonne1">
                <table>
                    <tr>
                        <td colspan="8" class="Jours"> Emploi du temps</td>
                    </tr>
                    <tr>
                        <td class="Jours"> Heure</td>
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
            <div class="colonne2">
                <form id="Emploie-Du-Temps" action="./Agent_Admin.php" method="post">
                    <p>
                        <label> Sélectionnez un agent : </label>
                        <?php echo $ld;?>
                    </p>
                    <p>
                        <label> Sélectionnez une semaine : </label>
                        <input type="date" name="week" id="camp-week" value="2020-12-28" min="2020-12-28" step="7">
                        <input type="hidden" value="" name="message">
                    <p> 
                        <input type="submit" value="Afficher l'emploie du temps" name="Maj_Planning"/>
                    </p>
                </form>
            </div>
        </fieldset>
    </div>
    <fieldset>
        <legend> Spécificités de l'horaire </legend>
        <?php echo $LesSpecDuRdv;?>
    </fieldset>
</body>