<?php

$dsn = "mysql:dbname=sys2_iesk2bc_a;host=localhost";
$user = "sys2_iesk2bc_a";
$password = "pT9sNfxB";

session_start();

if(isset($_FILES["Prof_Img"])){

    $save = "../Uimage/" . $_FILES["Prof_Img"]["name"];

    if(move_uploaded_file($_FILES['Prof_Img']['tmp_name'], $save)){

        $After_Img = $_FILES["Prof_Img"]["name"];

        $user_id = $_SESSION["USER_ID"];

        try{
            $dbh = new PDO($dsn, $user, $password);

            $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $dbh -> beginTransaction();

            $sql = "UPDATE USER SET PRO_IMG = ? WHERE USER_ID = ?";

            $prepare = $dbh -> prepare($sql);

            $prepare -> bindParam(1, $After_Img);

            $prepare -> bindParam(2, $user_id);

            $prepare -> execute();

            if($prepare-> rowCount() == 1){
                $dbh -> commit();
            }else{
                $dbh -> rollBack();
            }

            $dbh = null ;
            $prepare = null;

        }catch (PDOException $e){
        }

        header("Location: ../MyPage.php");
    }else{
        echo "失敗";
    }

}

?>