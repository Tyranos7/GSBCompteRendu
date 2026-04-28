<?php
/** 
 * Fonctions pour l'application GSB
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 */

/**
 * Teste si un quelconque visiteur est connecté
 * @return vrai ou faux 
 */
function estConnecteVisiteur(){
  return isset($_SESSION['idVisiteur']);
}

/**
 * Enregistre dans une variable session les infos d'un visiteur
 
 * @param $matricule 
 * @param $nom
 * @param $prenom
 */
function connecterVisiteur($matricule,$nom,$prenom){
	$_SESSION['idVisiteur']= $matricule; 
	$_SESSION['nom']= $nom;
	$_SESSION['prenom']= $prenom;
	$_SESSION['role']= 'visiteur';
}

/**
 * Teste si un quelconque responsable est connecté
 * @return vrai ou faux 
 */
function estConnecteResponsable(){
  return isset($_SESSION['idResponsable']);
}
/**
 * Enregistre dans une variable session les infos d'un responsable
 
 * @param $matricule 
 * @param $nom
 * @param $prenom
 */
function connecterResponsable($matricule,$nom,$prenom){
  $_SESSION['idResponsable']= $matricule; 
	$_SESSION['nom']= $nom;
	$_SESSION['prenom']= $prenom;
	$_SESSION['role']= 'responsable';
}

/**
 * Teste si un quelconque délégué régional est connecté
 * @return vrai ou faux 
 */
function estConnecteDelegue(){
  // A compléter
  return isset($_SESSION['idDelegue']);
}
/**
 * Enregistre dans une variable session les infos d'un délégué régional
 
 * @param $matricule 
 * @param $nom
 * @param $prenom
 */
function enregistrerDelegue($matricule, $nom, $prenom) {
	$_SESSION['idDelegue']= $matricule;
	$_SESSION['nom']= $nom;
	$_SESSION['prenom']= $prenom;
	$_SESSION['role']= 'delegue';
}

/**
 * Détruit la session active
 */
function deconnecter(){
	session_destroy();
}

/**
 * Transforme une date au format français jj/mm/aaaa vers le format anglais aaaa-mm-jj
 * @param $date au format  jj/mm/aaaa
 * @return string la date au format anglais aaaa-mm-jj
*/
function dateFrancaisVersAnglais($date){
	@list($jour,$mois,$annee) = explode('/',$date);
	return date("Y-m-d", mktime(0, 0, 0, $mois, $jour, $annee));
}

/**
 * Transforme une date au format format anglais aaaa-mm-jj vers le format 
 * français jj/mm/aaaa 
 * @param $date au format  aaaa-mm-jj
 * @return string la date au format format français jj/mm/aaaa
*/
function dateAnglaisVersFrancais($date){
   @list($annee,$mois,$jour)=explode('-',$date);
   return date("d/m/Y", mktime(0, 0, 0, $mois, $jour, $annee));

}

/* gestion des erreurs*/
/**
 * Indique si une valeur est un entier positif ou nul
 
 * @param $valeur
 * @return vrai ou faux
*/
function estEntierPositif($valeur) {
	return preg_match("/[^0-9]/", $valeur) == 0;
	
}

/**
 * Indique si un tableau de valeurs est constitué d'entiers positifs ou nuls
 
 * @param $tabEntiers : le tableau
 * @return vrai ou faux
*/
function estTableauEntiers($tabEntiers) {
	$ok = true;
	foreach($tabEntiers as $unEntier){
		if(!estEntierPositif($unEntier)){
		 	$ok=false; 
		}
	}
	return $ok;
}
/**
 * Vérifie si une date est inférieure d'un an à la date actuelle
 
 * @param $dateTestee 
 * @return vrai ou faux
*/
function estDateDepassee($dateTestee){
	$dateActuelle=date("d/m/Y");
	@list($jour,$mois,$annee) = explode('/',$dateActuelle);
	$annee--;
	$AnPasse = $annee.$mois.$jour;
	@list($jourTeste,$moisTeste,$anneeTeste) = explode('/',$dateTestee);
	return ($anneeTeste.$moisTeste.$jourTeste < $AnPasse); 
}
/**
 * Vérifie la validité du format d'une date française jj/mm/aaaa 
 
 * @param $date 
 * @return vrai ou faux
*/
function estDateValide($date){
	$tabDate = explode('/',$date);
	$dateOK = true;
	if (count($tabDate) != 3) {
	    $dateOK = false;
    }
    else {
		if (!estTableauEntiers($tabDate)) {
			$dateOK = false;
		}
		else {
			if (!checkdate($tabDate[1], $tabDate[0], $tabDate[2])) {
				$dateOK = false;
			}
		}
    }
	return $dateOK;
}

/**
 * Ajoute le libellé d'une erreur au tableau des erreurs 
 
 * @param $msg : le libellé de l'erreur 
 */
function ajouterErreur($msg){
   if (! isset($_REQUEST['erreurs'])){
      $_REQUEST['erreurs']=array();
	} 
   $_REQUEST['erreurs'][]=$msg;
}
/**
 * Retoune le nombre de lignes du tableau des erreurs 
 
 * @return le nombre d'erreurs
 */
function nbErreurs(){
   if (!isset($_REQUEST['erreurs'])){
	   return 0;
	}
	else{
	   return count($_REQUEST['erreurs']);
	}
}

/**
 * Validates and returns date range parameters
 * @param $dateDebut : start date from request
 * @param $dateFin : end date from request
 * @return array with validated dates or false if invalid
 */
function validerPlage($dateDebut, $dateFin) {
	$dateDebut = trim(htmlentities($dateDebut ?? ''));
	$dateFin = trim(htmlentities($dateFin ?? ''));
	
	if(empty($dateDebut) || empty($dateFin)){
		ajouterErreur("Les deux dates sont obligatoires");
		return false;
	}
	
	if(strtotime($dateDebut) === false || strtotime($dateFin) === false){
		ajouterErreur("Format de date invalide");
		return false;
	}
	
	if(strtotime($dateDebut) > strtotime($dateFin)){
		ajouterErreur("La date de début doit être antérieure à la date de fin");
		return false;
	}
	
	return [
		'dateDebut' => $dateDebut,
		'dateFin' => $dateFin
	];
}

/**
 * Gets current user session data based on role
 * @param $pdoGsb : database connection
 * @return array with user data or false if not authenticated
 */
function obtenirUtilisateur($pdoGsb) {
	$user = [
		'type' => null,
		'id' => null,
		'nom' => $_SESSION['nom'] ?? null,
		'prenom' => $_SESSION['prenom'] ?? null,
		'region' => null,
		'sector' => null
	];
	
	if(estConnecteVisiteur()) {
		$user['type'] = 'visiteur';
		$user['id'] = $_SESSION['idVisiteur'];
	} elseif(estConnecteDelegue()) {
		$user['type'] = 'delegue';
		$user['id'] = $_SESSION['idDelegue'];
		$user['region'] = $pdoGsb->getDelegateRegion($user['id']);
	} elseif(estConnecteResponsable()) {
		$user['type'] = 'responsable';
		$user['id'] = $_SESSION['idResponsable'];
		$user['sector'] = $pdoGsb->getResponsibleSector($user['id']);
	} else {
		return false;
	}
	
	return $user;
}

?>