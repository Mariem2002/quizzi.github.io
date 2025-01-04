<?php
// Start the session
session_start();

// Include the necessary files for your controller
if (isset($_SESSION['user']) && $_SESSION['user']->id != null) {

    require_once "c:\wamp64\www\Quizzi\app\controller\UserController.php";
    $userController = new UserController();
    $userController->insertFeedbackAction();
   
}

else{
    header("Location: ../../index.php");
    
    exit();
}

?>