<?php

class QuizzManager extends ObjectManager {

    ////////////////////////////////////////////////////////////////////////////
    public function __construct($database, $overideFullAccess = false) {
        parent::__construct($database, 'Quizz', 'quizz', $overideFullAccess);
    }

    ////////////////////////////////////////////////////////////////////////////
    public function getAllQuizz($orderBy) {
        return parent::getObjects($orderBy);
    }

    public function getQuizzByPrimaryKey($fieldName, $fieldValue, $orderBy) {
        return parent::getObjectsByPrimaryKey($fieldName, $fieldValue, $orderBy);
    }

    public function insertQuizz($object) {
        return parent::addObjectInDatabase($object);
    }

    public function updateQuizzInDatabase(Quizz $quizz) {
        return parent::updateObjectInDatabase($quizz);
    }

    public function deleteQuizz($object) {
        parent::deleteObjectFromDatabase($object);
    }

}
