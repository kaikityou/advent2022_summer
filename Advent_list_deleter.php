<?php
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=calendar_list','root','root');

        $date = $_POST["date"];
        $stmt = $db->prepare("DELETE FROM calendar_item WHERE date = ?;");

        $stmt->bindParam(1,$date,PDO::PARAM_INT);
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