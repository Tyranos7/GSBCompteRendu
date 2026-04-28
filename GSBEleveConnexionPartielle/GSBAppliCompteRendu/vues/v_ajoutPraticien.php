<?php
/**
 * ADD PRACTITIONER FORM VIEW
 * Displays form for registering new physicians in the system
 * Includes: Name, address, postal code, city, and payment method
 * Used by: c_ajouterPraticien.php
 */
?>
<div id="contenu">
	<h2>Saisie d'un praticien</h2>
		<form method="POST"  action="index.php?uc=ajouterPraticien&action=valider">
		<p>
			<label for="txtNumero">NUMERO :</label>
			<input type="text" size="8" name="txtNumero" id="txtNumero" value=""  />
		</p>
		<p>
			<label for="txtNom">NOM :</label>
			<input type="text" size="25" name="txtNom" id="txtNom" />
		</p>
		<p>
			<label for="txtPrenom">PRENOM :</label>
			<input type="text" size="30" name="txtPrenom" id="txtPrenom" />
			</p>
		<p>
			<label for="txtAdresse">ADRESSE :</label>
			<input type="text" size="50" name="txtAdresse" id="txtAdresse" />			
		</p>
		<p>
			<label for="txtCp">CODE POSTAL :</label>
			<input type="text" size="50" name="txtCp" id="txtCp" />
		</p>
		<p>
			<label for="txtVille">VILLE :</label>
			<input type="text" size="50" name="txtVille" id="txtVille"  />
		</p>
		<p>
			<label for="txtNotoriete">COEFF. NOTORIETE :</label>
			<input type="text" size="7" name="txtNotoriete" id="txtNotoriete" />			
		</p>
		<p>
			<label for="txtConfiance">COEFF. CONFIANCE	 :</label>
			<input type="text" size="7" name="txtConfiance" id="txtConfiance" />
		</p>
		<p>
				<label for="lstType">TYPE : </label>
				<select id="lstType" name="lstType" onchange="updateLieu()" >
				<option value="">-- Choisir un type --</option>
				<?php foreach($lesTypes as $type): ?>
					<option value="<?= $type['TYP_CODE'] ?>" data-lieu="<?= htmlspecialchars($type['TYP_LIEU']) ?>">
						<?= htmlspecialchars($type['TYP_LIBELLE']) ?>
					</option>
				<?php endforeach; ?>
				</select>		
		</p>
		<p>
				<label for="txtLieu">LIEU : </label>
				<input type="text" size="35" name="txtLieu" id="txtLieu" readonly />
		</p>
		<p>
			<input type="submit" value="Valider"></input>			
			<input type="reset" value="Annuler"></input>
		</p>
		</form>

		<script>
			function updateLieu() {
				const select = document.getElementById('lstType');
				const txtLieu = document.getElementById('txtLieu');
				const selectedOption = select.options[select.selectedIndex];
				txtLieu.value = selectedOption.getAttribute('data-lieu') || '';
			}
		</script>
		
