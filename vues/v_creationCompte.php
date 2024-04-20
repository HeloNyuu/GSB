<!DOCTYPE html>
<html lang="fr"> 
    <body >
    <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5 mt-4">
                <div class="text-center text-white">
                    <p class="display-4 fw-bolder ">Création de compte </p>
                      
                </div>
            </div>
        </header>


        <form method="post" action="index.php?uc=connexion&action=insertCompte">
            <div>
                <label for="crea_nom">Nom/Prenom :</label>
                <select name="crea_nom">
                <?php
                $lesVisiteurs = getInfoVis();
                foreach ($lesVisiteurs as $unVisiteur) {
                    //var_dump($unVisiteur);
                    echo '<OPTION value='.$unVisiteur['VIS_MATRICULE'].'>'.$unVisiteur['Vis_PRENOM'].' '.$unVisiteur['VIS_NOM'].'</OPTION>';
                }
                ?>
                </select>
            </div>
            
            </br>
            <div>
            <label for="crea_grade"> Grade : </label>
<select name="crea_grade">
    <?php
    $lesGrades = getListGrade();
    foreach ($lesGrades as $unGrade) {
        echo '<option value="' . $unGrade['id_Grade'] . '">' . $unGrade['type_Grade'] . '</option>';
    }
    ?>
</select>
            </div>
            </br>
            <div>
                <label for="crea_mail">Email :</label>
                <input type="email" name="crea_mail" class="form-control" id="mailVis"  size="12" />
            </div>
            </br>
            
            <div>
                <label for="crea_mdp">Mot de passe :</label>
                <input type="password" name="crea_mdp" class="form-control" id="mailVis"  size="12" />
            </div>
            </br>
            
            <input type="submit" class="btn btn-primary btn-md" value="Envoyer"/>
            <input type="reset" class="btn btn-primary btn-md" value="Annuler" />
        </form>
    </body>
</html>