<?php
if (!$userManager::isLogged() && (!isset($_GET['action']))) {
    include_once('library/login/auth.php');
    /* shows auth error message */
    echo!empty($_SESSION['authMessage']) ? $_SESSION['authMessage'] : '';
    unset($_SESSION['authMessage']);
}
?>
<!-- Navigation -->
<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo site_url(''); ?>">Quizz Epfc</a>
        </div>
        <!-- /.navbar-header -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="index.php?page=quizz&cat=htmlcss">Html-Css</a></li>
                <li><a href="index.php?page=quizz&cat=js">Js</a></li>
                <li><a href="index.php?page=quizz&cat=php">Php</a></li>
                <li><a href="index.php?page=quizz&cat=mysql">Mysql</a></li>
                <?php
                if ($userManager::isLogged()) {
                    ?>
                    <li><a href="index.php?page=zone-admin">Zone Admin</a></li>
                    <li><a href="index.php?page=login&action=logout">Se déconnecter</a></li>
                    <?php
                }
                ?>
                <li><a href="https://github.com/mzagai/Epfc">Télécharger le code source du projet QuizzEpfc</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<!-- /.navbar -->