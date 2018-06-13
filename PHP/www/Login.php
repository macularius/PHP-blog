<?php 
	header('Content-Type: text/html; charset=utf-8');
	//подключаем сессии

	session_start();
	$_SESSION['isStarted'] == 'OK';
	include_once('functions.php'); 
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles/style.css">
	  	<meta charset="utf-8">
	  	<title>Вход</title>
	</head>

	<body>
		<div class="log-container">
			
		<? 
			if (isLogin()) echo"
								<script type='text/javascript'>
							  		location.replace('Index.php');
								</script>";
		?>
			<div class="log-form">
				<form action="Login.php" method="POST">
					<span>логин:</span><br>
					<div align="center"><input class="indentation logfield" type="text" name="login"><br></div>
					<span>пароль:</span><br>
					<div align="center"><input class="indentation logfield" type="password" name="password"><br></div>
					<input class="indentation indentation-right" type="submit" name="login_submit" value="Войти">
					
					<input class="indentation" type="submit" name="registration_submit" value="Зарегистрироваться">
				</form>	
			</div>

			

		</div>
	</body>
</html>

<? 
	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		if($_POST['login_submit'] == 'Войти') {
	        $login = $_POST['login'];
			$password = $_POST['password'];
			if(login( $login, $password )) {
				echo"
					<script type='text/javascript'>
				  		location.replace('Index.php');
					</script>";
			}
			else echo "<script>alert('Неверный логин или пароль.')</script>";
		}
		if ($_POST['registration_submit'] == 'Зарегистрироваться') {
			echo"
					<script type='text/javascript'>
				  		location.replace('Registration.php');
					</script>";
		}
	}
?>

<?
	dump();
?>