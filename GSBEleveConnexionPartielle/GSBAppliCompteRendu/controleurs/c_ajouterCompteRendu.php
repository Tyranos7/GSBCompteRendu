<?php
if(estConnecteVisiteur()){
	include(VIEWSPATH."v_sommaireVisiteur.php");
	$idCollaborateur = $_SESSION['idVisiteur'];
}
else{
	if(estConnecteDelegue()){
		include(VIEWSPATH."v_sommaireDelegue.php");
		$idCollaborateur = $_SESSION['idDelegue'];
	}
	else{
		ajouterErreur("Erreur de connexion");
		include(VIEWSPATH."v_erreurs.php");
	}
}
$action = trim(htmlentities($_REQUEST['action']));
switch($action){

	case 'Ajouter': {
        // Récupération des listes pour la vue
        $lesPraticiens   = $pdo->getLesPraticiens();
        $lesMedicaments  = $pdo->getLesMedicaments();

        include(VIEWSPATH."v_ajouterCompteRendu.php");
        break;
    }

    
}

?>