<?php 
require_once "Database.php"; 
class CategoryModel {
    protected $pdo;

    public function __construct() { 
        $this->pdo = Database::getInstance()->getConnection();
    }

    function findAllCategory(){
        //selectionner tous les Categorys avec la class Database
        $req = "SELECT * FROM categorie_quiz";
        $reponse = $this->pdo->query($req);
        $categories = $reponse->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }
    function findCategory($id){
        $req = "SELECT * FROM categorie_quiz WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['id' => $id]);
        return ($requete->fetch(PDO::FETCH_OBJ));
    }
    function insertCategory($data){
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));
        $req = "INSERT INTO categorie_quiz($fields) VALUES ($values)";
        $requete = $this->pdo->prepare($req);
        return ($requete->execute($data));
    }
    function deleteCategory($id){
        $req = "DELETE FROM categorie_quiz WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ( $requete->execute(['id' => $id]));
    }

    function updateCategory($id, $data){
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');
        
        $data['id'] = $id;
        $req = "UPDATE categorie_quiz SET $fields WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ( $requete->execute($data));
        
    }
}