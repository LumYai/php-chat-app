<?php

session_start();

if (isset($_SESSION['username'])) {
    if(isset($_POST['message']) && isset($_POST['to_id'])){


	# database connection file
	include '../db.conn.php';

    $message = $_POST['message'];
    $to_id = $_POST['to_id'];

    $from_id = $_SESSION['user_id'];

    $sql = "INSERT INTO 
            chats(from_id, to_id, message)
            VALUE(?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$from_id, $to_id, $message]);

    if($res){
        //  เช็ค ถ้าหากเป็นการคุยกันครั้งแรก
        $sql2 = "SELECT * FROM conversations
                WHERE (user_1=? AND user_2=?) OR (user_2=? AND user_1=?)";

        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute([$from_id, $to_id, $from_id, $to_id]);


        define('TIMEZONE', 'Asia/Bangkok');
        date_default_timezone_set(TIMEZONE);
        
        $time = date("h:i:s a");
        if($stmt2->rowCount() == 0){
            // insert ไปยัง conversations table
            $sql3 = "INSERT INTO 
                    conversations(user_1, user_2)
                    VALUE (?, ?)";

            $stmt3 = $conn->prepare($sql3);
            $stmt3->execute([$from_id, $to_id]);
        }  ?>
        <p class="rtext align-self-end border rounded p-2 mb-1">
            <?=$message?> 
            <small class="d-block"><?=$time?></small>
        </p>

        <?php
        }
            
    }
}else {
	header("Location: ../../index.php");
	exit;
}