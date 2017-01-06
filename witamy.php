<?php

	session_start();
	
	if (!isset($_SESSION['udanaRejestracja']))
	{
		header('Location: rejestracja.php');
		exit();
	}
	else
	{
		unset($_SESSION['udanaRejestracja']);
	}
	
	// Usuwanie zmiennych pamietajacych wartosci wpisane do formularza
	if( isset($_SESSION['form-nick']) )	unset($_SESSION['form-nick']);
	if( isset($_SESSION['form-email']) )	unset($_SESSION['form-email']);
	if( isset($_SESSION['form-haslo1']) )	unset($_SESSION['form-haslo1']);
	if( isset($_SESSION['form-haslo2']) )	unset($_SESSION['form-haslo2']);
	if( isset($_SESSION['form-regulamin']) )	unset($_SESSION['form-regulamin']);
	
	// Usuwanie błędów rejestracji
	if( isset($_SESSION['e-nick']) )	unset($_SESSION['e-nick']);
	if( isset($_SESSION['e_email']) )	unset($_SESSION['e_email']);
	if( isset($_SESSION['e_haslo']) )	unset($_SESSION['e_haslo']);
	if( isset($_SESSION['e-regulamin']) )	unset($_SESSION['e-regulamin']);
	if( isset($_SESSION['e_bot']) )	unset($_SESSION['e_bot']);
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="Strona dla bliskich znajomych w celu zmawiania się na imprezy i proponowaniu
	 sposobu spędzenia czasu w wybranym miejscu z przyjaciółmi." />
	<meta name="keywords" content="wydarzenia, imprezy, najlepsze formy spędzenia czasu, Wrocław, zabawa"/>
	<title>Zalogowano do aktualnych wydarzeń we Wrocławiu. Sprawdź teraz ulubione wydarzenie!</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="js/script.js"> </script>

</head>

<body>

	<div id= "website">
			
			Konto zostało utworzone. Dziękujemy za dokonanie rejestracji.<br/></br>
			<a href="index.html"> Zaloguj się na swoje konto. </a>
			
	</div>		
</body>
</html>