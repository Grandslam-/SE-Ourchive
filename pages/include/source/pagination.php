<ul class="pagination">
    <?php

    if($pages >= 1 && $page <= $pages) {

        echo ($page == 1) ? "<li class='current'><a href=''>First</a></li>" : "<li><a href='?page=1'> First </a></li>";
        $truth = true;
        for ($x=1; $x<=$pages; $x++){

            if(($x < ($page - $limit_page_num) || $x > ($page + $limit_page_num)) && $truth == true){
                echo "<li class='unavailable'><a href=''>&hellip;</a></li>";
                $truth = false;
            }
            else if( (!($x > ($page + $limit_page_num))) && (!($x < ($page - $limit_page_num))) ){
                $truth = true;
                echo ($x == $page) ? "<li class='current'><a href=''>" . $x . "</a></li>" : "<li><a href='?page=" . $x . "'>" . $x . "</a></li>";
            }

        }

        echo ($page == $pages) ? "<li class='current'><a href=''> Last </a></li>" : "<li><a href='?page=".$pages."'> Last </a></li>";

    }

    else if($page > $pages){

        echo "<div style='color:red'> Don't manipulate the pages please! </div>";

    }

    ?>
</ul>