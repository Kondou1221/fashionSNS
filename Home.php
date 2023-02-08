<?php
/****************************
 * ファイル名：Home.php
 * 
 * @author 近藤　佑亮
 * @package IE1B
 * 
*****************************/

session_start();

if(isset($_SESSION["USER_ID"])){
  $USER_ID = $_SESSION["USER_ID"];
}

$postdata = filter_input_array(INPUT_POST);

$dsn = "mysql:dbname=sys2_iesk2bc_a;host=localhost";
$user = "sys2_iesk2bc_a";
$password = "pT9sNfxB";

$result = [
    "status" => false,
    "result" => [],
];

try{
    $dbh = new PDO($dsn, $user, $password);

    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $where = "";

    if(isset($postdata["search_word"]) && $postdata["search_word"]){

      $where .= "WHERE P.PNAME LIKE '%{$postdata["search_word"]}%'";

    }else{

      if(isset($postdata["search_category"]) && $postdata["search_category"] != ""){

        $where .= "WHERE P.CATE_NO = {$postdata["search_category"]}";

      }

    }

    if(!isset($USER_ID)){

      $sql = "SELECT * FROM PRODUCT AS P
              JOIN CATEGORY AS C ON C.CATE_NO = P.CATE_NO
              {$where}
              ORDER BY P.PRO_NO";

      $prepare = $dbh -> prepare($sql);

      $prepare -> execute();

      $Presult = $prepare -> fetchAll(PDO::FETCH_ASSOC);

    }else{

      $sql = "SELECT * FROM PRODUCT AS P
              JOIN CATEGORY AS C ON C.CATE_NO = P.CATE_NO
              LEFT OUTER JOIN (SELECT PRO_NO AS CATE_PRO_NO FROM FAVORITE WHERE USER_ID = $USER_ID) AS F ON F.CATE_PRO_NO = P.PRO_NO
              {$where}
              ORDER BY P.PRO_NO";

      $prepare = $dbh -> prepare($sql);

      $prepare -> execute();
  
      $Presult = $prepare -> fetchAll(PDO::FETCH_ASSOC);
  
    }

    if(isset($Presult)){

      $result["result"] = $Presult;

      $result["status"] = true;

    }

    $sql = "SELECT * FROM CATEGORY";

    $prepare = $dbh -> prepare($sql);

    $prepare -> execute();

    $Cresult = $prepare -> fetchAll(PDO::FETCH_ASSOC);

    if(isset($Cresult)){
      $result["Cresult"] = $Cresult;
    }

    $dbh = null ;
    $prepare = null;

}catch (PDOException $e){

  exit($e->getCode()." : ".$e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">  
    <title>Home</title>
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/Home.css">
</head>
<body>
  <header>
    <div><?php include("sidebar.php"); ?></div>
  </header>
  <main>
    <dialog id="login_dialog">
      <p>ログインしてください</p>
      <button id="close">閉じる</button>
    </dialog>

    <?php if( isset($USER_ID) ): ?>
      <input type="hidden" id="uid" value="<?= $USER_ID ?>">
    <?php endif ?>

        <!-- 検索ボックス -->
      <form action="" method="post">
        <div id="serch_content">
          <div id="search_checkbox">
            <select name="search_category">
              <option value="">すべて</option>
                  <?php foreach($result["Cresult"] as $c): ?>
                    <option value="<?= $c["CATE_NO"] ?>"><?= $c["CNAME"] ?></option>
                  <?php endforeach ?>
            </select>
          </div>

          <div>
            <input type="search" id="searchbox" name="search_word" placeholder="商品名を入力">
            <input type="submit" value="検索">
          </div>
        </div>
      </form>
    
    <div id="main_content">
        <div id="product_show">
          <?php foreach($result["result"] as $r): ?>
            <div class="product_item">
                <div class="image_wrap">
                  <a href="PDetail.php?pro_no=<?= $r["PRO_NO"] ?>"><img src="RollImage/<?= $r["PRO_IMG"] ?>" class="pro_img"></a>
                </div>

                <div class="info_wrap">
                    <div class="name">
                      <a href="PDetail.php?pro_no=<?= $r["PRO_NO"] ?>" class="name_url"><?= $r["PNAME"] ?></a>
                    </div>

                    <?php if( isset($r["CATE_PRO_NO"]) && $r["PRO_NO"] == $r["CATE_PRO_NO"]): ?>
                      <div class="fav">
                        <img src="RollImage/Favorite_Now.png" class="fav_img" name="<?= $r["PRO_NO"] ?>">
                        <input type="hidden" class="fav_value" value="1">
                      </div>
                    <?php else: ?>
                      <div class="fav">
                        <img src="RollImage/Favorite.png" class="fav_img" name="<?= $r["PRO_NO"] ?>">
                        <input type="hidden" class="fav_value" value="0">
                      </div>
                    <?php endif ?>
                    <input type="hidden" class="pro_no" value="<?= $r["PRO_NO"] ?>">
                </div>

                <div class="category">
                  <p><?= $r["CNAME"] ?></p>
                </div>
            </div>
          <?php endforeach ?>    
        </div>
    </div>

  </main>
  <script src="js/Home.js"></script>
</body>
</html>
