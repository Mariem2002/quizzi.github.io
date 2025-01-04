<?php 
require_once "Database.php"; 
class QuizModel {
    protected $pdo;

    public function __construct() { 
        $this->pdo = Database::getInstance()->getConnection();
    }

  
    function findAllQuiz(){
        //selectionner tous les quizzes avec la class Database
        $req = "SELECT * FROM quiz";
        $reponse = $this->pdo->query($req);
        $quizzes = $reponse->fetchAll(PDO::FETCH_OBJ);
        return $quizzes;
    }
    function findQuiz($id){
        $req = "SELECT * FROM quiz WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['id' => $id]);
        return ($requete->fetch(PDO::FETCH_OBJ));
    }

    function findAllQuizByUser($id){
        $req = "SELECT * FROM quiz WHERE id_auteur = :id";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['id' => $id]);
        return ($requete->fetchAll(PDO::FETCH_OBJ));
    }
    function insertQuiz($data) {
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));
        $req = "INSERT INTO quiz($fields) VALUES ($values)";
        $requete = $this->pdo->prepare($req);
        
        if ($requete->execute($data)) {
            // Fetch the last inserted ID (quiz_id)
            return $this->pdo->lastInsertId();  // Returns the ID of the last inserted quiz
        }
        return false;
    }
    
    function deleteQuiz($id){
        $req = "DELETE FROM quiz WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ( $requete->execute(['id' => $id]));
    }

     function updateQuiz($quizId, $title, $description, $categoryId, $image) {
        // SQL query to update the quiz data
        $sql = "UPDATE quiz SET titre = ?, description = ?, id_categorie = ?, image = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$title, $description, $categoryId, $image, $quizId]);
    }

    function getQuizQuestions($id){
        $req = "SELECT * FROM question WHERE id_quiz = $id";
        $reponse = $this->pdo->query($req);
        $questions = $reponse->fetchAll(PDO::FETCH_OBJ);
        return $questions;
    }
}