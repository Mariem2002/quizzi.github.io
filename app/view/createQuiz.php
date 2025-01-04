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

$title = 'Quizzi';
ob_start();
include_once "../controller/QuizController.php";
$quizController = new QuizController();
if (isset($_POST['quizTitle']) && $_POST['quizTitle']) {
    $quizController->insertQuizAction();
}
$categories = $quizController->findAllCategoryAction();
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

    #quizForm {
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
    .answers {
        margin-top: 10px;
    }
    .answer-input {
        margin-bottom: 10px;
    }
    .answer-option {
        margin-bottom: 10px;
    }
    .remove-answer {
        background-color: red;
        color: white;
        border: none;
        cursor: pointer;
        padding: 5px 10px;
        margin-top: 5px;
    }
</style>

<div class="containerQ">
    <center><h1>Create a Quiz</h1></center>
    <form id="quizForm" method="POST" action="app/view/createQuiz.php" enctype="multipart/form-data">
        <label for="quizTitle">Quiz Title</label>
        <input type="text" id="quizTitle" name="quizTitle" placeholder="Enter quiz title" required>

        <label for="quizDescription">Quiz Description</label>
        <textarea id="quizDescription" name="quizDescription" rows="3" placeholder="Enter a brief description" required></textarea>

        <label for="quizImage">Quiz Image</label>
        <input type="file" id="quizImage" name="quizImage" accept="image/*" required>

        <label for="categorieId">Category</label>
        <?php if ($categories != null) {
            foreach ($categories as $category) {
                echo '
                <input type="radio" id="' . $category->id . '" name="categorieId" value="' . $category->id . '" required>
                <label for="' . $category->id . '">' . $category->label . '</label><br>';
            }
        } ?>

        <div id="questionsContainer">
            
        </div>

        <div class="add-btn">
            <button class="btnQ" type="button" id="addQuestion">Add Question</button>
        </div>

        <button class="btnQ" type="submit">Create Quiz</button>
    </form>
</div>

<script>
    let questionCount = 0;
let answerCounts = [2]; // Initially 2 answers per question

// Add Question functionality
document.getElementById('addQuestion').addEventListener('click', () => {
    questionCount++;

    // Create new question section
    const questionContainer = document.createElement('div');
    questionContainer.classList.add('question');
    questionContainer.id = `question${questionCount}`;

    const questionTitle = document.createElement('center');
    questionTitle.innerHTML = `<h3>Question ${questionCount}</h3>`;

    const questionInput = document.createElement('input');
    questionInput.type = 'text';
    questionInput.id = `question${questionCount}Text`;
    questionInput.name = `question[${questionCount}][text]`;
    questionInput.placeholder = 'Enter the question';
    questionInput.required = true;

    const answersContainer = document.createElement('div');
    answersContainer.classList.add('answers');
    answersContainer.id = `answers${questionCount}`;

    // Create a wrapper for the answers and the button
    const answersWrapper = document.createElement('div');
    answersWrapper.classList.add('answers-wrapper');

    // Add two initial answers
    for (let i = 1; i <= 2; i++) {
        const answer = document.createElement('input');
        answer.type = 'text';
        answer.name = `question[${questionCount}][answers][${i}][text]`;
        answer.classList.add('answer-input');
        answer.placeholder = 'Enter the answer';
        answer.required = true;

        const correctAnswer = document.createElement('input');
        correctAnswer.type = 'radio';
        correctAnswer.name = `question[${questionCount}][correct_answer]`;
        correctAnswer.value = i;
        correctAnswer.required = true;

        answersWrapper.appendChild(answer);
        answersWrapper.appendChild(correctAnswer);
    }

    const addAnswerButton = document.createElement('button');
    addAnswerButton.type = 'button';
    addAnswerButton.classList.add('btnQ');
    addAnswerButton.innerText = 'Add Answer';
    addAnswerButton.id = `addAnswer${questionCount}`;

    // Add event listener to add more answers dynamically
    addAnswerButton.addEventListener('click', () => {
        answerCounts[questionCount - 1]++;

        const newAnswer = document.createElement('input');
        newAnswer.type = 'text';
        newAnswer.name = `question[${questionCount}][answers][${answerCounts[questionCount - 1]}][text]`;
        newAnswer.classList.add('answer-input');
        newAnswer.placeholder = 'Enter the answer';
        newAnswer.required = true;

        const newCorrectAnswer = document.createElement('input');
        newCorrectAnswer.type = 'radio';
        newCorrectAnswer.name = `question[${questionCount}][correct_answer]`;
        newCorrectAnswer.value = answerCounts[questionCount - 1];
        newCorrectAnswer.required = true;

        answersWrapper.appendChild(newAnswer);
        answersWrapper.appendChild(newCorrectAnswer);
    });

    // Append the button after all answers
    answersWrapper.appendChild(addAnswerButton);
    answersContainer.appendChild(answersWrapper);

    // Append to the question container
    questionContainer.appendChild(questionTitle);
    questionContainer.appendChild(questionInput);
    questionContainer.appendChild(answersContainer);

    // Append to the questions container
    document.getElementById('questionsContainer').appendChild(questionContainer);
    answerCounts.push(2); // Reset answer count for the new question
});

</script>

<?php
$content = ob_get_clean();
require_once('layout.php');
?>
