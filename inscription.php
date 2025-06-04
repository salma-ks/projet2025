<?php
require_once 'config.php';
require_once 'fonctions.php';

// Si l'utilisateur est déjà connecté, le rediriger vers la page d'accueil
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
    <title>Inscription - Site des Associations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg,rgb(15, 108, 179) 0%, #023053 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
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
            background-color: #034E88;
            color: white;
            border-color: #034E88;
        }
        .btn-primary {
            background: linear-gradient(135deg, #034E88 0%, #023053 100%);
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
            border-color: #034E88;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .password-strength {
            font-size: 0.8em;
            margin-top: 5px;
        }
        .strength-weak { color: #dc3545; }
        .strength-medium { color: #ffc107; }
        .strength-strong { color: #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">
                <i class="fas fa-user-plus me-2"></i>
                Inscription
            </h2>
            
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
                <!-- Formulaire d'inscription pour les membres -->
                <div class="tab-pane fade show active" id="membre" role="tabpanel">
                    <form action="traitement_inscription.php" method="post" id="form-membre">
                        <input type="hidden" name="type" value="membre">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_membre" class="form-label">
                                الإسم الشخصي<i class="fas fa-user me-1"></i> 
                                </label>
                                <input type="text" class="form-control" id="nom_membre" name="nom" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenom_membre" class="form-label">
                                الإسم العائلي<i class="fas fa-user me-1"></i> 
                                </label>
                                <input type="text" class="form-control" id="prenom_membre" name="prenom">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email_membre" class="form-label">
                            البريد الإلكتروني <i class="fas fa-envelope me-1"></i> 
                            </label>
                            <input type="email" class="form-control" id="email_membre" name="email" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="telephone_membre" class="form-label">
                                الهاتف<i class="fas fa-phone me-1"></i> 
                                </label>
                                <input type="tel" class="form-control" id="telephone_membre" name="telephone">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="adresse_membre" class="form-label">
                            العنوان <i class="fas fa-map-marker-alt me-1"></i> 
                            </label>
                            <textarea class="form-control" id="adresse_membre" name="adresse" rows="2"></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="mdp_membre" class="form-label">
                                كلمة المرور<i class="fas fa-lock me-1"></i> 
                                </label>
                                <input type="password" class="form-control" id="mdp_membre" name="mot_de_passe" required>
                                <div id="password-strength-membre" class="password-strength"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mdp_confirm_membre" class="form-label">
                                التأكد من كلمة المرور<i class="fas fa-lock me-1"></i> 
                                </label>
                                <input type="password" class="form-control" id="mdp_confirm_membre" name="mot_de_passe_confirm" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                        تسجيل الدخول كعضو<i class="fas fa-user-plus me-2"></i> 

                        </button>
                    </form>
                </div>
                
                <!-- Formulaire d'inscription pour les associations -->
                <div class="tab-pane fade" id="association" role="tabpanel">
                    <form action="traitement_inscription.php" method="post" id="form-association">
                        <input type="hidden" name="type" value="association">
                        
                        <div class="mb-3">
                            <label for="nom_association" class="form-label">
                                <i class="fas fa-building me-1"></i> Nom de l'association *
                            </label>
                            <input type="text" class="form-control" id="nom_association" name="nom" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description_association" class="form-label">
                                <i class="fas fa-info-circle me-1"></i> Description
                            </label>
                            <textarea class="form-control" id="description_association" name="description" rows="3"></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email_association" class="form-label">
                                    <i class="fas fa-envelope me-1"></i> Email *
                                </label>
                                <input type="email" class="form-control" id="email_association" name="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telephone_association" class="form-label">
                                    <i class="fas fa-phone me-1"></i> Téléphone
                                </label>
                                <input type="tel" class="form-control" id="telephone_association" name="telephone">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="adresse_association" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i> Adresse
                            </label>
                            <textarea class="form-control" id="adresse_association" name="adresse" rows="2"></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="site_web_association" class="form-label">
                                    <i class="fas fa-globe me-1"></i> Site web
                                </label>
                                <input type="url" class="form-control" id="site_web_association" name="site_web">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="siret_association" class="form-label">
                                    <i class="fas fa-id-card me-1"></i> Numéro SIRET
                                </label>
                                <input type="text" class="form-control" id="siret_association" name="numero_siret" maxlength="14">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="mdp_association" class="form-label">
                                    <i class="fas fa-lock me-1"></i> Mot de passe *
                                </label>
                                <input type="password" class="form-control" id="mdp_association" name="mot_de_passe" required>
                                <div id="password-strength-association" class="password-strength"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mdp_confirm_association" class="form-label">
                                    <i class="fas fa-lock me-1"></i> Confirmer le mot de passe *
                                </label>
                                <input type="password" class="form-control" id="mdp_confirm_association" name="mot_de_passe_confirm" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-building me-2"></i> S'inscrire comme Association
                        </button>
                    </form>
                </div>
                
                <!-- Formulaire d'inscription pour les bénévoles -->
                <div class="tab-pane fade" id="benevole" role="tabpanel">
                    <form action="traitement_inscription.php" method="post" id="form-benevole">
                        <input type="hidden" name="type" value="benevole">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_benevole" class="form-label">
                                    <i class="fas fa-user me-1"></i> Nom *
                                </label>
                                <input type="text" class="form-control" id="nom_benevole" name="nom" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenom_benevole" class="form-label">
                                    <i class="fas fa-user me-1"></i> Prénom
                                </label>
                                <input type="text" class="form-control" id="prenom_benevole" name="prenom">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email_benevole" class="form-label">
                                    <i class="fas fa-envelope me-1"></i> Email *
                                </label>
                                <input type="email" class="form-control" id="email_benevole" name="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telephone_benevole" class="form-label">
                                    <i class="fas fa-phone me-1"></i> Téléphone
                                </label>
                                <input type="tel" class="form-control" id="telephone_benevole" name="telephone">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="adresse_benevole" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i> Adresse
                            </label>
                            <textarea class="form-control" id="adresse_benevole" name="adresse" rows="2"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="competences_benevole" class="form-label">
                                <i class="fas fa-star me-1"></i> Compétences
                            </label>
                            <textarea class="form-control" id="competences_benevole" name="competences" rows="2" placeholder="Décrivez vos compétences et domaines d'expertise..."></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="disponibilite_benevole" class="form-label">
                                <i class="fas fa-calendar me-1"></i> Disponibilité
                            </label>
                            <textarea class="form-control" id="disponibilite_benevole" name="disponibilite" rows="2" placeholder="Indiquez vos créneaux de disponibilité..."></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="mdp_benevole" class="form-label">
                                    <i class="fas fa-lock me-1"></i> Mot de passe *
                                </label>
                                <input type="password" class="form-control" id="mdp_benevole" name="mot_de_passe" required>
                                <div id="password-strength-benevole" class="password-strength"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mdp_confirm_benevole" class="form-label">
                                    <i class="fas fa-lock me-1"></i> Confirmer le mot de passe *
                                </label>
                                <input type="password" class="form-control" id="mdp_confirm_benevole" name="mot_de_passe_confirm" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-hands-helping me-2"></i> S'inscrire comme Bénévole
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <p class="mb-0">Déjà inscrit ? <a href="connexion.php" class="text-decoration-none">Se connecter</a></p>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Vérification de la force du mot de passe
        function checkPasswordStrength(password, elementId) {
            const element = document.getElementById(elementId);
            let strength = 0;
            let message = '';
            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            switch (strength) {
                case 0:
                case 1:
                case 2:
                    message = '<span class="strength-weak">Faible</span>';
                    break;
                case 3:
                case 4:
                    message = '<span class="strength-medium">Moyen</span>';
                    break;
                case 5:
                    message = '<span class="strength-strong">Fort</span>';
                    break;
            }
            
            element.innerHTML = message;
        }
        
        // Événements pour vérifier la force du mot de passe
        document.getElementById('mdp_membre').addEventListener('input', function() {
            checkPasswordStrength(this.value, 'password-strength-membre');
        });
        
        document.getElementById('mdp_association').addEventListener('input', function() {
            checkPasswordStrength(this.value, 'password-strength-association');
        });
        
        document.getElementById('mdp_benevole').addEventListener('input', function() {
            checkPasswordStrength(this.value, 'password-strength-benevole');
        });
        
        // Validation des formulaires
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const password = this.querySelector('input[name="mot_de_passe"]').value;
                const confirmPassword = this.querySelector('input[name="mot_de_passe_confirm"]').value;
                
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Les mots de passe ne correspondent pas.');
                    return false;
                }
                
                if (password.length < 8) {
                    e.preventDefault();
                    alert('Le mot de passe doit contenir au moins 8 caractères.');
                    return false;
                }
            });
        });
    </script>
</body>
</html>