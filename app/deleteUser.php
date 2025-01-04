<?php
if(isset($_GET['idUser']) && $_GET['idUser'] != null){
    include_once "controller/UserController.php";
    $userController = new UserController();
    $userController->deleteUserAction();

}
   else{
    echo "Error in User deletion";
   }

?>