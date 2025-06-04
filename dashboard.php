<?php
require_once 'config.php';
require_once 'fonctions.php';

// Vérifier si l'utilisateur est connecté
if (!estConnecte()) {
    rediriger("connexion.php");
}

// Récupérer les informations de l'utilisateur
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_prenom = isset($_SESSION['user_prenom']) ? $_SESSION['user_prenom'] : '';
$user_email = $_SESSION['user_email'];
$user_type = $_SESSION['user_type'];

// Récupérer les notifications non lues
try {
    $query = $pdo->prepare("
        SELECT COUNT(*) as nb_notifications 
        FROM NOTIFICATIONS 
        WHERE ID_DESTINATAIRE = ? AND TYPE_DESTINATAIRE = ? AND STATUT = 'non_lu'
    ");
    $query->execute([$user_id, $user_type]);
    $nb_notifications = $query->fetchColumn();
} catch (PDOException $e) {
    $nb_notifications = 0;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Site des Associations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: 600;
        }
        .dashboard-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .welcome-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        .notification-badge {
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.8rem;
            position: absolute;
            top: -5px;
            right: -5px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">
                <i class="fas fa-users me-2"></i>
                Associations
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">
                            <i class="fas fa-tachometer-alt me-1"></i> Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="activites.php">
                            <i class="fas fa-calendar me-1"></i> Activités
                        </a>
                    </li>
                    <?php if ($user_type == 'membre'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="associations.php">
                            <i class="fas fa-building me-1"></i> Associations
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="messages.php">
                            <i class="fas fa-envelope me-1"></i> Messages
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            <?php if ($nb_notifications > 0): ?>
                            <span class="notification-badge"><?= $nb_notifications ?></span>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="notifications.php">Voir toutes les notifications</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>
                            <?= htmlspecialchars($user_name . ($user_prenom ? ' ' . $user_prenom : '')) ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profil.php">
                                <i class="fas fa-user-edit me-2"></i> Mon profil
                            </a></li>
                            <li><a class="dropdown-item" href="parametres.php">
                                <i class="fas fa-cog me-2"></i> Paramètres
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="deconnexion.php">
                                <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mt-4">
        <!-- Section de bienvenue -->
        <div class="welcome-section">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-2">
                        Bienvenue, <?= htmlspecialchars($user_name . ($user_prenom ? ' ' . $user_prenom : '')) ?> !
                    </h1>
                    <p class="mb-0">
                        Vous êtes connecté en tant que 
                        <strong>
                            <?php
                            switch ($user_type) {
                                case 'membre': echo 'Membre'; break;
                                case 'association': echo 'Association'; break;
                                case 'benevole': echo 'Bénévole'; break;
                            }
                            ?>
                        </strong>
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <i class="fas fa-user-circle" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>

        <!-- Statistiques rapides -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <i class="fas fa-calendar-alt stat-icon text-primary"></i>
                    <h4>12</h4>
                    <p class="text-muted mb-0">Activités disponibles</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <i class="fas fa-users stat-icon text-success"></i>
                    <h4>5</h4>
                    <p class="text-muted mb-0">Associations actives</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <i class="fas fa-hands-helping stat-icon text-warning"></i>
                    <h4>28</h4>
                    <p class="text-muted mb-0">Bénévoles inscrits</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <i class="fas fa-bell stat-icon text-info"></i>
                    <h4><?= $nb_notifications ?></h4>
                    <p class="text-muted mb-0">Notifications</p>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card dashboard-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-plus-circle text-primary me-2"></i>
                            Actions rapides
                        </h5>
                        <div class="d-grid gap-2">
                            <?php if ($user_type == 'association'): ?>
                            <a href="creer_activite.php" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i> Créer une activité
                            </a>
                            <?php endif; ?>
                            
                            <?php if ($user_type == 'membre' || $user_type == 'benevole'): ?>
                            <a href="activites.php" class="btn btn-success">
                                <i class="fas fa-search me-2"></i> Rechercher des activités
                            </a>
                            <?php endif; ?>
                            
                            <a href="messages.php" class="btn btn-info">
                                <i class="fas fa-envelope me-2"></i> Envoyer un message
                            </a>
                            
                            <a href="profil.php" class="btn btn-outline-secondary">
                                <i class="fas fa-user-edit me-2"></i> Modifier mon profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card dashboard-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-clock text-warning me-2"></i>
                            Activités récentes
                        </h5>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item border-0 px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Nettoyage de plage</h6>
                                        <small class="text-muted">Association Environnement</small>
                                    </div>
                                    <small class="text-muted">Il y a 2h</small>
                                </div>
                            </div>
                            <div class="list-group-item border-0 px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Formation premiers secours</h6>
                                        <small class="text-muted">Croix-Rouge locale</small>
                                    </div>
                                    <small class="text-muted">Hier</small>
                                </div>
                            </div>
                            <div class="list-group-item border-0 px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Collecte alimentaire</h6>
                                        <small class="text-muted">Banque alimentaire</small>
                                    </div>
                                    <small class="text-muted">Il y a 3 jours</small>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="activites.php" class="btn btn-outline-primary btn-sm">
                                Voir toutes les activités
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>