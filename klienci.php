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
	<meta name="description" content="Strona dla bliskich znajomych w celu zmawiania się na imprezy i proponowaniu
	 sposobu spędzenia czasu w wybranym miejscu z przyjaciółmi." />
	<meta name="keywords" content="wydarzenia, imprezy, najlepsze formy spędzenia czasu, Wrocław, zabawa"/>
	<title>Zalogowano do aktualnych wydarzeń we Wrocławiu. Sprawdź teraz ulubione wydarzenie!</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="js/script.js"> </script>

</head>

<body>

	<div id= "website">
			<div id= "menu" > 
				<p class="panel_napis"><b>Co wyszukać we Wrocławiu?</b></p>
				
				<?php
					if (isset($_SESSION['zalogowany'])){
							echo "Witaj ".$_SESSION['user'].'! [ <a href="logout.php">Wyloguj się!</a> ]';
							echo '<p style="font-size:12px;" >E-mail: '.$_SESSION['email'].'</p>';
					}
					else
						
				?>
			</div>
		
			<div id="reklama" > To jest miejsce na twoją reklamę </div>
		
			<div id= "content" > 
				
					<div id="zdjecie" ><h2>Witamy we Wrocławiu!</h2><br>
						 <img src="img/wroclaw_zdj_gl.jpg"  alt=" Wrocław, Najlepsze miasto w Polsce" />  
					 </div>
					 
					<?php
						if (isset($_SESSION['zalogowany']))
								echo '<p class="intro">Witaj '.$_SESSION['user'].'! Wpisz w polu poniżej miejsce w które chcesz się udać, a serwis wyszuka je!</p>';
						else
								echo '<p class="intro"> Nie jesteś zalogowany. "To jest wyszukiwarka wydarzeń, klubów, imprez itp. we Wrocławiu." <br/><br/> 
						"Zaloguj się by móc korzystać z możliwości serwisu"  </p>';
					?>
					
					 <div id="wyszukiwarka" > 
							 <p class="wyszukane_napis">Znajdź interesujące cię wydarzenie:</p>
							 
							 <form class="wprowadz_wydarzenie">
									   
											<input type="text" class="wydarzenia_wejscie" placeholder="wyszukaj" onfocus="this.placeholder='' " onblur="this.placeholder='wyszukaj' "/>
											<input type="submit" value="OK"/>
											
							</form> <div style="clear:both;"> </div>
							
							<?php
							if (isset($_SESSION['zalogowany']))
							{
								echo<<<END
								<a href="klienci.php" > 
								<button class="wydarzenia_wejscie" style="margin-top:40px;">Dodaj nowe wydarzenie</button>
								</a>
								
END;
							}
							
							
							?>
							<hr>
							
							<div id="map"></div>
							
								<?php
								if (isset($_SESSION['zalogowany']))
									echo<<<END
									<script>
									function initMap() {
									var uluru = {lat: 51.110, lng: 17.030};
									var map = new google.maps.Map(document.getElementById('map'), {
									zoom: 15,
									center: uluru
									});
									var marker = new google.maps.Marker({
									position: uluru,
									map: map
									});
									}
								</script>
								<script async defer
									src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuFgUnVW-nYWpRXRejrDstghFgjSjLeIM&callback=initMap">
								</script>
END;
								?>
						
					</div>
				
				<div id="wyszukane_wydarzenia" > 
						Brak Wydarzen
				</div>		
				<div style="height:40px;" ></div>
				
			</div>
			
			
			<div id= "footer" > Interesujące wydarzenia we Wrocławiu. Prosty sposób na poinformowanie
						znajomych o wydarzeniach na które zamierzasz przyjść &copy; 2016 </div>
			
	</div>		
</body>
</html>