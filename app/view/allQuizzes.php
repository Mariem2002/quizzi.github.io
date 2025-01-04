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
require_once "../controller/QuizController.php";
$quizController = new QuizController();
$userController = new UserController();
$quizzes = $quizController->findAllQuizAction();
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
<?php if ($quizzes != null) { ?>
    <section class="quizzes">
        <center><h2>All Quizzes</h2></center>
        <table>
            <thead>
                <tr>
                    <th>Quiz Name</th>
                    <th>Quiz Image</th>
                    <th>Description</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Date Created</th>
                    <th>Date Modified</th>
                    <th>Actions</th> <!-- Added a column for buttons -->
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($quizzes != null) {
                    foreach ($quizzes as $quiz) {
                        echo '<tr>
                            <td>' . $quiz->titre . '</td>
                            <td><img style="height: 30px;" src="images/' . $quiz->image . '"></td>
                            <td>' . $quiz->description . '</td>
                            <td>'. $userController->findUserByIdAction($quiz->id_auteur)->username .'</td>
                            <td>' . $quizController->findCategoryByIdAction($quiz->id_categorie)->label . '</td>
                            <td>' . $quiz->date_creation . '</td>
                            <td>' . $quiz->date_mise_a_jour . '</td>
                            <td>
                                <a href="app/view/editQuizView.php?idQuiz=' . $quiz->id . '" class="btn btn-edit">Edit</a>
                                <a href="app/deleteQuiz.php?idQuiz=' . $quiz->id . '" class="btn btn-delete" onclick="return confirm(\'Are you sure you want to delete this quiz?\')">Delete</a>
                            </td> <!-- Added buttons in actions column -->
                        </tr>';
                    }
                } ?>
            </tbody>
        </table>
    </section>
    <form action="app/view/createQuiz.php">
    <div class="add-btn">
        
        <button class="btnQ" type="submit" action="">Add Quiz</button>
    </div>
    </form>
   

<?php } else {
    echo '<br><br><p>Vous n\'avez pas encore de quizzes. <a href="app/view/createQuiz.php">Créez un</a> maintenant !</p>';
} ?>
</main>
<?php
$content = ob_get_clean();
require_once('layout.php');
?>