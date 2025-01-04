<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user']) && $_SESSION['user']->id != null) {
    $admin = $_SESSION['user'];
} else {
    // Redirect to index.php if the user is not logged in
    header("Location: ../../index.php");
    exit();
}

// Include necessary files
require_once "c:\wamp64\www\Quizzi\app\controller\QuizController.php";


// Initialize controllers
$quizController = new QuizController();


// Check if quiz ID is provided
if (isset($_GET['idQuiz'])) {
    $quizId = $_GET['idQuiz'];

    // Fetch the quiz from the database
    $quiz = $quizController->findQuizAction($quizId);

    if ($quiz === null) {
        echo "Quiz not found.";
        exit();
    }
} else {
    echo "Invalid request: Quiz ID is missing.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get updated quiz data from POST request
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $categoryId = $_POST['id_categorie'];
    
    // Handle the image upload (optional)
    $image = $quiz->image; // Default image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $imageTemp = $_FILES['image']['tmp_name'];
        move_uploaded_file($imageTemp, "../images/$image"); 
    }

    // Update quiz information in the database
    $quizController->updateQuizAction($quizId, $titre, $description, $categoryId, imagePath: $image);

    
    if (isset($_POST['questions'])) {
        foreach ($_POST['questions'] as $questionId => $questionData) {
            // Update question text
            $questionText = $questionData['question'];
            echo "---------<br>";
            echo $questionText;
            echo $questionId;
            echo "---------<br>";
            $quizController->updateQuestionAction($questionId, $questionText);

            // Update answers
            foreach ($questionData['answers'] as $answerIndex => $answerText) {
                $isCorrect = isset($questionData['correct_answer']) && $questionData['correct_answer'] == $answerIndex;
                $quizController->updateAnswerAction($questionId, $answerText, $isCorrect);
            }
        }
        echo 'post posted.';
    }
    else{
        echo "no questions.";
    }
//if($_SESSION['user']->id == 1){
    //header("Location: view/allQuizzes.php");
    //exit();
}
    // Redirect back to the quiz page (or any other page)
   
    //else if ($_SESSION['user']->id != 1){
       // header("Location: view/myQuizzes.php");
    
    //}
    
//}
?>
