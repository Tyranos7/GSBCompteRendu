<?php
/**
 * VISITOR MENU SIDEBAR
 * Displays navigation menu for Visitor role
 * Options: Add report, Modify report, Add practitioner, Consult practitioners,
 * Consult medications, Search reports by period
 * Used by: c_connexion.php, c_ajouterCompteRendu.php, c_modifierCompteRendu.php, etc.
 */
?>
    <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
			<?php  
				echo $_SESSION['prenom']."  ".$_SESSION['nom'];
			?>    
		</h2>
         <h3>Visiteur</h3>    
      </div>  
        <ul id="menuList">
           <li class="smenu">
              <a href="index.php?uc=ajouterCompteRendu&action=ajouter" title="Saisie compte-rendu">Ajout compte-rendu</a>
             
           </li>
           <li class="smenu">
              <a href="index.php?uc=majCompteRendu&action=selectionner" title="Modification compte-rendu">Modification compte-rendu</a>
           </li>		   
           <li class="smenu">
              <a href="index.php?uc=consulterPraticien&action=consulterPraticien " title="Consultation des praticiens">Consultation Praticiens</a>
           </li>
           <li class="smenu">
              <a href="index.php?uc=ajouterPraticien&action=ajouterPraticien " title="Saisie praticien">Ajout praticien</a>
           </li>		   
           <li class="smenu">
              <a href="index.php?uc=consulterMedicament&action=consulterMedicament" title="Consultation des médicaments">Consultation Médicaments</a>
           </li>	
           <li class="smenu">
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
           </li>
		
		
        </ul>
        
    </div>
    