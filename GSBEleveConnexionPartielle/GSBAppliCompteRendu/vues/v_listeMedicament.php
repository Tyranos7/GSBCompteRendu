 <?php
/**
 * MEDICATION LIST VIEW
 * Displays table of all available medications with selection form
 * Used by: c_consulterMedicament.php
 * Variables: $lesMedicaments
 */
?>
<div id="contenu">
      <h2>Consulter les médicaments</h2>
      <form action="index.php?uc=consulterMedicament&action=afficher" method="post">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstMedicament" accesskey="n">MEDICAMENT : </label>
        <select id="lstMedicament" name="lstMedicament">
        <option value="">-- Choisir un médicament --</option>
            <?php foreach($lesMedicaments as $med): ?>
                <option value="<?= $med['id'] ?>">
                    <?= htmlspecialchars($med['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
      </p>
        <p class="titre" /><label class="titre">&nbsp;</label>
		<input class="zone" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>    
      </form>
