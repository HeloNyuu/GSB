
<!DOCTYPE html>
<html lang="fr"> 
    <body >
    <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5 mt-4">
                <div class="text-center text-white">
                    <p class="display-4 fw-bolder ">Liste des Comptes existants </p>
                      
                </div>
            </div>
    </header>
<div class="card-body">
        <table>
    <thead>
        <tr>
            <th>Mail</th>
            <th>Grade</th>
            <th>Matricule Visiteur</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $comptes = getInfComptes();
        foreach ($comptes as $compte) {
            echo '<tr>';
            echo '<td>' . $compte['Mail_co'] . '</td>';
            echo '<td>' . $compte['grade'] . '</td>';
            echo '<td>' . $compte['mat_vis'] . '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
    </div>
    </body>
</html>