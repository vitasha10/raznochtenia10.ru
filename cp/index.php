<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>raznochtenia10.ru</title>
    
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="style1.css" rel="stylesheet">

</head>

<body id="page-top">

<?php
if(!isset($_COOKIE['userid'])){
    echo '<h1>Не авторизован</h1>';
    echo '<meta http-equiv="refresh" content="0;URL=/login">';
}else{
    $link = mysqli_connect('localhost','n902839i_root','rootroot','n902839i_root'); // Соединяемся с базой
    // Ругаемся, если соединение установить не удалось
    if (!$link) {
        echo 'Не могу соединиться с БД. Код ошибки: '.mysqli_connect_errno().', ошибка: '.mysqli_connect_error();
        exit;
    }
    date_default_timezone_set('Asia/Yekaterinburg');//выбираем часовой пояс
    $date=date("20y-m-d H:i:s");
    
    //запросы к бд
    $sql1 = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `peoples` WHERE `userid`='{$_COOKIE['userid']}'"));
    $result = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `peoples` WHERE `userid`='{$_COOKIE['userid']}'"));
    $version = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `_server_` WHERE `name`='version'"));
    $news = mysqli_fetch_array(mysqli_query($link, "SELECT `data` FROM `_server_` WHERE `name`='news'"));
    


    
    
    //Редактируем профиль
    if (isset($_POST["pass2"])) {
        $sql = mysqli_query($link, "UPDATE `peoples` SET `name`='{$_POST['name2']}', `pass` = '{$_POST['pass2']}', `ava` = '{$_POST['ava1']}',`birthday`='{$_POST['birthday1']}',`vk` = '{$_POST['vk1']}',`dis` = '{$_POST['dis1']}',`tg` = '{$_POST['tg1']}' WHERE `userid`={$_COOKIE['userid']}");
    }
    
    
    
    //Редактор всех профилей    
    //Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT `userid`, `name`, `pass`, `priv`, `ava` FROM `peoples` WHERE `userid`={$_GET['red_id']}");
      $product = mysqli_fetch_array($sql);
    }
   

    //запросы к бд
    $sql1 = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `peoples` WHERE `userid`='{$_COOKIE['userid']}'"));
    $result = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `peoples` WHERE `userid`='{$_COOKIE['userid']}'"));
echo"



<nav class='navbar navbar-expand navbar-dark bg-dark static-top'>

    <a class='navbar-brand mr-1' href='http://raznochtenia10.ru/cp'>raznochtenia10.ru</a>
    
    <button class='btn btn-link btn-sm text-white order-1 order-sm-0' id='sidebarToggle' href='#'>
        <i class='fas fa-bars'></i>
    </button>
    
</nav>
    
<div id='wrapper'>

    <!-- Sidebar -->
    <ul class='sidebar navbar-nav'>
        <li class='nav-item active'>
            <a class='nav-link' href='index.php'>
                <i class='fas fa-fw fa-tachometer-alt'></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class='nav-item dropdown'>
            <a class='nav-link dropdown-toggle' href='#' id='pagesDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                <i class='fas fa-fw fa-folder'></i>
                <span>Pages</span>
            </a>
            <div class='dropdown-menu' aria-labelledby='pagesDropdown'>
            <!--
                <h6 class='dropdown-header'>Login Screens:</h6>
                <a class='dropdown-item' href='login.html'>Login</a>
                <a class='dropdown-item' href='register.html'>Register</a>
                <a class='dropdown-item' href='forgot-password.html'>Forgot Password</a>
                <div class='dropdown-divider'></div>
                <h6 class='dropdown-header'>Other Pages:</h6>
            -->    
                <a class='dropdown-item' href='my.php'>Профиль</a>
                <a class='dropdown-item' href='galery.php'>Гелерея</a>
            </div>
        </li>
        <!--
        <li class='nav-item'>
            <a class='nav-link' href='charts.html'>
                <i class='fas fa-fw fa-chart-area'></i>
                <span></span>
            </a>
        </li>
        -->
        <li class='nav-item'>
            <a class='nav-link' href='http://raznochtenia10.ru/cp/messenger.php'>
                <i class='fas fa-fw fa-table'></i>
                <span>Мессенджер</span>
            </a>
        </li>
    </ul>


    <div id='content-wrapper'>
        <div class='container-fluid'>
            <!-- ===============================================================
            ==========================================================
            ==============================================================
            ===============================================================-->";
            echo $news['data'];
            echo"
            <!--===========================================================-->
            <footer class='sticky-footer'>
                <div class='container my-auto'>
                    <div class='copyright text-center my-auto'>
                        <span>Copyright © Your Website 2019. Version: {$version['data']} {$version['dop1']}</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class='scroll-to-top rounded' href='#page-top'>
    <i class='fas fa-angle-up'></i>
</a>";
}
?>


<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Page level plugin JavaScript-->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>
<!-- Demo scripts for this page-->
<script src="js/demo/datatables-demo.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
</body>
</html>