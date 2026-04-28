<?php
/**
 * CONTRÔLEUR AJOUTER PRATICIEN - Visiteurs et Délégués uniquement
 * Enregistre de nouveaux médecins dans le système avec validation
 */

// Vérifier si le visiteur est authentifié
if(estConnecteVisiteur()){
	include(VIEWSPATH."v_sommaireVisiteur.php");
	$idCollaborateur = $_SESSION['idVisiteur'];
}
else {
	// Check if delegate is authenticated
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
	case 'ajouterPraticien':
        $lesTypes = $pdo->getLesPraticienTypes();
        include(VIEWSPATH."v_ajoutPraticien.php");
        break;

    case 'valider':
        // Récupération des données du formulaire
        $praPraticienNum = isset($_POST['txtNumero']) ? intval($_POST['txtNumero']) : null;
        $praNom = $_POST['txtNom'] ?? '';
        $praPrenom = $_POST['txtPrenom'] ?? '';
        $praAdresse = $_POST['txtAdresse'] ?? null;
        $praCp = $_POST['txtCp'] ?? null;
        $praVille = $_POST['txtVille'] ?? null;
        $praCoefNotoriete = isset($_POST['txtNotoriete']) ? floatval($_POST['txtNotoriete']) : null;
        $praCoefConfiance = isset($_POST['txtConfiance']) ? floatval($_POST['txtConfiance']) : null;
        $typCode = $_POST['lstType'] ?? '';

        // Validation minimale
        $erreurs = [];
        if(empty($praPraticienNum)) $erreurs[] = "Numéro praticien obligatoire";
        if(empty($praNom)) $erreurs[] = "Nom obligatoire";
        if(empty($praPrenom)) $erreurs[] = "Prénom obligatoire";
        if(empty($typCode)) $erreurs[] = "Type obligatoire";

        if(!empty($erreurs)){
            foreach($erreurs as $err) ajouterErreur($err);
            $lesTypes = $pdo->getLesPraticienTypes();
            include(VIEWSPATH."v_erreurs.php");
            include(VIEWSPATH."v_ajoutPraticien.php");
            exit();
        }

        // Enregistrement du praticien
        $pdo->ajouterPraticien(
            $praPraticienNum,
            $praNom,
            $praPrenom,
            $praAdresse,
            $praCp,
            $praVille,
            $praCoefNotoriete,
            $praCoefConfiance,
            $typCode
        );

        include(VIEWSPATH."v_praticienValide.php");
        break;

    default:
        ajouterErreur("Action inconnue pour ajouterPraticien");
        include(VIEWSPATH."v_erreurs.php");
}
?>
