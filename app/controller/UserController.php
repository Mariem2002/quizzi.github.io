<?php
require_once "C:/wamp64/www/Quizzi/app/model/UserModel.php";
require_once "C:/wamp64/www/Quizzi/app/model/ResultatModel.php";
require_once "C:/wamp64/www/Quizzi/app/model/QuestionModel.php";
require_once "C:/wamp64/www/Quizzi/app/model/FeedbackModel.php";

class userController
{
    private $userModel;
    private $resultatModel;
    private $questionModel;
    private $feedbackModel;


    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->resultatModel = new ResultatModel();
        $this->questionModel = new QuestionModel();
        $this->feedbackModel = new feedbackModel();
    }
    function findAllUserAction()
    {
        $users = $this->userModel->findAlluser();

        if ($users != null)
            return $users;
        else
            return null;
        //require_once('app/view/FindAllUserView.php');
    }
    function AuthenticateAction()
    {
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $username = $_POST['username'];
            $mot_passe = $_POST['password'];
            $user = $this->userModel->Authenticate($username, $mot_passe);
            if ($user != null) {
                $_SESSION['user'] = $user;
                header("Location: /Quizzi/");
                return true;

            } else {
                echo '<script>alert("Coordonnées incorrectes !")</script>';
                return false;
            }
        } else {
            return false;
        }
        //require_once('app/view/FindAllUserView.php');
    }
    function SubscribeAction()
    {
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $username = $_POST['username'];
            $mot_passe = $_POST['password'];
            $user = $this->userModel->Subscribe($username, $mot_passe);
            if ($user != null) {
                echo '<script>alert("Inscription réussite ! Connectez vous")</script>';
                header("Location: /Quizzi/");
                return true;

            } else {
                echo '<script>alert("Veuillez vérifier vos entrées et réessayer !")</script>';
                return false;
            }
        } else {
            return false;
        }
        //require_once('app/view/FindAllUserView.php');
    }
    function addUserAction()
    {
        //require_once('app/view/AddUserView.php');
    }
    function insertUserAction()
    {
        $isInsert = $this->userModel->insertUser([
            'username' => $_POST['userName'],
            'mot_passe' => $_POST['password'],
            'date_inscription' => date('Y-m-d'),
            'id' => ''

        ]);
        header("location: allUsers.php");
    }
    function findUserAction()
    {
        $id = $_GET['id'];
        $user = $this->userModel->findUser($id);
        if ($user != null)
            return $user;
        else
            return null;
        //require_once('app/view/FindUserView.php');
    }

    function findUserByIdAction($id)
    {

        $user = $this->userModel->findUser($id);
        if ($user != null)
            return $user;
        else
            return null;
        //require_once('app/view/FindUserView.php');
    }
    function destroyUserAction()
    {
        $id = $_GET['id'];
        //require_once('app/view/DestroyUserView.php');
    }
    function deleteUserAction()
    {
        $this->userModel->deleteUser($_GET['idUser']);
        header("location: view/allUsers.php");
    }
    function editUserAction()
    {
        $id = $_GET['id'];
        $produit = $this->userModel->findUser($_GET['id']);
        //require_once('app/view/EditUserView.php');
    }
    function updateUserAction()
    {
        $this->userModel->updateUser($_GET['idUser'], [
            'username' => $_POST['username'],
            'mot_passe' => $_POST['password'],

        ]);
        header("location: allUsers.php");
    }
    /*     function getUserQuestionsAction()
        {
            $id = $_GET['id'];
            $questions = $this->userModel->getUserQuestions($id);
            if ($questions != null)
                return $questions;
            else
                return null;
        } */

    function getQuestionAnswersAction()
    {
        $id = $_GET['idQuestion'];
        $reponses = $this->questionModel->getQuestionAnswers($id);
        if ($reponses != null)
            return $reponses;
        else
            return null;
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
        $questionpoints = $_POST;
        $points = 0.0;
        $questionnumber = 0.0;
        foreach ($questionpoints as $questionpoint) {
            $points += $questionpoint;
            $questionnumber += 1.0;
        }
        $correctRate = $points / $questionnumber;

        $score = number_format($correctRate, 3, '.', thousands_separator: '') * 100;
        $idUtilisateur = $_GET['idUtilisateur'];
        $id = $_GET['id'];
        $data = [
            'id' => '',
            'score' => $score,
            'date' => date('Y-m-d'),
            'id_utilisateur' => $idUtilisateur,
            'id_user' => $id
        ];
        foreach ($data as $d)
            echo $d;
        $this->resultatModel->insertResultat($data);
    }

    function findUserResultsAction()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user']->id)) {
            throw new Exception("User not logged in or session invalid.");
        }
        $idUtilisateur = $_SESSION['user']->id;
        $results = $this->resultatModel->findAllResultatByUser($idUtilisateur);
        return $results ?: null;
    }


    function findAllFeedbackAction()
    {
        $feedbacks = $this->feedbackModel->findAllFeedback();
        return $feedbacks ?: null;
    }
    function insertFeedbackAction()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Ensure the user is logged in
        if (!isset($_SESSION['user']->id)) {
            throw new Exception("User not logged in or session invalid.");
        }

        // Extract user ID and quiz ID
        $idUser = $_SESSION['user']->id;

        // Validate and sanitize the input
        if (empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['satisfaction_level']) ) {
            echo '<script>alert("The required fields cannot be empty.");</script>';
            echo '<script>window.location.href = "../index.php";</script>';
            exit();
        }
        $message = $_POST['message'];
        $email = $_POST['email'];
        $full_name = $_POST['full_name'];
        $satisfaction_level = $_POST['satisfaction_level'];

        // Prepare the data for insertion
        $data = [
            'message' => $message,
            'satisfaction_level' => $satisfaction_level,
            'full_name' => $full_name,
            'email' => $email,

        ];

        // Insert the comment
        $this->feedbackModel->insertFeedback($data);

        // Redirect back to the quiz view

        header("Location: view/allFeedbacks.php");
        exit();
    }


}
