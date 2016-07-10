<?php

class UserManager extends ObjectManager {

    ////////////////////////////////////////////////////////////////////////
    /* Tells wether an user is logged or not. */
    public static function isLogged() {
        return (!empty($_SESSION['userName']));
    }

    /* Gets the username of the current user. */

    public static function getUsername() {
        return $_SESSION['userName'];
    }

    ////////////////////////////////////////////////////////////////////////
    public function insertUser(User $user) {
        return parent::addObjectInDatabase($user);
    }

    /* select all users in db */

    public function getAllUsers($orderBy) {
        return parent::getObjects($orderBy);
    }

    /* select user in db */

    public function getUserByPrimaryKey($fieldName, $fieldValue, $orderedBy) {
        return parent::getObjectsByPrimaryKey($fieldName, $fieldValue, $orderedBy);
    }

}

?>