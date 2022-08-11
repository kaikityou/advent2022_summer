<?php
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=calendar_list','root','root');

        $stmt = $db->prepare("SELECT COUNT(*) FROM calendar_item;");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        
        echo $count . "/31";

        $db = null;
    }

    catch(PDOException $e)
    {
        echo "接続失敗<br>";
        echo $e->getMessage();
    }
?>