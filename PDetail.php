<?php
/****************************
 * ファイル名：PDetail.php
 * 
 * @author 近藤　佑亮
 * @package IE1B
*****************************/

session_start();

$dsn = "mysql:dbname=sys2_iesk2bc_a;host=localhost";
$user = "sys2_iesk2bc_a";
$password = "pT9sNfxB";

$result = [
  "status" => [
    "product" => false,
    "store" => false,
    "review" => false
  ],
  "product" => [],
  "store" => [],
  "review" => []
];

$getdata = filter_input_array(INPUT_GET);

if(!isset($getdata)){
  header("Location: Home.php");
}

try{
    $dbh = new PDO($dsn, $user, $password);

    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM PRODUCT AS P 
            JOIN CATEGORY AS C ON P.CATE_NO = C.CATE_NO 
            WHERE P.PRO_NO = ?";

    $prepare = $dbh -> prepare($sql);

    $prepare -> bindParam(1, $getdata["pro_no"]);

    $prepare -> execute();

    $kekka = $prepare -> fetchAll(PDO::FETCH_ASSOC);

    if($kekka){
      $result["product"] = $kekka;
      $result["status"]["product"] = true;
    }

    $sql = "SELECT * FROM PRO_DETAIL AS D
            JOIN STORE AS S ON S.STORE_NO = D.STORE_NO 
            WHERE D.PRO_NO = ?";

    $prepare = $dbh -> prepare($sql);

    $prepare -> bindParam(1, $getdata["pro_no"]);

    $prepare -> execute();

    $kekka = $prepare -> fetchAll(PDO::FETCH_ASSOC);

    if($kekka){
      $result["store"] = $kekka;
      $result["status"]["store"] = true;
    }

    $sql = "SELECT * FROM REVIEW AS R
            JOIN USER AS U ON R.USER_ID = U.USER_ID
            WHERE PRO_NO = ?
            LIMIT 5";

    $prepare = $dbh -> prepare($sql);

    $prepare -> bindParam(1, $getdata["pro_no"]);

    $prepare -> execute();

    $kekka = $prepare -> fetchAll(PDO::FETCH_ASSOC);

    if($kekka){
      $result["review"] = $kekka;
      $result["status"]["review"] = true;
    }

    $dbh = null ;
    $prepare = null;

}catch (PDOException $e){
  header("Location: Home.php");
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <link rel="stylesheet" href="css/PDetail.css">
  <link rel="stylesheet" href="css/sidebar.css">
</head>
<body>
  <header>
    <div><?php include("sidebar.php"); ?></div>
  </header>

  <main>
    <div id="Product_Detail">
        <div id="Top_flex">
          <div id="Product_Img">
              <img id="Product_Img_Tagu" src="RollImage/<?= $result["product"][0]["PRO_IMG"] ?>" >
          </div>

          <div id="Product_Content">
            <div id="Product_Name">
              <p><?= $result["product"][0]["PNAME"] ?></p>
            </div>
            <div id="Product_Description">
              ここには商品の説明文が入ります。<br>
              今回は、ＤＢに登録できていないため、ベタ打ちの文章となります。
            </div>
            <div id="Product_Category">
                <p><?= $result["product"][0]["CNAME"] ?></p>
            </div>
          </div>
        </div>

        <section id="Product_Section">
          <?php foreach($result["store"] as $r): ?>
            <div class="Product_store">
              <?php if($r["SALE_NOW"] == 1): ?>
                <div class="Store_info">
                  <p><?= $r["SHOPNAME"] ?> / <?= $r["STORENAME"] ?>  <p class="Sale_Now">セール中</p> </p>
                </div>
              <?php else: ?>
                <div class="Store_info">
                  <p><?= $r["SHOPNAME"] ?> / <?= $r["STORENAME"] ?></p>
                </div>
              <?php endif ?>
              <div class="Store_Price">
                  <p><?= $r["PRICE"] ?></p>
              </div>
              <div class="Store_URL">
                  <a href="<?= $r["PRO_URL"] ?>"><?= $r["PRO_URL"] ?></a>
              </div>
            </div>
          <?php endforeach ?>
        </section>


        <div id="Product_Review">
          <div id="Review_Option">
              <div id="Insert_Review">
                  <form method="post" action="RWrite.php">
                      <input type="hidden" name="PRO_NO" value="<?= $getdata["pro_no"] ?>">
                      <button type="submit" id="Insert_Review_button">レビュ新規作成</button>
                  </form>
              </div>
              <div id="Serect_Review">
                  <form method="post" action="Rlist.php">
                      <input type="hidden" name="PRO_NO" value="<?= $getdata["pro_no"] ?>">
                      <button type="submit" id="Serect_Review_button">レビュー一覧</button>
                  </form>
              </div>
          </div>

          <?php foreach($result["review"] as $r): ?>
            <div class="Review_items">
                  <div class="User_info">
                      <div class="Profile_img">
                          <img class="Profile_img_Tagu" src="Uimage/<?=$r['PRO_IMG'] ?>">
                      </div>
                      <div class="User_Name">
                        <?= $r['NICKNAME'] ?>
                      </div>
                      <div class="Create_Now">
                        <?= $r['CREATE_NOW'] ?>
                      </div>
                  </div>
                  <div class="Review_contents">
                      <div class="Review_img">
                          <img src="Rimage/<?=$r['IMG_RNAME'] ?>" class="Review_img_Tagu" alt="">
                      </div>
                      <div class="Review_content">
                        <?php if($r['Review_GB'] == 0): ?>
                          <div class="Review_Evaluation">
                            <span>低評価</span>
                          </div>
                        <?php else: ?>
                          <div class="Review_Evaluation">
                            <span>高評価</span>
                          </div>                        
                        <?php endif ?>
                        <div class="Review_Sentence">
                          <?=$r['RCONTENT'] ?>
                        </div>
                      </div>
                  </div>
            </div>
          <?php endforeach ?>
        </div>
    </div>
  </main>
</body>
</html>