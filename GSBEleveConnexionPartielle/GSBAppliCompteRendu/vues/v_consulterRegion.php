<?php
/**
 * REGION-BASED SEARCH FORM VIEW
 * Displays form to search visit reports by region
 * Includes visitor selection for Responsibles
 * Used by: c_consulterCompteRenduRegion.php
 * Variables: $lstVisiteurs (for Responsibles)
 */
?>
<div id="contenu">
    <h2>Consulter les rapports de visite de la région</h2>
    
    <form method="POST" action="index.php?uc=consulterCompteRenduRegion&action=rechercher">
        <fieldset>
            <legend>Saisir les critères de recherche</legend>
            
            <p>
                <label for="dateDebut">Date de début : </label>
                <input type="date" id="dateDebut" name="dateDebut" required>
            </p>
            
            <p>
                <label for="dateFin">Date de fin : </label>
                <input type="date" id="dateFin" name="dateFin" required>
            </p>
            
            <?php if(isset($regions)): ?>
                <!-- Responsible view: show regions and collaborators -->
                <p>
                    <label for="lstRegion">Région (optionnel) : </label>
                    <select id="lstRegion" name="lstRegion">
                        <option value="">-- Toutes les régions du secteur --</option>
                        <?php
                        foreach($regions as $region){
                            echo "<option value=\"" . htmlspecialchars($region['REG_CODE']) . "\">";
                            echo htmlspecialchars($region['REG_NOM']);
                            echo "</option>";
                        }
                        ?>
                    </select>
                </p>
                
                <p>
                    <label for="lstCollaborateur">Collaborateur (optionnel) : </label>
                    <select id="lstCollaborateur" name="lstCollaborateur">
                        <option value="">-- Tous les collaborateurs --</option>
                        <?php
                        if(isset($regions)) {
                            // We're in responsible context, but collaborateurs not passed here
                            // Skip collaborators dropdown for region search
                        }
                        ?>
                    </select>
                </p>
            <?php else: ?>
                <!-- Delegate view: show visiteurs -->
                <p>
                    <label for="lstVisiteur">Visiteur (optionnel) : </label>
                    <select id="lstVisiteur" name="lstVisiteur">
                        <option value="">-- Tous les visiteurs de la région --</option>
                        <?php
                        foreach($visiteurs as $visiteur){
                            echo "<option value=\"" . htmlspecialchars($visiteur['COL_MATRICULE']) . "\">";
                            echo htmlspecialchars($visiteur['COL_NOM'] . " " . $visiteur['COL_PRENOM']);
                            echo "</option>";
                        }
                        ?>
                    </select>
                </p>
            <?php endif; ?>
            
            <p>
                <input type="submit" value="Rechercher" name="valider">
                <input type="reset" value="Annuler" name="annuler">
            </p>
        </fieldset>
    </form>
</div>
