<?php
$quizzManager = new QuizzManager($db);
$quizzList = $quizzManager->getAllQuizz('_created');
/* shows list of all Quizz */
$count = count($quizzList);
?>
<table class="table table-striped">
    <h1>Derniers quizz enregistrés</h1>
    <caption>Pour faire à un quizz cliquez sur le lien correspondant</caption>
    <thead>
        <tr>
            <th>Nom du quizz</th>
            <th>catégorie</th>
            <th>Date création</th>
            <th>Auteur</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($quizzList as $quizz => $quizzKey) {
            ?>
            <tr>
                <th scope="row" ><a href="index.php?page=quizz&id=<?php echo $quizzKey->_id; ?>"><?php echo $quizzKey->_name; ?></a></th>
                <td><?php echo $quizzKey->_category; ?></a></td>
                <td><?php echo db_date($quizzKey->_created); ?></a></td>
                <td><?php echo $quizzKey->_author; ?></a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>