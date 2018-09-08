<?php
session_start();
    include('funkcie.php');
    hlavicka('Kontakt');
    /*------*/
    include('db.php');
    nav();
    aside_left();
?>
	<section>
		<h2>Kontaktujte nás</h2>
		<article>
			<h2>Adresa:</h2>
			<address>
				Martin Hrebeňár<br>
				Vlčia dolina 1164<br>
				049 25, Dobšiná<br>
				Slovensko
			</address>
			<h2>Kontakty:</h2>
			<dl>
				<dt>Tel. číslo:</dt>
				<dd>0900 123 456</dd>
				<dt>Fax:</dt>
				<dd>058/1234 62 62</dd>
				<dt>Email:</dt>
				<dd>example@email.com</dd>
				<dt>Facebook page:</dt>
				<dd> <span><a href="https://www.facebook.com/LukostreleckyKlubDobsina/?fref=ts">Klik TU.</a></span> </dd>
			</dl>

			<h2>Mapa:</h2>
			<div id="mapa">Mapa bude TU.</div>
			<script>
				function myMap() {
					var mapCanvas = document.getElementById("mapa");
					var center = new google.maps.LatLng(48.826605, 20.375124);
					var mapOptions = { center, zoom: 15, mapTypeId: google.maps.MapTypeId.HYBRID }
					var map = new google.maps.Map(document.getElementById("mapa"), mapOptions);
					var marker = new google.maps.Marker({
						position: center,
						animation: google.maps.Animation.BOUNCE
					});
					marker.setMap(map);
				}
			</script>
			<script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
		</article>
	</section>
    <?php
        aside_right();
        footer();
?>