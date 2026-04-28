<?php
/**
 * GENERIC MENU SIDEBAR
 * Displays navigation menu based on user role
 * Roles: Visiteur (Visitor), Délégué (Delegate), Responsable (Manager)
 * Used by: c_connexion.php and all controllers
 */

// Get user role from session
$role = $_SESSION['role'] ?? 'visiteur';

// Menu items based on role
$menuItems = [];

// Common items for all roles
$commonItems = [
    [
        'label' => 'Déconnexion',
        'url' => 'index.php?uc=connexion&action=deconnexion',
        'title' => 'Se déconnecter'
    ]
];

// Role-specific items
if ($role === 'visiteur') {
    $roleTitle = 'Visiteur';
    $menuItems = [
        [
            'label' => 'Ajout compte-rendu',
            'url' => 'index.php?uc=ajouterCompteRendu&action=ajouter',
            'title' => 'Saisie compte-rendu'
        ],
        [
            'label' => 'Modification compte-rendu',
            'url' => 'index.php?uc=majCompteRendu&action=selectionner',
            'title' => 'Modification compte-rendu'
        ],
        [
            'label' => 'Consultation Praticiens',
            'url' => 'index.php?uc=consulterPraticien&action=consulterPraticien',
            'title' => 'Consultation des praticiens'
        ],
        [
            'label' => 'Ajout praticien',
            'url' => 'index.php?uc=ajouterPraticien&action=ajouterPraticien',
            'title' => 'Saisie praticien'
        ],
        [
            'label' => 'Consultation Médicaments',
            'url' => 'index.php?uc=consulterMedicament&action=consulterMedicament',
            'title' => 'Consultation des médicaments'
        ]
    ];
} 
elseif ($role === 'delegue') {
    $roleTitle = 'Délégué régional';
    $menuItems = [
        [
            'label' => 'Ajout compte-rendu',
            'url' => 'index.php?uc=ajouterCompteRendu&action=ajouter',
            'title' => 'Saisie compte-rendu'
        ],
        [
            'label' => 'Modification compte-rendu',
            'url' => 'index.php?uc=majCompteRendu&action=selectionner',
            'title' => 'Modification compte-rendu'
        ],
        [
            'label' => 'Consultation Praticiens',
            'url' => 'index.php?uc=consulterPraticien&action=consulterPraticien',
            'title' => 'Consultation des praticiens'
        ],
        [
            'label' => 'Ajout praticien',
            'url' => 'index.php?uc=ajouterPraticien&action=ajouterPraticien',
            'title' => 'Saisie praticien'
        ],
        [
            'label' => 'Consultation Médicaments',
            'url' => 'index.php?uc=consulterMedicament&action=consulterMedicament',
            'title' => 'Consultation des médicaments'
        ],
        [
            'label' => 'Compte-rendus d\'une période',
            'url' => 'index.php?uc=consulterCompteRenduPeriode&action=consulterCompteRenduPeriode',
            'title' => 'Consultation des compte-rendus'
        ],
        [
            'label' => 'Compte-rendus de sa région',
            'url' => 'index.php?uc=consulterCompteRenduRegion&action=consulterCompteRenduRegion',
            'title' => 'Consultation des compte-rendus'
        ]
    ];
}
elseif ($role === 'responsable') {
    $roleTitle = 'Responsable';
    $menuItems = [
        [
            'label' => 'Compte-rendus d\'une période',
            'url' => 'index.php?uc=consulterCompteRenduPeriode&action=consulterCompteRenduPeriode',
            'title' => 'Consultation des compte-rendus'
        ],
        [
            'label' => 'Compte-rendus d\'une région',
            'url' => 'index.php?uc=consulterCompteRenduRegion&action=consulterCompteRenduRegion',
            'title' => 'Consultation des compte-rendus'
        ],
        [
            'label' => 'Compte-rendus d\'un secteur',
            'url' => 'index.php?uc=consulterCompteRenduSecteur&action=consulterCompteRenduSecteur',
            'title' => 'Consultation des compte-rendus'
        ]
    ];
}

// Merge menu items with common items
$menuItems = array_merge($menuItems, $commonItems);
?>

<!-- Division pour le sommaire -->
<div id="menuGauche">
    <div id="infosUtil">
        <h2><?php echo htmlspecialchars($_SESSION['prenom'] . " " . $_SESSION['nom']); ?></h2>
        <h3><?php echo htmlspecialchars($roleTitle); ?></h3>
    </div>
    <ul id="menuList">
        <?php foreach ($menuItems as $item): ?>
        <li class="smenu">
            <a href="<?php echo htmlspecialchars($item['url']); ?>" 
               title="<?php echo htmlspecialchars($item['title']); ?>">
                <?php echo htmlspecialchars($item['label']); ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
