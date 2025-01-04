<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title ?></title>
    <!-- CSS FILES -->
    <base href="http://localhost/Quizzi/">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Playfair+Display&display=swap"
        rel="stylesheet">
    <link href="css\bootstrap.min.css" rel="stylesheet">
    <link href="css\bootstrap-icons.css" rel="stylesheet">
    <link href="css\magnific-popup.css" rel="stylesheet">
    <link href="css\tooplate-wedding-lite.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <?php require "C:\wamp64\www\Quizzi\inc\preloader.php" ?>
    <?php require "C:\wamp64\www\Quizzi\inc\header.php" ?>
    <?php echo $content ?>

    <?php require "C:/wamp64/www/Quizzi/inc/footer.php" ?>

<!-- JAVASCRIPT FILES -->
<script src="js\jquery.min.js"></script>
<script src="js\bootstrap.min.js"></script>
<script src="js\jquery.sticky.js"></script>
<script src="js\click-scroll.js"></script>
<script src="js\jquery.magnific-popup.min.js"></script>
<script src="js\magnific-popup-options.js"></script>
<script src="js\custom.js"></script>
<script src="js\checkAnswers.js"></script>

</body>

</html>