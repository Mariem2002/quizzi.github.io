<?php 
require_once "Database.php"; 
class CommentModel {
    protected $pdo;

    public function __construct() { 
        $this->pdo = Database::getInstance()->getConnection();
    }

    function findAllComment(){
        //selectionner tous les commentaires avec la class Database
        $req = "SELECT * FROM commentaire";
        $reponse = $this->pdo->query($req);
        $commentaires = $reponse->fetchAll(PDO::FETCH_OBJ);
        return $commentaires;
    }

    function findAllCommentByQuiz($id) {
        try {
            // Prepare the SQL statement
            $req = "SELECT * FROM commentaire WHERE id_quiz = :id";
            $stmt = $this->pdo->prepare($req);
    
            // Bind the parameter and execute the statement
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            // Fetch all results as objects
            $commentaires = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $commentaires;
        } catch (PDOException $e) {
            // Handle potential errors
            error_log("Error fetching comments: " . $e->getMessage());
            return [];
        }
    }
    
    function findComment($id){
        $req = "SELECT * FROM commentaire WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['id' => $id]);
        return ($requete->fetch(PDO::FETCH_OBJ));
    }
    function insertComment($data){
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));
        $req = "INSERT INTO commentaire($fields) VALUES ($values)";
        $requete = $this->pdo->prepare($req);
        return ($requete->execute($data));
    }
    function deleteComment($id){
        $req = "DELETE FROM commentaire WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ( $requete->execute(['id' => $id]));
    }

    function updateComment($id, $data){
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');
        
        $data['id'] = $id;
        $req = "UPDATE commentaire SET $fields WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ( $requete->execute($data));
        
    }
}