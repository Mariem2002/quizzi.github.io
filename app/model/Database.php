<?php
include "c:\wamp64\www\Quizzi\config\app.php";
class Database
{
    // déclaration d'une propriété
    private static $instance = null;
    private $pdo;

    // déclaration des méthodes
    private function __construct() {
        try{
            $this->pdo = new PDO("mysql:host=".App::DB_HOST.";dbname=".App::DB_NAME."",App::DB_USER,App::DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            die("Database connection failed: " . $e->getMessage());
        }
    }
    public static function getInstance() {
        if (self::$instance == null){
            self::$instance = new self(); //new Database();
        }
        return self::$instance;
    }
    public function getConnection(){
        return $this->pdo;
    }
}
?>