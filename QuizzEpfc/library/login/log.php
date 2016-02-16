<?php
/* if a new user registers and his registration form is sent */
if (!empty($_POST['form_register_sent']) && !empty($_POST['pseudo']) && !empty($_POST['password'])) {
    $userController = new UserController();
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $q1 = $_POST['q1'];
    $checkPseudo = $userController->checkPseudoSentSize($pseudo);
    $checkPassword = $userController->checkPasswordSentSize($password);
    $checkSelect = $q1 == 'epfc' ? true : false;
    if ($checkPseudo && $checkPassword && $checkSelect) {
        /* insert in db */
        $userDatas = [
            '_pseudo' => $_POST['pseudo'],
            '_password' => $userController->hash($_POST['password']),
            '_created' => '',
            '_modified' => '',
        ];
        $user = new User($userDatas);
        $result = $userManager->insertUser($user);
        echo '<br />Redirection en cours...<script type="text/javascript">setTimeout("location.href = \''.site_url('index.php').'\';", 2000);</script>';
        
    }
    /* there is a problem with atleast one of the 3 check  condition (ckchpseudo or checkpassword or epfc select list)  */ else {
        if (!$checkPseudo) {
            echo $registerMessage = 'Il y a un problème avec la taille de votre pseudo';
        } elseif (!$checkPassword) {
            echo $registerMessage = 'Il y a un problème avec la taille de votre mot de passe';
        } elseif (!$checkSelect) {
            echo $registerMessage = 'Il y a un problème avec votre réponse à la question de contrôle';
        }
        include_once 'library/login/register.php';
    }
}
/* if a new user registers and his registration form  isn't sent */ elseif (empty($_POST['form_register_sent']) && $_GET['action'] == 'register') {
    include_once 'library/login/register.php';
}
/* login */ elseif (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $testPseudo = $userController->checkPseudoSentSize($pseudo);
    $testPassword = $userController->checkPasswordSentSize($password);
    if ($testPseudo && $testPassword) {
        $comparaison = $userController->checkAuth($pseudo, $password, $userManager);
        if ($comparaison){
            $_SESSION['userName'] = $pseudo;
			echo '<br />Redirection en cours...<script type="text/javascript">setTimeout("location.href = \''.site_url('index.php').'\';", 2000);</script>';
        } else {
            if (!$comparaison) {
                $_SESSION['authMessage'] = 'Votre login ou mot de passe est faux';
                echo '<br />Redirection en cours...<script type="text/javascript">setTimeout("location.href = \''.site_url('index.php').'\';", 2000);</script>';
            }
        }
    }
}
/* logout */ elseif (!empty($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    echo '<br />Redirection en cours...<script type="text/javascript">setTimeout("location.href = \''.site_url('index.php').'\';", 2000);</script>';
}
/* if not registering or not login or not loginout (ie: sending empty form) */ else {
	echo '<br />Redirection en cours...<script type="text/javascript">setTimeout("location.href = \''.site_url('index.php').'\';", 2000);</script>';
}