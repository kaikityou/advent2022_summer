<?php
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=calendar_list','root','root');

        $stmt = $db->prepare("SELECT * FROM calendar_item;");
        $res = $stmt->execute();

        if($res)
        {
            $all = $stmt->fetchAll();

            foreach($all as $loop)
            {
                echo "<li class='item'>";
                    echo "<div class = 'head'>";
                        echo "<div class = 'date'>8/" . $loop["date"] . "</div>";
                        echo "<div class = 'name'>" . $loop["name"] . "</div>";
                    echo "</div>";

                        echo "<div class ='title'>" .$loop["title"]. "</div>";

                        if($loop["URL"] !== NULL)
                        {
                            $URL = $loop["URL"];
                            $source = @file_get_contents($URL);

                            if (preg_match('/<title>(.*?)<\/title>/i', mb_convert_encoding($source, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS'), $result)) 
                            {$title = $result[1];} 
                            else 
                            {$title = $url;}

                            echo "<div class = 'URL'>";
                            echo "<p id='URL_address'><a href='" .$URL. "'>" .$URL. "</a></p>";
                            echo "<p id='URL_title'>" .$title. "</p>";
                            echo "</div>";
                        }

                        echo "<div class ='delete_button' onsubmit='return delete_check()'>"; //削除ボタン            
                        echo "<form method='POST' action='Advent_list_deleter.php'>";
                        echo "<button type='submit' name='date' class ='button' value='" .$loop["date"]. "'>削除</button>";
                        echo "</form></div>";
                        
                        echo "<div class ='renew_button'>"; //更新ボタン
                            echo "<form method='POST' action='dialog_renew_manger.php'>";
                            echo "<button type='submit' class='button' name='date' value='" .$loop["date"]. "'>更新</button>";
                            echo "</form>";
                        echo "</div>";

                echo "</li>";
                
            }
        }
        $db = null;
    }

    catch(PDOException $e)
    {
        echo "接続失敗<br>";
        echo $e->getMessage();
    }
?>

<script>
function delete_check () 
{
        var flag = confirm ( "削除しますか？");
        return flag;
    }
</script>