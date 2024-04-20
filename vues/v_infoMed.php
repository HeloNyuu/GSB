<!-- Formulaire qui affiche une liste déroulante pour choisir un medicament pour voir les info -->
	<section>
	

	<FORM action="index.php?uc=affiMed&action=medicamentChoisie" method="post">
	<h2>Choix d'un medicament </h2>
	<section>

    <SELECT name="choix">

    <?php
	// affichage des medicaments
	$lesMedicaments = getLesMedicaments();
    foreach ($lesMedicaments as $unMedicament) {
    	echo '<OPTION value='.$unMedicament['MED_NOMCOMMERCIAL'].'>'.$unMedicament['MED_NOMCOMMERCIAL'].'</OPTION>';
    }
	
    ?>
    </SELECT>
	<INPUT type="submit" value="Valider" name="valider"/>
	</form>
	</section>

