<?php
/**
 * CONTRÔLEUR CONSULTER PRATICIEN - Visiteurs et Délégués uniquement
 * Affiche la liste des médecins et les informations détaillées sur les praticiens
 */
// Vérifier si le visiteur est authentifié
if(estConnecteVisiteur()){
	include(VIEWSPATH."v_sommaireVisiteur.php");
	$idCollaborateur = $_SESSION['idVisiteur'];
}
else {
	// Test connexion délégué
	if(estConnecteDelegue()){
		include(VIEWSPATH."v_sommaireDelegue.php");
		$idCollaborateur = $_SESSION['idDelegue'];
	}
	else{
		ajouterErreur("Erreur de connexion");
		include(VIEWSPATH."v_erreurs.php");
		exit;
	}
}

$action = trim(htmlentities($_REQUEST['action']));
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
        
        // Récupération des infos du praticien
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
?>
