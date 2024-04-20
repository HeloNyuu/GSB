<!DOCTYPE html>
<html>
<?php
require_once "modele/bdFunct.inc.php";
if (isset($_POST["mail"])) {
$recupMat = getInfoVisiteur($_POST['mail']);
$nom = getNom($recupMat[0][3]);
$grade = getGrade($recupMat[0][3]);
}
elseif (isset($_COOKIE["connexion"])) {
  $recupMat = getInfoVisiteur($_COOKIE["connexion"]);
$nom = getNom($recupMat[0][3]);
$grade = getGrade($recupMat[0][3]);
}

?>
<head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
        <link rel="stylesheet" href="bootstrap.css" media="screen" type="text/css" />
        <script type="text/javascript" src="bootstrap.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">

        <a class="navbar-brand" href="index.php?uc=accueil&action=pageAccueil">
            <img src="assets/images/logo.png" alt="Logo GSB" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?uc=accueil&action=pageAccueil">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?uc=rapport&action=voirLesPraticiens">Praticien</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?uc=rapport&action=voirLesMedicaments">Medicament</a>
        </li>
        <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRapports" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Rapports
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownRapports">
                        <li><a class="dropdown-item" href="index.php?uc=rapport&action=ajouterRapportVis">Saisir un Rapport</a></li>
                        <li><a class="dropdown-item" href="index.php?uc=rapport&action=affiInfoPratRapport">Rechercher un Rapport</a></li>
                    </ul>
                </li>

        <?php if (isset($grade)&&$grade[0][0] == 5) : ?>
          <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Comptes
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="index.php?uc=creerCompte&action=creerCompte">Création de compte</a></li>
                        <li><a class="dropdown-item" href="index.php?uc=connexion&action=listeCompte">Liste de comptes</a></li>
                    </ul>
                </li>
        <?php endif; ?>
        <?php if (isset($grade)&&$grade[0][0] == 2) : ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?uc=rapport&action=affiInfoPratRapTout"> rapport de visite par region </a>
          </li>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php?uc=connexion&action=deconnexion">Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


</body>
</html>