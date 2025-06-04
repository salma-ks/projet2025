<?php
require_once 'config.php';
require_once 'fonctions.php';

// Détruire toutes les variables de session
$_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Supprimer le cookie "Se souvenir de moi" s'il existe
if (isset($_COOKIE['remember_token'])) {
    setcookie('remember_token', '', time() - 3600, "/");
}

// Finalement, détruire la session
session_destroy();

// Rediriger vers la page de connexion avec un message
session_start();
$_SESSION['message_succes'] = "Vous avez été déconnecté avec succès.";
rediriger("connexion.php");
?>