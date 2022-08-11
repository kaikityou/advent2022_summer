<?php

    $date = $_POST["date"];

    echo "<div id='easyModal' class='modal'>";

    echo "<div class='Dialog-content'>";
        echo "<div class='Dialog-header'>" .$date;
        echo "</div>";
        
        echo "<div class='Dialog-body'>";
                 echo "<form method='POST' action='Advent_list_renewer.php'>";
                    echo "<input type='hidden' name='date' value='" .$date. "'></p>";
                    echo "<p>URL：<input type='text' name='URL' placeholder='予定日になったら入力してください'></p>";
                    echo "<input type='submit'>";
                echo "</form>";
        echo "</div>";
    echo "</div>";
    echo "</div>";
?>