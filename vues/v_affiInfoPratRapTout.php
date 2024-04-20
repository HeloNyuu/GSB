
  <section>
  

  
  
</h2>

<?php $session= $_COOKIE['connexion']; ?>
<?php $misMat=getVisMatConnecte($session);?>

<br>


<?php $infoRapportVisite=getRapportPartRegion($sct); ?>







<?php $numRap=0; 
if(sizeof($infoRapportVisite) > 0):
  foreach ($infoRapportVisite as $uneInfoRapportVisite) { 
    $numEche=0; 
    $praNom=getPraNom($uneInfoRapportVisite['PRA_NUM']); 
    $praNomRemplacant=getPraNom($uneInfoRapportVisite['remplacant']); 
    ?>

  <div class="card text-center mt-4 mb-4">
    <div class="card-header">
      <?php if ($numRap <= 0):  ?>
        <h2>Liste des rapports de visite </br>
      <?php  ?>
      <?php endif;?>
  </h2>
    </div>
    <div class="card-body">
      <p class="card-text">Matricule: <?php echo $uneInfoRapportVisite['VIS_MATRICULE'];?> </p>
      <p class="card-text">Nom du praticient: <?php echo $praNom[0][0];?> - <?php echo $praNom[0][1];?> </p>
      <p class="card-text">Remplacant:
      <?php if ($uneInfoRapportVisite['remplacant'] == 'Aucun') {
          echo 'Aucun'; 
        }
        else{
          echo $praNomRemplacant[0][0]. ' - ' .$praNomRemplacant[0][1];    
        }
        
      ?>
        
      </p>
      <p class="card-text">Numéro du rapport de visite: <?php echo $uneInfoRapportVisite['RAP_NUM'];?> </p>
      <p class="card-text">Date du rapport de visite: <?php echo $uneInfoRapportVisite['RAP_DATE'];?> </p>
      <p class="card-text">Bilan du rapport de visite: <?php echo $uneInfoRapportVisite['RAP_BILAN'];?> </p>
      <p class="card-text">Motif de la visite: <?php echo $uneInfoRapportVisite['RAP_MOTIF'];?> </p>
      <p class="card-text">Saisie definitive: <?php echo $uneInfoRapportVisite['saisieDef'];?> </p>

      <?php $produitsPresente = getProduitsPrésente($uneInfoRapportVisite['VIS_MATRICULE'],$uneInfoRapportVisite['RAP_NUM']); ?>
      
      
      <p class="card-text">Produit présenté: 
        <?php if (empty($produitsPresente)) {
          echo 'Aucun';
        }
        else{
          echo "<br> Produit 1: ".$produitsPresente[0][0]. " <br>  Produit 2: ".$produitsPresente[0][1];
        }?>

      
      <p class="card-text">Echantillion Offert:    

        <?php $echantillionOffert=getEchantillionOffert($uneInfoRapportVisite['VIS_MATRICULE'],$uneInfoRapportVisite['RAP_NUM']); ?>
        <?php if (empty($echantillionOffert)) {
          echo 'Aucun';
        }?>
        
        <?php $medOffert = getMedicamentOffert($uneInfoRapportVisite['VIS_MATRICULE'],$uneInfoRapportVisite['RAP_NUM']); ?>
        
        <?php foreach ($medOffert as $unMedOffert) { ?> 
          <br>

          Medicament: <?php echo $unMedOffert[0]; ?>
          -
          Quantité: <?php echo $unMedOffert[1] ; ?>

          
        <?php $numEche++; } ?>


       </p>
       
    </div>
  </div>
</div>
  <?php $numRap++; ?>

<?php } ?>

<?php else: ?>

  <div class="card text-center mt-4">
    <div class="card-header">
      <div class="card-body">
        <p class="card-text"> Aucun rapport de visite </p>

<?php endif;?>
  <section>
