<?php
/**
 * RESPONSIBLE MENU SIDEBAR
 * Displays navigation menu for Responsible role
 * Options: Search reports by period, region, sector, and visitor
 * Used by: c_connexion.php and all responsible-accessible controllers
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
         <h3>Responsable</h3>    
      </div>  
        <ul id="menuList">
			<li class="smenu">
              <a href="index.php?uc=consulterCompteRenduPeriode&action=consulterCompteRenduPeriode" title="Consultation des compte-rendus">Compte-rendus d'une période</a>
           </li>
           <li class="smenu">
              <a href="index.php?uc=consulterCompteRenduRegion&action=consulterCompteRenduRegion" title="Consultation des compte-rendus">Compte-rendus d'une région</a>
           </li>
           <li class="smenu">
              <a href="index.php?uc=consulterCompteRenduSecteur&action=consulterCompteRenduSecteur" title="Consultation des compte-rendus">Compte-rendus d'un secteur</a>
           </li>
			<li class="smenu">
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
           </li>
        </ul>
        
    </div>
    