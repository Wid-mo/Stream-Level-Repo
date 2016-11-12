	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="js/script.js"> </script>

<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.html');
		exit();
	}
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Zalogowano do aktualnych wydarzeń we Wrocławiu. Sprawdź teraz ulubione wydarzenie!</title>
</head>

<body>
	<div id= "website">
		<div id= "menu" > 
		<p class="panel_napis"><b>Co wyszukać we Wrocławiu?</b></p>
		<p class="rejestracja"> <u>Zalogowano uzytkownika</u> </p>
		
<?php
	
	echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';
	echo "<p><b>E-mail</b>: ".$_SESSION['email'];
?>
</div>
<div id= "content" > 
				<div id="zdjecie" ><h2>Witamy we Wrocławiu!</h2><br>
				     <img src="img/wroclaw_zdj_gl.jpg"  alt=" Wrocław, Najlepsze miasto w Polsce" />  
				 </div>
				 
				<p class="intro"><?php
	
	echo "<p>Witaj ".$_SESSION['user'].'! Wpisz w polu poniżej miejsce w które chcesz się udać, a serwis wyszuka je!</p>';
?></p>
				
				 <div id="wyszukiwarka" > 
						 <p class="wyszukane_napis">Znajdź interesujące cię wydarzenie:</p>
						 <hr>
						 <form class="wprowadz_wydarzenie">
								   
										<input type="text" class="wydarzenia_wejscie" placeholder="wyszukaj" onfocus="this.placeholder='' " onblur="this.placeholder='wyszukaj' "/>
										<input type="submit" value="OK"/>
										
						</form>
						<div style="clear:both;"> </div>
				</div>
</body>
</html>