<?php
/**
 * CONTRÔLEUR RECHERCHE RAPPORTS PAR SECTEUR
 * Recherche les rapports de visites par secteur pour les Responsables uniquement
 * Inclut le filtrage par période, région et visiteur
 * Contrôle d'accès : Bloque les Visiteurs et Délégués
 */

if(estConnecteResponsable()){
	include(VIEWSPATH."v_sommaireResponsable.php");
	$idResponsable = $_SESSION['idResponsable'];
	$pdoGsb = PdoGsb::getPdoGsb();
	$sectorResponsable = $pdoGsb->getResponsibleSector($idResponsable);
	
	if(!$sectorResponsable){
		ajouterErreur("Erreur : aucun secteur associé à ce responsable");
		include(VIEWSPATH."v_erreurs.php");
		exit;
	}
}
else{
	ajouterErreur("Erreur de connexion");
	include(VIEWSPATH."v_erreurs.php");
	exit;
}

$action = trim(htmlentities($_REQUEST['action'] ?? ''));
switch($action){
	
	case 'consulterCompteRenduSecteur':
		$pdoGsb = PdoGsb::getPdoGsb();
		$regions = $pdoGsb->getRegionsInSector($sectorResponsable);
		$collaborateurs = $pdoGsb->getCollaboratorsInSector($sectorResponsable);
        include(VIEWSPATH."v_consulterSecteur.php");
        break;

    case 'rechercher':
        $dates = validerPlage($_REQUEST['dateDebut'] ?? '', $_REQUEST['dateFin'] ?? '');
        
        if(!$dates) {
            // Error already added by validerPlage()
            $regions = $pdoGsb->getRegionsInSector($sectorResponsable);
            $collaborateurs = $pdoGsb->getCollaboratorsInSector($sectorResponsable);
            include(VIEWSPATH."v_consulterSecteur.php");
            break;
        }
        
        $regCode = trim(htmlentities($_REQUEST['lstRegion'] ?? ''));
        $idCollab = trim(htmlentities($_REQUEST['lstCollaborateur'] ?? ''));
        
        $rapports = $pdoGsb->getRapportsSector(
            $sectorResponsable, 
            $dates['dateDebut'], 
            $dates['dateFin'], 
            $regCode ?: null,
            $idCollab ?: null
        );
        
        if(empty($rapports)){
            ajouterErreur("Aucun rapport de visite pour cette période et ce secteur");
            $regions = $pdoGsb->getRegionsInSector($sectorResponsable);
            $collaborateurs = $pdoGsb->getCollaboratorsInSector($sectorResponsable);
            include(VIEWSPATH."v_consulterSecteur.php");
        } else {
            include(VIEWSPATH."v_resultatCompteRenduSecteur.php");
        }
        break;

    case 'detail':
        $idCollab = trim(htmlentities($_REQUEST['idCollab'] ?? ''));
        $rapNum = trim(htmlentities($_REQUEST['rapNum'] ?? ''));
        
        if(empty($idCollab) || empty($rapNum)){
            ajouterErreur("Paramètres manquants");
            include(VIEWSPATH."v_erreurs.php");
            break;
        }
        
        $pdoGsb = PdoGsb::getPdoGsb();
        $rapport = $pdoGsb->getRapport($idCollab, $rapNum);
        
        if(!$rapport){
            ajouterErreur("Rapport introuvable");
            include(VIEWSPATH."v_erreurs.php");
            break;
        }
        
        $produitsPresentes = $pdoGsb->getProduitsPresenDetail($idCollab, $rapNum);
        $echantillons = $pdoGsb->getEchantillonsDetail($idCollab, $rapNum);
        
        include(VIEWSPATH."v_detailCompteRenduSecteur.php");
        break;

    default:
        $pdoGsb = PdoGsb::getPdoGsb();
        $regions = $pdoGsb->getRegionsInSector($sectorResponsable);
        $collaborateurs = $pdoGsb->getCollaboratorsInSector($sectorResponsable);
        include(VIEWSPATH."v_consulterSecteur.php");

}

?>