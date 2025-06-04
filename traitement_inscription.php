<?php
require_once 'config.php';
require_once 'fonctions.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et nettoyer les données du formulaire
    $type = nettoyerDonnee($_POST['type']);
    $nom = nettoyerDonnee($_POST['nom']);
    $prenom = isset($_POST['prenom']) ? nettoyerDonnee($_POST['prenom']) : null;
    $email = nettoyerDonnee($_POST['email']);
    $telephone = isset($_POST['telephone']) ? nettoyerDonnee($_POST['telephone']) : null;
    $adresse = isset($_POST['adresse']) ? nettoyerDonnee($_POST['adresse']) : null;
    $mot_de_passe = $_POST['mot_de_passe'];
    $mot_de_passe_confirm = $_POST['mot_de_passe_confirm'];
    
    // Validation des données
    $erreurs = [];
    
    // Vérifier l'email
    if (!validerEmail($email)) {
        $erreurs[] = "L'adresse email n'est pas valide.";
    }
    
    // Vérifier que les mots de passe correspondent
    if ($mot_de_passe !== $mot_de_passe_confirm) {
        $erreurs[] = "Les mots de passe ne correspondent pas.";
    }
    
    // Vérifier la force du mot de passe
    if (!validerMotDePasse($mot_de_passe)) {
        $erreurs[] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.";
    }
    
    // Si il y a des erreurs, les afficher
    if (!empty($erreurs)) {
        $_SESSION['message_erreur'] = implode('<br>', $erreurs);
        rediriger("inscription.php");
    }
    
    // Hacher le mot de passe
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    
    try {
        // Traitement selon le type d'utilisateur
        switch ($type) {
            case 'membre':
                // Vérifier si l'email existe déjà
                if (emailExiste($pdo, $email, 'LES_MEMBRES')) {
                    $_SESSION['message_erreur'] = "Cet email est déjà utilisé par un membre.";
                    rediriger("inscription.php");
                }
                
                // Insérer le nouveau membre
                $query = $pdo->prepare("
                    INSERT INTO LES_MEMBRES (NOM, PRENOM, EMAIL, MOT_DE_PASSE, PHONE_NUMBER, ADRESSE, STATUT) 
                    VALUES (?, ?, ?, ?, ?, ?, 'actif')
                ");
                $query->execute([$nom, $prenom, $email, $mot_de_passe_hash, $telephone, $adresse]);
                
                $user_id = $pdo->lastInsertId();
                
                // Créer une notification de bienvenue
                creerNotification($pdo, $user_id, 'membre', 'Bienvenue !', 
                    'Votre compte membre a été créé avec succès. Bienvenue dans notre communauté !', 'success');
                
                break;
                
            case 'association':
                // Vérifier si l'email existe déjà
                if (emailExiste($pdo, $email, 'LES_ASSOCIATIONS')) {
                    $_SESSION['message_erreur'] = "Cet email est déjà utilisé par une association.";
                    rediriger("inscription.php");
                }
                
                // Récupérer les données spécifiques aux associations
                $description = isset($_POST['description']) ? nettoyerDonnee($_POST['description']) : null;
                $site_web = isset($_POST['site_web']) ? nettoyerDonnee($_POST['site_web']) : null;
                $numero_siret = isset($_POST['numero_siret']) ? nettoyerDonnee($_POST['numero_siret']) : null;
                
                // Insérer la nouvelle association
                $query = $pdo->prepare("
                    INSERT INTO LES_ASSOCIATIONS (NOM, DESCRIPTION, EMAIL, MOT_DE_PASSE, PHONE_NUMBER, ADRESSE, SITE_WEB, NUMERO_SIRET, STATUT) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'active')
                ");
                $query->execute([$nom, $description, $email, $mot_de_passe_hash, $telephone, $adresse, $site_web, $numero_siret]);
                
                $user_id = $pdo->lastInsertId();
                
                // Créer une notification de bienvenue
                creerNotification($pdo, $user_id, 'association', 'Bienvenue !', 
                    'Votre compte association a été créé avec succès. Vous pouvez maintenant créer des activités !', 'success');
                
                break;
                
            case 'benevole':
                // Vérifier si l'email existe déjà
                if (emailExiste($pdo, $email, 'BENEVOLE')) {
                    $_SESSION['message_erreur'] = "Cet email est déjà utilisé par un bénévole.";
                    rediriger("inscription.php");
                }
                
                // Récupérer les données spécifiques aux bénévoles
                $competences = isset($_POST['competences']) ? nettoyerDonnee($_POST['competences']) : null;
                $disponibilite = isset($_POST['disponibilite']) ? nettoyerDonnee($_POST['disponibilite']) : null;
                
                // Insérer le nouveau bénévole
                $query = $pdo->prepare("
                    INSERT INTO BENEVOLE (NOM, PRENOM, EMAIL, MOT_DE_PASSE, PHONE_NUMBER, ADRESSE, COMPETENCES, DISPONIBILITE, STATUT) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'actif')
                ");
                $query->execute([$nom, $prenom, $email, $mot_de_passe_hash, $telephone, $adresse, $competences, $disponibilite]);
                
                $user_id = $pdo->lastInsertId();
                
                // Créer une notification de bienvenue
                creerNotification($pdo, $user_id, 'benevole', 'Bienvenue !', 
                    'Votre compte bénévole a été créé avec succès. Vous pouvez maintenant participer aux activités !', 'success');
                
                break;
                
            default:
                $_SESSION['message_erreur'] = "Type d'utilisateur non valide.";
                rediriger("inscription.php");
        }
        
        // Inscription réussie
        $_SESSION['message_succes'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        rediriger("connexion.php");
        
    } catch (PDOException $e) {
        $_SESSION['message_erreur'] = "Erreur lors de l'inscription : " . $e->getMessage();
        rediriger("inscription.php");
    }
} else {
    // Si le formulaire n'a pas été soumis, rediriger vers la page d'inscription
    rediriger("inscription.php");
}
?>