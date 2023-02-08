<?php

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

    $sql = "SELECT * FROM PRO_DETAIL AS D
            JOIN PRODUCT AS P ON P.PRO_NO = D.PRO_NO
            JOIN STORE AS S ON D.STORE_NO = S.STORE_NO";

    $prepare = $dbh -> prepare($sql);

    $prepare -> execute();

    $kekka = $prepare -> fetchAll(PDO::FETCH_ASSOC);

    $result["result"] = $kekka;
    $result["status"] = true;

    $dbh = null ;
    $prepare = null;

}catch (PDOException $e){
  exit("読み込みに失敗しました リロードしてください");
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin_PRO_DETAIL</title>
</head>
<body class="bg-gray-50">
    <header><?php require("header.php") ?></header>
<main class="m-4">
    <div class="w-11/12 m-auto my-1">商品詳細表</div>
    <div class="overflow-y-scroll h-96">
        <table class="overflow-auto border-separate border border-green-800 m-auto w-11/12">
            <thead>
                <tr class="z-10 sticky top-0 left-0 z-10 bg-red-700">
                    <th class="border border-green-800 "></th>
                    <th class="border border-green-800 ">商品名</th>
                    <th class="border border-green-800 ">店舗名</th>
                    <th class="border border-green-800 ">値段</th>
                    <th class="border border-green-800 ">セール状況</th>
                    <th class="border border-green-800 ">商品のホームページ</th>
                    <th class="border border-green-800 "></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result["result"] as $r): ?>
                    <tr>
                        <td class="border border-green-800 text-center"><input type="checkbox" class="delete_check" name="<?= $r["PRO_NO"].$r["STORE_NO"] ?>"></td>
                        <td class="border border-green-800"><?= $r["PNAME"] ?></td>
                        <td class="border border-green-800"><?= $r["SHOPNAME"]." : ".$r["STORENAME"] ?></td>
                        <td class="border border-green-800"><?= $r["PRICE"] ?></td>
                        <td class="border border-green-800"><?= $r["SALE_NOW"] ?></td>
                        <td class="border border-green-800"><?= $r["PRO_URL"] ?></td>
                        <td class="border border-green-800 text-center"><a href="">詳細</a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="flex justify-between items-center m-auto my-4 w-11/12">
        <div class=""><input type="button" value="削除"></div>
        <div class=""><input type="button" id="delete_button" value="新規登録"></div>      
    </div>
</main>
<script src="js/Admin_Product.js"></script>
</body>
</html>