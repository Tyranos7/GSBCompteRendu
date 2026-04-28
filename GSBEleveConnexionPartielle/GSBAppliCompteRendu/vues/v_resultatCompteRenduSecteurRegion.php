<?php
/**
 * SECTOR REGION SEARCH RESULT VIEW
 * Displays table of visit reports for selected region within a sector
 * Used by: c_consulterCompteRenduSecteur.php
 * Variables: $rapports
 */
?>
<div id="contenu">
    <h2>Résultats de recherche - Rapports du secteur par région</h2>
    
    <form method="POST" action="index.php?uc=consulterCompteRenduRegion&action=consulterCompteRenduRegion">
        <p>
            <input type="submit" value="Retour à la recherche" name="retour">
        </p>
    </form>
    
    <?php
    if(empty($rapports)){
        echo "<p style='color: red;'>Aucun rapport de visite à cette période n'existe pour votre secteur.</p>";
    } else {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr>";
        echo "<th>N° Rapport</th>";
        echo "<th>Collaborateur</th>";
        echo "<th>Région</th>";
        echo "<th>N° Praticien</th>";
        echo "<th>Nom Praticien</th>";
        echo "<th>Motif de visite</th>";
        echo "<th>Date de visite</th>";
        echo "<th>Médicaments présentés</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        
        foreach($rapports as $rapport){
            echo "<tr>";
            echo "<td>" . htmlspecialchars($rapport['RAP_NUM']) . "</td>";
            echo "<td>" . htmlspecialchars($rapport['COL_NOM'] . " " . $rapport['COL_PRENOM']) . "</td>";
            echo "<td>" . htmlspecialchars($rapport['REG_NOM']) . "</td>";
            echo "<td>" . htmlspecialchars($rapport['PRA_NUM']) . "</td>";
            echo "<td>" . htmlspecialchars($rapport['PRA_NOM'] . " " . $rapport['PRA_PRENOM']) . "</td>";
            echo "<td>" . htmlspecialchars($rapport['MOT_LIBELLE']) . "</td>";
            echo "<td>" . htmlspecialchars($rapport['RAP_DATE_VISITE']) . "</td>";
            echo "<td>" . htmlspecialchars($rapport['medicaments'] ?? 'Aucun') . "</td>";
            echo "<td>";
            echo "<form method='POST' action='index.php?uc=consulterCompteRenduRegion&action=detail' style='display:inline;'>";
            echo "<input type='hidden' name='idCollab' value='" . htmlspecialchars($rapport['COL_MATRICULE']) . "'>";
            echo "<input type='hidden' name='rapNum' value='" . htmlspecialchars($rapport['RAP_NUM']) . "'>";
            echo "<input type='submit' value='Voir détail'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
    
    <form method="POST" action="index.php?uc=consulterCompteRenduRegion&action=consulterCompteRenduRegion">
        <p>
            <input type="submit" value="Retour à la recherche" name="retour">
        </p>
    </form>
</div>
