<?php
session_start();
$PRODUCTION = false;
if ($_SERVER['SERVER_NAME'] != 'localhost') {
	ini_set('display_errors', 1);
	error_reporting(~0);
    $PRODUCTION = true;
}
require_once('library/classes.inc.php');
require_once('library/common_functions.php');
require_once('controller.php');
$db = new Database();
$userManager = new UserManager($db, 'User', 'users');
$userController = new UserController();
define('BASE_URL', 'http://' . $_SERVER['SERVER_NAME'] . ($PRODUCTION ? '/epfc/QuizzEpfc/' : '/QuizzEpfc/'));
?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Quizz Epfc</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="Description" lang="en" content="ADD SITE DESCRIPTION">
        <meta name="author" content="ADD AUTHOR INFORMATION">
        
        <!-- NO INDEX ! -->
        <meta name="robots" content="noindex">

        <!-- icons -->
        <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
        <link rel="shortcut icon" href="favicon.ico">

        <!-- Bootstrap Core CSS file -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">

        <!-- Override CSS file - add your own CSS rules -->
        <link rel="stylesheet" href="assets/css/styles.css">

        <!-- Conditional comment containing JS files for IE6 - 8 -->
        <!--[if lt IE 9]>
                <script src="assets/js/html5.js"></script>
                <script src="assets/js/respond.min.js"></script>
        <![endif]-->
        
        <!-- Hilight.js call -->
        <link rel="stylesheet" href="highlight/styles/monokai-sublime.css">
        <script src="highlight/highlight.pack.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>
    </head>
    <body>

        <!-- Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Page breadcrumb -->
                    <ol class="breadcrumb">
                        <?php if ($userManager::isLogged()) { ?>
                            <li class="active"><?php echo "Bonjour {$_SESSION['userName']} "; ?></li>                                        
                            <?php
                        }
                        ?>
                        <li class="active"><?php echo frenchDays(date('w')) . ' ' . date('d') . ' ' . frenchMonth(date('m')) . ' ' . date(' H\hi'); ?></li>
                    </ol>
                    <?php require_once('header.php'); ?>
                    <!-- Page Heading -->
                    <hr>
                    <?php require_once($currentPage); ?>                                   
                </div>
            </div>
            <!-- /.row -->
            <hr>
            <h3>À propos des quizz:</h3>
            <p class="text-left">Un quizz peut contenir une ou plusieurs questions à  choix multiples. 
                Lors de la correction, le bouton radio de la bonne réponse est encadré en vert  
                tandis que la réponse du visiteur est encadrée en rouge. Si le visiteur a trouvé la bonne réponse, alors 
                la bonne réponse est uniquement encadrée en vert.
                Tout visiteur peut répondre à  un quizz.
            </p>
            <p class="text-left">Il existe quatre catégories de quizz:</p>
            <ul>
                <li>Html-Css</li>
                <li>Javascript</li>
                <li>Php</li>
                <li>Mysql</li>
            </ul>
            <p class="text-left">
                Zone membre: devenir membre permet de créer, éditer, supprimer un quizz lié à  son compte utilisateur
                (impossible de modifier le quizz d'un autre membre). Pour éditer un quizz il faut cliquez sur le menu zone-admin 
                qui apparaît lorsque la session utilisateur est créee.
            </p>
            <hr>
        </div>
        <!-- /.container-fluid -->
        <!-- Bootstrap Core scripts -->
        <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>