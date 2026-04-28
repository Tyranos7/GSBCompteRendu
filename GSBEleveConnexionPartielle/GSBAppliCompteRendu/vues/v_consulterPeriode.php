<?php
/**
 * PERIOD-BASED SEARCH FORM VIEW
 * Displays form to search visit reports by date range
 * Used by: c_consulterCompteRenduPeriode.php
 */
?>
<div id="contenu">
    <h2>Consulter les rapports de visite d'une période</h2>
    <form action="index.php?uc=consulterCompteRenduPeriode&action=rechercher" method="post">
        <div class="corpsForm">
            <p>
                <label for="txtDateDebut">Date début : </label>
                <input type="date" id="txtDateDebut" name="txtDateDebut" value="<?= isset($_POST['txtDateDebut']) ? htmlspecialchars($_POST['txtDateDebut']) : '' ?>" />
            </p>

            <p>
                <label for="txtDateFin">Date fin : </label>
                <input type="date" id="txtDateFin" name="txtDateFin" value="<?= isset($_POST['txtDateFin']) ? htmlspecialchars($_POST['txtDateFin']) : '' ?>" />
            </p>

            <p>
                <label for="lstPraticien">Praticien (optionnel) : </label>
                <select id="lstPraticien" name="lstPraticien">
                    <option value="">-- Tous les praticiens --</option>
                    <?php foreach($lesPraticiens as $pra): ?>
                        <option value="<?= $pra['PRA_NUM'] ?>" <?= isset($_POST['lstPraticien']) && $_POST['lstPraticien'] == $pra['PRA_NUM'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($pra['PRA_NOM'] . ' ' . $pra['PRA_PRENOM']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>

            <p>
                <input class="zone" type="submit" value="Rechercher" />
                <input id="annuler" type="reset" value="Effacer" />
            </p>
        </div>
    </form>
</div>
