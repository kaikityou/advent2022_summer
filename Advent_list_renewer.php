<?php

    $date = $_POST["date"];
    $URL = $_POST["URL"];
    
    try
    {   $db = new PDO('mysql:host=localhost;dbname=calendar_list','root','root');
        
        $stmt = $db->prepare("UPDATE calendar_item SET URL = ? WHERE date = ?;");

        $stmt->bindParam(1,$URL,PDO::PARAM_STR);
        $stmt->bindParam(2,$date,PDO::PARAM_INT);
        $res = $stmt->execute();

        $db = null;
        header("Location:Advent_2022.php");
        exit();
    }

    catch(PDOException $e)
    {
        echo "接続に失敗しました<br>";
        echo $e->getMessage();
    }

?>