<?php
session_start();
if(isset($_GET['idQuiz']) && $_GET['idQuiz'] != null){
    include_once "controller/QuizController.php";
    $quizController = new QuizController();
    $quizController->deleteQuizAction();
    if(isset($_SESSION['user']) && $_SESSION['user'] != 1){
        header("location: view/myQuizzes.php");
        exit();
    }
    else{
        header("location: view/allQuizzes.php");
        exit();
    }

}
   else{
    echo "Error in Quiz deletion";
   }

?>