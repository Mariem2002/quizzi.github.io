<?php 
require_once "Database.php"; 
class feedbackModel {
    protected $pdo;

    public function __construct() { 
        $this->pdo = Database::getInstance()->getConnection();
    }

    function findAllFeedback(){
        //selectionner tous les feedbacks avec la class Database
        $req = "SELECT * FROM feedback";
        $rep = $this->pdo->query($req);
        $feedbacks = $rep->fetchAll(PDO::FETCH_OBJ);
        return $feedbacks;
    }
    function findFeedback($id){
        $req = "SELECT * FROM feedback WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['id' => $id]);
        return ($requete->fetch(PDO::FETCH_OBJ));
    }

    function findFeedbackByEmail($email){
        $req = "SELECT * FROM feedback WHERE email = :email";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['email' => $email]);
        return ($requete->fetch(PDO::FETCH_OBJ));
    }
    function insertFeedback($data){
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));
        $req = "INSERT INTO feedback($fields) VALUES ($values)";
        $requete = $this->pdo->prepare($req);
        return ($requete->execute($data));
    }
    function deleteFeedback($id){
        $req = "DELETE FROM feedback WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ( $requete->execute(['id' => $id]));
    }

     function updateFeedback($questionId, $answerText, $isCorrect) {
        // Update the answer for the question
        $sql = "UPDATE feedback SET texte = ?, est_correcte = ? WHERE id_question_feedback = ? AND texte = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$answerText, $isCorrect, $questionId, $answerText]);
    }

}