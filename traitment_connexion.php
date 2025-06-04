<?php
require_once 'config.php';
require_once 'fonctions.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et nettoyer les données du formulaire
    $type = nettoyerDonnee($_POST['type']);
    $email = nettoyerDonnee($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];
    $remember = isset($_POST['remember']);
    
    // Validation des données
    if (!validerEmail($email)) {
        $_SESSION['message_erreur'] = "L'adresse email n'est pas valide.";
        rediriger("connexion.php");
    }
    
    try {
        // Traitement selon le type d'utilisateur
        switch ($type) {
            case 'membre':
                // Rechercher le membre dans la base de données
                $query = $pdo->prepare("
                    SELECT ID_MEMBERS, NOM, PRENOM, EMAIL, MOT_DE_PASSE, STATUT 
                    FROM LES_MEMBRES 
                    WHERE EMAIL = ? AND STATUT = 'actif'
                ");
                $query->execute([$email]);
                $utilisateur = $query->fetch();
                
                if ($utilisateur && password_verify($mot_de_passe, $utilisateur['MOT_DE_PASSE'])) {
                    // Connexion réussie
                    $_SESSION['user_id'] = $utilisateur['ID_MEMBERS'];
                    $_SESSION['user_name'] = $utilisateur['NOM'];
                    $_SESSION['user_prenom'] = $utilisateur['PRENOM'];
                    $_SESSION['user_email'] = $utilisateur['EMAIL'];
                    $_SESSION['user_type'] = 'membre';
                    
                    // Mettre à jour la dernière connexion
                    mettreAJourDerniereConnexion($pdo, $utilisateur['ID_MEMBERS'], 'membre');
                    
                    // Gestion du "Se souvenir de moi"
                    if ($remember) {
                        $token = bin2hex(random_bytes(32));
                        setcookie('remember_token', $token, time() + (86400 * 30), "/"); // 30 jours
                        // Vous pouvez stocker ce token en base pour plus de sécurité
                    }
                    
                    rediriger("dashboard.php");
                } else {
                    $_SESSION['message_erreur'] = "Email ou mot de passe incorrect, ou compte inactif.";
                    rediriger("connexion.php");
                }
                break;
                
            case 'association':
                // Rechercher l'association dans la base de données
                $query = $pdo->prepare("
                    SELECT ID_ASSOCIATION, NOM, EMAIL, MOT_DE_PASSE, STATUT 
                    FROM LES_ASSOCIATIONS 
                    WHERE EMAIL = ? AND STATUT = 'active'
                ");
                $query->execute([$email]);
                $utilisateur = $query->fetch();
                
                if ($utilisateur && password_verify($mot_de_passe, $utilisateur['MOT_DE_PASSE'])) {
                    // Connexion réussie
                    $_SESSION['user_id'] = $utilisateur['ID_ASSOCIATION'];
                    $_SESSION['user_name'] = $utilisateur['NOM'];
                    $_SESSION['user_email'] = $utilisateur['EMAIL'];
                    $_SESSION['user_type'] = 'association';
                    
                    // Mettre à jour la dernière connexion
                    mettreAJourDerniereConnexion($pdo, $utilisateur['ID_ASSOCIATION'], 'association');
                    
                    // Gestion du "Se souvenir de moi"
                    if ($remember) {
                        $token = bin2hex(random_bytes(32));
                        setcookie('remember_token', $token, time() + (86400 * 30), "/");
                    }
                    
                    rediriger("dashboard.php");
                } else {
                    $_SESSION['message_erreur'] = "Email ou mot de passe incorrect, ou compte inactif.";
                    rediriger("connexion.php");
                }
                break;
                
            case 'benevole':
                // Rechercher le bénévole dans la base de données
                $query = $pdo->prepare("
                    SELECT ID_BENEVOL, NOM, PRENOM, EMAIL, MOT_DE_PASSE, STATUT 
                    FROM BENEVOLE 
                    WHERE EMAIL = ? AND STATUT = 'actif'
                ");
                $query->execute([$email]);
                $utilisateur = $query->fetch();
                
                if ($utilisateur && password_verify($mot_de_passe, $utilisateur['MOT_DE_PASSE'])) {
                    // Connexion réussie
                    $_SESSION['user_id'] = $utilisateur['ID_BENEVOL'];
                    $_SESSION['user_name'] = $utilisateur['NOM'];
                    $_SESSION['user_prenom'] = $utilisateur['PRENOM'];
                    $_SESSION['user_email'] = $utilisateur['EMAIL'];
                    $_SESSION['user_type'] = 'benevole';
                    
                    // Mettre à jour la dernière connexion
                    mettreAJourDerniereConnexion($pdo, $utilisateur['ID_BENEVOL'], 'benevole');
                    
                    // Gestion du "Se souvenir de moi"
                    if ($remember) {
                        $token = bin2hex(random_bytes(32));
                        setcookie('remember_token', $token, time() + (86400 * 30), "/");
                    }
                    
                    rediriger("dashboard.php");
                } else {
                    $_SESSION['message_erreur'] = "Email ou mot de passe incorrect, ou compte inactif.";
                    rediriger("connexion.php");
                }
                break;
                
            default:
                $_SESSION['message_erreur'] = "Type d'utilisateur non valide.";
                rediriger("connexion.php");
        }
    } catch (PDOException $e) {
        $_SESSION['message_erreur'] = "Erreur lors de la connexion : " . $e->getMessage();
        rediriger("connexion.php");
    }
} else {
    // Si le formulaire n'a pas été soumis, rediriger vers la page de connexion
    rediriger("connexion.php");
}
?>