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

	public static function getPdo() {
		return self::$monPdo;
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

public function getMedicament($medDepotLegal) {
	$req = "SELECT m.MED_DEPOTLEGAL, m.MED_NOMCOMMERCIAL, m.FAM_CODE, m.MED_COMPOSITION, 
			m.MED_EFFETS, m.MED_CONTREINDIC, f.FAM_LIBELLE
			FROM MEDICAMENT m
			LEFT JOIN FAMILLE f ON m.FAM_CODE = f.FAM_CODE
			WHERE m.MED_DEPOTLEGAL = :med";
	$stmt = self::$monPdo->prepare($req);
	$stmt->execute([':med' => $medDepotLegal]);
	return $stmt->fetch(PDO::FETCH_ASSOC);
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
public function getLesPraticienTypes(){
	$req = "SELECT TYP_CODE, TYP_LIBELLE, TYP_LIEU FROM TYPE_PRATICIEN ORDER BY TYP_LIBELLE";
	$stmt = self::$monPdo->query($req);
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function ajouterPraticien($praPraticienNum, $praNom, $praPrenom, $praAdresse, $praCp, $praVille, $praCoefNotoriete, $praCoefConfiance, $typCode) {
	$req = "INSERT INTO PRATICIEN 
			(PRA_NUM, PRA_NOM, PRA_PRENOM, PRA_ADRESSE, PRA_CP, PRA_VILLE, 
			 PRA_COEFNOTORIETE, PRA_COEFCONFIANCE, TYP_CODE)
			VALUES 
			(:pranum, :pranom, :praprenom, :praadresse, :pracp, :praville, 
			 :pracoefnot, :pracoefconf, :typcode)";
	$stmt = self::$monPdo->prepare($req);
	$stmt->execute([
		':pranum' => $praPraticienNum,
		':pranom' => $praNom,
		':praprenom' => $praPrenom,
		':praadresse' => $praAdresse,
		':pracp' => $praCp,
		':praville' => $praVille,
		':pracoefnot' => $praCoefNotoriete,
		':pracoefconf' => $praCoefConfiance,
		':typcode' => $typCode
	]);
}
public function getPraticien($praPraticienNum) {
	$req = "SELECT PRA_NUM, PRA_NOM, PRA_PRENOM, PRA_ADRESSE, PRA_CP, PRA_VILLE, 
			PRA_COEFNOTORIETE, PRA_COEFCONFIANCE, TYP_CODE
			FROM PRATICIEN 
			WHERE PRA_NUM = :num";
	$stmt = self::$monPdo->prepare($req);
	$stmt->execute([':num' => $praPraticienNum]);
	return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**------------------------------------------------------------------------------------------------------------- */
/**---------------                   LES COMPTES-RENDUS                                -------------------------- */
/**------------------------------------------------------------------------------------------------------------- */
		
public function ajouterCompteRendu(
    $idVisiteur,
    $idPraticien,
    $dateVisite,
    $motif,
    $motifAutre,
    $bilan,
    $niveauConfiance,
    $dateSaisie,
    $saisieDef,
    $docOfferte,
    $praticienRempl = null,
    $produitsPresente = [],
    $echantillons = [],
    $qtes = []
) {
    // --- Génération du RAP_NUM ---
    $stmt = self::$monPdo->prepare(
        "SELECT MAX(RAP_NUM) FROM RAPPORT_VISITE WHERE COL_MATRICULE = :col"
    );
    $stmt->execute([':col' => $idVisiteur]);
    $rapNum = $stmt->fetchColumn() + 1;

    // --- Insertion du rapport ---
    // Conversion des chaînes vides en NULL pour les champs nullable
    $praticienRempl = (empty($praticienRempl)) ? null : $praticienRempl;
    $motifAutre = (empty($motifAutre)) ? null : $motifAutre;
    
    $stmt = self::$monPdo->prepare(
        "INSERT INTO RAPPORT_VISITE
        (COL_MATRICULE, RAP_NUM, PRA_NUM, PRA_NUM_REMPLACANT, RAP_DATE_VISITE,
         RAP_DATE_SAISIE, RAP_BILAN, RAP_MOTIF_AUTRE, MOT_CODE,
         RAP_DOCUMENTATION, RAP_SAISIEDEFINITIVE)
        VALUES
        (:col, :rap, :pra, :remp, :dv, :ds, :bilan, :motifAutre, :motif, :doc, :def)"
    );

    $stmt->execute([
        ':col'        => $idVisiteur,
        ':rap'        => $rapNum,
        ':pra'        => $idPraticien,
        ':remp'       => $praticienRempl,
        ':dv'         => $dateVisite,
        ':ds'         => $dateSaisie,
        ':bilan'      => $bilan,
        ':motifAutre' => $motifAutre,
        ':motif'      => $motif,
        ':doc'        => $docOfferte,
        ':def'        => $saisieDef
    ]);

    // --- Insertion des produits présentés ---
    foreach($produitsPresente as $prod){
        if(!empty($prod)){
            $stmt = self::$monPdo->prepare(
                "INSERT INTO PRESENTER (MED_DEPOTLEGAL, COL_MATRICULE, RAP_NUM)
                 VALUES (:med, :col, :rap)"
            );
            $stmt->execute([
                ':med' => $prod,
                ':col' => $idVisiteur,
                ':rap' => $rapNum
            ]);
        }
    }

    // --- Insertion des échantillons ---
    foreach($echantillons as $index => $medDepot){
        $qte = $qtes[$index] ?? 0;
        if(!empty($medDepot) && $qte > 0){
            $stmt = self::$monPdo->prepare(
                "INSERT INTO OFFRIR (COL_MATRICULE, RAP_NUM, MED_DEPOTLEGAL, OFF_QTE)
                 VALUES (:col, :rap, :med, :qte)"
            );
            $stmt->execute([
                ':col' => $idVisiteur,
                ':rap' => $rapNum,
                ':med' => $medDepot,
                ':qte' => $qte
            ]);
        }
    }
}

public function getCompteRenduParCollaborateur($idVisiteur, $rapNum = null){
    $sql = "SELECT * FROM RAPPORT_VISITE WHERE COL_MATRICULE = :idVisiteur";
    $params = [':idVisiteur' => $idVisiteur];

    if ($rapNum !== null) {
        $sql .= " AND RAP_NUM = :rapNum";
        $params[':rapNum'] = $rapNum;
    }

    $sql .= " ORDER BY RAP_DATE_VISITE DESC";

    $stmt = self::$monPdo->prepare($sql);  // <- correction ici
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getLesMotifs() {
    $req = "SELECT MOT_CODE as id, MOT_LIBELLE as libelle FROM MOTIF ORDER BY MOT_LIBELLE";
    $stmt = self::$monPdo->query($req);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getRapportsNonValides($idCollaborateur) {
    $sql = "
        SELECT rv.RAP_NUM, rv.RAP_DATE_VISITE, p.PRA_NOM, p.PRA_PRENOM
        FROM RAPPORT_VISITE rv
        INNER JOIN PRATICIEN p ON rv.PRA_NUM = p.PRA_NUM
        WHERE rv.COL_MATRICULE = :col
          AND rv.RAP_SAISIEDEFINITIVE = 0
        ORDER BY rv.RAP_DATE_VISITE DESC
    ";
    $stmt = self::$monPdo->prepare($sql);
    $stmt->execute([':col' => $idCollaborateur]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getRapportsPeriode($idCollaborateur, $dateDebut, $dateFin, $praPraticienNum = null) {
    $sql = "
        SELECT 
            rv.RAP_NUM, rv.RAP_DATE_VISITE, p.PRA_NUM, p.PRA_NOM, p.PRA_PRENOM, 
            m.MOT_LIBELLE, GROUP_CONCAT(DISTINCT med.MED_NOMCOMMERCIAL SEPARATOR ', ') as medicaments
        FROM RAPPORT_VISITE rv
        INNER JOIN PRATICIEN p ON rv.PRA_NUM = p.PRA_NUM
        INNER JOIN MOTIF m ON rv.MOT_CODE = m.MOT_CODE
        LEFT JOIN PRESENTER pr ON rv.COL_MATRICULE = pr.COL_MATRICULE AND rv.RAP_NUM = pr.RAP_NUM
        LEFT JOIN MEDICAMENT med ON pr.MED_DEPOTLEGAL = med.MED_DEPOTLEGAL
        WHERE rv.COL_MATRICULE = :col
          AND rv.RAP_DATE_VISITE >= :dateDebut
          AND rv.RAP_DATE_VISITE <= :dateFin
          AND rv.RAP_SAISIEDEFINITIVE = 1
    ";
    
    if($praPraticienNum){
        $sql .= " AND p.PRA_NUM = :pra";
    }
    
    $sql .= " GROUP BY rv.RAP_NUM, rv.RAP_DATE_VISITE, p.PRA_NUM, p.PRA_NOM, p.PRA_PRENOM, m.MOT_LIBELLE
              ORDER BY rv.RAP_DATE_VISITE DESC";
    
    $stmt = self::$monPdo->prepare($sql);
    $params = [':col' => $idCollaborateur, ':dateDebut' => $dateDebut, ':dateFin' => $dateFin];
    if($praPraticienNum){
        $params[':pra'] = $praPraticienNum;
    }
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getRapport($idCollaborateur, $rapNum) {
    $req = "
        SELECT 
            r.*,
            p.PRA_NUM, p.PRA_NOM, p.PRA_PRENOM, p.PRA_COEFCONFIANCE,
            m.MOT_LIBELLE
        FROM RAPPORT_VISITE r
        JOIN PRATICIEN p ON r.PRA_NUM = p.PRA_NUM
        LEFT JOIN MOTIF m ON r.MOT_CODE = m.MOT_CODE
        WHERE r.COL_MATRICULE = :col
          AND r.RAP_NUM = :rap
    ";

    $stmt = PdoGsb::$monPdo->prepare($req);
    $stmt->execute([
        ':col' => $idCollaborateur,
        ':rap' => $rapNum
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function getProduitsPresente($idCollaborateur, $rapNum) {
    $req = "SELECT MED_DEPOTLEGAL as id
            FROM PRESENTER 
            WHERE COL_MATRICULE = :col AND RAP_NUM = :rap 
            ORDER BY MED_DEPOTLEGAL";
    $stmt = self::$monPdo->prepare($req);
    $stmt->execute([':col' => $idCollaborateur, ':rap' => $rapNum]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getEchantillons($idCollaborateur, $rapNum) {
    $req = "SELECT MED_DEPOTLEGAL as id, OFF_QTE 
            FROM OFFRIR 
            WHERE COL_MATRICULE = :col AND RAP_NUM = :rap
            ORDER BY MED_DEPOTLEGAL";
    $stmt = self::$monPdo->prepare($req);
    $stmt->execute([':col' => $idCollaborateur, ':rap' => $rapNum]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getProduitsPresenDetail($idCollaborateur, $rapNum) {
    $req = "SELECT m.MED_DEPOTLEGAL, m.MED_NOMCOMMERCIAL
            FROM PRESENTER p
            INNER JOIN MEDICAMENT m ON p.MED_DEPOTLEGAL = m.MED_DEPOTLEGAL
            WHERE p.COL_MATRICULE = :col AND p.RAP_NUM = :rap";
    $stmt = self::$monPdo->prepare($req);
    $stmt->execute([':col' => $idCollaborateur, ':rap' => $rapNum]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getEchantillonsDetail($idCollaborateur, $rapNum) {
    $req = "SELECT m.MED_DEPOTLEGAL, m.MED_NOMCOMMERCIAL, o.OFF_QTE
            FROM OFFRIR o
            INNER JOIN MEDICAMENT m ON o.MED_DEPOTLEGAL = m.MED_DEPOTLEGAL
            WHERE o.COL_MATRICULE = :col AND o.RAP_NUM = :rap
            ORDER BY m.MED_NOMCOMMERCIAL";
    $stmt = self::$monPdo->prepare($req);
    $stmt->execute([':col' => $idCollaborateur, ':rap' => $rapNum]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function modifierCompteRendu(
    $idCollaborateur,
    $rapNum,
    $idPraticien,
    $dateVisite,
    $motif,
    $motifAutre,
    $bilan,
    $niveauConfiance,
    $dateSaisie,
    $saisieDef,
    $docOfferte,
    $praticienRempl = null,
    $produitsPresente = [],
    $echantillons = [],
    $qtes = []
) {
    // --- Mise à jour du rapport ---
    // Conversion des chaînes vides en null
    $praticienRempl = (empty($praticienRempl)) ? null : $praticienRempl;
    $motifAutre = (empty($motifAutre)) ? null : $motifAutre;
    
    $stmt = self::$monPdo->prepare(
        "UPDATE RAPPORT_VISITE
        SET PRA_NUM = :pra, PRA_NUM_REMPLACANT = :remp, RAP_DATE_VISITE = :dv,
            RAP_DATE_SAISIE = :ds, RAP_BILAN = :bilan, RAP_MOTIF_AUTRE = :motifAutre, 
            MOT_CODE = :motif, RAP_DOCUMENTATION = :doc, RAP_SAISIEDEFINITIVE = :def
        WHERE COL_MATRICULE = :col AND RAP_NUM = :rap"
    );

    $stmt->execute([
        ':col'        => $idCollaborateur,
        ':rap'        => $rapNum,
        ':pra'        => $idPraticien,
        ':remp'       => $praticienRempl,
        ':dv'         => $dateVisite,
        ':ds'         => $dateSaisie,
        ':bilan'      => $bilan,
        ':motifAutre' => $motifAutre,
        ':motif'      => $motif,
        ':doc'        => $docOfferte,
        ':def'        => $saisieDef
    ]);

    // --- Suppression et réinsertion des produits présentés ---
    $stmt = self::$monPdo->prepare(
        "DELETE FROM PRESENTER WHERE COL_MATRICULE = :col AND RAP_NUM = :rap"
    );
    $stmt->execute([':col' => $idCollaborateur, ':rap' => $rapNum]);

    foreach($produitsPresente as $prod){
        if(!empty($prod)){
            $stmt = self::$monPdo->prepare(
                "INSERT INTO PRESENTER (MED_DEPOTLEGAL, COL_MATRICULE, RAP_NUM)
                 VALUES (:med, :col, :rap)"
            );
            $stmt->execute([
                ':med' => $prod,
                ':col' => $idCollaborateur,
                ':rap' => $rapNum
            ]);
        }
    }

    // --- Suppression et réinsertion des échantillons ---
    $stmt = self::$monPdo->prepare(
        "DELETE FROM OFFRIR WHERE COL_MATRICULE = :col AND RAP_NUM = :rap"
    );
    $stmt->execute([':col' => $idCollaborateur, ':rap' => $rapNum]);

    foreach($echantillons as $index => $medDepot){
        $qte = $qtes[$index] ?? 0;
        if(!empty($medDepot) && $qte > 0){
            $stmt = self::$monPdo->prepare(
                "INSERT INTO OFFRIR (COL_MATRICULE, RAP_NUM, MED_DEPOTLEGAL, OFF_QTE)
                 VALUES (:col, :rap, :med, :qte)"
            );
            $stmt->execute([
                ':col' => $idCollaborateur,
                ':rap' => $rapNum,
                ':med' => $medDepot,
                ':qte' => $qte
            ]);
        }
    }
}
public function getDelegateRegion($idDelegue) {
    $req = "SELECT REG_CODE FROM delegue_regional WHERE DEL_MATRICULE = :id";
    $stmt = self::$monPdo->prepare($req);
    $stmt->execute([':id' => $idDelegue]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['REG_CODE'] : null;
}

public function getVisitorsInRegion($regCode) {
    $req = "
        SELECT DISTINCT c.COL_MATRICULE, c.COL_NOM, c.COL_PRENOM
        FROM collaborateur c
        INNER JOIN travailler t ON c.COL_MATRICULE = t.COL_MATRICULE
        WHERE t.REG_CODE = :reg AND t.DATE_FIN IS NULL
        ORDER BY c.COL_NOM, c.COL_PRENOM
    ";
    $stmt = self::$monPdo->prepare($req);
    $stmt->execute([':reg' => $regCode]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getRapportsRegion($regCode, $dateDebut, $dateFin, $idCol = null) {
    $sql = "
        SELECT DISTINCT
            rv.COL_MATRICULE, c.COL_NOM, c.COL_PRENOM,
            rv.RAP_NUM, rv.RAP_DATE_VISITE, p.PRA_NUM, p.PRA_NOM, p.PRA_PRENOM, 
            m.MOT_LIBELLE, GROUP_CONCAT(DISTINCT med.MED_NOMCOMMERCIAL SEPARATOR ', ') as medicaments
        FROM RAPPORT_VISITE rv
        INNER JOIN collaborateur c ON rv.COL_MATRICULE = c.COL_MATRICULE
        INNER JOIN travailler t ON c.COL_MATRICULE = t.COL_MATRICULE AND t.REG_CODE = :reg AND t.DATE_FIN IS NULL
        INNER JOIN PRATICIEN p ON rv.PRA_NUM = p.PRA_NUM
        INNER JOIN MOTIF m ON rv.MOT_CODE = m.MOT_CODE
        LEFT JOIN PRESENTER pr ON rv.COL_MATRICULE = pr.COL_MATRICULE AND rv.RAP_NUM = pr.RAP_NUM
        LEFT JOIN MEDICAMENT med ON pr.MED_DEPOTLEGAL = med.MED_DEPOTLEGAL
        WHERE rv.RAP_DATE_VISITE >= :dateDebut
          AND rv.RAP_DATE_VISITE <= :dateFin
          AND rv.RAP_SAISIEDEFINITIVE = 1
    ";
    
    if($idCol){
        $sql .= " AND rv.COL_MATRICULE = :col";
    }
    
    $sql .= " GROUP BY rv.RAP_NUM, rv.RAP_DATE_VISITE, p.PRA_NUM, rv.COL_MATRICULE, c.COL_NOM, c.COL_PRENOM, p.PRA_NOM, p.PRA_PRENOM, m.MOT_LIBELLE
              ORDER BY rv.RAP_DATE_VISITE DESC";
    
    $stmt = self::$monPdo->prepare($sql);
    $params = [':reg' => $regCode, ':dateDebut' => $dateDebut, ':dateFin' => $dateFin];
    if($idCol){
        $params[':col'] = $idCol;
    }
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getResponsibleSector($idResponsable) {
    $req = "SELECT SEC_CODE FROM responsable WHERE RES_MATRICULE = :id";
    $stmt = self::$monPdo->prepare($req);
    $stmt->execute([':id' => $idResponsable]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['SEC_CODE'] : null;
}

public function getRegionsInSector($secCode) {
    $req = "
        SELECT DISTINCT r.REG_CODE, r.REG_NOM
        FROM region r
        WHERE r.SEC_CODE = :sec
        ORDER BY r.REG_NOM
    ";
    $stmt = self::$monPdo->prepare($req);
    $stmt->execute([':sec' => $secCode]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getRapportsSector($secCode, $dateDebut, $dateFin, $regCode = null, $idCol = null) {
    $sql = "
        SELECT DISTINCT
            rv.COL_MATRICULE, c.COL_NOM, c.COL_PRENOM,
            rv.RAP_NUM, rv.RAP_DATE_VISITE, p.PRA_NUM, p.PRA_NOM, p.PRA_PRENOM, 
            m.MOT_LIBELLE, r.REG_NOM, GROUP_CONCAT(DISTINCT med.MED_NOMCOMMERCIAL SEPARATOR ', ') as medicaments
        FROM RAPPORT_VISITE rv
        INNER JOIN collaborateur c ON rv.COL_MATRICULE = c.COL_MATRICULE
        INNER JOIN travailler t ON c.COL_MATRICULE = t.COL_MATRICULE AND t.DATE_FIN IS NULL
        INNER JOIN region r ON t.REG_CODE = r.REG_CODE AND r.SEC_CODE = :sec
        INNER JOIN PRATICIEN p ON rv.PRA_NUM = p.PRA_NUM
        INNER JOIN MOTIF m ON rv.MOT_CODE = m.MOT_CODE
        LEFT JOIN PRESENTER pr ON rv.COL_MATRICULE = pr.COL_MATRICULE AND rv.RAP_NUM = pr.RAP_NUM
        LEFT JOIN MEDICAMENT med ON pr.MED_DEPOTLEGAL = med.MED_DEPOTLEGAL
        WHERE rv.RAP_DATE_VISITE >= :dateDebut
          AND rv.RAP_DATE_VISITE <= :dateFin
          AND rv.RAP_SAISIEDEFINITIVE = 1
    ";
    
    if($regCode){
        $sql .= " AND r.REG_CODE = :reg";
    }
    
    if($idCol){
        $sql .= " AND rv.COL_MATRICULE = :col";
    }
    
    $sql .= " GROUP BY rv.RAP_NUM, rv.RAP_DATE_VISITE, p.PRA_NUM, rv.COL_MATRICULE, c.COL_NOM, c.COL_PRENOM, p.PRA_NOM, p.PRA_PRENOM, m.MOT_LIBELLE, r.REG_NOM
              ORDER BY rv.RAP_DATE_VISITE DESC";
    
    $stmt = self::$monPdo->prepare($sql);
    $params = [':sec' => $secCode, ':dateDebut' => $dateDebut, ':dateFin' => $dateFin];
    if($regCode){
        $params[':reg'] = $regCode;
    }
    if($idCol){
        $params[':col'] = $idCol;
    }
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getRapportsPeriodeSector($secCode, $dateDebut, $dateFin, $idCol = null) {
    $sql = "
        SELECT DISTINCT
            rv.COL_MATRICULE, c.COL_NOM, c.COL_PRENOM,
            rv.RAP_NUM, rv.RAP_DATE_VISITE, p.PRA_NUM, p.PRA_NOM, p.PRA_PRENOM, 
            m.MOT_LIBELLE, r.REG_NOM, GROUP_CONCAT(DISTINCT med.MED_NOMCOMMERCIAL SEPARATOR ', ') as medicaments
        FROM RAPPORT_VISITE rv
        INNER JOIN collaborateur c ON rv.COL_MATRICULE = c.COL_MATRICULE
        INNER JOIN travailler t ON c.COL_MATRICULE = t.COL_MATRICULE AND t.DATE_FIN IS NULL
        INNER JOIN region r ON t.REG_CODE = r.REG_CODE AND r.SEC_CODE = :sec
        INNER JOIN PRATICIEN p ON rv.PRA_NUM = p.PRA_NUM
        INNER JOIN MOTIF m ON rv.MOT_CODE = m.MOT_CODE
        LEFT JOIN PRESENTER pr ON rv.COL_MATRICULE = pr.COL_MATRICULE AND rv.RAP_NUM = pr.RAP_NUM
        LEFT JOIN MEDICAMENT med ON pr.MED_DEPOTLEGAL = med.MED_DEPOTLEGAL
        WHERE rv.RAP_DATE_VISITE >= :dateDebut
          AND rv.RAP_DATE_VISITE <= :dateFin
          AND rv.RAP_SAISIEDEFINITIVE = 1
    ";
    
    if($idCol){
        $sql .= " AND rv.COL_MATRICULE = :col";
    }
    
    $sql .= " GROUP BY rv.RAP_NUM, rv.RAP_DATE_VISITE, p.PRA_NUM, rv.COL_MATRICULE, c.COL_NOM, c.COL_PRENOM, p.PRA_NOM, p.PRA_PRENOM, m.MOT_LIBELLE, r.REG_NOM
              ORDER BY rv.RAP_DATE_VISITE DESC";
    
    $stmt = self::$monPdo->prepare($sql);
    $params = [':sec' => $secCode, ':dateDebut' => $dateDebut, ':dateFin' => $dateFin];
    if($idCol){
        $params[':col'] = $idCol;
    }
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getCollaboratorsInSector($secCode) {
    $req = "
        SELECT DISTINCT c.COL_MATRICULE, c.COL_NOM, c.COL_PRENOM
        FROM collaborateur c
        INNER JOIN travailler t ON c.COL_MATRICULE = t.COL_MATRICULE
        INNER JOIN region r ON t.REG_CODE = r.REG_CODE AND r.SEC_CODE = :sec
        WHERE t.DATE_FIN IS NULL
        ORDER BY c.COL_NOM, c.COL_PRENOM
    ";
    $stmt = self::$monPdo->prepare($req);
    $stmt->execute([':sec' => $secCode]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}

?>