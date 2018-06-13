<?php 
	header('Content-Type: text/html; charset=utf-8');
	//подключаем сессии
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
			<form action="Registration.php" method="POST">
				<span>логин:</span><br>
				<div align="center"><input class="indentation logfield" type="text" id="login" name="login"><br></div>

				<span>пароль:</span><br>
				<div align="center"><input class="indentation logfield" type="password" id="password" name="password" oninput="check()"><br></div>

				<span>повторите пароль:</span><br>
				<div align="center"><input class="indentation logfield" type="password" id="password confirm" name="password confirm" oninput="check()"><br></div>

				<div align="right"><input class="indentation indentation-right" type="submit" id="login_submit" name="login_submit" value="Создать" disabled></div>
			</form>	
		</div>

			

		</div>
	</body>
</html>
<script type="text/javascript">
	function check(){
		if(document.getElementById('login').value !='' && document.getElementById('password').value !='' && document.getElementById('password confirm').value != '' && document.getElementById('password').value == document.getElementById('password confirm').value) document.getElementById('login_submit').disabled = false;
		else document.getElementById('login_submit').disabled = true;
	}
</script>

<?
	dump();
?>

<? 
	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		if($_POST['login_submit'] == 'Создать') {
	        $login = $_POST['login'];
			$password = $_POST['password'];
			if(registration($login, $password)) {
				echo"
					<script type='text/javascript'>
				  		location.replace('Index.php');
					</script>";
			}
			else echo "<script>alert('Этот логин занят.')</script>";
		}
		if ($_POST['registration_submit'] == 'Зарегистрироваться') {
			echo"
					<script type='text/javascript'>
				  		location.replace('Registration.php');
					</script>";
		}
	}
?>