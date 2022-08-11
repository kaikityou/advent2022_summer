<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>2022_Calendar</title>
	<link rel="stylesheet" href="Advent_2022.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="dialog.css">
</head>

    <body>
        <div id="logo">
            <h1>偽 Adventar</h1>
        </div>

		<div id="heading">
			<h1 id="title">音MAD Advent Calendar 2022 in Summer</h1>
			<p id="member_number">登録数：
            <?php
				require_once("Advent_member_count.php");
			?>
            </p>
			<p id="orner">開発者：kaikityou</p>
		</div>

        <div id ="calendar_on">
		    <p>音MADに関することならなんでもよいです。<br>
            音MAD以外のことがメインでも無理やり音MADに紐付けさえすれば問題無いです。</p>
        </div>
		
		<div id="calendar">
        <?php
            $week = array("SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT");
            $now_month = date("2022年8月"); //表示する年月
            $start_date = date('2022-8-01'); //開始の年月日
            $end_date = date("2022-8-30"); //終了の年月日
            $start_week = date("w",strtotime($start_date)); //開始の曜日の数字
            $end_week = 6 - date("w",strtotime($end_date)); //終了の曜日の数字
             
            echo "<table class='cal'>";
             
            //曜日の表示 日～土
            echo "<tr class='dayOfWeek'>";
            foreach($week as $key => $youbi){
                if($key == 0){ //日曜日
                    echo "<th class='first_day'>".$youbi.'</th>';
                }else if($key == 6){ //土曜日
                    echo "<th class='end_day'>".$youbi.'</th>';
                }else{ //平日
                    echo '<th>'.$youbi.'</th>';
                }	
            }
            echo '</tr>';
             
            //日付表示部分ここから
            echo "<tr class='days'>";
            //開始曜日まで日付を進める
            for($i=0; $i<$start_week; $i++){
                echo '<td></td>';
            }
             
            //1日～月末までの日付繰り返し
            for($i=1; $i<=date("t"); $i++)
            {
                $set_date = date("Y-m",strtotime($start_date)).'-'.sprintf("%02d",$i);
                $week_date = date("w", strtotime($set_date));

                echo "<td>" .$i. "<br>";

                try
                {
                    $db = new PDO('mysql:host=localhost;dbname=calendar_list','root','root');
                    $stmt = $db->prepare('SELECT name FROM calendar_item WHERE date = ?');
                    $stmt->bindParam(1,$i);
                    $stmt->execute();
 
                    $stmt2 = $db->prepare('SELECT name FROM calendar_item WHERE date = ?');
                    $stmt2->bindParam(1,$i);
                    $stmt2->execute(array($i));

                    if ($stmt2->fetch() === false) // データベースに存在しない時
                     {
                        echo "<form method='POST' action='dialog_maneger.php'>";
                        echo "<button type='submit' class='button' name='date' value='" .$i. "'>登録</button>";
                        echo "</form>";
                     }

                     else 
                     {
                         $all = $stmt->fetchAll(); //データベースに存在する時
 
                         foreach($all as $loop)
                         {
                             echo "<p>" .$loop["name"]. "</p>";
                         }
                     }

                    $db = null;
                }

                catch(PDOException $e){
                    echo "接続失敗sdd<br>";
                    echo $e->getMessage();}

                echo "</td>";

                if($week_date == 6)
                {
                    echo '</tr>';
                    echo '<tr>';
                }
            }
             
            //末日の余りを空白で埋める
            for($i=0; $i<$end_week; $i++){
                echo '<td></td>';
            }
             
            echo '</tr>';
            echo '</table>';
        ?>
		</div>
		
		<div id="list">
			<ul class = "EntryList">
			<?php
				require_once("Advent_list_show.php");
			?>
			</ul>
		</div>

        <script src="main.js"></script>
    </body>
</html>