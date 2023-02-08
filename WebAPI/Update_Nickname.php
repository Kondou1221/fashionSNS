<?php

$dsn = "mysql:dbname=sys2_iesk2bc_a;host=localhost";
$user = "sys2_iesk2bc_a";
$password = "pT9sNfxB";

$getdata = filter_input_array(INPUT_GET);

session_start();

$user_id = $_SESSION["USER_ID"];

try{
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> beginTransaction();

    $sql = "UPDATE USER SET NICKNAME = ? WHERE USER_ID = ?";

    $prepare = $dbh -> prepare($sql);

    $prepare -> bindParam(1, $getdata["upnick"]);

    $prepare -> bindParam(2, $user_id);

    $prepare -> execute();

    if($prepare-> rowCount() == 1){
        $dbh -> commit();

        $sql = "SELECT NICKNAME FROM USER WHERE USER_ID = ?";

        $prepare = $dbh -> prepare($sql);

        $prepare -> bindParam(1, $user_id);

        $prepare -> execute();

        $Uresult = $prepare -> fetch(PDO::FETCH_ASSOC);

        if($Uresult){
            $result["data"] = $Uresult;
            $result["status"] = true;
        }else{
            $result["status"] = false;
        }

    }else{
        $dbh -> rollBack();
        $result["status"] = false;
    }

    $dbh = null ;
    $prepare = null;

}catch (PDOException $e){
    $result["status"] = false;
}

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($result, JSON_UNESCAPED_UNICODE);


?>