<?php
ob_start();
session_start();

if (isset($_GET['logout'])) {
    //Exit message
    $logout_message = "<section class='column-md-10 column-xs-12'><span>User @<b>" . $_SESSION['name'] . "</b> has left the chat session.</span><br></section>";
    file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);

    session_destroy();
    header("Location: index.php"); //Redirect to Login
}

if (isset($_POST['enter'])) {
    $str = file_get_contents("users.json");

    $users = new RecursiveIteratorIterator(
        new RecursiveArrayIterator(json_decode($str, true)),
        RecursiveIteratorIterator::SELF_FIRST);

    foreach ($users as $key => $value) {
        if ((strtolower($_POST['name']) !== "" && strtolower($_POST['name']) == strtolower($value["name"]) && $_POST['pass'] !== "" && $_POST['pass'] == $value["pass"])) {
            $_SESSION['name'] = stripslashes(htmlspecialchars(strtolower($_POST['name'])));

            $login_message = "<section class='column-md-10 column-xs-12'><span>User @<b>" . $_SESSION['name'] . "</b> join to the chat session.</span><br></section>";
            file_put_contents("log.html", $login_message, FILE_APPEND | LOCK_EX);
        } else {
            $_SESSION['incorrect'] = '<span class="alert column-md-6 column-xs-10">Please type in correct username and password</span>';
        }
    }
}

//Login form
function loginForm()
{
    if (isset($_SESSION['incorrect'])) {
        echo $_SESSION['incorrect'];
        $_SESSION['incorrect'] = '';
    }

    echo
        '<nav class="row column-md-12 column-xs-12"></nav>
        <div id="loginform" class="column column-md-12 column-xs-12">
            <strong class="row column-md-10 column-xs-10">Global Chatroom!</strong>
            <p class="row column-md-10 column-xs-10">Enter your username and password to continue!</p>
            <form action="index.php" method="POST" class="column column-md-12 column-xs-12">
                <input type="text" name="name" id="name" class="column-md-5 column-xs-8 text-box" placeholder="Write your username" required/>
                <input type="password" name="pass" id="pass" class="column-md-5 column-xs-8 text-box" placeholder="Write your password" required/>

                <p class="row column-md-10 column-xs-10">Don`t have an account yet? <a href="signup.php">Sign up</a></p>

                <button type="submit" class="column-md-2 column-xs-5 button" name="enter" id="enter">Enter</button>
            </form>
        </div>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Chat Room</title>
    <meta name="description" content="'Chat Room' created by MohammadMahdi Salmani" />
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.js"></script>
    <script src="js/index.js"></script>
</head>

<body>
    <?php
if (!isset($_SESSION['name'])) {
    loginForm();
} else {
    ?>
    <div id="menu" class="row column-md-12 column-xs-12">
        <div class="row column-md-6 column-xs-6">
            <a id="exit" href="#" class="column-md-5 column-xs-10 button button-red link-button">Exit Chat</a>
        </div>

        <div class="row column-md-6 column-xs-6">
            <p class="row column-md-7 column-xs-5">Welcome, <strong>
                    <?php echo $_SESSION['name']; ?>
                </strong></p>
        </div>
    </div>


    <div id="chatbox" class="column-md-10 column-xs-12">
        <?php
if (file_exists("log.html") && filesize("log.html") > 0) {
        $contents = file_get_contents("log.html");
        echo $contents;
    }
    ?>
    </div>

    <div id="latest-messages" class="row column-md-10 column-xs-12">
        <button type="button" class="button message-button"> > </button>
    </div>

    <div class="row column-md-12 column-xs-12" id="message-box">
        <textarea name="usermsg" id="usermsg" class="text-box column-md-7 column-xs-9" autocomplete="off"
            placeholder="Message" /></textarea>

        <label for="image" style="cursor: pointer">
            <span></span>
            <span></span>
            <strong></strong>
        </label>

        <input name="image" type="file" id="image" class="xs-hidden md-hidden" />
    </div>
    </div>
</body>

</html>
<?php
}
?>