<?php
/**
 * MODIFY VISIT REPORT FORM VIEW
 * Displays form for editing existing medical visit reports
 * Includes: Practitioner selection, visit date, motivation, medications, samples
 * Used by: c_modifierCompteRendu.php
 * Variables: $lesPraticiens, $lesMotifs, $lesMedicaments, $compteRendu
 */
?>
<div id="contenu">
<h2>Modifier un compte rendu</h2>
<form method="POST"  action="index.php?uc=majCompteRendu&action=valideModif">
		<p>
			<label for="txtNumero">NUMERO : </label>
			<input type="text" size="10" id="txtNumero" name="txtNumero" readonly
	value="<?= htmlspecialchars($rapport['RAP_NUM']) ?>" />
		
		</p>
		<p>
			<label for="txtDateVisite">DATE VISITE : </label>			
			<input type="date" size="10" id="txtDateVisite" name="txtDateVisite"
	value="<?= htmlspecialchars($rapport['RAP_DATE_VISITE']) ?>" />

		</p>
		<p>
			<label for="lstPraticien">PRATICIEN : </label>
			<select id="lstPraticien" name="lstPraticien" >
			<?php foreach($lesPraticiens as $pra): ?>
	<option value="<?= $pra['PRA_NUM'] ?>" <?= $pra['PRA_NUM']==$rapport['PRA_NUM']?'selected':'' ?>>
		<?= htmlspecialchars($pra['PRA_NOM'].' '.$pra['PRA_PRENOM']) ?>
	</option>
<?php endforeach; ?>
			</select>
		</p>
		<p>
		<label for="txtConfiance">COEFFICIENT CONFIANCE : </label>
		<input type="text" id="txtConfiance" name="txtConfiance"
       value="<?= htmlspecialchars($rapport['PRA_COEFCONFIANCE']) ?>">
			
			</p>
		
		<p>
			<label for="lstRemplacant">REMPLACANT : </label>

			<select id="lstRemplacant" name="lstRemplacant" >
			<option value="">-- Aucun --</option>
			<?php foreach($lesPraticiens as $pra): ?>
				<option value="<?= $pra['PRA_NUM'] ?>" <?= $pra['PRA_NUM']==$rapport['PRA_NUM_REMPLACANT']?'selected':'' ?>>
					<?= htmlspecialchars($pra['PRA_NOM'].' '.$pra['PRA_PRENOM']) ?>
				</option>
			<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="lstMotif">MOTIF : </label>
			<select id="lstMotif" name="lstMotif" >
			<?php foreach($lesMotifs as $motif): ?>
				<option value="<?= $motif['id'] ?>" <?= $motif['id']==$rapport['MOT_CODE']?'selected':'' ?>>
					<?= htmlspecialchars($motif['libelle']) ?>
				</option>
			<?php endforeach; ?>
			</select>
			<input type="text" size="30" name="txtAutreMotif"
				value="<?= htmlspecialchars($rapport['RAP_MOTIF_AUTRE']) ?>" />
		</p>
		<p>
		<label for="txtBilan"><h3>Bilan</h3></label>
		<textarea rows="5" cols="50" id="txtBilan" name="txtBilan">
		<?= htmlspecialchars($rapport['RAP_BILAN']) ?>
		</textarea>
		</p>
		<p>
    <label class="titre"><h3>Éléments présentés</h3></label>

    <?php for ($i = 0; $i < 2; $i++): 
        $produit = $produitsPresente[$i]['id'] ?? '';
    ?>
        <label for="chkProduitPresente<?= $i+1 ?>">COCHEZ LA CASE :</label>
        <input type="checkbox" name="chkProduitPresente<?= $i+1 ?>" value="1"
            <?= !empty($produit) ? 'checked' : '' ?> />

        <label for="lstProduit<?= $i+1 ?>">CHOISIR PRODUIT <?= $i+1 ?> :</label>
        <select id="lstProduit<?= $i+1 ?>" name="lstProduit<?= $i+1 ?>">
            <option value="">-- Aucun --</option>
            <?php foreach($lesMedicaments as $med): ?>
                <option value="<?= $med['id'] ?>" <?= $med['id'] == $produit ? 'selected' : '' ?>>
                    <?= htmlspecialchars($med['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>
    <?php endfor; ?>

    <label for="chkDoc">DOCUMENTATION OFFERTE :</label>
    <input type="checkbox" name="chkDoc" value="1" <?= $rapport['RAP_DOCUMENTATION'] ? 'checked' : '' ?> />
</p>
<p>
    <label class="titre"><h3>Echantillons</h3></label>
    <div class="titre" id="lignes">

        <?php for ($i = 0; $i < 10; $i++):
            // Récupération du produit et de la quantité existants
            $produit = $echantillons[$i]['id'] ?? '';
            $qte     = $echantillons[$i]['OFF_QTE'] ?? '';
            // Pour créer des ids uniques
            $num = $i + 1;
        ?>
            <?php if ($num % 2 != 0): ?>
                <p>
            <?php endif; ?>

            <label for="lstEchantillon<?= $num ?>">PRODUIT <?= $num ?> :</label>
            <select id="lstEchantillon<?= $num ?>" name="lstEchantillon[]">
                <option value="">-- Aucun --</option>
                <?php foreach($lesMedicaments as $med): ?>
                    <option value="<?= $med['id'] ?>" <?= $med['id'] == $produit ? 'selected' : '' ?>>
                        <?= htmlspecialchars($med['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="text" name="txtQte[]" size="2" value="<?= htmlspecialchars($qte) ?>" />

            <?php if ($num % 2 == 0): ?>
                <br></p>
            <?php endif; ?>
        <?php endfor; ?>

    </div>
</p>

		<p>
		<label for="txtDateSaisie">DATE SAISIE : </label>
		<input type="date" size="10" id="txtDateSaisie" name="txtDateSaisie"
				value="<?= htmlspecialchars($rapport['RAP_DATE_SAISIE']) ?>" />
		</p>
		<p>
		<label for="chkSaisie">Saisie définitive :</label>
		<input type="checkbox" id="chkSaisie" name="chkSaisie" value="1"
				<?= $rapport['RAP_SAISIEDEFINITIVE'] ? 'checked' : '' ?> />
		</p>
		<p>
			<input type="submit" value="Valider"></input>			
			<input type="reset" value="Annuler"></input>
		</p>
</form>



