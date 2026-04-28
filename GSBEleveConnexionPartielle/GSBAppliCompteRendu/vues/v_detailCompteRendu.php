<?php
/**
 * GENERIC VISIT REPORT DETAIL VIEW
 * Displays all details of a single visit report (works for all contexts)
 * Used by: all detail controllers (period, region, sector, etc.)
 * Variables: $rapport, $produitsPresente, $echantillons
 */
?>
<div id="contenu">
    <h2>Détail du rapport de visite</h2>
    
    <p>
        <a href="javascript:history.back()">← Retour à la recherche</a>
    </p>

    <div class="corpsForm">
        <h3>Informations du rapport</h3>
        <p>
            <label><strong>N° Rapport :</strong></label>
            <span><?= htmlspecialchars($rapport['RAP_NUM'] ?? '') ?></span>
        </p>

        <p>
            <label><strong>Praticien visité :</strong></label>
            <span><?= htmlspecialchars(($rapport['PRA_NOM'] ?? '') . ' ' . ($rapport['PRA_PRENOM'] ?? '')) ?>
                <form action="index.php?uc=consulterPraticien&action=afficher" method="post" style="display:inline;">
                    <input type="hidden" name="lstPraticien" value="<?= htmlspecialchars($rapport['PRA_NUM'] ?? '') ?>" />
                    <input type="submit" value="Voir détails praticien" />
                </form>
            </span>
        </p>

        <p>
            <label><strong>Date visite :</strong></label>
            <span><?= htmlspecialchars($rapport['RAP_DATE_VISITE'] ?? '') ?></span>
        </p>

        <p>
            <label><strong>Date saisie :</strong></label>
            <span><?= htmlspecialchars($rapport['RAP_DATE_SAISIE'] ?? '') ?></span>
        </p>

        <p>
            <label><strong>Motif :</strong></label>
            <span><?= htmlspecialchars($rapport['MOT_LIBELLE'] ?? '') ?></span>
        </p>

        <?php if(!empty($rapport['RAP_MOTIF_AUTRE'])): ?>
        <p>
            <label><strong>Motif autre :</strong></label>
            <span><?= htmlspecialchars($rapport['RAP_MOTIF_AUTRE']) ?></span>
        </p>
        <?php endif; ?>

        <p>
            <label><strong>Bilan :</strong></label>
            <textarea rows="5" cols="50" readonly><?= htmlspecialchars($rapport['RAP_BILAN'] ?? '') ?></textarea>
        </p>

        <?php if(isset($rapport['PRA_COEFCONFIANCE'])): ?>
        <p>
            <label><strong>Coefficient de confiance :</strong></label>
            <span><?= htmlspecialchars($rapport['PRA_COEFCONFIANCE']) ?></span>
        </p>
        <?php endif; ?>

        <?php if(isset($rapport['RAP_DOCUMENTATION'])): ?>
        <p>
            <label><strong>Documentation offerte :</strong></label>
            <span><?= $rapport['RAP_DOCUMENTATION'] ? 'Oui' : 'Non' ?></span>
        </p>
        <?php endif; ?>

        <?php if(isset($rapport['RAP_SAISIEDEFINITIVE'])): ?>
        <p>
            <label><strong>Saisie définitive :</strong></label>
            <span><?= $rapport['RAP_SAISIEDEFINITIVE'] ? 'Oui' : 'Non' ?></span>
        </p>
        <?php endif; ?>

        <h3>Éléments présentés</h3>
        <?php if(!empty($produitsPresente)) : ?>
            <table border="1" cellpadding="5">
                <thead>
                    <tr>
                        <th>Dépôt légal</th>
                        <th>Nom commercial</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produitsPresente as $prod): ?>
                        <tr>
                            <td><?= htmlspecialchars($prod['MED_DEPOTLEGAL'] ?? '') ?></td>
                            <td><?= htmlspecialchars($prod['MED_NOMCOMMERCIAL'] ?? '') ?></td>
                            <td>
                                <form action="index.php?uc=consulterMedicament&action=afficher" method="post" style="display:inline;">
                                    <input type="hidden" name="lstMedicament" value="<?= htmlspecialchars($prod['MED_DEPOTLEGAL'] ?? '') ?>" />
                                    <input type="submit" value="Info médicament" />
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun produit présenté</p>
        <?php endif; ?>

        <h3>Échantillons offerts</h3>
        <?php if(!empty($echantillons)) : ?>
            <table border="1" cellpadding="5">
                <thead>
                    <tr>
                        <th>Dépôt légal</th>
                        <th>Nom commercial</th>
                        <th>Quantité</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($echantillons as $echant): ?>
                        <tr>
                            <td><?= htmlspecialchars($echant['MED_DEPOTLEGAL'] ?? '') ?></td>
                            <td><?= htmlspecialchars($echant['MED_NOMCOMMERCIAL'] ?? '') ?></td>
                            <td><?= htmlspecialchars($echant['OFF_QTE'] ?? '') ?></td>
                            <td>
                                <form action="index.php?uc=consulterMedicament&action=afficher" method="post" style="display:inline;">
                                    <input type="hidden" name="lstMedicament" value="<?= htmlspecialchars($echant['MED_DEPOTLEGAL'] ?? '') ?>" />
                                    <input type="submit" value="Info médicament" />
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun échantillon offert</p>
        <?php endif; ?>
    </div>
</div>
