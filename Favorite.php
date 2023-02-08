<?php
/****************************
 * ファイル名：MyPage.php
 * 
 * @author 近藤　佑亮
 * @package IE1B
*****************************/

session_start();

if(!isset($_SESSION["USER_ID"])){
  header("Location: login_form.php");
}

$user_id = $_SESSION["USER_ID"];

$dsn = "mysql:dbname=sys2_iesk2bc_a;host=localhost";
$user = "sys2_iesk2bc_a";
$password = "pT9sNfxB";

$result = [
  "status" => false,
  "result" => []
];

try{
    $dbh = new PDO($dsn, $user, $password);

    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM FAVORITE AS F
            JOIN PRODUCT AS P ON F.PRO_NO = P.PRO_NO
            JOIN CATEGORY AS C ON P.CATE_NO = C.CATE_NO
            WHERE F.USER_ID = ?";

    $prepare = $dbh -> prepare($sql);

    $prepare -> bindParam(1, $user_id);

    $prepare -> execute();

    $kekka = $prepare -> fetchAll(PDO::FETCH_ASSOC);

    if(1==1){
      $result["result"] = $kekka;
      $result["status"] = true;
    }

    $dbh = null ;
    $prepare = null;

}catch (PDOException $e){
  exit("読み込みに失敗しました");
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">  
    <title>Home</title>
    <link rel="stylesheet" href="css/Favorite.css">
    <link rel="stylesheet" href="css/sidebar.css">
  </head>
<body>
  <header>
    <div><?php include("sidebar.php"); ?></div>
  </header>
  <main>
    <div id="main_content">
      <?php foreach($result["result"] as $r): ?>
        <div id="Favorite_item">
          <div class="Image_wrap">
              <img class="Pro_image" src="RollImage/<?= $r["PRO_IMG"] ?>">
          </div>

          <div class="Product_Content">
            <div class="Product_Name">
                <p><?= $r["PNAME"] ?></p>
            </div>
            <div class="Product_Description">
                ここには商品の説明文が入ります。<br>
                今回は、ＤＢに登録できていないため、ベタ打ちの文章となります。
            </div>
            <div class="Product_Category">
                  <p><?= $r["CNAME"] ?></p>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </main>
  <script src="js/Favorite.js"></script>
</body>
</html>
