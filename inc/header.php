<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


?>

<style>
  .loginoutbtn {
    background: none; /* Removes background */
    border: none;     /* Removes border */
    color: inherit;   /* Inherits text color from parent element */
    font: inherit;    /* Matches the font of surrounding text */
    padding: 0;       /* Removes default padding */
    cursor: pointer;  /* Keeps pointer for clickable effect */
}

</style>
<nav class="navbar navbar-expand-lg">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a href="index.php" class="navbar-brand mx-auto mx-lg-0">
            <span>QUI</span>
            <i class="bi-question-circle-fill" style="color: red;"></i>
            <span>ZZI</span>
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="index.php #section_1">Homepage</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="index.php #section_2">Test your knowledge</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="index.php #section_3">Personality tests</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="index.php #section_4">Puzzle Quizzes</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="index.php #section_5">Different Quizzes
                    </a>
                </li>

<?php if (isset($_SESSION['user']) && $_SESSION['user'] != null && $_SESSION['user']->id != 1) {
            echo'
                <li class="nav-item">
                    <a class="nav-link" href="app/view/myScores.php">Your scores</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="app/view/myQuizzes.php">Your Quizzes</a>
                </li>';
 } if (isset($_SESSION['user']) && $_SESSION['user'] != null && $_SESSION['user']->id == 1){
    echo'
                <li class="nav-item">
                    <a class="nav-link" href="app/view/allUsers.php">Users</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="app/view/allQuizzes.php">All Quizzes</a>
                </li>';
 }
 ?>
            </ul>
        </div>
        <?php if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
            echo
                '<form action="app/signout.php" method="post"><button class="loginoutbtn" type="submit"><i class="fa fa-sign-out" style="font-size:24px"></i></button></form>';
        } else {
            echo
                '<form action="login.php"><button class="loginoutbtn" type="submit"><i class="fa fa-sign-in" style="font-size:24px"></i>
</button></form>';
        }

        ?>
    </div>
</nav>