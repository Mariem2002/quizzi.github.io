<?php 
require_once "Database.php"; 
class resultatModel {
    protected $pdo;

    public function __construct() { 
        $this->pdo = Database::getInstance()->getConnection();
    }

    function findAllResultatByUser($id){
        //selectionner tous les resultats avec la class Database
        $req = "SELECT * FROM resultat WHERE id_utilisateur = :id";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['id' => $id]);
        $resultats = $requete->fetchAll(PDO::FETCH_OBJ);
        return $resultats;
    }
    function findResultat($id){
        $req = "SELECT * FROM resultat WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['id' => $id]);
        return ($requete->fetch(PDO::FETCH_OBJ));
    }
    function insertResultat($data){
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));
        $req = "INSERT INTO resultat($fields) VALUES ($values)";
        $requete = $this->pdo->prepare($req);
        return ($requete->execute($data));
    }
    function deleteResultat($id){
        $req = "DELETE FROM resultat WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ( $requete->execute(['id' => $id]));
    }

    function updateResultat($id, $data){
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');
        
        $data['id'] = $id;
        $req = "UPDATE resultat SET $fields WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        return ( $requete->execute($data));
        
    }
}