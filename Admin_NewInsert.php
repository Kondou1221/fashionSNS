<?php

$dsn = "mysql:dbname=sys2_iesk2bc_a;host=localhost";
$user = "sys2_iesk2bc_a";
$password = "pT9sNfxB";

$result = [
    "PRODUCT" => [],
    "CATEGORY" => [],
    "STORE" => []
  ];  

$getdata = filter_input_array(INPUT_GET);

if(!isset($getdata)){
    $h = $_SERVER["HTTP_HOST"];
    $r = $_SERVER["HTTP_REFERER"];
    if(!empty($r) && strpos($r,$h) !== false){
        header("Location: ", $r);
    }
}

try{

    $dbh = new PDO($dsn, $user, $password);

    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($getdata["TABLE"] == "PRODUCT_DETAIL"){

        //商品表から情報を取る

        $sql = "SELECT * FROM PRODUCT";

        $prepare = $dbh -> prepare($sql);

        $prepare -> execute();
  
        $Presult = $prepare -> fetchAll(PDO::FETCH_ASSOC);

        $result["PRODUCT"] = $Presult;

        //店表から情報を取る

        $sql = "SELECT * FROM STORE";

        $prepare = $dbh -> prepare($sql);

        $prepare -> execute();
  
        $Sresult = $prepare -> fetchAll(PDO::FETCH_ASSOC);

        $result["STORE"] = $Sresult;
  
    }else if($getdata["TABLE"] == "PRODUCT"){

        //カテゴリ表から情報を取る

        $sql = "SELECT * FROM CATEGORY";

        $prepare = $dbh -> prepare($sql);

        $prepare -> execute();
    
        $Cresult = $prepare -> fetchAll(PDO::FETCH_ASSOC);

        $result["CATEGORY"] = $Cresult;

    }

}catch(PDOException $e){
    exit($e->getCode()." : ".$e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin_Newinsert</title>
</head>
<body class="bg-gray-50">
    <header><?php require("header.php") ?></header>
<main class="m-4">
    <input type="hidden" id="table_kind" value="<?= $getdata["TABLE"] ?>">
    <div class="text-center mt-10 bg-red-400">
        <?php if($getdata["TABLE"] == "CATEGORY"):?>
            <!-- カテゴリ新規作成 -->
            <div class="my-1">
                <p class="my-0.5">カテゴリ新規登録</p>
                <input type="text" class="border border-gray-900 rounded-lg" id="CNAME" placeholder="カテゴリ名を入力してください" required>
            </div>
        <?php elseif($getdata["TABLE"] == "PRODUCT_DETAIL"): ?>
            <!-- 商品詳細新規作成 -->
            <div class="my-1">
                <p class="my-0.5">商品詳細新規登録</p>
                <div class="flex justify-evenly my-10">
                    <select class="w-2/5 text-center border border-gray-900 rounded-lg" id="PRO_NO">
                        <option value=""> 1 : 商品名 </option>
                    </select>
                    <select class="w-2/5 text-center border border-gray-900 rounded-lg" id="STORE_NO">
                        <option value=""> 1 : 店舗名 / 支店名 </option>
                    </select>
                </div>
                <div class="flex justify-evenly">
                    <div>
                        <p class="my-0.5">値段を入力してください <span>＊必須</span></p>
                        <input type="number" class="my-0.5 w-10/12 border border-gray-900 rounded-lg" id="PRICE" min=0 max=99999999 value="0" placeholder="値段を入力してください" required>
                    </div>
                    <div class="w-1/4">
                        <p class="my-0.5 m-auto w-10/12">セールの有無</p>
                        <select class="my-0.5 w-10/12 text-center border border-gray-900 rounded-lg" id="SALE_NOW">
                            <option value="0">セールなし</option>
                            <option value="1">セール中</option>
                        </select>
                    </div>
                    <div>
                        <p class="my-0.5">商品URL</p>
                        <input type="url" class="my-0.5 border border-gray-900 rounded-lg" id="PRO_URL" placeholder="URLを入力してください">
                    </div>
                </div>
            </div>
        <?php elseif($getdata["TABLE"] == "PRODUCT"): ?>
            <!-- 商品新規作成 -->
            <div class="my-1">
                    <input type="text" class="my-2 border border-gray-900 rounded-lg" id="PNAME" maxlength="30" placeholder="商品名を入力してください" required>
                <div class="my-2">
                    <select class="w-2/5 text-center border border-gray-900 rounded-lg" id="CATE_GORY">
                        <option value=""> 1 : カテゴリ名 </option>
                    </select>
                    <select class="w-2/5 text-center border border-gray-900 rounded-lg" id="STORE_NO">
                        <option value=""> 1000 : 店舗名 / 支店名 </option>
                    </select>
                </div>
                <p>商品写真</p>
                <div class="h-28 flex justify-center justify items-center">
                    <img class="h-4/5 object-cover" id="PRO_IMG_PLASE" src="" style="display: none;">
                    <input type="file" class="mx-2" id="PRO_IMG">
                </div>
            </div>
        <?php elseif($getdata["TABLE"] == "STORE"): ?>
            <!-- 店新規作成 -->
            <div>
                <div class="text-center my-2 pt-2" id="INSE_STORE_div">
                    <div class="my-1">
                        <select class="text-center my-1 border border-gray-900 rounded-lg" id="STORE_NO_SHOP">
                            <option value=""> 1000 : 店の名前 </option>
                        </select>
                    </div>
                    <div class="my-1">
                        <p>支店名を入力してください</p>
                        <input type="text" class="my-1 border border-gray-900 rounded-lg" id="STORENAME" placeholder="支店名を入力してください">
                    </div>
                </div>
                <div class="text-center my-2 pt-2" id="INSE_SHOP_div" style="display: none;">
                    <div class="my-2">
                        <p class="mt-2">お店番号</p>
                        <input type="number" class="w-44 my-2 text-center border border-gray-900 rounded-lg" id="STORE_NO_STORE" min="1000" max="999000" value="1000" step="1000">
                    </div>
                    <div>
                        <p>お店の名前(25字以内)</p>
                        <input type="text" class="border border-gray-900 rounded-lg" id="SHOPNAME" maxlength="25" placeholder="お店の名前(25字以内)">
                    </div>
                </div>

                <input type="button" class="border-2 border-gray-900 rounded-lg bg-blue-600" id="INSE_SHOP" style="display: none;" value="店の新規登録">
                <input type="button" class="border-2 border-gray-900 rounded-lg bg-blue-600" id="INSE_STORE" value="支店の新規登録">

            </div>
        <?php elseif($getdata["TABLE"] == "USER"): ?>
            <!-- ユーザー新規作成 -->
            <div class="pt-2" >
                <div class="flex justify-evenly">
                    <div class="w-2/5">
                        <p>ユーザーIDを入力してください</p>
                        <input type="number" class="w-5/6 border border-gray-900 rounded-lg" id="USER_ID" maxlength="6" placeholder="ユーザーIDを入力してください">
                    </div>
                    <div class="w-2/5">
                        <p>パスワードを入力してください</p>
                        <input type="text" class="w-5/6 border border-gray-900 rounded-lg" id="PASS_WD" maxlength="14" placeholder="パスワードを入力してください">
                    </div>
                </div>
                <div class="my-2">
                    <p>ニックネームを入力してください(15字以内)</p>
                    <input type="text" class="border border-gray-900 rounded-lg" id="UNAME" maxlength="15" placeholder="ニックネームを入力してください">
                </div>
                <div class="flex justify-center">
                    <input type="checkbox" id="ROLL">
                    <p>管理者</p>
                </div>
                <p>プロフィール写真</p>
                <div class="h-28 flex justify-center items-center">
                    <img class="h-4/5 object-cover" id="UIMG_PLASE" src="" style="display: none;">
                    <input type="file" class="mx-2" id="UIMG">
                </div>
            </div>
        <?php endif ?>
        <!-- 新規作成決定ボタン -->
        <div class="my-2">
            <input type="button" class="w-11 my-2 border-2 border-gray-900 rounded-lg bg-red-600" id="Insert_button" value="登録">
        </div>
    </div>
    <!-- モーダルウィンドウ -->
    <div id="overlay" class="fixed top-0 left-0 w-full h-screen bg-gray-800 opacity-0 invisible delay-[.3s]"></div>

    <div id="modal" class="bg-gray-50 max-w-lg w-4/5 h-5/6 py-4 px-5 fixed top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] opacity-0 invisible delay-[.3s]">
        <div class="m-auto text-center">
            <p id="modal_text">変更中</p>
            <button id="agin_btn">次の登録をする</button>
            <button id="close_btn">閉じる</button>
        </div>
    </div>

    <script src="js/Admin_Newinsert.js"></script>
</main>
</body>
</html>