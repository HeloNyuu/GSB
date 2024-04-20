<!-- Formulaire qui affiche une liste déroulante pour choisir un medicament pour voir les info -->
	<section>
	

</h2>
<?php $test=$_POST['choix'];?>



<?php $infoDesMeds=getLesDetailsDesMedicaments($test); ?>


<div class="card text-center mt-5">
  <div class="card-header">
    <h2>Info du Medicament : <?php echo $_POST['choix']; ?> </br>
</h2>
  </div>
  <div class="card-body">
    
    <p class="card-text"><h4>Depot legal: </h4><?php echo $infoDesMeds[0]['MED_DEPOTLEGAL'];?> </p>
    <p class="card-text"><h4>Famille: </h4><?php echo $infoDesMeds[0]['FAM_LIBELLE'];?> </p>
    <p class="card-text">Composition: <?php echo $infoDesMeds[0]['MED_COMPOSITION'];?> </p>
    <p class="card-text">Effet secondaire: <?php echo $infoDesMeds[0]['MED_EFFETS'];?> </p>
    <p class="card-text">Contre indication: <?php echo $infoDesMeds[0]['MED_CONTREINDIC'];?> </p>
    
    
  </div>
  
</div>


	<section>

    