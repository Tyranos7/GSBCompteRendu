<?php
/**
 * VISIT REPORT LIST VIEW
 * Displays table of visit reports for consultation with selection for detail view
 * Used by: c_modifierCompteRendu.php (modify content)
 * Variables: $lesRapports
 */
?>
<div id="contenu">
    <h2>Modifier un compte rendu</h2>
    <?php if(!empty($rapports)) : ?>
        <form action="index.php?uc=majCompteRendu&action=modifier" method="post">
            <div class="corpsForm">
                <p>
                    <label for="lstRapport">Choisir le rapport</label>
                    <select name="lstRapport" id="lstRapport">
                        <?php foreach($rapports as $rapport) : ?>
                            <?php 
                                $numero = htmlspecialchars($rapport['RAP_NUM']);
                                $dateVisite = htmlspecialchars($rapport['RAP_DATE_VISITE']);
                                $praticien = htmlspecialchars($rapport['PRA_NOM'].' '.$rapport['PRA_PRENOM']);
                            ?>
                            <option value="<?= $numero ?>">Rapport n°<?= $numero ?> - <?= $dateVisite ?> - <?= $praticien ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>

                <p>
                    <!-- Bouton pour modifier le rapport -->
                    <input class="zone" type="submit" name="action" value="modifier" />

                    <input id="annuler" type="reset" value="Effacer" /> 
                </p>
            </div>
        </form>
    <?php else: ?>
        <p>Aucun rapport en cours de saisie</p>
    <?php endif; ?>
</div>
