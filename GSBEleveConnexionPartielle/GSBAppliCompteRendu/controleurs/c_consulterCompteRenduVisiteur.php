<?php
if(estConnecteResponsable()){
	include(VIEWSPATH."v_sommaireResponsable.php");
	$idCollaborateur = $_SESSION['idResponsable'];
}
else{
	ajouterErreur("Erreur de connexion");
	include(VIEWSPATH."v_erreurs.php");
}

$action = trim(htmlentities($_REQUEST['action']));
switch($action){



}


?>