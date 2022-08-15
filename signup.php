<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.js"></script>
    <script src="js/index.js"></script>
</head>

<body>
    <nav class="row column-md-12 column-xs-12"></nav>
    <main>
            <?php
                if(isset($_SESSION['created'])) {
                    echo $_SESSION['created'];
                    $_SESSION['created'] = '';

                }

                if(isset($_SESSION['unique'])) {
                    echo $_SESSION['unique'];
                    $_SESSION['unique'] = '';
                }
            ?>
        <div id="signupform" class="column column-md-12 column-xs-12">
            <p class="row column-md-10 column-xs-10">Be careful to choosing your username and password. If you forget your information you can't recover your account.</p>
            <form action="users.php" method="POST" class="column column-md-12 column-xs-12">
                <input type="text" name="username" id="username" class="text-box column-md-5 column-xs-8"
                    placeholder="Username (at least 8 characters)" minlength="8" pattern="[^' '!@#$%&*-+=~`:^()/_{}?><\][\\\x22,;|]+" title="Username must be without any space or symbol!" autocomplete="off" required>
                <input type="password" name="password" id="password" class="text-box column-md-5 column-xs-8"
                    placeholder="Password (at least 8 characters)" minlength="8" required>
                <input type="password" name="repassword" id="repassword" class="text-box column-md-5 column-xs-8"
                    placeholder="Enter your password" required>

                <p class="row column-md-10 column-xs-10">Have an account? <a href="index.php">Login</a></p>

                <button type="submit" class="button column-md-2 column-xs-5">Create my account</button>
            </form>
        </div>
    </main>
</body>

</html>