<div data-magellan-expedition="fixed">
    <div class="row">
        <div class="large-7 columns">
            <ul class="inline-list menu">
                <li class="active"><a href="home.php">Home</a></li>
                <?php
                    $page_type = "";
                    $type_text = "";

                    $sql = "SELECT * FROM user_type WHERE type_no = " . $_SESSION['type'];
                    $get = mysql_query($sql);

                    while($row = mysql_fetch_array($get)){

                        if($row["name_type"] == "Administrator"){
                            $page_type = "manage_account.php";
                            $type_text = "Manage College";
                        }
                        else if($row["name_type"] == "Dean"){
                            $page_type = "manage_account_dean.php";
                            $type_text = "Manage Staff";
                        }

                    }

                ?>
                <li><a href="<?php echo $page_type; ?>"><?php echo $type_text; ?></a></li>
                <li><a href="info.php">MyAccount</a></li>
            </ul>
        </div>

        <div class="large-5 columns">
            <div class="row collapse">
                <form class="custom" method="post" action="search.php">
                    <div class="large-10 columns">
                            <input type="text" placeholder="Name" />
                    </div>
                    <div class="large-2 columns">
                        <input type="submit" class="button postfix" value="Search" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>