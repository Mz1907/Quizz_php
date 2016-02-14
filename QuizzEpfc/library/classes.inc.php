<?php

// module Database
require('objects/Database.php');

// objects
require('objects/Quizz.php');
require('objects/Question.php');
require('objects/User.php');


// modules
require('managers/ObjectManager.php');
require('managers/QuestionManager.php');
require('managers/QuizzManager.php');
require('managers/UserManager.php');

//controllers
require_once('controllers/UserController.php');
require_once('controllers/QuizzController.php');


