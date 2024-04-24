<?php
if(isset($_REQUEST['uc']))
{
    if (isset($_COOKIE["connexion"] ))
        {
            
            include("vues/v_entete.inc.php") ;
        }
    require_once('modele/bdFunct.inc.php');
}
if (!isset($_REQUEST['uc']))
     $uc = 'connexion'; // si $_GET['uc'] n'existe pas , $uc reçoit une valeur par défaut
else
    $uc = $_REQUEST['uc'];

 
switch($uc)
{
    case 'accueil':{
        include("controleur/c_gestionRapport.php");
    }
        break;
    case 'connexion' :
    {
        include("controleur/c_ConnexionGsb.php");
    }
    break;

    case 'rapport' : 
        { 
            include("controleur/c_gestionRapport.php");
        }
        break;

    case 'affiMed' :{
        include("controleur/c_gestionRapport.php");
    }
    break;

    case 'gestionPage':{
        include("controleur/c_gestionRapport.php");
    }
    break;
    case 'creerCompte': {
        include("controleur/c_ConnexionGsb.php");
    }
}
include("vues/v_piedpage.inc.php") ;
?>
