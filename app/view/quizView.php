<?php
$title = 'Quizzi';
ob_start();
require_once "c:\wamp64\www\Quizzi\app\controller\QuizController.php";
require_once "c:\wamp64\www\Quizzi\app\controller\UserController.php";
require_once "c:\wamp64\www\Quizzi\app\model\QuestionModel.php";
session_start();

// Initialize necessary controllers and models
$quizController = new QuizController();
$userController = new UserController();
$questionModel = new QuestionModel();

// Fetch quiz data
$quiz = $quizController->findQuizAction($_GET['idQuiz']);
$questions = $quizController->getQuizQuestionsAction($_GET['idQuiz']);
$comments = $quizController->findAllCommentByQuizAction();

// Fetch reaction counts
$reactionCounts = [
    'likes' => $quizController->getReactionCountAction($_GET['idQuiz'], 0),
    'loves' => $quizController->getReactionCountAction($_GET['idQuiz'], 1),
    'laughs' => $quizController->getReactionCountAction($_GET['idQuiz'], 2),
    'surprises' => $quizController->getReactionCountAction($_GET['idQuiz'], 3),
    'sads' => $quizController->getReactionCountAction($_GET['idQuiz'], 4)
];

// Get user session details
$user = $_SESSION['user'] ?? null;

?>

<style>
    .quizImages {
        max-width: 100%;
        max-height: 350px;
        display: block;
        margin: 20px auto;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<main>
    <center>
        <h2 class="section-title"><?php echo htmlspecialchars($quiz->titre); ?></h2>
        <p><?php echo htmlspecialchars($quiz->description); ?></p>
        <div class="image-hover-thumb">
            <img src="images/<?php echo $quiz->image ?>" class="about-image img-fluid" alt="">
        </div>
        <a href="#section_questions" class="custom-link custom-btn btn mt-4">Start Quiz</a>

        <section class="about-section section-padding" id="section_questions">
            <form id="quizForm" action="app/view/checkAnswersAndGetResults.php?idQuiz=<?php echo $_GET['idQuiz']; ?>&idUtilisateur=<?php echo isset($_SESSION['user']->id) ? $_SESSION['user']->id : 'null'; ?>" method="POST">
                <?php
                if($questions != null)

                foreach ($questions as $question) {
                    $idQ = $question->id_question;
                    $reponses = $quizController->getQuestionAnswersAction($idQ);
                    echo '<div class="question"><p>' .$question->texte_question . '</p>';
                    
                    if ($_GET['images'] == 0) {
                        // If no images, show text-based questions
                        foreach ($reponses as $reponse) {
                            echo '<label><input type="radio" name="q' . $idQ . '" value="' . $reponse->est_correcte . '"> ' . htmlspecialchars($reponse->texte) . '</label><br>';
                        }
                    } else {
                        // If images are enabled, show image-based questions
                        echo '<img class="quizImages" src="images/' . htmlspecialchars($question->texte_question) . '">';
                        foreach ($reponses as $reponse) {
                            echo '<label><input type="radio" name="q' . $idQ . '" value="' . $reponse->est_correcte . '"> ' . htmlspecialchars($reponse->texte) . '</label><br>';
                        }
                    }
                    echo '</div><br><br>';
                }
                ?>
                <button type="submit" class="btn">Submit</button>
            </form>

            <!-- Comments and Reactions Section -->
            <section id="commentsAndReactions" class="comments-section">
                <h3>Comments</h3>
                <div class="commentsContainer"><br>
                    <?php if ($comments) {
                        foreach ($comments as $comment) {
                            $userComment = $userController->findUserByIdAction($comment->id_utilisateur);
                            echo '<strong>' . htmlspecialchars($userComment->username) . '</strong>
                            <p>' . htmlspecialchars($comment->texte) . '</p>
                            <small>Posted on: ' . htmlspecialchars($comment->date_creation) . '</small><br>';
                        }
                    }
                    ?>
                </div>
                <?php if ($user) {
                    echo '<form method="POST" action="app/addComment.php?idQuiz=' . $_GET['idQuiz'] . '"><textarea id="commentInput" name="commentTexte" placeholder="Write a comment..." rows="3"></textarea>
                    <button id="addCommentButton" class="btn">Add Comment</button></form>';
                }
                ?>

                <h3>Reactions</h3>
                <?php if ($user) { ?>
                    <div id="reactionsContainer">
                        <?php 
                        // Loop to create reaction buttons dynamically
                        $reactions = [
                            'like' => '👍 Like',
                            'love' => '❤️ Love',
                            'laugh' => '😂 Laugh',
                            'surprise' => '😮 Wow',
                            'sad' => '😢 Sad'
                        ];
                        $reactionIndexes = [
                            'like' => 0,
                            'love' => 1,
                            'laugh' => 2,
                            'surprise' => 3,
                            'sad' => 4
                        ];
                        foreach ($reactions as $reaction => $label) {
                            echo '
                            <form action="app/toggleReaction.php" method="POST" style="display:inline;">
                                
                                <input type="hidden" name="reaction" value="' .$reactionIndexes[$reaction] . '">
                                <input type="hidden" name="quizId" value="' . $_GET['idQuiz'] . '">
                                <input type="hidden" name="userId" value="' . $user->id . '">
                                <button type="submit" class="reaction-btn">' . $label . '</button>
                            </form>';
                        }
                        ?>
                    </div>
                <?php } ?>
                <p id="reactionSummary">
                    <span id="likeCount"><?php echo $reactionCounts['likes']; ?></span> Likes,
                    <span id="loveCount"><?php echo $reactionCounts['loves']; ?></span> Loves,
                    <span id="laughCount"><?php echo $reactionCounts['laughs']; ?></span> Laughs,
                    <span id="surpriseCount"><?php echo $reactionCounts['surprises']; ?></span> Wows,
                    <span id="sadCount"><?php echo $reactionCounts['sads']; ?></span> Sads
                </p>
            </section>
        </section>
    </center>
</main>

<?php
$content = ob_get_clean();
require_once('layout.php');
?>
