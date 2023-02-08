<?php

$dsn = "mysql:dbname=sys2_iesk2bc_a;host=localhost";
$user = "sys2_iesk2bc_a";
$password = "pT9sNfxB";

$result = [
    "status" => false,
    "result" => [],
    "result2" => []
];

try{
    $dbh = new PDO($dsn, $user, $password);

    $where = "";

    $sql = "SELECT * FROM PRODUCT AS P
    JOIN CATEGORY AS C ON C.CATE_NO = P.CATE_NO
    LEFT OUTER JOIN (SELECT PRO_NO AS CATE_PRO_NO FROM FAVORITE WHERE USER_ID = 1) AS F ON F.CATE_PRO_NO = P.PRO_NO";

    $prepare = $dbh -> prepare($sql);

    $prepare -> execute();

    $presult = $prepare -> fetchAll(PDO::FETCH_ASSOC);

    if(isset($presult)){
      $result["result"] = $presult;
      $result["status"] = true;
    }

    $dbh = null ;
    $prepare = null;

    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($result, JSON_UNESCAPED_UNICODE);


}catch (PDOException $e){

}


?>