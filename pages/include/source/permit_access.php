<?php

if($_SESSION["type"] != $access){

    header("location: $dir"."home.php ");

}

?>