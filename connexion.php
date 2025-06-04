<?php
require_once 'config.php';
require_once 'fonctions.php';

// Si l'utilisateur est déjà connecté, le rediriger vers le dashboard
if (estConnecte()) {
    rediriger("dashboard.php");
}

// Récupérer les messages d'erreur ou de succès
$message_erreur = isset($_SESSION['message_erreur']) ? $_SESSION['message_erreur'] : "";
$message_succes = isset($_SESSION['message_succes']) ? $_SESSION['message_succes'] : "";

// Supprimer les messages de la session
unset($_SESSION['message_erreur']);
unset($_SESSION['message_succes']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Site des Associations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px 0;
        }
        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
            width: 100%;
        }
        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-weight: 600;
        }
        .nav-tabs .nav-link {
            border-radius: 10px 10px 0 0;
            margin-right: 5px;
        }
        .nav-tabs .nav-link.active {
            background-color: #667eea;
            color: white;
            border-color: #667eea;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .login-icon {
            font-size: 4rem;
            color: #667eea;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="text-center">
                <i class="fas fa-sign-in-alt login-icon"></i>
            </div>
            <h2 class="form-title">Connexion</h2>
            
            <?php 
            if (!empty($message_erreur)) echo afficherErreur($message_erreur);
            if (!empty($message_succes)) echo afficherSucces($message_succes);
            ?>
            
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="membre-tab" data-bs-toggle="tab" data-bs-target="#membre" type="button" role="tab">
                        <i class="fas fa-user me-1"></i> Membre
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="association-tab" data-bs-toggle="tab" data-bs-target="#association" type="button" role="tab">
                        <i class="fas fa-users me-1"></i> Association
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="benevole-tab" data-bs-toggle="tab" data-bs-target="#benevole" type="button" role="tab">
                        <i class="fas fa-hands-helping me-1"></i> Bénévole
                    </button>
                </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
                <!-- Formulaire de connexion pour les membres -->
                <div class="tab-pane fade show active" id="membre" role="tabpanel">
                    <form action="traitement_connexion.php" method="post">
                        <input type="hidden" name="type" value="membre">
                        
                        <div class="mb-3">
                            <label for="email_membre" class="form-label">
                                <i class="fas fa-envelope me-1"></i> Email
                            </label>
                            <input type="email" class="form-control" id="email_membre" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="mdp_membre" class="form-label">
                                <i class="fas fa-lock me-1"></i> Mot de passe
                            </label>
                            <input type="password" class="form-control" id="mdp_membre" name="mot_de_passe" required>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember_membre" name="remember">
                            <label class="form-check-label" for="remember_membre">
                                Se souvenir de moi
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                        </button>
                    </form>
                </div>
                
                <!-- Formulaire de connexion pour les associations -->
                <div class="tab-pane fade" id="association" role="tabpanel">
                    <form action="traitement_connexion.php" method="post">
                        <input type="hidden" name="type" value="association">
                        
                        <div class="mb-3">
                            <label for="email_association" class="form-label">
                                <i class="fas fa-envelope me-1"></i> Email
                            </label>
                            <input type="email" class="form-control" id="email_association" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="mdp_association" class="form-label">
                                <i class="fas fa-lock me-1"></i> Mot de passe
                            </label>
                            <input type="password" class="form-control" id="mdp_association" name="mot_de_passe" required>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember_association" name="remember">
                            <label class="form-check-label" for="remember_association">
                                Se souvenir de moi
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                        </button>
                    </form>
                </div>
                
                <!-- Formulaire de connexion pour les bénévoles -->
                <div class="tab-pane fade" id="benevole" role="tabpanel">
                    <form action="traitement_connexion.php" method="post">
                        <input type="hidden" name="type" value="benevole">
                        
                        <div class="mb-3">
                            <label for="email_benevole" class="form-label">
                                <i class="fas fa-envelope me-1"></i> Email
                            </label>
                            <input type="email" class="form-control" id="email_benevole" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="mdp_benevole" class="form-label">
                                <i class="fas fa-lock me-1"></i> Mot de passe
                            </label>
                            <input type="password" class="form-control" id="mdp_benevole" name="mot_de_passe" required>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember_benevole" name="remember">
                            <label class="form-check-label" for="remember_benevole">
                                Se souvenir de moi
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <p class="mb-2">
                    <a href="mot_de_passe_oublie.php" class="text-decoration-none">Mot de passe oublié ?</a>
                </p>
                <p class="mb-0">
                    Pas encore inscrit ? <a href="inscription.php" class="text-decoration-none">S'inscrire</a>
                </p>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>