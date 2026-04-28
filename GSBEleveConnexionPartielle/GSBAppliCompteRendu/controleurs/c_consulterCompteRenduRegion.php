<?php
$pdoGsb = PdoGsb::getPdoGsb();
$isResponsible = false;

if(estConnecteVisiteur()){
	include(VIEWSPATH."v_sommaireVisiteur.php");
	// Visitors cannot access this use case
	ajouterErreur("Accès refusé : vous n'avez pas les droits nécessaires");
	include(VIEWSPATH."v_erreurs.php");
	exit;
}
elseif(estConnecteDelegue()){
	include(VIEWSPATH."v_sommaireDelegue.php");
	$idDelegue = $_SESSION['idDelegue'];
	$regionDelegue = $pdoGsb->getDelegateRegion($idDelegue);
	
	if(!$regionDelegue){
		ajouterErreur("Erreur : aucune région associée à ce délégué");
		include(VIEWSPATH."v_erreurs.php");
		exit;
	}
}
elseif(estConnecteResponsable()){
	include(VIEWSPATH."v_sommaireResponsable.php");
	$idResponsable = $_SESSION['idResponsable'];
	$sectorResponsable = $pdoGsb->getResponsibleSector($idResponsable);
	$isResponsible = true;
	
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
	
	case 'consulterCompteRenduRegion':
		if($isResponsible){
			$regions = $pdoGsb->getRegionsInSector($sectorResponsable);
		} else {
			$visiteurs = $pdoGsb->getVisitorsInRegion($regionDelegue);
		}
        include(VIEWSPATH."v_consulterRegion.php");
        break;

    case 'rechercher':
        $dates = validerPlage($_REQUEST['dateDebut'] ?? '', $_REQUEST['dateFin'] ?? '');
        
        if(!$dates) {
            // Error already added by validerPlage()
            if($isResponsible){
                $regions = $pdoGsb->getRegionsInSector($sectorResponsable);
            } else {
                $visiteurs = $pdoGsb->getVisitorsInRegion($regionDelegue);
            }
            include(VIEWSPATH."v_consulterRegion.php");
            break;
        }
        
        if($isResponsible){
            $regCode = trim(htmlentities($_REQUEST['lstRegion'] ?? ''));
            $idCollab = trim(htmlentities($_REQUEST['lstCollaborateur'] ?? ''));
            $rapports = $pdoGsb->getRapportsSector(
                $sectorResponsable, 
                $dates['dateDebut'], 
                $dates['dateFin'], 
                $regCode ?: null,
                $idCollab ?: null
            );
        } else {
            $idVisiteur = trim(htmlentities($_REQUEST['lstVisiteur'] ?? ''));
            $rapports = $pdoGsb->getRapportsRegion($regionDelegue, $dates['dateDebut'], $dates['dateFin'], $idVisiteur ?: null);
        }
        
        if(empty($rapports)){
            ajouterErreur("Aucun rapport de visite pour cette période et cette région");
            if($isResponsible){
                $regions = $pdoGsb->getRegionsInSector($sectorResponsable);
            } else {
                $visiteurs = $pdoGsb->getVisitorsInRegion($regionDelegue);
            }
            include(VIEWSPATH."v_consulterRegion.php");
        } else {
            if($isResponsible){
                include(VIEWSPATH."v_resultatCompteRenduSecteurRegion.php");
            } else {
                include(VIEWSPATH."v_resultatCompteRenduRegion.php");
            }
        }
        break;

    case 'detail':
        if($isResponsible){
            $idCollab = trim(htmlentities($_REQUEST['idCollab'] ?? ''));
        } else {
            $idCollab = trim(htmlentities($_REQUEST['idVisiteur'] ?? ''));
        }
        $rapNum = trim(htmlentities($_REQUEST['rapNum'] ?? ''));
        
        if(empty($idCollab) || empty($rapNum)){
            ajouterErreur("Paramètres manquants");
            include(VIEWSPATH."v_erreurs.php");
            break;
        }
        
        $rapport = $pdoGsb->getRapport($idCollab, $rapNum);
        
        if(!$rapport){
            ajouterErreur("Rapport introuvable");
            include(VIEWSPATH."v_erreurs.php");
            break;
        }
        
        $produitsPresentes = $pdoGsb->getProduitsPresenDetail($idCollab, $rapNum);
        $echantillons = $pdoGsb->getEchantillonsDetail($idCollab, $rapNum);
        
        if($isResponsible){
            include(VIEWSPATH."v_detailCompteRenduSecteurRegion.php");
        } else {
            include(VIEWSPATH."v_detailCompteRenduRegion.php");
        }
        break;

    default:
        if($isResponsible){
            $regions = $pdoGsb->getRegionsInSector($sectorResponsable);
        } else {
            $visiteurs = $pdoGsb->getVisitorsInRegion($regionDelegue);
        }
        include(VIEWSPATH."v_consulterRegion.php");

}

?>

?>