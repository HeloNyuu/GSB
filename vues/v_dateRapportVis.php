<!DOCTYPE html>
<html lang="fr"> 
<!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5 mt-4">
                <div class="text-center text-white">
                    <p class="display-4 fw-bolder ">Sélectionnez la période souhaitée </p>
                      
				    
                </div>
            </div>
        </header>


    <body>
        <form method="post" action="index.php?uc=rapport&action=affiInfoPratRapport" class="mt-4">

            <div class="d-flex justify-content-center mt-2">

                <div class="form-group mb-3  " style="width: 300px; " >
                    <label for="nom">Date début: </label>
                    <input type="date" name="dateDebut" class="form-control "  id="dateDebut" />
                </div>
                

                <div class="form-group mb-3 " style="width: 300px; ">
                    <label for="nom">Date fin: </label>
                    <input type="date" name="dateFin" class="form-control "  id="dateFin" />
                </div>

            </div>



            <input type="submit" class="btn btn-primary btn-md mt-4" value="Rechercher"/>

        </form>
       <?php
		if(isset($dateIncorrecte)){ 
			echo $dateIncorrecte; 
			} 
	?>         
        
        
    </body>
</html>


<?php ?>