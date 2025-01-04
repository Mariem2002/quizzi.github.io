<?php
$title = 'Quizzi';
ob_start();
session_start();


require_once "../controller/QuizController.php";
require_once "../model/QuestionModel.php";
$quizController = new QuizController();
$questionModel = new QuestionModel();
$quiz = $quizController->findQuizAction($_GET['idQuiz']);
$questions = $quizController->getQuizQuestionsAction($_GET['idQuiz']);
if (isset($_GET['saved']) && $_GET['saved'] == 1) {
    $quizController->insertResultatAction();
}
$questionpoints = $_POST;

$points = 0.0;
$questionnumber = 0.0;
foreach ($questionpoints as $questionpoint) {
 
    $points += $questionpoint;
    $questionnumber += 1.0;

}
if($questionnumber != 0)
$correctRate = $points / $questionnumber;
else
$correctRate = 0;

$score = number_format($correctRate, 3, '.', thousands_separator: '') * 100;

?>
<style>
    .quizImages {
        max-width: 100%;
        /* Ensures the image does not exceed its container width */
        max-height: 350px;
        /* Maintains aspect ratio */
        display: block;
        /* Removes any extra space below the image */
        margin: 20px auto;
        /* Adds spacing around the image, centered horizontally */
        border-radius: 8px;
        /* Optional: Adds rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Optional: Adds a subtle shadow */
    }
</style>
<main>

    <center>

        <h2 class="section-title"><?php echo $quiz->titre ?></h2>
        <p><?php echo $quiz->description ?></p>
        <div class="image-hover-thumb">
            <img src="images/<?php echo $quiz->image ?>" class="about-image img-fluid" alt="">
        </div>
        <?php if(isset($_SESSION['user'])&& $_SESSION['user']!=null)
        echo '<a href="app/view/myScores.php?saved=1&idQuiz='. $_GET['idQuiz'] . '&idUtilisateur='. $_GET['idUtilisateur'] . '&score='. $score .'" class="custom-link custom-btn btn mt-4">Save your score</a>
        <section class="about-section section-padding" id="section_questions">';
        else{
            echo '<p><a href="login.php">Sign in </a>to save your score.</p>';
        }
        ?>      


            <p><?php echo $score; ?></p>



        </section>
    </center>

</main>
<?php
$content = ob_get_clean();
require_once('layout.php');
?>