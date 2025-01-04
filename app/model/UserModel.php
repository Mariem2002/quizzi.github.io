<?php 
require_once "C:/wamp64/www/Quizzi/app/model/Database.php"; 
class UserModel {
    protected $pdo;

    public function __construct() { 
        $this->pdo = Database::getInstance()->getConnection();
    }

    function findAllUser(){
        //selectionner tous les users avec la class Database
        $req = "SELECT * FROM utilisateur";
        $reponse = $this->pdo->query($req);
        $users = $reponse->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }
    function findUser($id){
        $req = "SELECT * FROM utilisateur WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['id' => $id]);
        return ($requete->fetch(PDO::FETCH_OBJ));
    }
    function Authenticate($username, $mot_passe){
        $req = "SELECT * FROM utilisateur WHERE username = :username AND mot_passe = :mot_passe";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['username' => $username, 'mot_passe' => $mot_passe]);

        return ($requete->fetch(PDO::FETCH_OBJ));
    }

    function Subscribe($username, $mot_passe){
       
            $dateInscrit = date('Y-m-d'); // Correct date format for SQL
            $req = "INSERT INTO utilisateur (username, mot_passe, date_inscription) VALUES (:username, :mot_passe, :dateInscrit)";
            $requete = $this->pdo->prepare($req);
            $success = $requete->execute([
                ':username' => $username,
                ':mot_passe' => $mot_passe,
                ':dateInscrit' => $dateInscrit
            ]);
        
            return $success;
    }
    function insertUser($data){
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));
        $req = "INSERT INTO utilisateur($fields) VALUES ($values)";
        $requete = $this->pdo->prepare($req);
        return ($requete->execute($data));
    }
    function deleteUser($id){
        $req = "DELETE FROM utilisateur WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ( $requete->execute(['id' => $id]));
    }

    function updateUser($id, $data){
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');
        
        $data['id'] = $id;
        $req = "UPDATE utilisateur SET $fields WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ( $requete->execute($data));
        
    }
}