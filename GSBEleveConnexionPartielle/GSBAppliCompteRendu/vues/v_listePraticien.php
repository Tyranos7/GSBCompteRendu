 <?php
/**
 * PRACTITIONER LIST VIEW
 * Displays table of all physicians with selection form for detailed view
 * Used by: c_consulterPraticien.php
 * Variables: $lesPraticiens
 */
?>
<div id="contenu">
      <h2>Consulter les praticiens</h2>
      <form action="index.php?uc=consulterPraticien&action=afficher" method="post">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstPraticien" accesskey="n">PRATICIEN : </label>
        <select id="lstPraticien" name="lstPraticien">
        <option value="">-- Choisir un praticien --</option>
            <?php foreach($lesPraticiens as $praticien): ?>
                <option value="<?= $praticien['PRA_NUM'] ?>">
                    <?= htmlspecialchars($praticien['PRA_NOM'] . ' ' . $praticien['PRA_PRENOM']) ?>
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
