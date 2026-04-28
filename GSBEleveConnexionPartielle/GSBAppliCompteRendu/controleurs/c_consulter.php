<?php
/**
 * CONTRÔLEUR CONSULTER - Combined controller for all consultation use cases
 * Handles: consulterPraticien, consulterMedicament, consulterCompteRendu*
 */

$pdo = PdoGsb::getPdoGsb();

switch($uc){
    case 'consulterPraticien':
    case 'consulterMedicament':
        // Accessible to visiteur and delegue
        if(estConnecteVisiteur()){
            include(VIEWSPATH."v_sommaireVisiteur.php");
            $idCollaborateur = $_SESSION['idVisiteur'];
        }
        elseif(estConnecteDelegue()){
            include(VIEWSPATH."v_sommaireDelegue.php");
            $idCollaborateur = $_SESSION['idDelegue'];
        }
        else{
            ajouterErreur("Erreur de connexion");
            include(VIEWSPATH."v_erreurs.php");
            exit;
        }

        $action = trim(htmlentities($_REQUEST['action'] ?? ''));
        if($uc == 'consulterPraticien'){
            switch($action){
                case 'consulterPraticien':
                    $lesPraticiens = $pdo->getLesPraticiens();
                    include(VIEWSPATH."v_listePraticien.php");
                    break;
                case 'afficher':
                    $praPraticienNum = $_POST['lstPraticien'] ?? null;
                    if(!$praPraticienNum){
                        ajouterErreur("Veuillez sélectionner un praticien.");
                        $lesPraticiens = $pdo->getLesPraticiens();
                        include(VIEWSPATH."v_erreurs.php");
                        include(VIEWSPATH."v_listePraticien.php");
                        break;
                    }
                    $praticien = $pdo->getPraticien($praPraticienNum);
                    if(!$praticien){
                        ajouterErreur("Le praticien sélectionné n'existe pas.");
                        include(VIEWSPATH."v_erreurs.php");
                        break;
                    }
                    include(VIEWSPATH."v_consultPraticien.php");
                    break;
                default:
                    ajouterErreur("Action inconnue pour consulterPraticien");
                    include(VIEWSPATH."v_erreurs.php");
            }
        }
        elseif($uc == 'consulterMedicament'){
            switch($action){
                case 'consulterMedicament':
                    $lesMedicaments = $pdo->getLesMedicaments();
                    include(VIEWSPATH."v_listeMedicament.php");
                    break;
                case 'afficher':
                    $medDepotLegal = $_POST['lstMedicament'] ?? null;
                    if(!$medDepotLegal){
                        ajouterErreur("Veuillez sélectionner un médicament.");
                        $lesMedicaments = $pdo->getLesMedicaments();
                        include(VIEWSPATH."v_erreurs.php");
                        include(VIEWSPATH."v_listeMedicament.php");
                        break;
                    }
                    $medicament = $pdo->getMedicament($medDepotLegal);
                    if(!$medicament){
                        ajouterErreur("Le médicament sélectionné n'existe pas.");
                        include(VIEWSPATH."v_erreurs.php");
                        break;
                    }
                    include(VIEWSPATH."v_consultMedicament.php");
                    break;
                default:
                    ajouterErreur("Action inconnue pour consulterMedicament");
                    include(VIEWSPATH."v_erreurs.php");
            }
        }
        break;

    case 'consulterCompteRenduPeriode':
    case 'consulterCompteRenduRegion':
    case 'consulterCompteRenduVisiteur':
    case 'consulterCompteRenduSecteur':
        // Accessible to delegue and responsable, some to visiteur
        $idCollaborateur = null;
        $typeUtilisateur = null;
        $isResponsible = false;
        $regionDelegue = null;
        $sectorResponsable = null;

        if(estConnecteVisiteur()){
            if($uc == 'consulterCompteRenduPeriode'){
                include(VIEWSPATH."v_sommaire.php");
                ajouterErreur("Accès refusé : vous n'avez pas les droits nécessaires");
                include(VIEWSPATH."v_erreurs.php");
                exit();
            }
            else{
                // For other uc, visiteur not allowed
                ajouterErreur("Accès refusé");
                include(VIEWSPATH."v_erreurs.php");
                exit();
            }
        }
        elseif(estConnecteDelegue()){
            include(VIEWSPATH."v_sommaire.php");
            $idCollaborateur = $_SESSION['idDelegue'];
            $typeUtilisateur = 'delegue';
            $regionDelegue = $pdo->getDelegateRegion($idCollaborateur);
            if(!$regionDelegue && in_array($uc, ['consulterCompteRenduRegion'])){
                ajouterErreur("Erreur : aucune région associée à ce délégué");
                include(VIEWSPATH."v_erreurs.php");
                exit;
            }
        }
        elseif(estConnecteResponsable()){
            include(VIEWSPATH."v_sommaire.php");
            $idResponsable = $_SESSION['idResponsable'];
            $typeUtilisateur = 'responsable';
            $isResponsible = true;
            $sectorResponsable = $pdo->getResponsibleSector($idResponsable);
            if(!$sectorResponsable){
                ajouterErreur("Erreur : aucun secteur associé à ce responsable");
                include(VIEWSPATH."v_erreurs.php");
                exit;
            }
        }
        else{
            ajouterErreur("Erreur de connexion");
            include(VIEWSPATH."v_erreurs.php");
            exit();
        }

        $action = trim(htmlentities($_REQUEST['action'] ?? ''));
        // Now sub-switch based on uc and action
        if($uc == 'consulterCompteRenduPeriode'){
            switch($action){
                case 'consulterCompteRenduPeriode':
                    if($typeUtilisateur === 'responsable'){
                        $collaborateurs = $pdo->getCollaboratorsInSector($sectorResponsable);
                        include(VIEWSPATH."v_consulterPeriodeSecteur.php");
                    } else {
                        $lesPraticiens = $pdo->getLesPraticiens();
                        include(VIEWSPATH."v_consulterPeriode.php");
                    }
                    break;
                case 'rechercher':
                    $dates = validerPlage($_REQUEST['dateDebut'] ?? '', $_REQUEST['dateFin'] ?? '');
                    if(!$dates){
                        ajouterErreur("Dates invalides");
                        include(VIEWSPATH."v_erreurs.php");
                        break;
                    }
                    $dateDebut = $dates['debut'];
                    $dateFin = $dates['fin'];
                    if($typeUtilisateur === 'responsable'){
                        $collab = $_REQUEST['lstCollaborateur'] ?? '';
                        $resultats = $pdo->getReportsByPeriodAndSector($dateDebut, $dateFin, $sectorResponsable, $collab);
                        include(VIEWSPATH."v_resultatCompteRenduSecteurPeriode.php");
                    } else {
                        $praticien = $_REQUEST['lstPraticien'] ?? '';
                        $resultats = $pdo->getReportsByPeriod($dateDebut, $dateFin, $idCollaborateur, $praticien);
                        include(VIEWSPATH."v_resultatCompteRendu.php");
                    }
                    break;
                default:
                    ajouterErreur("Action inconnue");
                    include(VIEWSPATH."v_erreurs.php");
            }
        }
        elseif($uc == 'consulterCompteRenduRegion'){
            switch($action){
                case 'consulterCompteRenduRegion':
                    if($isResponsible){
                        $regions = $pdo->getRegionsInSector($sectorResponsable);
                    } else {
                        $visiteurs = $pdo->getVisitorsInRegion($regionDelegue);
                    }
                    include(VIEWSPATH."v_consulterRegion.php");
                    break;
                case 'rechercher':
                    $dates = validerPlage($_REQUEST['dateDebut'] ?? '', $_REQUEST['dateFin'] ?? '');
                    if(!$dates) {
                        if($isResponsible){
                            $regions = $pdo->getRegionsInSector($sectorResponsable);
                        } else {
                            $visiteurs = $pdo->getVisitorsInRegion($regionDelegue);
                        }
                        include(VIEWSPATH."v_consulterRegion.php");
                        break;
                    }
                    if($isResponsible){
                        $regCode = trim(htmlentities($_REQUEST['lstRegion'] ?? ''));
                        $idCollab = trim(htmlentities($_REQUEST['lstCollaborateur'] ?? ''));
                        $rapports = $pdo->getRapportsSector(
                            $sectorResponsable, 
                            $dates['debut'], 
                            $dates['fin'], 
                            $regCode ?: null,
                            $idCollab ?: null
                        );
                    } else {
                        $idVisiteur = trim(htmlentities($_REQUEST['lstVisiteur'] ?? ''));
                        $rapports = $pdo->getRapportsRegion($regionDelegue, $dates['debut'], $dates['fin'], $idVisiteur ?: null);
                    }
                    if(empty($rapports)){
                        ajouterErreur("Aucun rapport de visite pour cette période et cette région");
                        if($isResponsible){
                            $regions = $pdo->getRegionsInSector($sectorResponsable);
                        } else {
                            $visiteurs = $pdo->getVisitorsInRegion($regionDelegue);
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
                    // Add detail logic if needed
                    break;
                default:
                    ajouterErreur("Action inconnue");
                    include(VIEWSPATH."v_erreurs.php");
            }
        }
        elseif($uc == 'consulterCompteRenduVisiteur'){
            switch($action){
                case 'consulterCompteRenduVisiteur':
                    if($isResponsible){
                        $visiteurs = $pdo->getVisitorsInSector($sectorResponsable);
                    } else {
                        $visiteurs = $pdo->getVisitorsInRegion($regionDelegue);
                    }
                    include(VIEWSPATH."v_listeCompteRendu.php");
                    break;
                case 'afficher':
                    $visiteur = $_REQUEST['lstVisiteur'] ?? '';
                    if(!$visiteur){
                        ajouterErreur("Veuillez sélectionner un visiteur");
                        include(VIEWSPATH."v_erreurs.php");
                        break;
                    }
                    $comptesRendus = $pdo->getReportsByVisitor($visiteur);
                    include(VIEWSPATH."v_detailCompteRendu.php");
                    break;
                default:
                    ajouterErreur("Action inconnue");
                    include(VIEWSPATH."v_erreurs.php");
            }
        }
        elseif($uc == 'consulterCompteRenduSecteur'){
            // Only responsable
            if(!$isResponsible){
                ajouterErreur("Accès refusé");
                include(VIEWSPATH."v_erreurs.php");
                exit();
            }
            switch($action){
                case 'consulterCompteRenduSecteur':
                    $regions = $pdo->getRegionsInSector($sectorResponsable);
                    include(VIEWSPATH."v_consulterSecteur.php");
                    break;
                case 'rechercher':
                    $region = $_REQUEST['lstRegion'] ?? '';
                    if(!$region){
                        ajouterErreur("Veuillez sélectionner une région");
                        include(VIEWSPATH."v_erreurs.php");
                        break;
                    }
                    $resultats = $pdo->getReportsBySector($region, $sectorResponsable);
                    include(VIEWSPATH."v_resultatCompteRenduSecteur.php");
                    break;
                default:
                    ajouterErreur("Action inconnue");
                    include(VIEWSPATH."v_erreurs.php");
            }
        }
        break;

    default:
        ajouterErreur("Cas d'utilisation inconnu");
        include(VIEWSPATH."v_erreurs.php");
}
?>