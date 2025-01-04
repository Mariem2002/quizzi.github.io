<?php
require_once "c:\wamp64\www\Quizzi\app\model\QuizModel.php";
require_once "c:\wamp64\www\Quizzi\app\model\ResultatModel.php";
require_once "c:\wamp64\www\Quizzi\app\model\QuestionModel.php";
require_once "c:\wamp64\www\Quizzi\app\model\CategoryModel.php";
require_once "c:\wamp64\www\Quizzi\app\model\ReponseModel.php";
require_once "c:\wamp64\www\Quizzi\app\model\CommentModel.php";
require_once "c:\wamp64\www\Quizzi\app\model\ReactionModel.php";
class QuizController
{
    public $quizModel;
    public $resultatModel;
    public $questionModel;
    public $categoryModel;
    public $reponseModel;
    public $commentModel;
    public $reactionModel;

    public function __construct()
    {
        $this->quizModel = new QuizModel();
        $this->resultatModel = new ResultatModel();
        $this->questionModel = new QuestionModel();
        $this->categoryModel = new CategoryModel();
        $this->reponseModel = new ReponseModel();
        $this->commentModel = new CommentModel();
        $this->reactionModel = new ReactionModel();
    }

    function findAllQuizAction()
    {
        $quizzes = $this->quizModel->findAllQuiz();
        return $quizzes ?: null;
    }

    function findAllCategoryAction()
    {
        $categories = $this->categoryModel->findAllCategory();
        return $categories ?: null;
    }

    function findQuizAction($id)
    {
        $quiz = $this->quizModel->findQuiz($id);
        return $quiz ?: null;
    }

    function getQuizQuestionsAction($quizId)
    {
        $questions = $this->quizModel->getQuizQuestions($quizId);
        return $questions ?: null;
    }

    function getQuestionAnswersAction($questionId)
    {
        $answers = $this->questionModel->getQuestionAnswers($questionId);
        return $answers ?: null;
    }

     function updateQuizAction($quizId, $title, $description, $categoryId, $imagePath) {
        try {
            // Handle image upload if provided
            if ($imagePath) {
                $image = "../images/" . basename($imagePath);
                move_uploaded_file($imagePath, "../../images" . $image); 
            } else {
                // Use the existing image if no new image is uploaded
                $image = null;  // Or pass an existing image path if available
            }
    
            // Update the quiz in the database
            $this->quizModel->updateQuiz($quizId, $title, $description, $categoryId, $image);
    
            // Handle updating the questions and answers from arguments
            if (isset($questionsData) && is_array($questionsData)) {
                foreach ($questionsData as $questionId => $questionData) {
                    // Update the question if it's valid
                    if (!empty($questionData['question'])) {
                        $this->questionModel->updateQuestion($questionId, $questionData['question']);
                    }
    
                    // Update the answers for each question
                    if (isset($questionData['answers']) && is_array($questionData['answers'])) {
                        foreach ($questionData['answers'] as $answerIndex => $answerText) {
                            $isCorrect = ($answerIndex == $questionData['correct_answer']) ? 1 : 0;
                            // Update the answer in the database
                            $this->reponseModel->updateReponse($questionId,  $answerText, $isCorrect);
                        }
                    }
                }
            }
            else{
                echo 'no questions';
            }
    
        } catch (Exception $e) {
            // Handle errors and log them
            echo "Error: " . $e->getMessage();
        }
    }
    
    

    function updateQuestionAction($questionId, $questionText) {
        try {
            // Call the updateQuestion method in questionModel to update the question
            $this->questionModel->updateQuestion($questionId, $questionText);
    
            // Optionally log success (useful for debugging)
            // echo "Question updated successfully for ID: $questionId";
        } catch (Exception $e) {
            // Handle exceptions and log errors
            throw new Exception("Error updating question ID $questionId: " . $e->getMessage());
        }
    }
    public function updateAnswerAction($questionId, $answerText, $correctAnswer) {
        try {
            // Call the updateReponse method in reponseModel to update the answer
            $this->reponseModel->updateReponse($questionId,  $answerText, $correctAnswer);
    
            // Optionally log success (useful for debugging)
            // echo "Answer updated successfully for Question ID: $questionId, Answer Index: $answerIndex";
        } catch (Exception $e) {
            // Handle exceptions and log errors
            throw new Exception("Error updating answer for Question ID $questionId, Answer Text $answerText: " . $e->getMessage());
        }
    }
    

