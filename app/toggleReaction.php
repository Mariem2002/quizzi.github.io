<?php
session_start();

require_once "C:\wamp64\www\Quizzi\app\controller\QuizController.php";

$quizController = new QuizController();

// Check if the user is logged in and necessary POST data is provided
if (isset($_SESSION['user'], $_POST['reaction'], $_POST['quizId'])) {
    // Extract the necessary data from session and POST request
    $userId = $_SESSION['user']->id;
    $quizId = $_POST['quizId'];
    $reactionType = $_POST['reaction'];

    // Initialize a variable to store the message
    $message = '';


        try {
            $quizController->toggleReaction($userId, $quizId, $reactionType);
            
        } catch (Exception $e) {
            // Handle any errors during the insertion process
            $message = "Error adding reaction: " . $e->getMessage();
        }
     
  
    


    // Get updated reaction counts
    try {
        $reactionCounts = [
            'likes' => $quizController->getReactionCountAction($quizId, 'like'),
            'loves' => $quizController->getReactionCountAction($quizId, 'love'),
            'laughs' => $quizController->getReactionCountAction($quizId, 'laugh'),
            'surprises' => $quizController->getReactionCountAction($quizId, 'surprise'),
            'sads' => $quizController->getReactionCountAction($quizId, 'sad')
        ];
    } catch (Exception $e) {
        // Handle any errors when fetching reaction counts
        $message = "Error fetching reaction counts: " . $e->getMessage();
        $reactionCounts = [];
    }

    // Return a JSON response with success or failure status, message, and updated reaction counts
    echo json_encode([
        'success' => true,
        'message' => $message,
        'reactions' => $reactionCounts
    ]);

    // Correct redirect after the response
    $images = isset($_GET['images']) ? $_GET['images'] : 0;
   header("Location: /Quizzi/app/view/quizView.php?idQuiz=" . $quizId."&images=".$images);
    exit();
} else {
    // User not logged in or missing required data
    echo json_encode([
        'success' => false,
        'message' => "You must be logged in to react."
    ]);
}
?>
