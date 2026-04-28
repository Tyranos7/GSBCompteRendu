<?php
/**
 * CONTRÔLEUR AJOUTER RAPPORT DE VISITE - Visiteurs et Délégués uniquement
 * Crée de nouveaux rapports de visites médicales avec infos praticien, médicaments et échantillons
 */
if(estConnecteVisiteur()){
	include(VIEWSPATH."v_sommaire.php");
	$idCollaborateur = $_SESSION['idVisiteur'];
}
else{
	if(estConnecteDelegue()){
		include(VIEWSPATH."v_sommaire.php");
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

	case 'ajouter': {
        // Récupération des listes pour la vue
        $lesPraticiens = $pdo->getLesPraticiens();
        $lesMotifs = $pdo->getLesMotifs();
        $lesMedicaments = $pdo->getLesMedicaments();
       
        include(VIEWSPATH."v_ajouterCompteRendu.php");
        break;
    }


    case 'valider':
        // Récupération des valeurs du formulaire
        $idPraticien    = $_POST['lstPraticien'] ?? '';
        $praticienRempl = (isset($_POST['lstRemplacant']) && !empty($_POST['lstRemplacant'])) ? $_POST['lstRemplacant'] : null;
        $dateVisite     = $_POST['txtDateVisite'] ?? null;
        $motif          = $_POST['lstMotif'] ?? '';
        $motifAutre     = $_POST['txtAutreMotif'] ?? null;
        $bilan          = $_POST['txtBilan'] ?? null;
        $niveauConf     = $_POST['txtConfiance'] ?? null;
        $dateSaisie     = $_POST['txtDateSaisie'] ?? null;
        $saisieDef      = isset($_POST['chkSaisie']) ? 1 : 0;
        $docOfferte     = isset($_POST['chkDoc']) ? 1 : 0;
    
        // Produits présentés
        $produitsPresente = [];
        if(isset($_POST['chkProduitPresente1'])) $produitsPresente[] = $_POST['lstProduit1'];
        if(isset($_POST['chkProduitPresente2'])) $produitsPresente[] = $_POST['lstProduit2'];
    
        // Échantillons et quantités
        $echantillons = $_POST['lstEchantillon'] ?? [];
        $qtes         = $_POST['txtQte'] ?? [];
    
        // Vérification des champs obligatoires si saisie définitive
        $erreurs = [];
        if($saisieDef){
            if(empty($idPraticien)) $erreurs[] = "Code praticien obligatoire";
            if(empty($dateVisite))  $erreurs[] = "Date visite obligatoire";
            if(empty($motif))       $erreurs[] = "Motif visite obligatoire";
            if($motif == 'AUTMO' && empty($motifAutre)) $erreurs[] = "Veuillez saisir le motif autre";
            if(empty($bilan))       $erreurs[] = "Bilan obligatoire";
            if(empty($niveauConf))  $erreurs[] = "Niveau de confiance obligatoire";
            if(empty($dateSaisie))  $erreurs[] = "Date de saisie obligatoire";
        }
    
        if(!empty($erreurs)){
            foreach($erreurs as $err) ajouterErreur($err);
    
            // Recharger les listes pour la vue
            $lesPraticiens  = $pdo->getLesPraticiens();
            $lesMotifs      = $pdo->getLesMotifs();
            $lesMedicaments = $pdo->getLesMedicaments();
    
            include(VIEWSPATH."v_erreurs.php");
            include(VIEWSPATH."v_ajouterCompteRendu.php");
            exit();
        }
    
        // --- Appel de la  fonction PDO ---
        $pdo->ajouterCompteRendu(
            $idCollaborateur,
            $idPraticien,
            $dateVisite,
            $motif,
            $motifAutre,
            $bilan,
            $niveauConf,
            $dateSaisie,
            $saisieDef,
            $docOfferte,      
            $praticienRempl,
            $produitsPresente,
            $echantillons,
            $qtes
        );
    
        include(VIEWSPATH."v_compteRenduValide.php");
        break;
    

}

?>