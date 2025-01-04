<?php
session_start();

// Check if the admin is logged in.
if (isset($_SESSION['user']) && $_SESSION['user']->id == 1) {

} else {
    // Redirect to index.php if the admin is not logged in
    header("Location: ../../index.php");
    exit();
}
require_once "../controller/UserController.php";
$userController = new UserController();
$feedbacks = $userController->findAllFeedbackAction();
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
        color: #f1c522;
    }

    /* Table Styles */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    thead {
        background-color: rgb(255, 130, 108);

        color: #fff;
    }

    th,
    td {
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
        background-color: rgb(255, 124, 124);
        color: white;
        border: none;
        cursor: pointer;
    }

    .btnQ:hover {
        background-color: rgb(179, 0, 0);
    }
</style>
<main>
    <?php if ($feedbacks != null) { ?>
        <section class="feedbacks">
            <center>
                <h2>All Feedbacks</h2>
            </center>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Satisfaction Level</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($feedbacks != null) {
                        foreach ($feedbacks as $feedback) {
                            echo '<tr>
                             <td>' . $feedback->id . '</td>
                            <td>' . $feedback->full_name . '</td>
                            <td>' . $feedback->email . '</td>
                            <td>' . $feedback->satisfaction_level . '</td>';
                             if ($feedback->message != null)
                                echo '<td>' . $feedback->message . '</td>';
                            else
                                echo '<td>No message</td>';
                            echo '<td>' . $feedback->date . '</td>';
                           
                            
                        echo '</tr>';
                        }
                    } ?>
                </tbody>
            </table>
        </section>



    <?php }
    else{
        echo 'No feedbacks.';
    } ?>
</main>
<?php
$content = ob_get_clean();
require_once('layout.php');
?>