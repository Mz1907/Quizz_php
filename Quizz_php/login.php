<?php

if ($userManager::isLogged()) {
    if (!empty($_GET['action']) && $_GET['action'] == 'logout') {
        include_once 'library/login/log.php';
    } else
        return 'erreur 204';
}

elseif (!$userManager::isLogged()) {
    if (!empty($_GET['action']) && $_GET['action'] == 'register') {
        include_once 'library/login/log.php';
    } elseif (!empty($_GET['action']) && $_GET['action'] == 'login') {
        include_once 'library/login/log.php';
    }
} else
    return 'erreur 205';

