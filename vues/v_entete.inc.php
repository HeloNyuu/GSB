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
    <a class="navbar-brand" href="index.php?uc=accueil&action=pageAccueil">GSB</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?uc=accueil&action=pageAccueil">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?uc=rapport&action=voirLesPraticiens">Praticien</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?uc=rapport&action=voirLesMedicaments">Medicament</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?uc=rapport&action=ajouterRapportVis">Saisie Rapport Visite</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?uc=rapport&action=affiInfoPratRapport">Rapport de visite</a>
        </li>

        <?php if (isset($grade)&&$grade[0][0] == 5) : ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?uc=creerCompte&action=creerCompte">Création de compte</a>
        </li>
        <?php endif; ?>
        <?php if (isset($grade)&&$grade[0][0] == 2) : ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?uc=rapport&action=affiInfoPratRapTout"> rapport de visite par region </a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?uc=connexion&action=deconnexion">Deconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

</body>
</html>