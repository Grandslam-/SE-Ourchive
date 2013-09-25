<?php

session_start();

$title = trim($_POST["title"]);
$date = $_POST["date"];
$content = trim($_POST["content"]);

include "open_db.php";

if($title == "" || $content == ""){
    $_SESSION["warning"] = "all";
    $_SESSION["warning_content"] = "Please fill in all the contents to continue.";
    header("location:../../edit_announce.php");
}

else{
    $sql = "update announcement set
            title = '$title', position = '$position', date = '$date', content = '$content'
            where user_id = '" . $_SESSION['user'] . "'";

    mysql_query($sql);

    header("location:../../Home.php");
}

?>