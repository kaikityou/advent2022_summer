<?php

    $date = $_POST["date"];

    echo "<div id='easyModal' class='modal'>";

    echo "<div class='Dialog-content'>";
        echo "<div class='Dialog-header'>" .$date;
        echo "</div>";
            
            echo "<div class='Dialog-body'>";
                    echo "<form method='POST' action='Advent_list_maneger.php'>";
                        echo "<input type='hidden' name='date' value='" .$date. "'></p>";
                        echo "<p>名前：<input type='text' name='name' placeholder='お名前を入力してください'></p>";
                        echo "<p>タイトル：<input type='text' name='title' placeholder='記事の内容の予定などを入力してください'></p>";
                        echo "<input type='submit'>";
                    echo "</form>";
            echo "</div>";
    echo "</div>";
    echo "</div>";
?>