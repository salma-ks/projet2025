<?php
require_once 'config.php';

/**
 * Fonction pour vérifier si un email existe déjà dans une table
 */
function emailExiste($pdo, $email, $table) {
    $query = $pdo->prepare("SELECT COUNT(*) FROM $table WHERE EMAIL = ?");
    $query->execute([$email]);
    return $query->fetchColumn() > 0;
}

/**
 * Fonction pour nettoyer les données d'entrée
 */
function nettoyerDonnee($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Fonction pour vérifier si l'utilisateur est connecté
 */
function estConnecte() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_type']);
}

/**
 * Fonction pour rediriger vers une page
 */
function rediriger($url) {
    header("Location: $url");
    exit();
}

/**
 * Fonction pour afficher un message d'erreur
 */
function afficherErreur($message) {
    return "<div class='alert alert-danger'>$message</div>";
}

/**
 * Fonction pour afficher un message de succès
 */
function afficherSucces($message) {
    return "<div class='alert alert-success'>$message</div>";
}

/**
 * Fonction pour valider un email
 */
function validerEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Fonction pour valider un mot de passe
 */
function validerMotDePasse($password) {
    // Au moins 8 caractères, une majuscule, une minuscule et un chiffre
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@$!%*?&]{8,}$/', $password);
}

/**
 * Fonction pour créer une notification
 */
function creerNotification($pdo, $id_destinataire, $type_destinataire, $titre, $contenu, $type_notification = 'info') {
    try {
        $query = $pdo->prepare("
            INSERT INTO NOTIFICATIONS (ID_DESTINATAIRE, TYPE_DESTINATAIRE, TITRE, CONTENU, TYPE_NOTIFICATION) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $query->execute([$id_destinataire, $type_destinataire, $titre, $contenu, $type_notification]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Fonction pour mettre à jour la dernière connexion
 */
function mettreAJourDerniereConnexion($pdo, $user_id, $user_type) {
    try {
        switch ($user_type) {
            case 'membre':
                $query = $pdo->prepare("UPDATE LES_MEMBRES SET DATE_DERNIERE_CONNEXION = NOW() WHERE ID_MEMBERS = ?");
                break;
            case 'association':
                $query = $pdo->prepare("UPDATE LES_ASSOCIATIONS SET DATE_DERNIERE_CONNEXION = NOW() WHERE ID_ASSOCIATION = ?");
                break;
            case 'benevole':
                $query = $pdo->prepare("UPDATE BENEVOLE SET DATE_DERNIERE_CONNEXION = NOW() WHERE ID_BENEVOL = ?");
                break;
            default:
                return false;
        }
        $query->execute([$user_id]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
?>