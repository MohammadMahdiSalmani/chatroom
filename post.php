<?php
ob_start();
session_start();

if (isset($_SESSION['name'])) {
    date_default_timezone_set("Asia/Tehran");
    
    $text = $_POST['text'];
    $picture = $_FILES['image']['name'];

    $_SESSION['typing'] = $_POST['typing'];

    $randnum = '12345';
    $randstr = 'abcdefghijklmnopqrstuvwxyz';
    $randsym = '@%?&$';
    $shuffled = str_shuffle($randnum + $randstr + $randsym);
    echo $shuffled;

    $allow = array("jpg", "jpeg", "gif", "png", "svg", "mp4", "mkv", "mov");

    if (isset($_FILES['image']['tmp_name'])) {
        $info = explode('.', $_FILES['image']['name']);

        if (in_array(end($info), $allow)) {
            $randnum = '12345';
            $randstr = 'abcdefghijkl';
            $shuffled = str_shuffle($randnum . $randstr);
            echo $shuffled;
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . ($shuffled . "." . end($info)));
            $_SESSION[photo] = $_FILES['image']['tmp_name'];
            $media_message = "<div class='column column-md-12 column-xs-12 msgln'><strong class='column-md-12 column-xs-12 user-name'>" . $_SESSION['name'] . " :</strong><img class='column-md-5 column-xs-5' src='uploads/" . $address. "' style='border-radius: 20px' /><span class='column-md-12 column-xs-12 chat-time'>" . date("Y-m-d") ." ". date("h:i A") . "</span></div>";
            file_put_contents("log.html", $media_message, FILE_APPEND | LOCK_EX);
        } else {
            echo "Invalid";
        }
    }

    if(isset($text)){
        $text_message = "<div class='column column-md-12 column-xs-12 msgln'><strong class='column-md-12 column-xs-12 user-name'>" . $_SESSION['name'] . " :</strong><pre class='column-md-10 column-xs-10 user-message'><p>" . $text . "</p></pre><span class='column-md-12 column-xs-12 chat-time'>" . date("Y-m-d") ." ". date("h:i A") . "</span></div>";
        file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
    }
}


// date sample code
// <span class='chat-time'>" . date("Y Md") . "</span>