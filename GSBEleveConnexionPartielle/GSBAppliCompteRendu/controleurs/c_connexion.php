<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = trim(htmlentities($_REQUEST['action']));
switch($action){
	case 'demandeConnexion':{
		include(VIEWSPATH."v_connexion.php");
		break;
	}
	case 'valideConnexion':{
		$login = trim(htmlentities($_REQUEST['login']));
		$mdp = trim(htmlentities($_REQUEST['mdp']));
		$collaborateur = $pdo->getIdCollaborateur($login,$mdp);
		if(!is_array( $collaborateur)){
				ajouterErreur("Login ou mot de passe incorrect");
				include(VIEWSPATH."v_erreurs.php");
				include(VIEWSPATH."v_connexion.php");
		}
		else{
		    // Récupération du matricule du collaborateur
			$matricule = $collaborateur['matricule'];
			// Test si le collaborateur est un responsable avec affichage de son sommaire 
			if ($pdo->estResponsable($matricule)){
                // A compléter
				$resp = $pdo->getInfosCollaborateur($matricule);
                $nom = $resp['nom'];
                $prenom = $resp['prenom'];

                connecterResponsable($matricule, $nom, $prenom);

                include(VIEWSPATH."v_sommaireResponsable.php");
                include(VIEWSPATH."v_accueil.php");
			}
			else{
			    // Test si le collaborateur est un délégué avec affichage de son sommaire
				if ($pdo->estDelegue($matricule)){
                    // A compléter
					$delegue = $pdo->getInfosCollaborateur($matricule);
                $nom = $delegue['nom'];
                $prenom = $delegue['prenom'];

                connecterDelegue($matricule, $nom, $prenom);

                include(VIEWSPATH."v_sommaireDelegue.php");
                include(VIEWSPATH."v_accueil.php");					
				}
				else{
					// Le collaborateur est un visiteur 
					// Affichage de son sommaire
					$visiteur = $pdo->getInfosCollaborateur($matricule);
					$nom =  $visiteur['nom'];
					$prenom = $visiteur['prenom'];
					connecterVisiteur($matricule,$nom,$prenom);
					include(VIEWSPATH."v_sommaireVisiteur.php");
					include(VIEWSPATH."v_accueil.php");
				}
			}
		}
		break;
	}
	case 'deconnexion':{
		deconnecter();
		include(VIEWSPATH."v_connexion.php");
		break;
	}
	default :{
		include(VIEWSPATH."v_connexion.php");
		break;
	}
}
?>