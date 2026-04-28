<?php
/**
 * DELEGATE MENU SIDEBAR
 * Displays navigation menu for Delegate role
 * Options: All visitor options + Search reports by period, region, and visitor
 * Used by: c_connexion.php and all delegate-accessible controllers
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
         <h3>Délégué régional</h3>    
      </div>  
        <ul id="menuList">
		   <li class="smenu">
              <a href="index.php?uc=ajouterCompteRendu&action=ajouter" title="Saisie compte-rendu">Ajout compte-rendu</a>
        
            </li>
           <li class="smenu">
              <a href="index.php?uc=majCompteRendu&action=selectionner" title="Modification compte-rendu">Modification compte-rendu</a>
           </li>		   
           <li class="smenu">
              <a href="index.php?uc=consulterPraticien&action=consulterPraticien" title="Consultation des praticiens">Consultation Praticiens</a>
           </li>
           <li class="smenu">
              <a href="index.php?uc=ajouterPraticien&action=ajouterPraticien" title="Saisie praticien">Ajout praticien</a>
           </li>		   
           <li class="smenu">
              <a href="index.php?uc=consulterMedicament&action=consulterMedicament" title="Consultation des médicaments">Consultation Médicaments</a>
           </li>	
           <li class="smenu">
              <a href="index.php?uc=consulterCompteRenduPeriode&action=consulterCompteRenduPeriode" title="Consultation des compte-rendus">Compte-rendus d'une période</a>
           </li>	
           <li class="smenu">
              <a href="index.php?uc=consulterCompteRenduRegion&action=consulterCompteRenduRegion" title="Consultation des compte-rendus">Compte-rendus de sa région</a>
           </li>
			<li class="smenu">
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
           </li>
        </ul>
        
    </div>
    