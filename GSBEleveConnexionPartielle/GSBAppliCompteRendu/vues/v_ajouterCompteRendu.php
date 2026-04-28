<?php
/**
 * ADD VISIT REPORT FORM VIEW
 * Displays form for creating new medical visit reports
 * Includes: Practitioner selection, visit date, motivation, medications, samples
 * Used by: c_ajouterCompteRendu.php
 * Variables: $lesPraticiens, $lesMotifs, $lesMedicaments
 */
?>
<div id="contenu">
	<h2>Compte-rendu de visite</h2>
	<form method="POST" action="index.php?uc=ajouterCompteRendu&action=valider">

			<p>
				<label for="txtNumero">NUMERO : </label>
				<input type="text" size="10" name="txtNumero" id="txtNumero"/>
			</p>
			<p>
				<label for="txtDateVisite">DATE VISITE : </label>			
				<input type="date" size="10" name="txtDateVisite" id="txtDateVisite" />
			</p>
			<p>
				<label for="lstPraticien">PRATICIEN : </label>
				<select id="lstPraticien" name="lstPraticien" >
			<option value="">-- Choisir un praticien --</option>
				<?php foreach ($lesPraticiens as $praticien) { ?>
        <option value="<?= $praticien['PRA_NUM'] ?>">
            <?= $praticien['PRA_NOM'] . ' ' . $praticien['PRA_PRENOM'] ?>
        </option>
    <?php } ?>
				</select>
			</p>
			<p>
				<label for="txtConfiance">COEFFICIENT CONFIANCE : </label>
				<input type="text" size="6" name="txtConfiance" id="txtConfiance" />
			</p>
			<p>
				<label for="lstRemplacant">REMPLACANT : </label>
			<select id="lstRemplacant" name="lstRemplacant" >
			<option value="">-- Aucun --</option>
				<?php foreach ($lesPraticiens as $praticien) { ?>
        <option value="<?= $praticien['PRA_NUM'] ?>">
            <?= $praticien['PRA_NOM'] . ' ' . $praticien['PRA_PRENOM'] ?>
        </option>
    <?php } ?>
				</select>
			</p>
			<p>
				<label for="lstMotif">MOTIF : </label>
				<select id="lstMotif" name="lstMotif" >
<?php foreach ($lesMotifs as $motif) { ?>
        <option value="<?= $motif['id'] ?>">
            <?= $motif['libelle'] ?>
        </option>
    <?php } ?>
				</select>
				<input type="text" name="txtAutreMotif" />
			</p>
			<p>
				<label for="txtBilan" ><h3> Bilan </h3></label>
				<textarea rows="5" cols="50" name="txtBilan" id="txtBilan" ></textarea>
			</p>
			<p>
				<label class="titre" ><h3> Eléments présentés </h3></label>
				<label for="chkProduitPresente1">COCHEZ LA CASE : </label>
				<input type="checkbox" name="chkProduitPresente1" id="chkProduitPresente1"/>
				<label for="lstProduit1">CHOISIR PRODUIT 1 : </label>
				<select id="lstProduit1" name="lstProduit1" >
				<?php foreach ($lesMedicaments as $medicament) { ?>
    <option value="<?= $medicament['id'] ?>">
        <?= $medicament['nom'] ?>
    </option>
<?php } ?>
				</select>
				<label for="chkProduitPresente2">COCHEZ LA CASE : </label>
				<input type="checkbox" name="chkProduitPresente2" id="chkProduitPresente2"/>
				<label for="lstProduit2">CHOISIR PRODUIT 2 : </label>
				<select id="lstProduit2" name="lstProduit2" >
				<?php foreach ($lesMedicaments as $medicament) { ?>
    <option value="<?= $medicament['id'] ?>">
        <?= $medicament['nom'] ?>
    </option>
<?php } ?>
   
				</select>
				<label for="chkDoc">DOCUMENTATION OFFERTE : </label>
				<input name="chkDoc" type="checkbox" id="chkDoc"/>
			</p>
			<p>
				<label class="titre"><h3>Echantillons</h3></label>
				<div class="titre" id="lignes">

				<?php for ($i = 1; $i <= 10; $i++) { ?>
        <?php if ($i % 2 != 0) { ?>
            <p>
        <?php } ?>
        
        <label for="lstEchantillon<?php echo $i; ?>">PRODUIT <?php echo $i; ?> : </label>
        <select id="lstEchantillon<?php echo $i; ?>" name="lstEchantillon[]">
            <option value="">-- Choisir un produit --</option>
            <?php foreach ($lesMedicaments as $medicament) { ?>
                <option value="<?= $medicament['id'] ?>">
                    <?= $medicament['nom'] ?>
                </option>
            <?php } ?>
        </select>
        <input type="text" name="txtQte[]" size="2" placeholder="Qté"/>
        
        <?php if ($i % 2 == 0) { ?>
            <br>
            </p>
        <?php } ?>
    <?php } ?>
			
				</div>
			</p>
			<p>
				<label for="txtDateSaisie">DATE SAISIE : </label>
				<input type="text" size="10" name="txtDateSaisie" id="txtDateSaisie"/>
			</p>
			<p>
				<label for="chkSaisie">SAISIE DEFINITIVE : </label>
				<input name="chkSaisie" type="checkbox" id="chkSaisie" />
			</p>
			<p>
				<input type="submit" value="Valider"></input>			
				<input type="reset" value="Annuler"></input>
			</p>
		</form>


