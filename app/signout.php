<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        unset($_SESSION['user']);
 
        session_destroy();
        echo "<p>Vous etes deconnecte, retour... </p>";
        header ("Refresh: 2;URL=../index.php");
        } else {
            echo '<script>alert("Erreur inconnue")</script>';
        }

    
    ?>