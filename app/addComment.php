<?php
// Start the session
session_start();

// Include the necessary files for your controller
if (isset($_SESSION['user']) && $_SESSION['user']->id != null) {
if(isset($_GET['idQuiz']) && $_GET['idQuiz'] != null){
    require_once "c:\wamp64\www\Quizzi\app\controller\QuizController.php";
    $quizController = new QuizController();
    $quizController->insertCommentAction();
   
}
   else{
    echo "Error in comment insertion";
   }
}
else{
    header("Location: ../../index.php");
    
    exit();
}

?>