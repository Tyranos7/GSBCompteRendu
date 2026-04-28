<?php
/**
 * MEDICATION DETAIL VIEW
 * Displays detailed information about a selected medication
 * Used by: c_consulterMedicament.php
 * Variables: $medicament
 */
?>

      <div class="corpsForm">
		<p>
			<label for="txtDepotLegal">DEPOT LEGAL : </label>
			<input type="text" size="15" id="txtDepotLegal" name="txtDepotLegal" readonly value="<?= htmlspecialchars($medicament['MED_DEPOTLEGAL']) ?>"  />
		</p>
		<p>
			<label for="txtNomCommercial">NOM COMMERCIAL : </label>
			<input type="text" size="25" id="txtNomCommercial" name="txtNomCommercial" readonly value="<?= htmlspecialchars($medicament['MED_NOMCOMMERCIAL']) ?>" />
		</p>
		<p>
			<label for="txtFamille">FAMILLE : </label>
			<input type="text" size="25" id="txtFamille" name="txtFamille" readonly value="<?= htmlspecialchars($medicament['FAM_LIBELLE']) ?>" />
		</p>
		<p>
			<label for="txtComposition">COMPOSITION : </label>
			<textarea rows="5" cols="50" id="txtComposition" name="txtComposition" readonly><?= htmlspecialchars($medicament['MED_COMPOSITION']) ?></textarea>
		</p>
		<p>
			<label for="txtEffet">EFFETS : </label>
			<textarea rows="5" cols="50" id="txtEffet" name="txtEffet" readonly><?= htmlspecialchars($medicament['MED_EFFETS']) ?></textarea>
		</p>
		<p>
			<label for="txtContreIndic">CONTRE INDICATIONS : </label>
			<textarea rows="5" cols="50" id="txtContreIndic" name="txtContreIndic" readonly><?= htmlspecialchars($medicament['MED_CONTREINDIC']) ?></textarea>
		</p>
	  </div>


