<?php
if (!empty($_GET['page'])) {
    switch ($_GET['page']) {
        case 'home': $currentPage = 'home.php';
            $pageTitle = 'Quizz epfc home';
            $metaDescription = 'Quizz epfc';
            $metaKeywords = 'Quizz Epfc des exercices pour les étudiants de la section web-developpeur Epfc Bruxelles';
            break;

        case 'quizz': $currentPage = 'quizz.php';
            $pageTitle = 'Liste des quizz pour s\'entrainer';
            $metaDescription = 'Quizz epfc';
            $metaKeywords = 'epfc, quizz, exercices';
            break;

        case 'zone-admin': $currentPage = 'zone-admin.php';
            $pageTitle = 'Zone admin';
            $metaDescription = 'Zone d\'administration du site';
            $metaKeywords = 'epfc, quizz, exercices';
            break;

        case 'login': $currentPage = 'login.php';
            $pageTitle = 'Register';
            $metaDescription = 'Page d\'inscription';
            $metaKeywords = 'register, subscribe';
            break;

        default: $currentPage = 'home.php';
            $pageTitle = 'Quizz epfc home';
            $metaDescription = 'Quizz epfc';
            $metaKeywords = 'epfc, quizz, exercices';
            break;
    }
} else {
    $currentPage = 'home.php';
    $pageTitle = 'Quizz epfc';
    $metaDescription = 'Quizz Epfc des exercices pour les étudiants de la section web-developpeur Epfc Bruxelles';
    $metaKeywords = 'epfc, quizz, exercices';
}
?>