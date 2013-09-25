<?php
$show_hidden = 0;
if(isset($_SESSION["notification"])){
    $alert_type = "success";
    $content = $_SESSION["notification_content"];
    unset($_SESSION["notification"]);
    unset($_SESSION["notification_content"]);
    $show_hidden = 1;
}
else if(isset($_SESSION["warning"])){
    $alert_type = "alert";
    $content = $_SESSION["warning_content"];
    unset($_SESSION["warning"]);
    unset($_SESSION["warning_content"]);
    $show_hidden = 1;
}

if($show_hidden == 1){
    ?>

    <div class="row">
        <div class="large-12 columns text-center">
            <div class="<?php echo $alert_type; ?> alert-box">
                <?php echo $content; ?>
                <a href="#" class="close">&times;</a>
            </div>
        </div>
    </div>

    <?php
    $show_hidden = 0;
}
?>