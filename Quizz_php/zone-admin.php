<?php
if (UserManager::isLogged()) {
    $quizzManager = new QuizzManager($db);
    $questionManager = new QuestionManager($db);
    $userQuizzList = $quizzManager->getQuizzByPrimaryKey('_author', UserManager::getUsername(), '_created');
    $usercptQuizz = count($userQuizzList);
    if (!isset($_GET['action'])) { // if there is no action in the URL, show the menu
        ?>
        <h2>Ajouter</h2>
        <a href="?page=zone-admin&type=quizz&action=add">Ajouter un nouveau Quizz</a>

        <?php if ($usercptQuizz > 0) { ?>
            <h2>Editer</h2>
            <a href="?page=zone-admin&type=quizz&action=view_quizz_list">Editer un Quizz</a><br />
            <a href="?page=zone-admin&type=quizz&action=addQuestion">Ajouter une nouvelle question à un quizz</a><br />
            <h2>Supprimer</h2>
            <a href="?page=zone-admin&type=quizz&action=delete">Supprimer un quizz</a><br />
        <?php } ?>
        <br />
        <?php
    } else { // after click on a link with the GET action defined (add or edit)
        $type = $_GET['type'];
        switch ($type) {
            case 'quizz': include_once('zone-admin/quizz.php');
                break;
            case 'question': include_once('zone-admin/questions.php');
                break;
            default: echo 'Erreur 404';
        }
    }
} else {
    echo '<p>Vous devez vous connecter pour accèder aux infos de cette page</p>';
}
?>