<?php
if (isset($_GET['idResultat'])) {
    $resultId = $_GET['idResultat'];
    require_once "controller/UserController.php";
    $userController = new UserController();
    $userController->deleteResultatAction();
} else {
    echo 'erreur dans le serveur.';
}

?>