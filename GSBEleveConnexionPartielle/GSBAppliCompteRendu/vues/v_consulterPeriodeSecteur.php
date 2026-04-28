<?php
/**
 * PERIOD-BASED SEARCH FOR SECTOR VIEW
 * Displays form to search visit reports by date range for sector context
 * Used by: c_consulterCompteRenduSecteur.php
 */
?>
<div id="contenu">
    <h2>Consulter les rapports de visite du secteur - Par période</h2>
    
    <form method="POST" action="index.php?uc=consulterCompteRenduPeriode&action=rechercher">
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
                <label for="lstCollaborateur">Collaborateur (optionnel) : </label>
                <select id="lstCollaborateur" name="lstCollaborateur">
                    <option value="">-- Tous les collaborateurs du secteur --</option>
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
