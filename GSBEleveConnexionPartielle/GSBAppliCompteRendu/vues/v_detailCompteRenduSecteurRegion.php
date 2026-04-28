<?php
/**
 * SECTOR REGION RESULT DETAIL VIEW
 * Displays details of a single visit report from sector region search
 * Used by: c_consulterCompteRenduSecteur.php
 * Variables: $compteRendu
 */
?>
<div id="contenu">
    <h2>Détail du rapport de visite</h2>
    
    <fieldset>
        <legend>Informations du rapport</legend>
        
        <p>
            <strong>N° Rapport :</strong> <?php echo htmlspecialchars($rapport['RAP_NUM']); ?>
        </p>
        
        <p>
            <strong>Date de visite :</strong> <?php echo htmlspecialchars($rapport['RAP_DATE_VISITE']); ?>
        </p>
        
        <p>
            <strong>Praticien visité :</strong> 
            <?php echo htmlspecialchars($rapport['PRA_NUM'] . " - " . $rapport['PRA_NOM'] . " " . $rapport['PRA_PRENOM']); ?>
            <form method="POST" action="index.php?uc=consulterPraticien&action=afficher" style="display:inline;">
                <input type="hidden" name="lstPraticien" value="<?php echo htmlspecialchars($rapport['PRA_NUM']); ?>">
                <input type="submit" value="Voir détails praticien">
            </form>
        </p>
        
        <p>
            <strong>Motif de la visite :</strong> <?php echo htmlspecialchars($rapport['MOT_LIBELLE']); ?>
        </p>
        
        <?php if(!empty($rapport['RAP_MOTIF_AUTRE'])): ?>
        <p>
            <strong>Motif autre :</strong> <?php echo htmlspecialchars($rapport['RAP_MOTIF_AUTRE']); ?>
        </p>
        <?php endif; ?>
        
        <p>
            <strong>Bilan de la visite :</strong> <?php echo htmlspecialchars($rapport['RAP_BILAN']); ?>
        </p>
        
        <p>
            <strong>Coefficient de confiance :</strong> <?php echo htmlspecialchars($rapport['PRA_COEFCONFIANCE']); ?>
        </p>
        
        <p>
            <strong>Documentation offerte :</strong> 
            <?php echo $rapport['RAP_DOCUMENTATION'] ? "Oui" : "Non"; ?>
        </p>
        
        <p>
            <strong>Saisie définitive :</strong> 
            <?php echo $rapport['RAP_SAISIEDEFINITIVE'] ? "Oui" : "Non"; ?>
        </p>
    </fieldset>
    
    <?php if(!empty($produitsPresentes)): ?>
    <fieldset>
        <legend>Médicaments présentés</legend>
        <table border='1' cellpadding='5'>
            <tr>
                <th>Dépôt légal</th>
                <th>Nom commercial</th>
                <th>Action</th>
            </tr>
            <?php foreach($produitsPresentes as $produit): ?>
            <tr>
                <td><?php echo htmlspecialchars($produit['MED_DEPOTLEGAL']); ?></td>
                <td><?php echo htmlspecialchars($produit['MED_NOMCOMMERCIAL']); ?></td>
                <td>
                    <form method="POST" action="index.php?uc=consulterMedicament&action=afficher" style="display:inline;">
                        <input type="hidden" name="lstMedicament" value="<?php echo htmlspecialchars($produit['MED_DEPOTLEGAL']); ?>">
                        <input type="submit" value="Info médicament">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </fieldset>
    <?php endif; ?>
    
    <?php if(!empty($echantillons)): ?>
    <fieldset>
        <legend>Échantillons offerts</legend>
        <table border='1' cellpadding='5'>
            <tr>
                <th>Dépôt légal</th>
                <th>Nom commercial</th>
                <th>Quantité</th>
                <th>Action</th>
            </tr>
            <?php foreach($echantillons as $echantillon): ?>
            <tr>
                <td><?php echo htmlspecialchars($echantillon['MED_DEPOTLEGAL']); ?></td>
                <td><?php echo htmlspecialchars($echantillon['MED_NOMCOMMERCIAL']); ?></td>
                <td><?php echo htmlspecialchars($echantillon['OFF_QTE']); ?></td>
                <td>
                    <form method="POST" action="index.php?uc=consulterMedicament&action=afficher" style="display:inline;">
                        <input type="hidden" name="lstMedicament" value="<?php echo htmlspecialchars($echantillon['MED_DEPOTLEGAL']); ?>">
                        <input type="submit" value="Info médicament">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </fieldset>
    <?php endif; ?>
    
    <form method="POST" action="index.php?uc=consulterCompteRenduRegion&action=consulterCompteRenduRegion">
        <p>
            <input type="submit" value="Retour à la recherche" name="retour">
        </p>
    </form>
</div>
