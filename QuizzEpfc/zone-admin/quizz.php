<?php
if (UserManager::isLogged()) {
    $action = !empty($_GET['action']) ? $_GET['action'] : null;
    if ((!empty($_GET['quizzId']) && ctype_digit($_GET['quizzId']) == true)) {
        $quizzId = (int) $_GET['quizzId'];
        $editQuestions = true;
        $quizz = $quizzManager->getQuizzByPrimaryKey('_id', $quizzId, '_created');
        $quizz = $quizz[0];
        $editedQuizzQuestions = $questionManager->getQuestionByPrimaryKey('_quizzName', $quizz->_name, '_created');
        $quizzCptQuestions = count($editedQuizzQuestions);
        /* unserialzes and retrieves choices */
        $choicesDatas = [];
        for ($i = 0; $i < $quizzCptQuestions; $i++)
            $choicesDatas [] = unserialize($editedQuizzQuestions[$i]->_choices);
    }
    if ($action == 'add' || ($action == 'edit' && $quizzId > 0) || $action == "addQuestion") {
        $addingNewQuizz = ($action == 'add' ? true : false);
        $addingNewQuestion = ($action == 'addQuestion' ? true : false);
        if (!$addingNewQuizz && !$addingNewQuestion) {
            $editedQuizzQuestions = $questionManager->getQuestionByPrimaryKey('_quizzName', $quizz->_name, '_created');
        }
        if (!isset($_POST['form_sent'])) { // displaying the quizz adding/editing form
            ?>
            <h1><?= ($addingNewQuizz ? 'Ajouter' : 'Editer') ?> un quizz</h1>
            <br />                        
            <form method="post" action="?page=zone-admin&type=quizz&action=<?php echo $action; ?><?php echo ($addingNewQuizz || $addingNewQuestion ? '' : '&quizzId=' . $quizz->_id); ?>">
                <input type="hidden" name="form_sent" value="1" />
                <?php if ($addingNewQuizz || $action == 'edit') { ?>
                    Titre du quizz:
                    <br /><input type="text" name="quizzName" size="100" value="<?php echo!$addingNewQuizz ? $quizz->_name : ''; ?>" class="longInput" /><br /><br />
                <?php } elseif ($addingNewQuestion) {
                    ?>
                    Dans quel quizz souhaitez-vous ajouter une question ?
                    <select name="quizzName">
                        <?php
                        for ($i = 0; $i < $usercptQuizz; $i++) {
                            ?>
                            <option><?php echo $userQuizzList[$i]->_name; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                }
                if ((!empty($editQuestions) && $editQuestions) || $addingNewQuestion || $addingNewQuizz) {
                    $quizzCptQuestions = $addingNewQuestion || $addingNewQuizz ? 1 : $quizzCptQuestions;
                    for ($i = 0; $i < $quizzCptQuestions; $i++) {
                        ?>
                        <p>Question: (il est possible d'ajouter d'autres questions à votre quizz par la suite en cliquant sur le lien "zone-admin" présent dans le menu, si vous êtes authentifié)</p>
                        <textarea name="<?php echo $action == 'edit' ? 'question' . $i : 'question' ?>" class="longTextarea" cols="120" rows="12"><?php echo $action != 'add' && !empty($editQuestions) && $editQuestions ? $editedQuizzQuestions[$i]->_title : ''; ?></textarea><br /><br />
                        <p>Format des 4 choix multiples:</p>
                        <select name="answerFormat<?php if($action=='edit')echo $i; ?>">
                            <option value="0">Texte</option>
                            <option value="1">Code</option>
                        </select><br /><br />
                        <?php
                        /* 4 choices */
                        $nbChoix = 4;
                        for ($j = 1, $k = 0; $j <= $nbChoix; $j++, $k++) {
                            ?>
                            Choix n°<?php echo $j; ?>
                            <br /><textarea name="<?php echo $action == 'edit' ? 'choice' . $i . $j : 'choice' . $j; ?>" class="longTextarea" cols="120" rows="12"><?php echo $action != 'add' && !empty($editQuestions) && $editQuestions ? $choicesDatas[$i][$k] : ''; ?></textarea><br />
                        <?php }
                        ?>
                        La bonne réponse est:
                        <br /><select name="<?php echo $action == 'add' || $action == 'edit' || $addingNewQuestion ? 'answer' . $i : 'answer'; ?>">
                            <option value="1" <?php echo!$addingNewQuizz && !empty($editQuestions) && $editQuestions && $editedQuizzQuestions[$i]->_answer == '1' ? 'selected="selected"' : ''; ?> >choix 1</option>
                            <option value="2" <?php echo!$addingNewQuizz && !empty($editQuestions) && $editQuestions && $editedQuizzQuestions[$i]->_answer == '2' ? 'selected="selected"' : ''; ?>>choix 2</option>
                            <option value="3" <?php echo!$addingNewQuizz && !empty($editQuestions) && $editQuestions && $editedQuizzQuestions[$i]->_answer == '3' ? 'selected="selected"' : ''; ?>>choix 3</option>
                            <option value="4" <?php echo!$addingNewQuizz && !empty($editQuestions) && $editQuestions && $editedQuizzQuestions[$i]->_answer == '4' ? 'selected="selected"' : ''; ?>>choix 4</option>
                        </select>
                    <?php }
                }
                ?>
                <br /><br />
            <?php ?>
                Catégorie : <select name="category">
                    <option value="html_css">Html-css</option>
                    <option value="js">Javascript</option>
                    <option value="php">Php</option>
                    <option value="mysql">Mysql</option>
                </select> <?= $addingNewQuizz || $addingNewQuestion ? '' : '(' . $quizz->_category . ')' ?><br />
                <input type="submit" name="submit" value="<?= ($addingNewQuizz || $addingNewQuestion ? 'Ajouter' : 'Editer') ?> !" class="btn-danger" >
            </form>

            <?php
        } else { // the quizz adding/editing form has been posted
            $db->connect();
            if (!$addingNewQuestion) {
                $optionsQuizz = [];
                $optionsQuizz['_id'] = $addingNewQuizz ? null : $quizz->_id;
                $optionsQuizz['_author'] = $addingNewQuizz ? UserManager::getUsername() : $quizz->_author;
                $optionsQuizz['_name'] = $_POST['quizzName'];
                $optionsQuizz['_category'] = $_POST['category'];
                $optionsQuizz['_created'] = $addingNewQuizz ? '' : $quizz->_created;
                $optionsQuizz['_modified'] = $addingNewQuizz ? '' : $quizz->_modified;
                $quizz = new Quizz($optionsQuizz);
            }
            if ($action != 'edit') { // if $addingNewQuestion
                $optionsQuestion['_quizzName'] = $addingNewQuizz || $addingNewQuestion ? $_POST['quizzName'] : $question->_id;
                $optionsQuestion['_title'] = $addingNewQuizz || $addingNewQuestion  ? $_POST['question'] : $question->_title;
                $optionsQuestion['_isChoiceCode'] = $addingNewQuizz || $addingNewQuestion  ? $_POST['answerFormat'] : $question->_isChoiceCode;
                for ($j = 1; $j <= 4; $j++)
                    $choices [] = $_POST['choice' . $j]; // collecting 5 posted choices
                $optionsQuestion['_choices'] = $choices;
                $optionsQuestion['_answer'] = $_POST['answer0'];
                $optionsQuestion['_created'] = $addingNewQuizz || $addingNewQuestion ? '' : $quizz->_created;
                $optionsQuestion['_modified'] = $addingNewQuizz || $addingNewQuestion || $action == 'edit' ? '' : $quizz->_modified;
                $question = new Question($optionsQuestion);
            } elseif ($action == 'edit') {
                for ($i = 0; $i < $quizzCptQuestions; $i++) {
                    $optionsQuestion['_id'] = $editedQuizzQuestions[$i]->_id;
                    $optionsQuestion['_quizzName'] = $_POST['quizzName'];
                    $optionsQuestion['_title'] = $_POST['question' . $i];
                    $optionsQuestion['_isChoiceCode'] = (int)$_POST['answerFormat'.$i];
                    for ($j = 1; $j <= 4; $j++)
                        $choices [$i][] = $_POST['choice' . $i . $j]; // collecting 5 posted choices
                    $optionsQuestion['_choices'] = $choices[$i];
                    $optionsQuestion['_answer'] = $_POST['answer' . $i];
                    $optionsQuestion['_created'] = $quizz->_created;
                    $optionsQuestion['_modified'] = '';
					var_dump($optionsQuestion);
                    $question = new Question($optionsQuestion);
                    $questionManager->updateQuestionInDatabase($question);
                    $optionsQuestion = null;
                    $question = null;
                }
            }

            if ($addingNewQuizz) {
                $quizzManager->insertQuizz($quizz);
            }
            if ($addingNewQuestion || $addingNewQuizz) {
                $questionManager->insertQuestion($question);
            }
            if ($action == 'edit') {
                $quizzManager->updateQuizzInDatabase($quizz);
            }
            $db->close($db);
            $message = '<br /><br /><span class="green">Quizz ';
            $message .= ($addingNewQuizz ? 'ajoutée' : 'éditée');
            $message .= ' !</span>';
            echo $message;
            echo '<br />Redirection en cours...<script type="text/javascript">setTimeout("location.href = \''.site_url('index.php?page=zone-admin&type=quizz&action=add').'\';", 2000);</script>';
        }
    } elseif ($action == 'view_quizz_list' || $action = 'delete') {
        if (is_array($userQuizzList)) {
            for ($i = 0; $i < $usercptQuizz; $i++) {
                $currentQuizz = $userQuizzList[$i];
                $link = '<a href="' . site_url('index.php?page=zone-admin&type=quizz&action=edit&quizzId=' . $currentQuizz->_id) . '">' . $currentQuizz->_name . '</a>' . '&nbsp;&nbsp;&nbsp;&nbsp;' . $currentQuizz->_created;
                $link .= ' <a href="' . site_url('index.php?page=zone-admin&type=quizz&action=delete&quizzId=' . $currentQuizz->_id) . '&userQuizzListKey=' . $i . '">Supprimer ce quizz</a><br />';
                echo $link;
            }
        } else
            echo 'Aucune quizz trouvée.';
    }
    if ($action == 'delete') {
        if ((!empty($_GET['quizzId']) && ctype_digit($_GET['quizzId']) == true) && ctype_digit($_GET['userQuizzListKey']) == true) {
            $quizzId = (int) $_GET['quizzId'];
            echo $quizzId;
            $quizz = $quizzManager->getQuizzByPrimaryKey('_id', $quizzId, '_created');
            $quizz = new Quizz(['_id' => $quizz[0]->_id,
                '_author' => $quizz[0]->_author,
                '_name' => $quizz[0]->_name,
                '_category' => $quizz[0]->_category,
                '_created' => $quizz[0]->_created,
                '_modified' => $quizz[0]->_modified
            ]);
            $result = $quizzManager->deleteQuizz($quizz);
            $userQuizzListKey = $_GET['userQuizzListKey'];
            /* delete the deleted Quizz object from $userQuizzList */
            $userQuizzList = array_splice($userQuizzList, $userQuizzListKey, 1);
        }
    }
}
?>