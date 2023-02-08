<!-- <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="sidebar.css">
</head>

<body> -->
    <div class="header"></div>
    <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
    <label for="openSidebarMenu" class="sidebarIconToggle">
        <div class="spinner diagonal part-1"></div>
        <div class="spinner horizontal"></div>
        <div class="spinner diagonal part-2"></div>
    </label>
    <div id="sidebarMenu">
        <ul class="sidebarMenuInner">
            <li><a href="Home" target="_blank">HOME</a></li>
            <li><a href="Favorite" target="_blank">お気に入り</a></li>
            <li><a href="MyPage" target="_blank">マイページ</a></li>
            <li><a href="login.php" target="_blank">ログイン</a></li>
            <li><a href="logout" target="_blank">ログアウト</a></li>
            <?php if ( isset($_SESSION['ROLL']) && ($_SESSION['ROLL']) == 1) : ?>
                <li><a href=Roll.php>管理者</a></li>
            <?php endif; ?>
        </ul>
    </div>
<!-- </body>

</html> -->