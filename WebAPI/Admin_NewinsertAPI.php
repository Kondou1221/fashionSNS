<?php

$INSERT_DATA = json_decode($_POST["INSERT_DATA"]);

$result = [
    "status" => true,
    "message" => ""
];

foreach($INSERT_DATA as $i){
    if(trim($i) == ""){
        $result["status"] = false;
    }
}

$dsn = "mysql:dbname=sys2_iesk2bc_a;host=localhost";
$user = "sys2_iesk2bc_a";
$password = "pT9sNfxB";
try{

    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($INSERT_DATA["TABLE"] == "PRODUCT"){
        if(isset($INSERT_DATA["PRO_IMG"])){
            $sql = "INSERT INTO PRODUCT(PRO_NO, PNAME, CATE_NO, PRO_IMG) VALUES(?, ?, ?, ?)";
            $prepare = $dbh -> prepare($sql);
            $prepare -> bindParam(1, $INSERT_DATA["PRO_NO"]);
            $prepare -> bindParam(2, $INSERT_DATA["PNAME"]);        
            $prepare -> bindParam(3, $INSERT_DATA["CATE_NO"]);        
            $prepare -> bindParam(4, $INSERT_DATA["PRO_IMG"]);        
        }else{
            $sql = "INSERT INTO PRODUCT(PRO_NO, PNAME, CATE_NO) VALUES(?, ?, ?)";
            $prepare = $dbh -> prepare($sql);
            $prepare -> bindParam(1, $INSERT_DATA["PRO_NO"]);
            $prepare -> bindParam(2, $INSERT_DATA["PNAME"]);        
            $prepare -> bindParam(3, $INSERT_DATA["CATE_NO"]);        
        }
    }else if($INSERT_DATA["TABLE"] == "PRODUCT_DETAIL"){
        if($INSERT_DATA["PRO_URL"]){
            $sql = "INSERT INTO PRODUCT_DETAIL(PRO_NO, STORE_NO, PRICE, SALE_NOW) VALUES(?, ?, ?, ?)";
            $prepare = $dbh -> prepare($sql);
            $prepare -> bindParam(1, $INSERT_DATA["PRO_NO"]);
            $prepare -> bindParam(2, $INSERT_DATA["STORE_NO"]);        
            $prepare -> bindParam(3, $INSERT_DATA["PRICE"]);        
            $prepare -> bindParam(4, $INSERT_DATA["SALE_NOW"]);        
        }else{
            $sql = "INSERT INTO PRODUCT_DETAIL VALUES(?, ?, ?, ?, ?)";
            $prepare = $dbh -> prepare($sql);
            $prepare -> bindParam(1, $INSERT_DATA["PRO_NO"]);
            $prepare -> bindParam(2, $INSERT_DATA["STORE_NO"]);        
            $prepare -> bindParam(3, $INSERT_DATA["PRICE"]);        
            $prepare -> bindParam(4, $INSERT_DATA["SALE_NOW"]);
            $prepare -> bindParam(5, $INSERT_DATA["PRO_URL"]);           
        }

    }else if($INSERT_DATA["TABLE"] == "CATEGORY"){
        $sql = "INSERT INTO CATEGORY VALUES(?, ?)";
        $prepare = $dbh -> prepare($sql);
        $prepare -> bindParam(1, $INSERT_DATA["CATE_NO"]);
        $prepare -> bindParam(2, $INSERT_DATA["CNAME"]);        
    }else if($INSERT_DATA["TABLE"] == "STORE"){
        if(!isset($INSERT_DATA["STORENAME"])){
            $sql = "INSERT INTO STORE(STORE_NO, SHOPNAME) VALUES(?, ?)";
            $prepare = $dbh -> prepare($sql);
            $prepare -> bindParam(1, $INSERT_DATA["STORE_NO"]);
            $prepare -> bindParam(2, $INSERT_DATA["SHOPNAME"]);            
        }else{
            $sql = "INSERT INTO STORE VALUES(?, ?, ?)";
            $prepare = $dbh -> prepare($sql);
            $prepare -> bindParam(1, $INSERT_DATA["STORE_NO"]);
            $prepare -> bindParam(2, $INSERT_DATA["SHOPNAME"]);            
            $prepare -> bindParam(3, $INSERT_DATA["STORENAME"]);
        }
    }else if($INSERT_DATA["TABLE"] == "USER"){
        if(isset($INSERT_DATA["UIMG"])){
            $sql = "INSERT INTO USER VALUES(?, ?, ?, ?, ?)";
            $prepare = $dbh -> prepare($sql);
            $prepare -> bindParam(1, $INSERT_DATA["USER_ID"]);
            $prepare -> bindParam(2, $INSERT_DATA["PASS_WD"]);        
            $prepare -> bindParam(3, $INSERT_DATA["UNAME"]);        
            $prepare -> bindParam(4, $INSERT_DATA["ROLL"]);
            $prepare -> bindParam(5, $INSERT_DATA["UIMG"]);           
        }else{
            $sql = "INSERT INTO USER(USER_ID, PASS_WD, NICKNAME, ROLL) VALUES(?, ?, ?, ?)";
            $prepare = $dbh -> prepare($sql);
            $prepare -> bindParam(1, $INSERT_DATA["USER_ID"]);
            $prepare -> bindParam(2, $INSERT_DATA["PASS_WD"]);        
            $prepare -> bindParam(3, $INSERT_DATA["UNAME"]);        
            $prepare -> bindParam(4, $INSERT_DATA["ROLL"]);
        }
    }

    $prepare -> execute();


    $result["status"] = true;

    $dbh = null ;
    $prepare = null;

}catch (PDOException $e){
    $result["message"] = "失敗しました".$e->getMessage();

}

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>