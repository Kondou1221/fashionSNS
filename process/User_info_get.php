<?php

// session_start();

if(!isset($_SESSION["USER_ID"])){
    header("Location: ./login_form.php");
}

$result = [
    "status" => false,
    "result" => [],
    "message" =>""
];

if(isset($_SESSION["USER_ID"])){
    $dsn = "mysql:dbname=sys2_iesk2bc_a;host=localhost";
    $user = "sys2_iesk2bc_a";
    $password = "pT9sNfxB";

    $user_id = $_SESSION["USER_ID"];

    try{
        $dbh = new PDO($dsn, $user, $password);

        $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $dbh -> beginTransaction();

        $sql = "SELECT * FROM USER WHERE USER_ID = ?";

        $prepare = $dbh -> prepare($sql);

        $prepare -> bindParam(1, $user_id);

        $prepare -> execute();

        $Uresult = $prepare -> fetch(PDO::FETCH_ASSOC);

        if(isset($Uresult)){
            $result["result"] = $Uresult;
            $result["status"] = true;      
        }

        $dbh = null ;
        $prepare = null;

        // header("Content-Type: application/json; charset=UTF-8");
        // echo json_encode($result, JSON_UNESCAPED_UNICODE);

    }catch (PDOException $e){
        $result["message"] = "接続に失敗しました";
    }
}

?>