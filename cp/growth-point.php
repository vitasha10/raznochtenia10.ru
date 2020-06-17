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
    <link href="style.css" rel="stylesheet">
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
    if(isset($_FILES) && $_FILES['inputfile']['error'] == 0 && $_FILES['inputfile']['name']!=''){
        $destiation_dir = dirname(__FILE__) ."/galery/{$_FILES['inputfile']['name']}"; // Директория для размещения файла
        move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir ); // Перемещаем файл в желаемую директорию
        $sql = mysqli_query($link, "INSERT INTO `galery` (`data`) VALUES ('http://raznochtenia10.ru/cp/galery/{$_FILES['inputfile']['name']}')");
    }
    //Удаляем сообщение
    if (isset($_POST['dell_zad'])) {
        $sql = mysqli_query($link, "DELETE FROM `galery` WHERE `id`='{$_POST['dell_zad']}'");
        if ($sql) {
            //Удаление успешно
        }else{
            echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
        }
    }  
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
        <li class='nav-item'>
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
                <a class='dropdown-item ' href='my.php'>Профиль</a>
                <a class='dropdown-item active' href='galery.php'>Гелерея</a>
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
    echo "
    <form method='post' action='' enctype='multipart/form-data'>
        <table>
          <tr>
            <input class='small_btn123' type='file' id='inputfile' name='inputfile'>
          </tr>
          <tr>
            <input class='small_btn123' type='submit' value='Загрузить любой файл'>
          </tr>
        </table>
    </form>
    <table border='1'>
        <tr>
          <td>Картинка</td>
          <td>Удалить</td>
        </tr>";
            $sql = mysqli_query($link, "SELECT * FROM `galery`");
            while ($result = mysqli_fetch_array($sql)) { 
                echo '<tr>' .
                     "<td><img class='img1313' alt='' src='{$result['data']}'></td>" .
                     "<td><form method='post' action=''>
                              <input type='hidden' name='dell_zad' value='{$result['id']}'>
                              <input class='small_btn123' type='submit' value='Удалить'>
                          </form>".
                     "</tr>";
            }
        echo "
        </table>";

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
</a>


";
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