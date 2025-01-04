<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user']) && $_SESSION['user']->id != null) {
    $admin = $_SESSION['user'];
} else {
    // Redirect to index.php if the user is not logged in
    header("Location: ../../index.php");
    exit();
}

$title = 'Quizzi';
ob_start();

require_once "c:\wamp64\www\Quizzi\app\controller\QuizController.php";

// Check if a quiz ID is provided in the URL
if (isset($_GET['idQuiz'])) {
    $quizController = new QuizController();
    $quiz = $quizController->findQuizAction($_GET['idQuiz']);
    if ($quiz === null) {
        echo "Quiz not found.";
        exit();
    }
} else {
    echo "Invalid request: Quiz ID is missing.";
    exit();
}

ob_start();
?>

<!-- Improved CSS -->
<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    main {
        background-color: #fff;
        padding: 2rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        width: 100%;
        max-width: 800px;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #333;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        color: #333;
    }

    textarea {
        resize: vertical;
        min-height: 150px;
    }

    input[type="file"] {
        padding: 5px;
    }

    .btnE[type="submit"] {
        background-color: #f1c522;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
        margin-top: 1rem;
    }

    .btnE[type="submit"]:hover {
        background-color: #e0b91f;
    }

    .back-link {
        display: block;
        margin-top: 1rem;
        text-align: center;
        color: #333;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    img {
        margin-top: 10px;
        max-height: 100px;
        object-fit: contain;
    }

    /* Styling for question and answer groups */
    .question-group {
        margin-bottom: 2rem;
        border-bottom: 1px solid #ddd;
        padding-bottom: 1rem;
    }

    .answer-group {
        margin-bottom: 1rem;
    }

    .add-answer,
    .remove-answer {
        background: none;
        border: none;
        color: #007bff;
        cursor: pointer;
        font-size: 1rem;
    }

    .add-answer:hover,
    .remove-answer:hover {
        text-decoration: underline;
    }
</style>
<center>
<main>

    <h1>Edit Quiz</h1>

    <form action="app/editQuizAction.php?idQuiz=<?php echo $quiz->id; ?>" method="POST" enctype="multipart/form-data">

        <!-- Quiz Title -->
        <div class="form-group">
            <label for="titre">Title</label>
            <input type="text" name="titre" id="titre" value="<?php echo $quiz->titre; ?>" required>
        </div>

        <!-- Quiz Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" required><?php echo $quiz->description; ?></textarea>
        </div>

        <!-- Quiz Category -->
        <div class="form-group">
            <label for="id_categorie">Category</label>
            <select name="id_categorie" id="id_categorie" required>
                <?php
                $categories = $quizController->findAllCategoryAction();
                foreach ($categories as $category) {
                    $selected = $category->id == $quiz->id_categorie ? 'selected' : '';
                    echo "<option value='{$category->id}' $selected>{$category->label}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Quiz Image -->
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
            <img src="images/<?php echo $quiz->image; ?>" alt="Current Image">
        </div>

        <!-- Quiz Questions -->
        <h3>Questions</h3>
        <div id="questions-container">
            <?php
            $questions = $quizController->getQuizQuestionsAction($quiz->id);
            if ($questions) {
                foreach ($questions as $question) {
                    ?>
                    <div class="question-group" id="question_<?php echo $question->id_question; ?>">
                        <label for="question_<?php echo $question->id_question; ?>">Question: </label>
                        <input type="text" name="questions[<?php echo $question->id_question; ?>][question]" 
                               value="<?php echo $question->texte_question; ?>" required>

                        <label>Answers:</label>
                        <?php
                        $answers = $quizController->getQuestionAnswersAction($question->id_question);
                        if ($answers) {
                            foreach ($answers as $answerIndex => $answer) {
                                ?>
                                <div class="answer-group">
                                    <input type="text" name="questions[<?php echo $question->id_question; ?>][answers][<?php echo $answerIndex; ?>]" 
                                           value="<?php echo $answer->texte; ?>" required>
                                    <input type="radio" name="questions[<?php echo $question->id_question; ?>][correct_answer]" 
                                           value="<?php echo $answerIndex; ?>" 
                                           <?php echo ($answer->est_correcte ? 'checked' : ''); ?>> Correct
                                    <button type="button" class="remove-answer">Remove Answer</button>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <button type="button" class="add-answer">Add Answer</button>
                    </div>
                    <?php
                }
            } else {
                echo "No questions available.";
            }
            ?>
        </div>

        <button type="button" id="add-question">Add Question</button>
        <button type="submit" class="btnE">Save Changes</button>
    </form>

    <a href="<?php echo $_SESSION['user']->id != 1 ? 'app/view/myQuizzes.php' : 'app/view/allQuizzes.php'; ?>" class="back-link">
        Back to <?php echo $_SESSION['user']->id != 1 ? 'My Quizzes' : 'All Quizzes'; ?>
    </a>

</main>
</center>

<script>
    // Add new question field
    document.getElementById('add-question').addEventListener('click', function() {
    let questionId = Date.now(); // Unique timestamp for each question
    let questionContainer = document.createElement('div');
    questionContainer.classList.add('question-group');
    questionContainer.id = `question_${questionId}`;

    questionContainer.innerHTML = `
        <label for="question_${questionId}">Question: </label>
        <input type="text" name="questions[${questionId}][question]" required>

        <label>Answers:</label>
        <div class="answer-group">
            <input type="text" name="questions[${questionId}][answers][0]" required>
            <input type="radio" name="questions[${questionId}][correct_answer]" value="0"> Correct
        </div>
        <button type="button" class="add-answer">Add Answer</button>
    `;

    document.getElementById('questions-container').appendChild(questionContainer);
});


    // Add new answer field
    document.addEventListener('click', function(event) {
    if (event.target && event.target.classList.contains('add-answer')) {
        let questionGroup = event.target.closest('.question-group');
        let questionId = questionGroup.id.split('_')[1]; // Extract question ID
        let answerCount = questionGroup.querySelectorAll('.answer-group').length; // Count existing answers

        let answerGroup = document.createElement('div');
        answerGroup.classList.add('answer-group');
        answerGroup.innerHTML = `
            <input type="text" name="questions[${questionId}][answers][${answerCount}]" required>
            <input type="radio" name="questions[${questionId}][correct_answer]" value="${answerCount}"> Correct
        `;
        questionGroup.appendChild(answerGroup);
    }
});


    // Remove answer field
    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('remove-answer')) {
            let answerGroup = event.target.closest('.answer-group');
            answerGroup.remove();
        }
    });
</script>

<?php
$content = ob_get_clean();
require_once('layout.php');
?>
