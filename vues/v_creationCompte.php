<!DOCTYPE html>
<html lang="fr"> 
    <body >
        <form method="post" action="index.php?uc=gestionRapport&action=creerCompte">
            <div>
                <label for="nom">Nom/Prenom visiteur</label>
                <select>
                <?php
                $lesVisiteurs = getInfoVis();
                foreach ($lesVisiteurs as $unVisiteur) {
                    //var_dump($unVisiteur);
                    echo '<OPTION value='.$unVisiteur['VIS_NOM'].'>'.$unVisiteur['VIS_MATRICULE'].' '.$unVisiteur['Vis_PRENOM'].' '.$unVisiteur['VIS_NOM'].'</OPTION>';
                }
                ?>
                </select>
            </div>
            <div>
                <label for="id"> grade du visiteur </label>
            </div>
        </form>
    </body>
</html>