<?php



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
	break;
	case 'creerCompte':
	{
		include("vues/v_creationCompte.php");
	}
	break;

	case 'listeCompte':
		{
			include_once("vues/v_listeCompte.php");
		}
		break;

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

	case 'insertCompte':
		{
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				// Récupére les valeurs du formulaire
				$crea_mat = $_POST['crea_nom'];
				$crea_mail = $_POST['crea_mail'];
				$crea_grade = $_POST['crea_grade'];
				$crea_mdp = password_hash($_POST['crea_mdp'], PASSWORD_DEFAULT );
		
				try {
					// Connexion à la base de données
					$monPdo = connexionPDO();
					
					// Prépare la requête SQL avec des paramètres
					$sql = 'INSERT INTO compte (MDP_CO, MAIL_CO, GRADE, MAT_VIS) VALUES (?, ?, ?, ?)';
					$stmt = $monPdo->prepare($sql);
					
					// Lie les valeurs aux paramètres dans la requête
					$stmt->bindParam(1, $crea_mdp);
					$stmt->bindParam(2, $crea_mail);
					$stmt->bindParam(3, $crea_grade);
					$stmt->bindParam(4, $crea_mat);
					
					// Exécute la requête
					$stmt->execute();
					
					// Vérifie si l'insertion a réussi
					if ($stmt->rowCount() > 0) {
						echo "Insertion réussie.";
					} else {
						echo "Erreur lors de l'insertion.";
					}
				} catch (PDOException $e) {
					// En cas d'erreur, affiche le message d'erreur
					print "Erreur !: " . $e->getMessage();
					die();
				}
		
				// Inclure le fichier de vue après l'insertion
				include("vues/v_creationCompte.php");
			}
			break;
		}
		





		
	
}


?>

