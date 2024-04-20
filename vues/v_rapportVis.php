<!-- Formulaire de création d'un rapport de visite -->
<section>
    <h2 class="d-flex text-center justify-content-center mt-4 mb-4">Ajout d'un rapport de visite</h2>
	<!-- attribut action à compléter : c'est le case ajouterFamille qui réalisera l'ajout -->

	 


	<form method="post" action="index.php?uc=rapport&action=insertRapport">

   

	<div class="form-group" style="width:350px;">
	<label for="nom">Date Visite: </label>
	<input type="datetime-local" name="dateVis" class="form-control"  id="dateVis" />
	
	</div>

	<br>

	<div class="form-group">
		<label for="prat">Praticien: </label>
	<select name="praticien" id="prat">
		<?php
	// affichage des medicaments
	$lesPraticiens = getLesPraticiens();
    foreach ($lesPraticiens as $unPraticien) {
    	echo '<OPTION value='.$unPraticien['PRA_NUM'].'>'.$unPraticien['PRA_NOM'].'-'.$unPraticien['PRA_PRENOM'].'</OPTION>';
    }
    ?>

	</select>

	<br>
	<br>

	<div class="form-group">
	<label for="rempl">Remplacant: </label>
	<br>
	<input type="checkbox" name="rempl" value="value1" > 
	<select name="remplacant" id="idRemplacant" class="listRemplacant">
		<?php
	// affichage des remplacants
	$lesPraticiens = getLesPraticiens();
    foreach ($lesPraticiens as $unPraticien) {
    	echo '<OPTION value='.$unPraticien['PRA_NUM'].'>'.$unPraticien['PRA_NOM'].'-'.$unPraticien['PRA_PRENOM'].'</OPTION>';
    }
	
    ?>
	</select>
	</div>

	<br>
	<br>
	<div class="form-group">
	<label for="motif">Motif: </label>
	<select name="motif" id="idMotif">
		<?php
	// affichage des motifs
	$lesMotifs = getLesMotifs();
    foreach ($lesMotifs as $unMotif) {
    	echo '<OPTION value='.$unMotif['libelle_motif'].'>'.$unMotif['libelle_motif'].'</OPTION>';
    }
    ?>
	</select>

	<p class="mt-3"> Autre motif: </p>

	<input type="checkbox" name="rempl" value="valueMotif" > 
		<input type="textarea" name="autreMotif" class="autreMotif"  />
	
	</div>
	<br>

	<label for="bilanRapport">Bilan:</label>
    <input type="textarea" name="bilanRap" class="form-control" id="bilanRap" />
	</div>

	<br>
	<br>
	<h4> Élements présentés </h4>
	<br>

	<label for="Produit1">Produit 1: </label>
	<SELECT name="produit1">
	<option value="Aucun"> Aucun </option>
    <?php
	// affichage des medicaments
	$lesMedicaments = getLesMedicaments();
    foreach ($lesMedicaments as $unMedicament) {
    	echo '<OPTION value='.$unMedicament['MED_NOMCOMMERCIAL'].'>'.$unMedicament['MED_NOMCOMMERCIAL'].'</OPTION>';
    }
    ?>
    </SELECT>
	<br>
	<br>
	<label for="Produit2">Produit 2: </label>
    <SELECT name="produit2">
    <option value="Aucun"> Aucun </option>
    <?php
	// affichage des medicaments
	$lesMedicaments = getLesMedicaments();
    foreach ($lesMedicaments as $unMedicament) {
    	echo '<OPTION value='.$unMedicament['MED_NOMCOMMERCIAL'].'>'.$unMedicament['MED_NOMCOMMERCIAL'].'</OPTION>';
    }
    ?>
    </SELECT>
    <br>
    <br>

	<h4> Échantillons offerts </h4>
	<br>
	<label for="produit">Produit:   </label>
	<br>
	
	<div class="echantillon">
	<SELECT name="echantillonName[]">
	<option value="Aucun produit">Aucun produit</option>
    <?php
	// affichage des medicaments
	$lesMedicaments = getLesMedicaments();

    foreach ($lesMedicaments as $unMedicament) {
    	echo '<OPTION value='.$unMedicament['MED_NOMCOMMERCIAL'].'>'.$unMedicament['MED_NOMCOMMERCIAL'].'</OPTION>';
    }
    ?>
    </SELECT>
    <input name="echantillonCount[]" class="form-control" style="width: 20%;display: inline;" type="number" value="1" min="1" max="100">
    
    </div>

    <a class="btn btn-info" style="background-color: #2D7EF1; border-color: #2D7EF1; color:black;" onclick="ajouterEchantillon(this)">+</a>



   

	<br>
	<br>


	<label for="saisieDef">Saisie définitive:   </label>
	<input type="checkbox" name="saisieDef" value="saisieDef"> 
	<br>
	<br>

<input type="submit" class="btn btn-primary btn-md" value="Envoyer"/>
<input type="reset" class="btn btn-primary btn-md" value="Annuler" />

</form>
</section>