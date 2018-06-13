<?php 
	header('Content-Type: text/html; charset=utf-8');
	//подключаем сессии
	include_once('functions.php'); 
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
	  <meta charset="utf-8">
	  <link rel="stylesheet" href="styles/style.css">
	  <title>Вход</title>
	</head>

	<body>
		<div name="user_info" class="index-block">
			<? 
				if(isLogin()){
					echo "<span>Здравствуй, ".$_SESSION["login"]."</span>";
				}	
				else echo "<span>Здравствуй, "."Гость"."</span>";
			?>
			<div align="center">
				<form class="indentation" action="Index.php" method="POST">
					<? 
					if(isLogin()){
						echo "<input type='submit' name='log' value='Выйти'>";
					}	
					else echo "<input type='submit' name='log' value='Войти'>";


					?>
				</form>
			</div>
		</div>


		<div name='messages_container' class="index-block">
			<?
			if(!isLogin()){
				echo "<span>Авторизируйтесь для просмотра сообщений</span>";
			}
			else{
				showMessages();
				
				echo "
						<hr>
						<div name='create_message'>
							<div align='right' style='margin-top: 10px'>
								<form action='Index.php' method='POST'>
									<div align='center'>
										<textarea name='text' class='message-create-text'></textarea>
									</div>
									<input type='submit' name='submit' value='Отправить'>
								</form>
							</div>
						</div>
					";
			}
			?>
			
		</div>
		

	</body>
</html>

<? 
	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		if($_POST['log'] == 'Выйти') {
	        logout();
		}
		if($_POST['log'] == 'Войти') {
	        echo"
					<script type='text/javascript'>
				  		location.replace('Login.php');
					</script>";
		}
		if ($_POST['registration_submit'] == 'Зарегистрироваться') {
			echo"
					<script type='text/javascript'>
				  		location.replace('Registration.php');
					</script>";
		}
		if ($_POST['message-btn'] == 'D') {
			$id = $_POST['id'];
			deleteMessage($id);
			echo"
					<script type='text/javascript'>
				  		location.replace('Index.php');
					</script>";
		}
		if ($_POST['message-btn'] == 'C') {
			$id = $_POST['id'];
			$text = $_POST['text'];
			changeMessage($id, $text);
			echo"
					<script type='text/javascript'>
				  		location.replace('Registration.php');
					</script>";
		}
		if($_POST['submit'] == 'Отправить') {
			$text = $_POST['text'];
			addMessage($text);
	        echo"
				<script type='text/javascript'>
			  		location.replace('Login.php');
				</script>";
		}

	}
?>

<?
	dump();
?>