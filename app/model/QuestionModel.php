<?php 
require_once "Database.php"; 
class QuestionModel {
    protected $pdo;

    public function __construct() { 
        $this->pdo = Database::getInstance()->getConnection();
    }

    function findAllQuestion(){
        //selectionner tous les questionzes avec la class Database
        $req = "SELECT * FROM question";
        $reponse = $this->pdo->query($req);
        $questions = $reponse->fetchAll(PDO::FETCH_OBJ);
        return $questions;
    }
    function findQuestion($id){
        $req = "SELECT * FROM question WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['id' => $id]);
        return ($requete->fetch(PDO::FETCH_OBJ));
    }
    function insertQuestion($data) {
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));
        $req = "INSERT INTO question($fields) VALUES ($values)";
        $requete = $this->pdo->prepare($req);
        
        if ($requete->execute($data)) {
            // Fetch the last inserted ID (question_id)
            return $this->pdo->lastInsertId();  // Returns the ID of the last inserted question
        }
        return false;
    }
    
    function deleteQuestion($id){
        $req = "DELETE FROM question WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ( $requete->execute(['id' => $id]));
    }

     function updateQuestion($questionId, $questionText) {
        // Update the question in the database
        $sql = "UPDATE question SET texte_question = ? WHERE id_question = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$questionText, $questionId]);
    }
    
    

    function getQuestionAnswers($id){
        $req = "SELECT * FROM reponse WHERE id_question_reponse = $id";
        $rep = $this->pdo->query($req);
        $reponses = $rep->fetchAll(PDO::FETCH_OBJ);

        return $reponses;
    }

    function getRightAnswer($id){
        $req = "SELECT * FROM reponse WHERE (id_question_reponse = $id AND est_correcte = 1)";
        $rep = $this->pdo->query($req);
        $reponseCorrecte = $rep->fetch(PDO::FETCH_OBJ);

        return $reponseCorrecte;
    }
}