<!-- Formulaire qui affiche une liste déroulante pour choisir un medicament pour voir les info -->
<!DOCTYPE html>
<html lang="fr"> 
<body>
<?php $test=$_POST['choix'];?>


<?php $infoDesPrat=getLesDetailsDesPraticiens($test); ?>

<header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">

                    
                    </p> 
                </div>
               
            </div>

        </header>




<div class="card text-center mt-5">
  <div class="card-header">
    <h2>Info du Praticien : <?php echo $_POST['choix']; ?> </br>
</h2>
  </div>
  <div class="card-body">
    <p class="card-text">Nom: <?php echo $infoDesPrat[0]['PRA_NOM'];?> </p>
    <p class="card-text">Prenom: <?php echo $infoDesPrat[0]['PRA_PRENOM'];?> </p>
    <p class="card-text">Adresse: <?php echo $infoDesPrat[0]['PRA_ADRESSE'];?> </p>
    <p class="card-text">Code Postal: <?php echo $infoDesPrat[0]['PRA_CP'];?> </p>
    <p class="card-text">Ville: <?php echo $infoDesPrat[0]['PRA_VILLE'];?> </p>
    <p class="card-text">Coefficient de notoriété: <?php echo $infoDesPrat[0]['PRA_COEFNOTORIETE'];?> </p>
    <p class="card-text">Spécialité: <?php echo $infoDesPrat[0]['TYP_LIBELLE'];?> </p>
    <p class="card-text">Lieu de profession: <?php echo $infoDesPrat[0]['TYP_LIEU'];?> </p>
    
    
  </div>
</div>


</body>

    

