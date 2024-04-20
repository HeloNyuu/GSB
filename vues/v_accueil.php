<!DOCTYPE html>
<html lang="fr"> 
    <body>
       
        
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Bienvenue</h1>
                    <p class="lead fw-normal text-white-50 mb-0"><?php echo $nom[0][0]." ".$nom[0][1];?></p>
                    <p class="lead fw-normal text-white-50 mb-0">Grade : 
                    <?php
                    if (isset($grade)) {
                        if ($grade[0][0] == 1) {
                        echo "Visiteur";
                    }
                    if ($grade[0][0] == 2) {
                        echo "visiteur delegué";
                    }
                    if ($grade[0][0] == 5) {
                        echo "administrateur";
                    }
                    }
                    ?>
                    </p> 
                </div>
               
            </div>

        </header>
        <?php
        ?>
    </body>
</html>
