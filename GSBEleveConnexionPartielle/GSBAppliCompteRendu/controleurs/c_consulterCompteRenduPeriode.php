<?php
// Détermination de l'ID du collaborateur et du type d'utilisateur
$idCollaborateur = null;
$typeUtilisateur = null;
$pdoGsb = PdoGsb::getPdoGsb();

if(estConnecteVisiteur()){
	include(VIEWSPATH."v_sommaire.php");
	// Visitors cannot access this use case
	ajouterErreur("Accès refusé : vous n'avez pas les droits nécessaires");
	include(VIEWSPATH."v_erreurs.php");
	exit();
}
else{
	if(estConnecteDelegue()){
	include(VIEWSPATH."v_sommaire.php");
		$idCollaborateur = $_SESSION['idDelegue'];
		$typeUtilisateur = 'delegue';
	}
	else{
		if(estConnecteResponsable()){
		include(VIEWSPATH."v_sommaire.php");
			$idResponsable = $_SESSION['idResponsable'];
			$typeUtilisateur = 'responsable';
			$sectorResponsable = $pdoGsb->getResponsibleSector($idResponsable);
		}
		else{
			ajouterErreur("Erreur de connexion");
			include(VIEWSPATH."v_erreurs.php");
			exit();
		}
	}
}

$action = trim(htmlentities($_REQUEST['action'] ?? ''));
switch($action){
	case 'consulterCompteRenduPeriode':
        // Affichage du formulaire de recherche
        if($typeUtilisateur === 'responsable'){
            $collaborateurs = $pdoGsb->getCollaboratorsInSector($sectorResponsable);
            include(VIEWSPATH."v_consulterPeriodeSecteur.php");
        } else {
            $lesPraticiens = $pdoGsb->getLesPraticiens();
            include(VIEWSPATH."v_consulterPeriode.php");
        }
        break;

    case 'rechercher':
        // Traitement de la recherche
        $dates = validerPlage($_REQUEST['dateDebut'] ?? '', $_REQUEST['dateFin'] ?? '');
        
        if(!$dates) {
            // Error already added by validerPlage()
            if($typeUtilisateur === 'responsable'){
                $collaborateurs = $pdoGsb->getCollaboratorsInSector($sectorResponsable);
                include(VIEWSPATH."v_consulterPeriodeSecteur.php");
            } else {
                $lesPraticiens = $pdoGsb->getLesPraticiens();
                include(VIEWSPATH."v_consulterPeriode.php");
            }
            break;
        }
        
        // Récupération des rapports
        if($typeUtilisateur === 'responsable'){
            $idCollab = trim(htmlentities($_REQUEST['lstCollaborateur'] ?? ''));
            $rapports = $pdoGsb->getRapportsPeriodeSector($sectorResponsable, $dates['dateDebut'], $dates['dateFin'], $idCollab ?: null);
        } else {
            $praPraticienNum = trim(htmlentities($_REQUEST['lstPraticien'] ?? ''));
            $rapports = $pdoGsb->getRapportsPeriode($idCollaborateur, $dates['dateDebut'], $dates['dateFin'], $praPraticienNum ?: null);
        }

        if(empty($rapports)){
            ajouterErreur("Aucun rapport de visite trouvé pour cette période");
            if($typeUtilisateur === 'responsable'){
                $collaborateurs = $pdoGsb->getCollaboratorsInSector($sectorResponsable);
                include(VIEWSPATH."v_consulterPeriodeSecteur.php");
            } else {
                $lesPraticiens = $pdoGsb->getLesPraticiens();
                include(VIEWSPATH."v_consulterPeriode.php");
            }
        } else {
            if($typeUtilisateur === 'responsable'){
                include(VIEWSPATH."v_resultatCompteRenduSecteurPeriode.php");
            } else {
                include(VIEWSPATH."v_resultatCompteRendu.php");
            }
        }
        break;

    case 'detail':
        // Affichage du détail d'un rapport
        $idCollab = trim(htmlentities($_REQUEST['idCollab'] ?? ''));
        $rapNum = trim(htmlentities($_REQUEST['rapNum'] ?? ''));
        
        if(!$rapNum){
            ajouterErreur("Le numéro de rapport est manquant");
            include(VIEWSPATH."v_erreurs.php");
            break;
        }
        
        if($typeUtilisateur === 'responsable' && empty($idCollab)){
            ajouterErreur("Paramètres manquants");
            include(VIEWSPATH."v_erreurs.php");
            break;
        }

        // Récupération du rapport
        $idForQuery = ($typeUtilisateur === 'responsable') ? $idCollab : $idCollaborateur;
        $rapport = $pdoGsb->getRapport($idForQuery, $rapNum);
        
        if(!$rapport){
            ajouterErreur("Le rapport sélectionné n'existe pas");
            include(VIEWSPATH."v_erreurs.php");
            break;
        }

        // Récupération des produits présentés et échantillons avec détails
        $produitsPresente = $pdoGsb->getProduitsPresenDetail($idForQuery, $rapNum);
        $echantillons = $pdoGsb->getEchantillonsDetail($idForQuery, $rapNum);

        if($typeUtilisateur === 'responsable'){
            include(VIEWSPATH."v_detailCompteRenduSecteurPeriode.php");
        } else {
            include(VIEWSPATH."v_detailCompteRendu.php");
        }
        break;

    default:
        if($typeUtilisateur === 'responsable'){
            $collaborateurs = $pdoGsb->getCollaboratorsInSector($sectorResponsable);
            include(VIEWSPATH."v_consulterPeriodeSecteur.php");
        } else {
            $lesPraticiens = $pdoGsb->getLesPraticiens();
            include(VIEWSPATH."v_consulterPeriode.php");
        }
}
?>