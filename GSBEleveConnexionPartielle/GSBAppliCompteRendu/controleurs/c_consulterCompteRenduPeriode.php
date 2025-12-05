<?php
if(estConnecteVisiteur()){
	include(VIEWSPATH."v_sommaireVisiteur.php");
	$idVisiteur = $_SESSION['idVisiteur'];
}
else{
	if(estConnecteDelegue()){
		include(VIEWSPATH."v_sommaireDelegue.php");
		$idDelegue = $_SESSION['idDelegue'];
	}
	else{
		if(estConnecteResponsable()){
			include(VIEWSPATH."v_sommaireResponsable.php");
			$idResponsable = $_SESSION['idResponsable'];
		}
		else{
			ajouterErreur("Erreur de connexion");
			include(VIEWSPATH."v_erreurs.php");
		}
	}
}
$action = trim(htmlentities($_REQUEST['action']));
switch($action){


}

?>