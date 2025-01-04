<?php
session_start();

// Check if user session is set and not null
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    // Redirect to index.php if the user is not logged in
    header("Location: ../../index.php");
    exit();
}
require_once "../controller/UserController.php";
require_once "../controller/QuizController.php";
$quizController = new QuizController();
$userController = new UserController();
$results = $userController->findUserResultsAction();
$title = 'Quizzi';
if (isset($_GET['saved']) && $_GET['saved'] == 1) {
    $quizController->insertResultatAction();
    header("Location: myScores.php");
    exit();
}
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

</style>
<main>
<?php 
if ($results != null) { ?>
    <section class="scores">
        <h2>Your Quiz Results</h2>
        <table>
            <thead>
                <tr>
                    <th>Quiz Name</th>
                    <th>Result</th>
                    <th>Date Taken</th>
                    <th>Actions</th> <!-- Added Actions column -->
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($results as $result) {
                    $quiz = $quizController->findQuizAction($result->id_quiz); // Fetch quiz info
                    echo '<tr>
                        <td>' . $quiz->titre . '</td>
                        <td>' . $result->score . '</td>
                        <td>' . $result->date . '</td>
                        <td>
                            <a href="app/deleteResult.php?idResultat=' . $result->id . '" class="btn btn-delete" onclick="return confirm(\'Are you sure you want to delete this result?\')">Delete</a>
                            <a href="app/shareResult.php?idResultat=' . $result->id . '" class="btn btn-share">Share</a>
                        </td>
                    </tr>';
                } ?>
            </tbody>
        </table>
    </section>
<?php } else {
    echo '<br><br><p>Vous n\'avez pas encore de scores. <a href="index.php">Jouez des quizzes</a> maintenant !</p>';
} ?>

    </main>
<?php
$content = ob_get_clean();
require_once('layout.php');
?>