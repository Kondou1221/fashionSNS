<?php

// define( "DB_HOST", "localhost" );
// define( "DB_USER", "sys2_iesk2bc_a" );
// define( "DB_PASS", "pT9sNfxB" );
// define( "DB_NAME", "sys2_iesk2bc_a" );
// define( "DB_CHARSET", "utf8mb4" );

// $result = [
//     "status" => false,
//     "message" => "システムエラー",
//     "result" => []
// ];

// $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// if($mysqli -> connect_error){
//     header("Content-Type: application/json; charset=UTF-8");
//     echo json_encode($result, JSON_UNESCAPED_UNICODE);
// }

// $mysqli -> set_charset(DB_CHARSET);


// // $USER_ID = $_SESSION["userid"];

// // $pro_no = filter_input_array(INPUT_GET, "pro_no");

// // sql文の作成
// // $sql = "INSERT INTO FAVORIRE VALUES ('{$USER_ID}', '{$pro_no}') ";
// $sql = "INSERT INTO FAVORIRE VALUES (2, 5) ";


// $stmt = mysqli_prepare($mysqli, $sql);

// if(mysqli_stmt_execute($stmt)){
//     $result = [
//         "status" => false,
//         "message" => "お気に入り登録に失敗しました"
//     ];
// }

// mysqli_stmt_close($stmt);

// mysqli_close($mysqli);

// $result["status"];

$dsn = "mysql:dbname=sys2_iesk2bc_a;host=localhost";
$user = "sys2_iesk2bc_a";
$password = "pT9sNfxB";

$getdata = filter_input_array(INPUT_GET);

session_start();

$user_id = $_SESSION["USER_ID"];

try{
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> beginTransaction();

    if($getdata["SQL"] == "I"){
        $sql = "INSERT INTO FAVORITE VALUES(?,?)";
    }else{
        $sql = "DELETE FROM FAVORITE WHERE PRO_NO = ? AND USER_ID = ?";
    }

    $prepare = $dbh -> prepare($sql);

    $prepare -> bindParam(1, $getdata["pro_no"]);

    $prepare -> bindParam(2, $user_id);

    $prepare -> execute();

    if($prepare-> rowCount() == 1){
        $dbh -> commit();
        $result["status"] = true;
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