<?php
/**
 * PRACTITIONER DETAIL VIEW
 * Displays detailed information about a selected physician
 * Used by: c_consulterPraticien.php
 * Variables: $praticien
 */
?>

      <div class="corpsForm">
		<p>
			<label for="txtNumero">NUMERO :</label>
			<input type="text" size="8" id="txtNumero" name="txtNumero" readonly value="<?= htmlspecialchars($praticien['PRA_NUM']) ?>"  />
		</p>
		<p>
			<label for="txtNom">NOM :</label>
			<input type="text" size="25" id="txtNom" name="txtNom" readonly value="<?= htmlspecialchars($praticien['PRA_NOM']) ?>"  />
		</p>
		<p>
			<label for="txtPrenom">PRENOM :</label>
			<input type="text" size="30" id="txtPrenom" name="txtPrenom" readonly value="<?= htmlspecialchars($praticien['PRA_PRENOM']) ?>"  />
			</p>
		<p>
			<label for="txtAdresse">ADRESSE :</label>
			<input type="text" size="50" id="txtAdresse" name="txtAdresse" readonly value="<?= htmlspecialchars($praticien['PRA_ADRESSE']) ?>"  />			
		</p>
		<p>
			<label for="txtCp">CODE POSTAL :</label>
			<input type="text" size="50" id="txtCp" name="txtCp" readonly value="<?= htmlspecialchars($praticien['PRA_CP']) ?>"  />
		</p>
		<p>
			<label for="txtVille">VILLE :</label>
			<input type="text" size="50" id="txtVille" name="txtVille" readonly value="<?= htmlspecialchars($praticien['PRA_VILLE']) ?>"  />
		</p>
		<p>
			<label for="txtNotoriete">COEFF. NOTORIETE :</label>
			<input type="text" size="7" id="txtNotoriete" name="txtNotoriete" readonly value="<?= htmlspecialchars($praticien['PRA_COEFNOTORIETE']) ?>"  />			
		</p>
		<p>
			<label for="txtConfiance">COEFF. CONFIANCE	 :</label>
			<input type="text" size="7" id="txtConfiance" name="txtConfiance" readonly value="<?= htmlspecialchars($praticien['PRA_COEFCONFIANCE']) ?>"  />
		</p>
		<p>
			<label for="txtType">TYPE :</label>
			<input type="text" size="25" id="txtType" name="txtType" readonly value="<?= htmlspecialchars($praticien['TYP_CODE']) ?>"  />
		</p>
	  </div>
