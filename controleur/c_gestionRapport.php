<?php

// contrôleur qui gère les rapports de visite
if (!isset($_REQUEST['action']))
    $action= 'accueil'; 
else
	$action = $_REQUEST['action'];

switch($action)
{
	case 'ajouterRapportVis':
	{
		include("vues/v_rapportVis.php");
	}
	break;

	case 'voirLesMedicaments':
	{
  		$lesMedicaments = getLesMedicaments();
		include("vues/v_infoMed.php");
  		
	}break;

	case 'voirLesPraticiens':
		{
			$lesPraticien = getLesPraticiens();
			include("vues/v_InfoPrat.php");
			  
		}break;

	case 'voirInfoPrat':{
		include("vues/v_affiInfoPrat.php");
	}
	break;

	case 'pageAccueil':{
		$recupMat = getInfoVisiteur($_COOKIE["connexion"]);
		$nom = getNom($recupMat[0][3]);
		include("vues/v_accueil.php");
	}
	break;

	case 'affiInfoPratRapport':{
		$dateDebut = @htmlspecialchars($_POST['dateDebut']);
		$dateFin = @htmlspecialchars($_POST['dateFin']);
		
		if ($dateDebut < $dateFin) {
			include("vues/v_affiInfoPratRapport.php");
		}
		else{
			echo "date incorrecte";
			include("vues/v_dateRapportVis.php");
		}

		
	}
	break;
	case 'affiInfoPratRapTout':
	$sct=getSecteur($_COOKIE["connexion"]);
	include ("vues/v_affiInfoPratRapTout.php");
		break;

	case 'dateRapportVis':{
		include("vues/v_dateRapportVis.php");
	}
	break;

	case 'modifierRapport':{
		include("vues/v_modificationRapportVis.php");
	}
	break;

	case 'insertRapport':{
		$praticien = htmlspecialchars($_POST['praticien']);
		$dateVis = htmlspecialchars($_POST['dateVis']);
		$bilanRap = htmlspecialchars($_POST['bilanRap']);
		$motif = htmlspecialchars($_POST['motif']);
		$remplacant = 'Aucun';
		
		$produit1 = htmlspecialchars($_POST['produit1']);
		$produit2 = htmlspecialchars($_POST['produit2']);

		if (isset($_POST['rempl'])) {
			$remplacant = htmlspecialchars($_POST['remplacant']);
		}

		if ($dateVis == '') {
			$dateIncorrecte = "Veuillez saisir une date";
			include("vues/v_rapportVis.php");
		
		}
		

		$session= $_COOKIE['connexion']; 
		$misMat=getVisMatConnecte($session);

		$infoRapportVisite=getLesDetailsDesPraticiensRapport1($misMat[0]['mat_vis']); 
		if (isset($_POST['saisieDef'])) {
			$saisieDef = 'oui';
		}
		else{
			$saisieDef = 'non';
		}

      	
        
		try{
            $monPdo = connexionPDO();
            $req = $monPdo->prepare('INSERT INTO rapport_visite (VIS_MATRICULE, PRA_NUM, remplacant, RAP_DATE, RAP_BILAN, RAP_MOTIF,saisieDef)
 			VALUES
 			("'.$infoRapportVisite[0][0].'", '.$praticien.',"'.$remplacant.'", "'.$dateVis.'", "'.$bilanRap.'", "'.$motif.'","'.$saisieDef.'")');  
         
           	$req->execute([]);
            $numRapp=$monPdo->lastInsertId();
          
       
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();

        die();
        }



        try{
            $monPdo = connexionPDO();
            $req = 'INSERT INTO presente (VIS_MATRICULE, RAP_NUM, produit1, produit2)
 			VALUES
 			("'.$infoRapportVisite[0][0].'", '.$numRapp.', "'.$produit1.'", "'.$produit2.'")'; 
            //revoir la sécurité
            $res = $monPdo->query($req);
          
       
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }


         $echantillons = [];
                foreach($_POST['echantillonName'] as $key => $value)
                {
                    if($value != "Aucun produit")
                    {
                        $echantillons[] = [$value, $_POST['echantillonCount'][$key]];
                    }
                }

                

        foreach($echantillons as $echantillon)
		{
			
		    try {
		        $monPdo = connexionPDO();
		        $req = $monPdo->prepare("
		            INSERT IGNORE INTO offrir (
		            	VIS_MATRICULE,
		            	rap_num,
		                med_depotlegal,
		                off_qte)
		                VALUES(?, ?, ?, ?);
		                ");
		        
		        @$req->execute([
		        	$misMat[0]['mat_vis'],
		        	$numRapp,
		            $echantillon[0],
		            $echantillon[1]
		        ]);
		    } catch(Exception $e){
		    	print "Erreur !: " . $e->getMessage();
        		die();
		    }
		}
                



		echo "<div class='alert alert-success bg-white text-blue '>Votre rapport de visite à bien été saisie</div>";
		include("vues/v_dateRapportVis.php");
	}
	break;

	case 'updateRapport':
	{
		

 		$visMat = $_GET['leVisMat'];
 		$rapNum = $_GET['leIdRap'];

		if (isset($_POST['saisieDef'])) {
			$saisieDef = 'oui';
		}
		else{
			$saisieDef = 'non';
		} 


		$praticien = htmlspecialchars($_POST['praticien']);
		$dateVis = htmlspecialchars($_POST['dateVis']);
		$bilanRap = htmlspecialchars($_POST['bilanRap']);
		$motif = htmlspecialchars($_POST['motif']);
		$remplacant = 'Aucun';
		
		$produit1 = htmlspecialchars($_POST['produit1']);
		$produit2 = htmlspecialchars($_POST['produit2']);

		


		if (isset($_POST['rempl'])) {
			$remplacant = htmlspecialchars($_POST['remplacant']);
		}

		if ($dateVis == '') {
			$dateIncorrecte = "Veuillez saisir une date";
			include("vues/v_rapportVis.php");
			break;
		}

		try{
            $monPdo = connexionPDO();
            $req = 'UPDATE rapport_visite SET 
            PRA_NUM = '.$praticien.',
            remplacant = "'.$remplacant.'",
            RAP_DATE = "'.$dateVis.'",
            RAP_BILAN = "'.$bilanRap.'",
            RAP_MOTIF = "'.$motif.'",
            saisieDef = "'.$saisieDef.'"
            
 			WHERE VIS_MATRICULE="'.$visMat.'" and RAP_NUM="'.$rapNum.'"'; 
            //revoir la sécurité
            $res = $monPdo->query($req);
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();

        die();
        }


         try{
            $monPdo = connexionPDO();
            $req = 'UPDATE presente SET 
            produit1 = "'.$produit1.'",
            produit2 = "'.$produit2.'"
            WHERE VIS_MATRICULE="'.$visMat.'" and RAP_NUM="'.$rapNum.'"'; 
            //revoir la sécurité
            $res = $monPdo->query($req);
          
       
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }

        try{
            $monPdo = connexionPDO();
            $req = 'DELETE FROM offrir
            WHERE VIS_MATRICULE="'.$visMat.'" and RAP_NUM="'.$rapNum.'"'; 
            //revoir la sécurité
            $res = $monPdo->query($req);
          
       
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }


        $echantillons = [];
                foreach($_POST['echantillonName'] as $key => $value)
                {
                    if($value != "Aucun produit")
                    {
                        $echantillons[] = [$value, $_POST['echantillonCount'][$key]];
                    }
                }

        foreach($echantillons as $echantillon)
		{
			
		    try {
		        $monPdo = connexionPDO();
		        $req = $monPdo->prepare("
		            INSERT IGNORE INTO offrir (
		            	VIS_MATRICULE,
		            	rap_num,
		                med_depotlegal,
		                off_qte)
		                VALUES(?, ?, ?, ?);
		                ");
		        
		        @$req->execute([
		        	$visMat,
		        	$rapNum,
		            $echantillon[0],
		            $echantillon[1]
		        ]);
		    } catch(Exception $e){
		    	print "Erreur !: " . $e->getMessage();
        		die();
		    }
		}
		echo "<div class='alert alert-success bg-white text-blue '>Votre rapport de visite à bien été modifiée</div>";
		include("vues/v_dateRapportVis.php");

	}
		break;




case 'medicamentChoisie':
	{
		//récupération du choix effectué dans la liste déroulante
		include("vues/v_affiInfoMed.php");
		// $choixMediment= $_POST['choix'];
		// if($choixMediment ==''){
		// 	include('');
		// 	}
		// 		else{
		// 		include('');
		// 		}

		
	}break;
case 'creerCompte':{
	include("vues/v_creationCompte.php");
	}break;


}





?>