<?php
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=calendar_list','root','root');

        $date = $_POST["date"];
        $name = $_POST["name"];
        $title = $_POST["title"];
        $URL = NULL;

        $stmt = $db->prepare("INSERT INTO calendar_item VALUES(?,?,?,?);");

        $stmt->bindParam(1,$date,PDO::PARAM_INT);
        $stmt->bindParam(2,$name,PDO::PARAM_STR);
        $stmt->bindParam(3,$title,PDO::PARAM_STR);
        $stmt->bindParam(4,$URL,PDO::PARAM_STR);

        $res = $stmt->execute();

        $db = null;
        header("Location:Advent_2022.php");
    }

    catch(PDOException $e)
    {
        echo "接続に失敗しました<br>";
        echo $e->getMessage();
    }
?>