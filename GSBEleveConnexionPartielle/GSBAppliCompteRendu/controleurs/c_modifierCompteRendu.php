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
 /* ========= AFFICHER FORMULAIRE AJOUT ========= */
 case 'ajouter':{
	include(VIEWSPATH."v_ajouterCompteRendu.php");
	break;
}

/* ========= VALIDER AJOUT ========= */
case 'validerAjout':{
	$date = $_POST['date'];
	$motif = $_POST['motif'];
	$bilan = $_POST['bilan'];
	$idPraticien = $_POST['idPraticien'];

	// TODO : Appel à la méthode PDO correspondante :
	// $pdo->ajouterCompteRendu($idCollaborateur, $idPraticien, $date, $motif, $bilan);

	include(VIEWSPATH."v_compteRenduValide.php");
	break;
}

/* ========= AFFICHER LISTE POUR MODIFICATION ========= */
case 'modifier':{
	// $lesComptes = $pdo->getCompteRendusDuCollaborateur($idCollaborateur);
	include(VIEWSPATH."v_majCompteRendu.php");
	break;
}

/* ========= CONSULTER UN COMPTE-RENDU ========= */
case 'voir':{
	// Exemple : $compte = $pdo->getCompteRendu($id);
	include(VIEWSPATH."v_listeCompteRendu.php");
	break;
}

default:{
	ajouterErreur("Action inconnue");
	include(VIEWSPATH."v_erreurs.php");
	break;
}
}

?>