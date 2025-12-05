<?php
// Test connexion visiteur
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
	}
}

$action = trim(htmlentities($_REQUEST['action']));
switch($action){

}
?>
