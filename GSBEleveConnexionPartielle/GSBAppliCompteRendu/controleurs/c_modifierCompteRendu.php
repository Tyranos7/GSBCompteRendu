<?php
/**
 * CONTRÔLEUR MODIFIER RAPPORT DE VISITE - Visiteurs et Délégués uniquement
 * Modifie des rapports de visites médicales existants avec validation
 */
if(estConnecteVisiteur()){
    include(VIEWSPATH."v_sommaire.php");
    $idCollaborateur = $_SESSION['idVisiteur'];
} else {
    if(estConnecteDelegue()){
        include(VIEWSPATH."v_sommaire.php");
        $idCollaborateur = $_SESSION['idDelegue'];
    } else {
        ajouterErreur("Erreur de connexion");
        include(VIEWSPATH."v_erreurs.php");
        exit();
    }
}



// Récupération de l'action demandée
$action = trim(htmlentities($_REQUEST['action'] ?? ''));

switch($action){

    case 'selectionner':
        // Liste des rapports non validés
        $rapports = $pdo->getRapportsNonValides($idCollaborateur);
        include(VIEWSPATH."v_listeCompteRendu.php");
        break;

        case 'modifier':
         // Numéro du rapport sélectionné
    $rapNum = $_POST['lstRapport'] ?? null;

    if(!$rapNum){
        ajouterErreur("Veuillez sélectionner un rapport.");
        include(VIEWSPATH."v_erreurs.php");
        exit();
    }

    // Récupération du rapport
    $rapport = $pdo->getRapport($idCollaborateur, $rapNum);

    if(!$rapport){
        ajouterErreur("Le rapport sélectionné n'existe pas.");
        include(VIEWSPATH."v_erreurs.php");
        exit();
    }

    // Listes pour le formulaire
    $lesPraticiens  = $pdo->getLesPraticiens();
    $lesMotifs      = $pdo->getLesMotifs();
    $lesMedicaments = $pdo->getLesMedicaments();


   // Récupération des produits présentés et échantillons
$produitsPresente = $pdo->getProduitsPresente($idCollaborateur, $rapNum);
$echantillons      = $pdo->getEchantillons($idCollaborateur, $rapNum);


            include(VIEWSPATH."v_majCompteRendu.php");
            break;
            case 'valideModif': // Traite la modification
                $rapNum = $_POST['txtNumero'] ?? null;
        
                if(!$rapNum){
                    ajouterErreur("Aucun rapport sélectionné pour modification.");
                    include(VIEWSPATH."v_erreurs.php");
                    exit();
                }
        
                // Récupération des champs
                $idPraticien    = $_POST['lstPraticien'] ?? '';
                $praticienRempl = $_POST['lstRemplacant'] ?? null;
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
        
                // Validation minimale
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
                    // Recharger listes pour formulaire
                    $lesPraticiens  = $pdo->getLesPraticiens();
                    $lesMotifs      = $pdo->getLesMotifs();
                    $lesMedicaments = $pdo->getLesMedicaments();
                    include(VIEWSPATH."v_erreurs.php");
                    include(VIEWSPATH."v_majCompteRendu.php");
                    exit();
                }
        
                // Appel de la fonction PDO pour mise à jour
                $pdo->modifierCompteRendu(
                    $idCollaborateur,
                    $rapNum,
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
        

    default:
        ajouterErreur("Action inconnue pour modifierCompteRendu");
        include(VIEWSPATH."v_erreurs.php");
    }
?>
