<?php 
require_once "Database.php"; 
class ReactionModel {
    protected $pdo;

    public function __construct() { 
        $this->pdo = Database::getInstance()->getConnection();
    }

    function findAllReaction(){
        //selectionner tous les reactions avec la class Database
        $req = "SELECT * FROM reaction";
        $reponse = $this->pdo->query($req);
        $reactions = $reponse->fetchAll(PDO::FETCH_OBJ);
        return $reactions;
    }
    function findReaction($userId, $reactiontype, $quizId){
        $req = "SELECT * FROM reaction WHERE id_utilisateur = :userId AND id_quiz = :quizId AND type = :reactiontype";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['userId' => $userId, 'quizId' => $quizId, 'reactiontype' => $reactiontype]); // Fixed closing quote
        return $requete->fetch(PDO::FETCH_OBJ);
    }

    public function getReactionCount($quizId, $reactionType) {
        // SQL query to count the reactions of a specific type for a quiz
        $sql = "SELECT COUNT(*) FROM reaction
                WHERE id_quiz = ? AND type = ?";
        
        // Prepare and execute the query
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$quizId, $reactionType]);

        // Fetch and return the count
        return $stmt->fetchColumn();
    }
    
    function insertReaction($data){
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));
        $req = "INSERT INTO reaction($fields) VALUES ($values)";
        $requete = $this->pdo->prepare($req);
        return ($requete->execute($data));
    }
    function deleteReaction($userId, $reactiontype, $quizId){
        $req = "DELETE FROM reaction WHERE id_utilisateur = :userId AND id_quiz = :quizId AND type = :reactiontype";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['userId' => $userId, 'quizId' => $quizId, 'reactiontype' => $reactiontype]);
    }

    function updateReaction($id, $data){
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');
        
        $data['id'] = $id;
        $req = "UPDATE reaction SET $fields WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ( $requete->execute($data));
        
    }
}