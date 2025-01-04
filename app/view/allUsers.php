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
require_once "../controller/UserController.php";
$userController = new UserController();
$users = $userController->findAllUserAction();
$title = 'Quizzi';

ob_start();

?>
<style>
   
   main {
       max-width: 800px;
       margin: 2rem auto;
       padding: 1rem;
       background: #fff;
       box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
       border-radius: 8px;
   }
   
   .scores h2 {
       margin-bottom: 1rem;
       text-align: center;
       color:#f1c522;
   }
   
   /* Table Styles */
   table {
       width: 100%;
       border-collapse: collapse;
       margin-top: 1rem;
   }
   
   thead {
       background-color:rgb(255, 130, 108);

       color: #fff;
   }
   
   th, td {
       padding: 10px;
       text-align: center;
       border: 1px solid #ddd;
   }
   
   tbody tr:nth-child(even) {
       background-color: #f2f2f2;
   }
   
   /* Footer */
   footer {
       text-align: center;
       margin-top: 2rem;
       padding: 1rem;
       background-color: #333;
       color: #fff;
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
<main>
<?php if ($users != null) { ?>
    <section class="users">
        <center><h2>All Users</h2></center>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Subscription Date</th>
                    <th>Actions</th> <!-- Added a column for buttons -->
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($users != null) {
                    foreach ($users as $user) {
                        echo '<tr>
                             <td>' . $user->id . '</td>
                            <td>' . $user->username . '</td>
                            <td>' . $user->mot_passe . '</td>
                            <td>' . $user->date_inscription . '</td>
                            <td>
                           
                                <a href="app/view/updateUser.php?idUser=' . $user->id . '" class="btn btn-edit">Edit</a>';
                                if($user->id != 1){ 
                                echo'<a href="app/deleteUser.php?idUser=' . $user->id . '" class="btn btn-delete" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</a>';
                               } 
                            echo'</td> <!-- Added buttons in actions column -->
                        </tr>';
                    }
                } ?>
            </tbody>
        </table>
    </section>
    <form action="app/view/createUser.php">
    <div class="add-btn">
        
        <button class="btnQ" type="submit" action="">Add User</button>
    </div>
    </form>
   

<?php }  ?>
</main>
<?php
$content = ob_get_clean();
require_once('layout.php');
?>