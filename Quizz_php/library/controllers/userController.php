<?php

class userController {
    /* check passord size */

    public function checkPseudoSentSize($pseudo){
        return $result = strlen($pseudo) >= 4 && strlen($pseudo) <= 18 ? true : false;
    }

    public function checkPasswordSentSize($password){
        return $result = strlen($password) >= 4 && strlen($password) <= 20 ? true : false;
    }

    /* hash passwordSent */

    public function hash($passwordSent){
        return $hashedPassword = password_hash($passwordSent, PASSWORD_DEFAULT);
    }

    /* check if sent password is the same as in db */

    public function checkAuth($pseudoSent, $passwordSent, UserManager $userManager) {
        $user = $userManager->getUserByPrimaryKey('_pseudo', $pseudoSent, '_created');
        if (count($user) == 1) {
            $passwordDb = $user[0]->_password;
            $isAuth = password_verify($passwordSent, $passwordDb);
            return $isAuth;
        } else
            return false;
    }

}
