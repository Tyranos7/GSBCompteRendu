<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */
		
class PdoGsb{   		
      	private static $serveur=DB_HOST;
      	private static $bdd=DB_NAME;   		
      	private static $user=DB_LOGIN;    		
      	private static $mdp=DB_MDP;		
		private static $monPdo;
		private static $monPdoGsb=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
		PdoGsb::$monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}


/**------------------------------------------------------------------------------------------------------------- */
/**---------------                   LES TRANSACTIONS                                -------------------------- */
/**------------------------------------------------------------------------------------------------------------- */
	


/**
 * Démarre une transaction
*/
	public function demarreTransaction(){
		PdoGsb::$monPdo->beginTransaction();
	}	

/**
 * Valide une transaction
*/
	public function valideTransaction(){
		PdoGsb::$monPdo->commit();
	}	

/**
 * Annule une transaction
*/
	public function annuleTransaction(){
		PdoGsb::$monPdo->rollback();
	}			


/**------------------------------------------------------------------------------------------------------------- */
/**---------------                   LES UTILISATEURS                                 -------------------------- */
/**------------------------------------------------------------------------------------------------------------- */


	
/**
 * Retourne le matricule d'un collaborateur
 
 * @param $login 
 * @param $mdp
 * @return le matricule sous la forme d'un tableau associatif 
*/
	public function getIdCollaborateur($login, $mdp){
		$req = "select COLLABORATEUR.COL_MATRICULE as matricule from COLLABORATEUR 
		where COLLABORATEUR.COL_LOGIN= :login and COLLABORATEUR.COL_MDP= :mdp";
		$idJeuRes = PdoGsb::$monPdo->prepare($req); 
		$idJeuRes->execute(array( ':login' => $login, ':mdp' => $mdp));			
		$ligne = $idJeuRes->fetch();
		return $ligne;
	}

/**
 * Teste si le collaborateur est un responsable
 
 * @param $matricule 
 * @return vrai ou faux 
*/
	public function estResponsable($matricule){
		$ok = false;
		$req = "select count(*) as nbResponsable from COLLABORATEUR inner join RESPONSABLE 
		on COLLABORATEUR.COL_MATRICULE = RESPONSABLE.RES_MATRICULE 
		where COLLABORATEUR.COL_MATRICULE = :matricule";
		$idJeuRes = PdoGsb::$monPdo->prepare($req); 
		$idJeuRes->execute(array( ':matricule' => $matricule));			
		$ligne = $idJeuRes->fetch();
		if($ligne['nbResponsable'] == 1){
			$ok = true;
		}
		return $ok;
	}

/**
 * Teste si le collaborateur est un délégué régional
 
 * @param $matricule 
 * @return vrai ou faux 
*/
	public function estDelegue($matricule){
		$ok = false;
		$req = "select count(*) as nbDelegue from COLLABORATEUR inner join DELEGUE_REGIONAL 
		on COLLABORATEUR.COL_MATRICULE = DELEGUE_REGIONAL.DEL_MATRICULE 
		where COLLABORATEUR.COL_MATRICULE = :matricule";
		$idJeuRes = PdoGsb::$monPdo->prepare($req); 
		$idJeuRes->execute(array( ':matricule' => $matricule));			
		$ligne = $idJeuRes->fetch();
		if($ligne['nbDelegue'] == 1){
			$ok = true;
		}
		return $ok;
	}
	
/**
 * Retourne les informations d'un responsable
 
 * @param $matricule 
 * @return le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function getInfosResponsable($matricule){
        // A compléter
		$req = "SELECT COL_NOM as nom, COL_PRENOM as prenom 
				FROM COLLABORATEUR 
				INNER JOIN RESPONSABLE ON COL_MATRICULE = RES_MATRICULE 
				WHERE COL_MATRICULE = :matricule";
		$stmt = PdoGsb::$monPdo->prepare($req);
		$stmt->execute([':matricule'=>$matricule]);
		return $stmt->fetch();
	}

/**
 * Retourne les informations d'un délégué régional
 
 * @param $matricule 
 * @return le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function getInfosDelegue($matricule){
        // A compléter
		$req = "SELECT COL_NOM as nom, COL_PRENOM as prenom 
				FROM COLLABORATEUR 
				INNER JOIN DELEGUE_REGIONAL ON COL_MATRICULE = DEL_MATRICULE 
				WHERE COL_MATRICULE = :matricule";
		$stmt = PdoGsb::$monPdo->prepare($req);
		$stmt->execute([':matricule'=>$matricule]);
		return $stmt->fetch();
	}
	
	
	
/**
 * Retourne les informations d'un collaborateur
 
 * @param $matricule 
 * @return le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function getInfosCollaborateur($matricule){
		$req = "SELECT COLLABORATEUR.COL_NOM as nom, COLLABORATEUR.COL_PRENOM as prenom from COLLABORATEUR 
		where COLLABORATEUR.COL_MATRICULE = :matricule";
		$idJeuRes = PdoGsb::$monPdo->prepare($req); 
		$idJeuRes->execute(array( ':matricule' => $matricule));			
		$ligne = $idJeuRes->fetch();
		return $ligne;
	}

/**
 * Retourne tous les responsables
 * @param string $nomTable nom de la table demandée
 * @param string $nomColonne critère de tri
 * @return array 
 */
	function getLesResponsables() {
        // A compléter
		$req = "SELECT COL_MATRICULE as id, COL_NOM as nom, COL_PRENOM as prenom 
            FROM COLLABORATEUR 
            INNER JOIN RESPONSABLE ON COL_MATRICULE = RES_MATRICULE 
            ORDER BY COL_NOM, COL_PRENOM";
    $stmt = PdoGsb::$monPdo->query($req);
    return $stmt->fetchAll();
	}
	
