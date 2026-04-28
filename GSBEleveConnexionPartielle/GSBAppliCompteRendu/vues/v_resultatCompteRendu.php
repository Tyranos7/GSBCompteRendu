<?php
/**
 * GENERIC SEARCH RESULT VIEW
 * Displays table of visit reports (works for period, region, sector, etc.)
 * Used by: all result controllers
 * Variables: $rapports, $returnUrl, $displayColumns, $actionUrl, $actionParams
 */
?>
<div id="contenu">
    <h2>Résultats de recherche</h2>
    
    <?php if(isset($returnUrl)): ?>
    <p>
        <a href="<?= htmlspecialchars($returnUrl) ?>">← Retour à la recherche</a>
    </p>
    <?php endif; ?>

    <?php if(empty($rapports)): ?>
        <p style='color: red;'>Aucun rapport de visite ne correspond à votre recherche.</p>
    <?php else: ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>N° Rapport</th>
                    <?php if(isset($displayColumns) && in_array('visitor', $displayColumns)): ?>
                    <th>Visiteur/Collaborateur</th>
                    <?php endif; ?>
                    <?php if(isset($displayColumns) && in_array('region', $displayColumns)): ?>
                    <th>Région</th>
                    <?php endif; ?>
                    <th>N° Praticien</th>
                    <th>Praticien</th>
                    <th>Motif</th>
                    <th>Date Visite</th>
                    <th>Médicaments</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rapports as $rapport): ?>
                    <tr>
                        <td><?= htmlspecialchars($rapport['RAP_NUM'] ?? '') ?></td>
                        <?php if(isset($displayColumns) && in_array('visitor', $displayColumns)): ?>
                        <td><?= htmlspecialchars(($rapport['COL_NOM'] ?? '') . ' ' . ($rapport['COL_PRENOM'] ?? '')) ?></td>
                        <?php endif; ?>
                        <?php if(isset($displayColumns) && in_array('region', $displayColumns)): ?>
                        <td><?= htmlspecialchars($rapport['REG_NOM'] ?? 'N/A') ?></td>
                        <?php endif; ?>
                        <td><?= htmlspecialchars($rapport['PRA_NUM'] ?? '') ?></td>
                        <td><?= htmlspecialchars(($rapport['PRA_NOM'] ?? '') . ' ' . ($rapport['PRA_PRENOM'] ?? '')) ?></td>
                        <td><?= htmlspecialchars($rapport['MOT_LIBELLE'] ?? '') ?></td>
                        <td><?= htmlspecialchars($rapport['RAP_DATE_VISITE'] ?? '') ?></td>
                        <td><?= htmlspecialchars($rapport['medicaments'] ?? 'Aucun') ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <?php if(isset($actionParams)): ?>
                                    <?php foreach($actionParams as $key => $value): ?>
                                        <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value ?? '') ?>" />
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <input type="hidden" name="rapNum" value="<?= htmlspecialchars($rapport['RAP_NUM']) ?>" />
                                <input type="submit" value="Voir détail" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
