<?php
/**
 * SECTOR-BASED SEARCH FORM VIEW
 * Displays form to search visit reports for a sector with date range and filters
 * Used by: c_consulterCompteRenduSecteur.php
 * Variables: $regions, $collaborateurs
 */
?>
<div id="contenu">
    <h2>Consulter les rapports de visite du secteur</h2>
    
    <form method="POST" action="index.php?uc=consulterCompteRenduSecteur&action=rechercher">
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
                    foreach($collaborateurs as $collab){
                        echo "<option value=\"" . htmlspecialchars($collab['COL_MATRICULE']) . "\">";
                        echo htmlspecialchars($collab['COL_NOM'] . " " . $collab['COL_PRENOM']);
                        echo "</option>";
                    }
                    ?>
                </select>
            </p>
            
            <p>
                <input type="submit" value="Rechercher" name="valider">
                <input type="reset" value="Annuler" name="annuler">
            </p>
        </fieldset>
    </form>
</div>
