<?php

	session_start();
	
	if ( isset($_SESSION['zalogowany']))
	{
		header('Location: klienci.php');
		exit();
	}
	
	if( isset($_POST['Email'] )   ){
		
		//walidacja danych
		$wszystko_ok = true;
		
		// USERNAME
		$nick = $_POST['username'];
		if(strlen($nick) < 3 || strlen($nick) > 20 ){
			
			$wszystko_ok = false;
			$_SESSION['e_nick'] = "Nazwa u¿ytkownika powinna posiadac od 3 od 20 znakow";
		}
		if( ctype_alnum($nick) == false){
			$wszystko_ok = false;
			$_SESSION['e_nick'] = "Nick mo¿e sk³adaæ siê tylko z liter i cyfr";
		}
		
		// EMAIL
		$email = $_POST['Email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		if( filter_var($emailB, FILTER_VALIDATE_EMAIL) == false || $email  != $emailB ){
			$wszystko_ok = false;
			$_SESSION['e_Email'] = "Podaj poprawny adres Email";
		}
		
		// Sprawdz poprawnosc hasla
		$haslo1 = $_SESSION['Haslo1'];
		$haslo2 = $_SESSION['Haslo2'];
		if(strlen($haslo1) < 8 || strlen($haslo1) > 20){
			$wszystko_ok = false;
			$_SESSION['e_haslo'] = "Has³o musi posiadaæ od 8 do 20 znaków.";
		}
		if( $haslo1 != $haslo2){
			$wszystko_ok = false;
			$_SESSION['e_haslo'] = "Podane has³a musz¹ byæ identyczne";
		}
		$haslo_hash = password_hash( $haslo1, PASSWORD_DEFAULT);
		
		if( $wszystko_ok == true){
			// dodajemy gracza do bazy
			echo "Udana Walidacja"; exit();
			
		}
	}
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="Strona dla bliskich znajomych w celu zmawiania siê na imprezy i proponowaniu
	 sposobu spêdzenia czasu w wybranym miejscu z przyjació³mi." />
	<meta name="keywords" content="wydarzenia, imprezy, najlepsze formy spêdzenia czasu, Wroc³aw, zabawa"/>
	<title>Dokonaj rejestracji</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="js/script.js"> </script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>

	<div id= "do_rejestracji">
			
			<form method="POST">
				Nick: <br/><input type="text" name="username"/><br/><br/><br/><br/>
				<?php
					if( isset($_SESSION['e_nick'])  ){
						echo '<div class="error" >'.$_SESSION['e_nick'].'</div>';
						unset($_SESSION['e_nick']);
					}
				?>
				Email: <br/><input type="text" name="Email"/><br/><br/><br/><br/>
				<?php
					if( isset($_SESSION['e_Email'])  ){
						echo '<div class="error" >'.$_SESSION['e_Email'].'</div>';
						unset($_SESSION['e_Email']);
					}
				?>
				Haslo: <br/><input type="password" name="Haslo1"/><br/><br/><br/><br/>
				<?php
					if( isset($_SESSION['e_haslo'])  ){
						echo '<div class="error" >'.$_SESSION['e_haslo'].'</div>';
						unset($_SESSION['e_haslo']);
					}
				?>
				
				Powtorz haslo: <br/><input type="password" name="Haslo2"/><br/><br/><br/><br/>
				
				<label style="cursor:pointer;">
					<input type="checkBox" name="regulamin" /> Akceptuje regulamin </input>
				</label>
				<?php
					if( isset($_SESSION['e_nick'])  ){
						echo '<div class="error" >'.$_SESSION['e_nick'].'</div>';
						unset($_SESSION['e_nick']);
					}
				?>
				<br/><br/>
				<div class="g-recaptcha" data-sitekey="6LcDlg8UAAAAAKH5luY-Z9EyAWScJkhcVoYOopNT"></div>
				<br/>
				<input type="submit" class="przycisk" value="Stwórz konto" name="logowanie"/>

			</form>
			
	</div>		
</body>
</html>