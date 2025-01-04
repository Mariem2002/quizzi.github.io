<?php 
 session_start();
 if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head> <!-- session erreur w session succees, idha ken session eerrur m3abbya bch naffishih w nfaskh session-->

    <?php
   require_once "app/controller/UserController.php";
   $userController = new UserController();
   $userController->AuthenticateAction();
    
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Simple Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .login-form {
            width: 340px;
            margin: 50px auto;
            font-size: 15px;
        }

        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .login-form h2 {
            margin: 0 0 15px;
        }

        .form-control,
        .btn {
            min-height: 38px;
            border-radius: 2px;
        }

        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="login-form">
        <form action="login.php" method="post"> <!-- ou action = ""   -->
            <!-- $_POST ainsi que $_REQUEST sont des tableaux associatifs qui stoquent les valeurs de POST -->
            <!-- if($_SERVER["REQUEST_METHOD"] == 'POST') (wa9tli l client clique sur submit)-->
            <h2 class="text-center">Log in</h2>
            <div class="form-group">
    <input type="text" name="username" class="form-control" 
        placeholder="Username" 
        value="<?php echo isset($_COOKIE['login']) ? htmlspecialchars($_COOKIE['login'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
        required="required">
</div>
<div class="form-group">
    <input type="password" name="password" class="form-control" 
        placeholder="Password" 
        value="<?php echo isset($_COOKIE['password']) ? htmlspecialchars($_COOKIE['password'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
        required="required">
</div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </div>
            <div class="clearfix">
                <label class="float-left form-check-label"><input type="checkbox" name="remember" value="1" <?php echo isset($_COOKIE['login']) ? htmlspecialchars("checked", ENT_QUOTES, 'UTF-8') : ''; ?>> Remember me</label>
                <a href="#" class="float-right">Forgot Password?</a>
            </div>
        </form>
       
        <p class="text-center"><form><a href="createAccount.php">Create an Account</a></form></p>
    </div>
</body>

</html>