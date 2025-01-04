<?php 
require_once "Database.php"; 
class reponseModel {
    protected $pdo;

    public function __construct() { 
        $this->pdo = Database::getInstance()->getConnection();
    }

    function findAllReponse(){
        //selectionner tous les reponses avec la class Database
        $req = "SELECT * FROM reponse";
        $rep = $this->pdo->query($req);
        $reponses = $rep->fetchAll(PDO::FETCH_OBJ);
        return $reponses;
    }
    function findReponse($id){
        $req = "SELECT * FROM reponse WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['id' => $id]);
        return ($requete->fetch(PDO::FETCH_OBJ));
    }
    function insertReponse($data){
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));
        $req = "INSERT INTO reponse($fields) VALUES ($values)";
        $requete = $this->pdo->prepare($req);
        return ($requete->execute($data));
    }
    function deleteReponse($id){
        $req = "DELETE FROM reponse WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ( $requete->execute(['id' => $id]));
    }

     function updateReponse($questionId, $answerText, $isCorrect) {
        // Update the answer for the question
        $sql = "UPDATE reponse SET texte = ?, est_correcte = ? WHERE id_question_reponse = ? AND texte = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$answerText, $isCorrect, $questionId, $answerText]);
    }

}