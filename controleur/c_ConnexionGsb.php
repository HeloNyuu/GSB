<?php
// contrôleur qui gère les enfants et les familles


if (!isset($_REQUEST['action']))
    $action= 'connexion'; 
else{
	$action = $_REQUEST['action'];
}
	
switch($action)
{
	case 'connexion':
	{
		include_once("vues/v_connexion.php");
	}
	break;
	case 'deconnexion':
	{
		setcookie("connexion",  "", time() - 3600, "/");
		header("Location: index.php");
	
	}

	case 'Verification':
	{
		$info=VerifyUt($_POST['mail']);
		if(is_null($info)){
			echo "l'utilisateur n'existe pas";
			include("vues/v_connexion.php");
		}
		else{
			$verify=password_verify($_POST['password'], $info[0]);
			if ($verify) 
			{
				$recupMat = getInfoVisiteur($_POST['mail']);
				$nom = getNom($recupMat[0][3]);
				$grade = getGrade($recupMat[0][3]);
				setcookie("connexion",$_POST["mail"], 0, "/");//cookie pour check la connexion
				$_COOKIE["connexion"]=$_POST["mail"];
				header('Location:index.php?uc=accueil&action=pageAccueil');			
			}
			else
			{
				echo "mot de passe  incorrecte";
				include("vues/v_connexion.php");
			}
		}
	}
	break;
	case 'accueil':
	{
		include("vues/v_accueil.php");
	}
	break;

	case '':
	break;
}