/**
 * Retourne tous les délégués
 * @param string $nomTable nom de la table demandée
 * @param string $nomColonne critère de tri
 * @return array 
 */
	function getLesDelegues() {
        // A compléter
		$req = "SELECT COL_MATRICULE as id, COL_NOM as nom, COL_PRENOM as prenom 
		FROM COLLABORATEUR 
		INNER JOIN DELEGUE_REGIONAL ON COL_MATRICULE = DEL_MATRICULE 
		ORDER BY COL_NOM, COL_PRENOM";
		$stmt = PdoGsb::$monPdo->query($req);
		return $stmt->fetchAll();
	}	
	
/**
 * Retourne tous les visiteurs (collaborateurs non responsables)
 * @param string $nomTable nom de la table demandée
 * @param string $nomColonne critère de tri
 * @return array 
 */
	function getLesVisiteurs() {
        // A compléter
		$req = "SELECT COL_MATRICULE as id, COL_NOM as nom, COL_PRENOM as prenom 
            FROM COLLABORATEUR 
            WHERE COL_MATRICULE NOT IN (SELECT RES_MATRICULE FROM RESPONSABLE) 
              AND COL_MATRICULE NOT IN (SELECT DEL_MATRICULE FROM DELEGUE_REGIONAL)
            ORDER BY COL_NOM, COL_PRENOM";
    $stmt = PdoGsb::$monPdo->query($req);
    return $stmt->fetchAll();
	}


/**------------------------------------------------------------------------------------------------------------- */
/**---------------                   LES MEDICAMENTS                                 -------------------------- */
/**------------------------------------------------------------------------------------------------------------- */

	// A compléter avec toutes fonctions nécessaires 
// Médicaments
public function getLesMedicaments(){
    $req = "SELECT MED_DEPOTLEGAL as id, MED_NOMCOMMERCIAL as nom FROM MEDICAMENT ORDER BY MED_NOMCOMMERCIAL";
    $stmt = PdoGsb::$monPdo->query($req);
    return $stmt->fetchAll();
}
/**------------------------------------------------------------------------------------------------------------- */
/**---------------                   LES PRATICIENS                                 -------------------------- */
/**------------------------------------------------------------------------------------------------------------- */
		
// A compléter avec toutes fonctions nécessaires 
public function getLesPraticiens(){
	$req = "SELECT PRA_NUM, PRA_NOM, PRA_PRENOM FROM PRATICIEN ORDER BY PRA_NOM";
	$stmt = self::$monPdo->query($req);
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**------------------------------------------------------------------------------------------------------------- */
/**---------------                   LES COMPTES-RENDUS                                -------------------------- */
/**------------------------------------------------------------------------------------------------------------- */
		
	// A compléter avec toutes fonctions nécessaires 
// Ajouter un compte-rendu
public function ajouterCompteRendu($idVisiteur,$idPraticien,$dateVisite,$motif,$motifAutre,$bilan,$niveauConfiance,$dateSaisie,$etat){
	
	
}

// Récupérer les comptes-rendus d’un collaborateur
public function getCompteRenduParCollaborateur($idVisiteur){
    $sql = "SELECT * FROM RAPPORT_VISITE WHERE VIS_MATRICULE = :idVisiteur ORDER BY RAP_DATEVISITE DESC";
    $stmt = $this->monPdo->prepare($sql);
    $stmt->execute([':idVisiteur'=>$idVisiteur]);
    return $stmt->fetchAll();
}
}	
?>