    function deleteQuizAction()
    {
        $this->quizModel->deleteQuiz($_GET['idQuiz']);
        
    }



  
    function findAllQuizByUserAction()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user']->id)) {
            throw new Exception("User not logged in or session invalid.");
        }  
        $idUtilisateur = $_SESSION['user']->id;
        $quizzes = $this->quizModel->findAllQuizByUser($idUtilisateur);
        if ($quizzes != null)
            return $quizzes;
        else
            return null;
        //require_once('app/view/FindAllQuizView.php');
    }

    function findAllCommentByQuizAction()
    {
        
        
        $idQuiz = $_GET['idQuiz'];
        $comments = $this->commentModel->findAllCommentByQuiz($idQuiz);
        if ($comments != null)
            return $comments;
        else
            return null;
        //require_once('app/view/FindAllQuizView.php');
    }
    function addQuizAction()
    {
        //require_once('app/view/AddQuizView.php');
    }
    function insertQuizAction() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user']->id)) {
            throw new Exception("User not logged in or session invalid.");
        }
    
        // Ensure the file is uploaded
        if (isset($_FILES['quizImage']) && $_FILES['quizImage']['error'] === UPLOAD_ERR_OK) {
            // Define target directory and file path
            $targetFile = basename($_FILES['quizImage']['name']);
    
            // Move uploaded file to the target directory
            if (move_uploaded_file($_FILES['quizImage']['tmp_name'], $targetFile)) {
                // Insert quiz into the database
                $quizData = [
                    'titre' => $_POST['quizTitle'],
                    'description' => $_POST['quizDescription'],
                    'image' => $targetFile, // Use the file path
                    'date_creation' => date('Y-m-d'),
                    'date_mise_a_jour' => date('Y-m-d'),
                    'id_auteur' => $_SESSION['user']->id,
                    'id_categorie' => $_POST['categorieId']
                ];
                $quizId = $this->quizModel->insertQuiz($quizData);
    
                // Check if quiz insertion was successful
                if ($quizId) {
                    // Insert questions and answers
                    if (isset($_POST['question']) && is_array($_POST['question'])) {
                        foreach ($_POST['question'] as $question) {
                            // Insert question
                            $questionData = [
                                'id_quiz' => $quizId,
                                'texte_question' => $question['text'],
                            ];
                            $questionId = $this->questionModel->insertQuestion($questionData);
    
                            // Check if question insertion was successful
                            if ($questionId) {
                                // Insert answers for this question
                                if (isset($question['answers']) && is_array($question['answers'])) {
                                    foreach ($question['answers'] as $answer) {
                                        $answerData = [
                                            'id_question_reponse' => $questionId,
                                            'texte' => $answer['text'],
                                            'est_correcte' => $answer['correct_answer'] == $answer['value'] ? 1 : 0
                                        ];
                                        $this->reponseModel->insertReponse($answerData);
                                    }
                                }
                            }
                        }
                    }
                    else{
                        echo 'pas de questions';
                    }
    
                    // Redirect to index if everything was successful
                    // header("Location: ../../index.php");
                    exit;
                }
            }
        }
    
        // Handle failure cases
        echo "Error: Unable to insert quiz or handle file upload.";
        exit;
    }
    
    function getRightAnswer()
    {
        $id = $_GET['idQuestion'];
        $reponses = $this->questionModel->getRightAnswer($id);
        if ($reponses != null)
            return $reponses;
        else
            return null;
    }

    function insertResultatAction()
    {
        
        $score = $_GET['score'];
        $idUtilisateur = $_GET['idUtilisateur'];
        $idQuiz = $_GET['idQuiz'];
        $data = [
            'id' => '',
            'score' => $score,
            'date' => date('Y-m-d'),
            'id_utilisateur' => $idUtilisateur,
            'id_quiz' => $idQuiz
        ];
        
        $this->resultatModel->insertResultat($data);
        return $data;
    }
    function insertCommentAction() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Ensure the user is logged in
        if (!isset($_SESSION['user']->id)) {
            throw new Exception("User not logged in or session invalid.");
        }
    
        // Extract user ID and quiz ID
        $idUser = $_SESSION['user']->id;
        if (!isset($_GET['idQuiz'])) {
            throw new Exception("Quiz ID is missing.");
        }
        $idQuiz = $_GET['idQuiz'];
    
        // Validate and sanitize the input
        if (empty($_POST['commentTexte'])) {
            throw new Exception("Comment text cannot be empty.");
        }
        $commentTexte = htmlspecialchars($_POST['commentTexte']);
        $dateCreation = date('Y-m-d');
    
        // Prepare the data for insertion
        $data = [
            'texte' => $commentTexte,
            'date_creation' => $dateCreation,
            'id_utilisateur' => $idUser,
            'id_quiz' => $idQuiz
        ];
    
        // Insert the comment
        $this->commentModel->insertComment($data);
    
        // Redirect back to the quiz view
        $images = isset($_GET['images']) ? $_GET['images'] : 0;
header("Location: view/quizView.php?idQuiz=" . $idQuiz . "&images=" . $images);

        header("Location: view/quizView.php?idQuiz=" . $idQuiz."&images=".$images);
        exit();
    }

    public function toggleReaction($userId, $quizId, $reactionType) {
        // Check if the same type of reaction already exists
        $existingReaction = $this->reactionModel->findReaction($userId, $reactionType, $quizId);

        if ($existingReaction) {
            // If the same type of reaction exists, remove it
            $this->reactionModel->deleteReaction($userId, $reactionType, $quizId);
            return true; // Indicates reaction was removed
        } else {
            // If the same type of reaction doesn't exist, add it
            $data = [
                'type' => $reactionType,
                'date' => date('Y-m-d'),
                'id_utilisateur' => $userId,
                'id_quiz' => $quizId

            ];
            $this->reactionModel->insertReaction($data);
            return false; // Indicates reaction was added
        }
    }
    function getReactionCountAction($quizId, $reactionType) {
        $reactionCount = $this->reactionModel->getReactionCount($quizId, $reactionType);
        return $reactionCount;
    }
    
    function findCategoryByIdAction($id)
    {
       
        $category = $this->categoryModel->findCategory($id);
        if ($category != null)
            return $category;
        else
            return null;
        
    }
 /*    function insertQuestionAction()
    {

        $questions = [];
            $questionCount = $_POST['questionCount'];

        for($i=0; $i < $questionCount; $i++){
            array_push($questions, $_POST['question${questionCount}']);
        }
        
        
        $idUtilisateur = $_GET['idUtilisateur'];
        $idQuiz = $_GET['idQuiz'];
        $data = [
            'id_question' => '',
            'texte_question' => $score,
            'id_quiz' => $idQuiz
        ];
        
        $this->resultatModel->insertResultat($data);
        return $data;
    } */

   
}