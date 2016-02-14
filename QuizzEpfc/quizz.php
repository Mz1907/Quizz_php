<?php
/* shows the selectemd $_GET['id']  quizz */
if (!empty($_GET['id'])) {
    if (!empty($_POST['form_choices_sent'])) {
        $quizzController = new QuizzController();
        $quizzDone = true;
        $userPostedDatas = $_POST;
        $title = "Correction ";
    }
    $maxIdLength = 4;
    if (strlen($_GET['id']) <= $maxIdLength && ctype_digit($_GET['id']) == true) {
        $id = (int) $_GET['id'];
        $quizzManager = new QuizzManager($db, true);
        $questionManager = new QuestionManager($db, true);
        $quizzDatas = $quizzManager->getQuizzByPrimaryKey('_id', $id, '_created');
        $quizz = new Quizz((array) $quizzDatas[0]);
        $questionsList = $questionManager->getQuestionByPrimaryKey('_quizzName', $quizz->_name, '_created');
        $cptQuestions = count($questionsList);
        ?>
        <h1><?php if (!empty($quizzDone) && $quizzDone) echo $title . $quizzDatas[0]->_name;
        else echo $quizzDatas[0]->_name; ?></h1>
        <p>Nombre de questions: <?php echo $cptQuestions; ?></p>
        <form action="" method="POST">
            <?php
            /* displays each questions of the quizz */
            for ($i = 0; $i < $cptQuestions; $i++) {
                $question = new Question((array) $questionsList[$i]);
                ?>
                <!-- The question n title  -->
                <h2><?php $geshiColoration = geshi_highlight($question->_title, 'php', '', true);
                echo $geshiColoration; ?></h2>
                <!-- The choices of the question n -->
                <input type="hidden" name="form_choices_sent" value="1">
                <div <?php if (!empty($quizzDone) && $quizzDone) {
                    echo $quizzController->highlightGoodAnswer($question->getAnswer(), 1);
                    echo $quizzController->highlightUserChoice($userPostedDatas, 1, $i);
                } ?>><input type="radio" name="uChoice<?php echo ($i + 1); ?>" value="1" checked></div><?php $geshiColoration = geshi_highlight($question->_choices[0], 'php', '', true);
            echo $geshiColoration; ?><br /><br />
                <div <?php if (!empty($quizzDone) && $quizzDone) {
                echo $quizzController->highlightGoodAnswer($question->getAnswer(), 2);
                echo $quizzController->highlightUserChoice($userPostedDatas, 2, $i);
            } ?>><input type="radio" name="uChoice<?php echo ($i + 1); ?>" value="2"></div><?php $geshiColoration = geshi_highlight($question->_choices[1], 'php', '', true);
            echo $geshiColoration; ?><br /><br />
                <div <?php if (!empty($quizzDone) && $quizzDone) {
                echo $quizzController->highlightGoodAnswer($question->getAnswer(), 3);
                echo $quizzController->highlightUserChoice($userPostedDatas, 3, $i);
            } ?>><input type="radio" name="uChoice<?php echo ($i + 1); ?>" value="3"></div><?php $geshiColoration = geshi_highlight($question->_choices[2], 'php', '', true);
            echo $geshiColoration; ?><br /><br />
                <div <?php if (!empty($quizzDone) && $quizzDone) {
                echo $quizzController->highlightGoodAnswer($question->getAnswer(), 4);
                echo $quizzController->highlightUserChoice($userPostedDatas, 4, $i);
            } ?>><input type="radio" name="uChoice<?php echo ($i + 1); ?>" value="4"></div><?php $geshiColoration = geshi_highlight($question->_choices[3], 'php', '', true);
            echo $geshiColoration; ?><br /><br />
            <?php
        }
        if (!isset($quizzDone) || !$quizzDone) {
            ?>
                <input type="submit" name="submit" id="submit" class="btn-success" />
            <?php
        }
        ?>
        </form>
        <?php
    } else {
        echo '<p>Il y a eu un problème (error 1)</p>';
    }
} elseif (!empty($_GET['cat'])) {
    /* user clicked on one cat of the menu then must display all quizz from the cat $_GET['cat'] */
    $quizzManager = new QuizzManager($db, true);
    $quizzList = $quizzManager->getQuizzByPrimaryKey('_category', $_GET['cat'], '_created');
    ?>
    <table class="table table-striped">
        <h1>Quizz dans la catégorie <?php echo $_GET['cat']; ?></h1>
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
    <?php
} else
    echo '<p>Il y a eu un problème (error 2)</p>';
