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

    $sql = "SELECT * FROM CATEGORY";

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
    <title>Admin_Category</title>
</head>
<body class="bg-gray-50">
    <header><?php require("header.php") ?></header>
<main class="m-4">
    <div class="w-11/12 m-auto my-1">カテゴリ表</div>
    <div class="overflow-y-scroll h-96">
        <table class="overflow-auto border-separate border border-green-800 m-auto w-11/12">
            <thead>
                <tr class="sticky top-0 left-0 bg-red-700">
                    <th class="border border-green-800 "></th>
                    <th class="border border-green-800 ">カテゴリ番号</th>
                    <th class="border border-green-800 ">カテゴリ名</th>
                    <th class="border border-green-800 "></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result["result"] as $r): ?>
                    <tr>
                        <td class="border border-green-800 text-center"><input type="checkbox" class="delete_check" name="<?= $r["CATE_NO"] ?>"></td>
                        <td class="border border-green-800"><?= $r["CATE_NO"] ?></td>
                        <td class="border border-green-800"><?= $r["CNAME"] ?></td>
                        <td class="border border-green-800 text-center"><a href="">詳細</a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <div id="overlay" class="fixed top-0 left-0 w-full h-screen bg-gray-800 opacity-0 invisible delay-[.3s]"></div>

    <div id="modal" class="bg-gray-50 max-w-lg w-4/5 h-5/6 py-4 px-5 fixed top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] opacity-0 invisible delay-[.3s]">
        <div class="m-auto text-center">
            <p id="modal_text">変更中</p>
            <button id="close_btn">閉じる</button>
        </div>
    </div>

    <div class="flex justify-between items-center m-auto my-4 w-11/12">
        <div class=""><input type="button" id="delete_button" value="削除"></div>
        <div class=""><input type="button" id="Insert_button" value="新規登録"></div>      
    </div>
</main>
<script src="js/Admin_Category.js"></script>
</body>
</html>