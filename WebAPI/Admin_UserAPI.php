<?php

$Dlete_User_No = json_decode($_POST["User_No"]);

$result = [
    "status" => false,
    "message" => ""
];

$dsn = "mysql:dbname=sys2_iesk2bc_a;host=localhost";
$user = "sys2_iesk2bc_a";
$password = "pT9sNfxB";

try{

    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach( $Dlete_User_No as $d ){

        $sql = "CALL プロシージャの名前(?)";

        $prepare = $dbh -> prepare($sql);

        $prepare -> bindParam(1, $d);

        $prepare -> execute();

    }

    $result["status"] = true;

    $dbh = null ;
    $prepare = null;

}catch (PDOException $e){
    $result["message"] = "失敗しました".$e->getMessage();

}


header("Content-Type: application/json; charset=UTF-8");
echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>