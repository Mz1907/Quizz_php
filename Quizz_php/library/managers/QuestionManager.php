<?php

class QuestionManager extends ObjectManager {

    ////////////////////////////////////////////////////////////////////////////
    public function __construct($database, $overideFullAccess = false) {
        parent::__construct($database, 'Question', 'quizz_questions', $overideFullAccess);
    }

    ////////////////////////////////////////////////////////////////////////////
    public function getAllQuestions($orderBy) {
        return parent::getObjects($orderBy);
    }

    public function getQuestionByPrimaryKey($fieldName, $fieldValue, $orderBy) {
        return parent::getObjectsByPrimaryKey($fieldName, $fieldValue, $orderBy);
    }

    public function insertQuestion($object) {
        return parent::addObjectInDatabase($object);
    }

    public function updateQuestionInDatabase(Question $question) {
        return parent::updateObjectInDatabase($question);
    }

}
