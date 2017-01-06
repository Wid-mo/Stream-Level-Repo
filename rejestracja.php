<?php

	session_start();
	
	if ( isset($_SESSION['zalogowany']))
	{
		header('Location: klienci.php');
		exit();
	}
	
	if( isset($_POST['logowanie'] )   ){
		
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
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		if( filter_var($emailB, FILTER_VALIDATE_EMAIL) == false || $email  != $emailB ){
			$wszystko_ok = false;
			$_SESSION['e_email'] = "Podaj poprawny adres Email";
		}
		
		// Sprawdz poprawnosc hasla
		$haslo1 = $_POST['Haslo1'];
		$haslo2 = $_POST['Haslo2'];
		if(strlen($haslo1) < 6 || strlen($haslo1) > 20){
			$wszystko_ok = false;
			$_SESSION['e_haslo'] = "Has³o musi posiadaæ od 6 do 20 znaków.";
		}
		if( $haslo1 != $haslo2){
			$wszystko_ok = false;
			$_SESSION['e_haslo'] = "Podane has³a musz¹ byæ identyczne";
		}
		$haslo_hash = password_hash( $haslo1, PASSWORD_DEFAULT);
		
		
		// Czy zaakceptowano regulamin
		if ( !isset($_POST['regulamin'])  ){
			$wszystko_ok = false;
			$_SESSION['e_regulamin'] = "Najpierw zaakceptuj regulamin";
		}
		
		// Czy jesteœ botem
		$secret = "6LcDlg8UAAAAANHKx0CuMlNLWQfmw1vmdx9Eywgp";
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response'] );  // pobierz zawartosc pliku
		$odpowiedz = json_decode( $sprawdz);
		if( !$odpowiedz->success){
			$wszystko_ok = false;
			$_SESSION['e_bot'] = "PotwierdŸ, ¿e nie jesteœ botem";
		}
		
		// Przed polaczeniem z baza zapamietaj wczesniej wpisane wartosci w formularzu
		$_SESSION['form-nick']= $nick;
		$_SESSION['form-email']= $email;
		$_SESSION['form-haslo1']= $haslo1;
		$_SESSION['form-haslo2']= $haslo2;
		if( isset($_POST['regulamin']) )
			$_SESSION['form-regulamin']= true;
		
		
		// Sprawdz czy emaile ( podany i z bazy danych) siê powtarzaj¹
		require_once "connect.php";
		mysqli_report( MYSQLI_REPORT_STRICT);
		try
		{
			$polaczenie = new mysqli($host, $db_user,$db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno() );
			}
			else
			{
				//Czy email juz istnieje
				$rezultat = $polaczenie->query("SELECT id FROM klienci WHERE email='$email'");
				
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if( $ile_takich_maili > 0)
				{
					$wszystko_ok = false;
					$_SESSION['e_email'] = "Istnieje ju¿ konto przypisane do tego konta email";
				}
				
				// Czy login ju¿ istnieje
				$rezultat = $polaczenie->query("SELECT id FROM klienci WHERE user='$nick'");
				
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_userow = $rezultat->num_rows;
				if( $ile_takich_userow > 0)
				{
					$wszystko_ok = false;
					$_SESSION['e_nick'] = "Podany login ju¿ istnieje. Podaj inny.";
				}
				
				// Jesli wszystkie testy zaliczone. Wstaw nowego u¿ytkownika do bazy
				if( $wszystko_ok == true)
				{
					if( $polaczenie->query( "INSERT INTO klienci VALUES( NULL, '$nick', '$haslo_hash', '$email' , 1,1,1,3)" ) )
					{
						$_SESSION['udanaRejestracja'] = true;
						header( 'Location: witamy.php');
					}
					else{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
		}
		catch( Exception $e)
		{
			echo '<span style="color:red;" > B³¹d serwera. Przepraszamy za niedogodnoœci. Prosimy o rejestracje w innym terminie.</span> ';
			echo '<br/> <span style="color:red;" >Informacja deweloperska: '.$e.'</span>';
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
	<a href="index.html" > Powrot do strony g³ównej </a>
	<div id= "do_rejestracji">
			
			<form method="POST">
				Nick: <br/><input type="text" name="username" value="<?php
					if( isset($_SESSION['form-nick']) ){
						echo  $_SESSION['form-nick'];
						unset($_SESSION['form-nick']);
					}
				?>" /><br/><br/><br/><br/>
				<?php
					if( isset($_SESSION['e_nick'])  )
					{
						echo '<div class="error" >'.$_SESSION['e_nick'].'</div>';
						unset($_SESSION['e_nick']);
					}
				?>
				
				Email: <br/><input type="text" name="email" value="<?php
					if( isset($_SESSION['form-email']) )
					{
						echo  $_SESSION['form-email'];
						unset($_SESSION['form-email']);
					}
				?>" /><br/><br/><br/><br/>
				<?php
					if( isset($_SESSION['e_email'])  )
					{
						echo '<div class="error" >'.$_SESSION['e_email'].'</div>';
						unset($_SESSION['e_email']);
					}
				?>
				Haslo: <br/><input type="password" name="Haslo1" value="<?php
					if( isset($_SESSION['form-haslo1']) )
					{
						echo  $_SESSION['form-haslo1'];
						unset($_SESSION['form-haslo1']);
					}
				?>" /><br/><br/><br/><br/>
				<?php
					if( isset($_SESSION['e_haslo'])  )
					{
						echo '<div class="error" >'.$_SESSION['e_haslo'].'</div>';
						unset($_SESSION['e_haslo']);
					}
				?>
				
				Powtorz haslo: <br/><input type="password" name="Haslo2" value="<?php
					if( isset($_SESSION['form-haslo2']) )
					{
						echo  $_SESSION['form-haslo2'];
						unset($_SESSION['form-haslo2']);
					}
				?>" /><br/><br/><br/><br/>
				
				<label style="cursor:pointer;">
					<input type="checkbox" name="regulamin" <?php
					if( isset($_SESSION['form-regulamin']) )
					{
						echo  "checked";
						unset($_SESSION['form-regulamin']);
					}
				?> /> Akceptuje regulamin
				</label>
				<?php
					if( isset($_SESSION['e_regulamin'])  )
					{
						echo '<div class="error" >'.$_SESSION['e_regulamin'].'</div>';
						unset($_SESSION['e_regulamin']);
					}
				?>
				<br/><br/>
				<div class="g-recaptcha" data-sitekey="6LcDlg8UAAAAAKH5luY-Z9EyAWScJkhcVoYOopNT"></div>
				<?php
					if( isset($_SESSION['e_bot'])  ){
						echo '<div class="error" >'.$_SESSION['e_bot'].'</div>';
						unset($_SESSION['e_bot']);
					}
				?>
				<br/>
				<input type="submit" class="przycisk" value="Stwórz konto" name="logowanie"/>

			</form>
			
	</div>		
</body>
</html>