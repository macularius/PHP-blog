<?php 
	header('Content-Type: text/html; charset=utf-8');

	session_start();

	function isLogin(){
		if($_SESSION['isLogin'] == 'OK') return true;
		else return false;
	}

	function isAdmin(){
		if($_SESSION['isAdmin'] == 'OK') return true;
		else return false;
	}

	function isAuthor($author){
		if($_SESSION['login'] == $author) return true;
		else return false;
	}

	function login($login,$password){
		$mysqli = new mysqli( "localhost", "root", "", "blog" ) or die(mysql_error());
		$users = $mysqli -> query( "SELECT * FROM  `users` " );

		while ( $user = $users -> fetch_assoc() ) {
			//echo "<script>alert('Логин ".$login." Логин бд ".$user[Login]." ".($login==$user[Login])."')</script>";
			//echo "<script>alert('Пароль ".$password." Пароль бд ".$user[Password]." ".($password==$user[Password])."')</script>";
			//echo "<script>alert('Роль ".$user[Role]." ".$user[Role] == 'admin'."')</script>";
			if ( ($user[Login] == $login) && ($user[Password] == $password)) {
				$_SESSION['login'] = $login;
				$_SESSION['isLogin'] = 'OK';
				if($user[Role] == 'admin') $_SESSION['isAdmin'] = 'OK';

			}
		}
		$mysqli -> close();
		//echo "<script>alert('Аутентификация ".$_SESSION['isLogin']."')</script>";
		return isLogin();
	}

	function logout(){
		unset($_SESSION['isLogin']);
		unset($_SESSION['login']);
		unset($_SESSION['isAdmin']);
		echo"
				<script type='text/javascript'>
			  		location.replace('Index.php');
				</script>";
	}

	function isRegistration($login){
		//echo "<script>alert('$login')</script>";
		$mysqli = new mysqli( "localhost", "root", "", "blog" ) or die(mysql_error());
		$users = $mysqli -> query( "SELECT * from `users`" );
		while ( $user = $users -> fetch_assoc() ) {
			if ($user[Login] == $login) $isReg = true;
		}
		$mysqli -> close();
		return $isReg;
	}

	function registration($login,$password){
		if(!isRegistration($login)){
			$mysqli = new mysqli( "localhost", "root", "", "blog" ) or die(mysql_error());
			$mysqli -> query( "INSERT INTO `blog`.`users` VALUES (NULL, '$login', '$password', NULL)" );
			/*if ($mysqli) {
	        	echo "<script>alert('Добавлено')</script>";
		    }
		    else{
		    	echo "<script>alert('Не добавлено')</script>";
		    }*/
			$mysqli -> close();
			login($login,$password);
			return true;
		}
		else return false;
	}

	function showMessages(){
		$mysqli = new mysqli( "localhost", "root", "", "blog" ) or die(mysql_error());
		$messages = $mysqli -> query( "SELECT * FROM  `messages`" );
		//var_dump($messages);
		
		while ( $message = $messages -> fetch_assoc() ) {
			//print_r($message);
			echo 	"<div name='messages_container' class='message-container' id='".$message[MessageId]."'>
						<div name='message' class='message'>
				    		<div name='panel'>
				    			<div class='message-date'>".$message[Date]."</div><br>
								<div class='message-author'>".$message[Author]."</div>";
			
			if(isAdmin()){
			echo 	"	<form action='Index.php' method='POST'>
							<input class='message-btn' type='submit' name='message-btn' value='D'>
							<input type='hidden' name='id' value='".$message[MessageId]."'>
						</form>";
			}
			
			echo 	"	<form action='Index.php' method='POST'>
							<input class='message-btn' type='submit' name='message-btn' value='C' ";if(!isAdmin() && !isAuthor($message[Author]))echo "hidden"; echo " >
							<input type='hidden' name='id' value='".$message[MessageId]."'>
							<div>
								<textarea name='text' id='".$message[MessageId]."' "; if(!isAdmin() && !isAuthor($message[Author])){echo "disabled";} echo" style='resize: none; background-color: #ffffff'>".$message[Text]."</textarea>
							</div>
						</form>";
			echo			"</div>
						</div>
					</div>";
		}
		$mysqli -> close();
	}

	function addMessage($text){
		$author = $_SESSION['login'];
		$date = date('Y-m-d');
		//echo "<script>alert('Text ".$text."')</script>";
		$mysqli = new mysqli( "localhost", "root", "", "blog" ) or die(mysql_error());
		$mysqli -> query( "INSERT INTO `blog`.`messages` VALUES (NULL, '$author', '$date', '$text')" );
		/*if ($mysqli) {
	        echo "<script>alert('Добавлено')</script>";
	    }
	    else{
	    	echo "<script>alert('Не добавлено')</script>";
	    }*/
		$mysqli -> close();
	}

	function deleteMessage($id){
		$mysqli = new mysqli( "localhost", "root", "", "blog" ) or die(mysql_error());
		$mysqli -> query( "SELECT * from `messages`" );
		$access = $mysqli -> query( "DELETE FROM messages WHERE MessageId = '$id'" );
		$mysqli -> close();
	}

	function changeMessage($id, $newText){
		echo "<script>alert('Text ".$newText." ".$id."')</script>";
		$mysqli = new mysqli( "localhost", "root", "", "blog" ) or die(mysql_error());
		$mysqli -> query( "UPDATE `blog`.`messages` SET `Text` = '$newText' WHERE `messages`.`MessageId` = '$id'" );
		$mysqli -> close();
	}

	function dump(){
		//var_dump($_SESSION["login"]);
		//var_dump($password);
		//var_dump($_SESSION["isAdmin"]);
		//var_dump(isset($_SESSION["isLogin"]));
		//var_dump(isset($_SESSION['isStarted']));
	}
?>