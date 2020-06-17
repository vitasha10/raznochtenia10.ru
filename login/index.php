<?php
    
    $host = 'localhost';  // Хост, у нас все локально
    $user = 'n902839i_root';    // Имя созданного вами пользователя
    $pass = 'rootroot'; // Установленный вами пароль пользователю
    $db_name = 'n902839i_root';   // Имя базы данных
    $link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой
    
    // Ругаемся, если соединение установить не удалось
    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }

 
    $result2=$_COOKIE['userid'];

    
    
    //Если переменная ID передана
    if (isset($_POST["name1"])) {
        $result1=mysqli_fetch_array(mysqli_query($link, "SELECT `userid` FROM `peoples` WHERE `peoples`.`name`='{$_POST['name1']}'"));
        $result = mysqli_fetch_array(mysqli_query($link, "SELECT `pass` FROM `peoples` WHERE `peoples`.`name`='{$_POST['name1']}'"));
        if ($result['pass']!="" and $_POST["Pass"]==$result['pass']){
            
            $result2=$result1["userid"];
            setcookie('userid', $result1["userid"], time()+86400, '/');
            echo '<meta http-equiv="refresh" content="0;URL=/cp">';
            
        }
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="style.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="name1" id="inputEmail" class="form-control" placeholder="Login" required="required" autofocus="autofocus">
              <label for="inputEmail">Имя</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="Pass" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Пароль</label>
            </div>
          </div>
          <input type="submit" class="btn btn-primary btn-block" value='Login'>
        </form>
        <div class="text-center">
        <?php
		//Если переменная ID передана
        if (isset($_POST["name1"])) {
            
            $result1=mysqli_fetch_array(mysqli_query($link, "SELECT `userid` FROM `peoples` WHERE `peoples`.`name`='{$_POST['name1']}'"));
            $result = mysqli_fetch_array(mysqli_query($link, "SELECT `pass` FROM `peoples` WHERE `peoples`.`name`='{$_POST['name1']}'"));
            if($result['pass']==""){
                echo"
					<span class='txt1'>
						Пользователь не найден!
					</span>
                ";
            }else{
                if ($_POST["Pass"]!=$result['pass']){
                    echo"
						<span class='txt1'>
							Данные не верны!
						</span>
                    ";
                }
            }  
        }	
		if(isset($_COOKIE['userid'])){
		echo"
			<a href='http://raznochtenia10.ru/cp/' class='txt2 hov1'>
				Вернутся в профиль
			</a>
		";}
		?>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
