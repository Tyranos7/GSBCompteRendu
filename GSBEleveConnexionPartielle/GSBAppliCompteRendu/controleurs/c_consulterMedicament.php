<?php
/**
 * CONTRÔLEUR CONSULTER MÉDICAMENT - Visiteurs et Délégués uniquement
 * Affiche les médicaments disponibles et les informations détaillées des produits
 */

// Vérifier si le visiteur est authentifié
if(estConnecteVisiteur()){
	include(VIEWSPATH."v_sommaireVisiteur.php");
	$idCollaborateur = $_SESSION['idVisiteur'];
}
else {
	// Vérifier si le délégué est authentifié
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
        
        // Récupération des infos du médicament
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
?>