<!-- Formulaire qui affiche une liste déroulante pour choisir un medicament pour voir les info -->
<section>
	

	<FORM action="index.php?uc=gestionPage&action=affiInfoPratRapport" method="post">
	<h2>Choix d'un praticien </h2>
	<section>

    <SELECT name="choix">

    <?php
	// affichage des medicaments
	$lesPraticiens = getLesPraticiens();
    foreach ($lesPraticiens as $unPraticien) {
    	echo '<OPTION value='.$unPraticien['PRA_NUM'].'>'.$unPraticien['PRA_NOM'].'-'.$unPraticien['PRA_PRENOM'].'</OPTION>';
    }
	
    ?>
    </SELECT>
	<INPUT type="submit" value="Valider" name="valider"/>
	</form>
	</section>
