<?php
session_start();

// Check if user session is set and not null
if (isset($_SESSION['user']) && $_SESSION['user']->id == 1) {
    $admin = $_SESSION['user'];
} else {
    // Redirect to index.php if the user is not logged in
    header("Location: ../../index.php");
    exit();
}
$title = 'Quizzi';
ob_start();
if (isset($_POST['userName']) && $_POST['password']){
include_once "../controller/UserController.php";
    $userController = new UserController();
    $userController->insertUserAction();
}
?>
<style>
       
        .containerQ {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
     
        #userForm {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, textarea, select, button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        textarea {
            resize: vertical;
        }
        .question {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f9f9f9;
        }
        .question h3 {
            margin-top: 0;
        }
        .add-btn {
            display: flex;
            justify-content: center;
        }
        
        .btnQ {
            background-color:rgb(255, 124, 124);
            color: white;
            border: none;
            cursor: pointer;
        }
        .btnQ:hover {
            background-color:rgb(179, 0, 0);
        }
    </style>
</head>

    <div class="containerQ">
        <center><h1>Create a User</h1></center>
        <form id="userForm" method="POST" action="app/view/createuser.php">
    <label for="userName">User Name</label>
    <input type="text" id="userName" name="userName" placeholder="Enter user Name" required>

    <label for="userPassword">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter a password" required>

   



    <button class="btnQ" type="submit">Create User</button>
</form>

    </div>


<?php
$content = ob_get_clean();
require_once('layout.php');
?>