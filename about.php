<?php

include("functions.php");

// in: $_GET['startyear'] out: $exhibitions
include("queries/exhibitionlist.php");


//print_r($exhibitions);





?>
<!doctype html>
<html lang="nl">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/styles.css">

	<title>Tentoonstellingen Rijksmuseum</title>
</head>
<body id="about">



	<div class="container">

		<div id="topnavbar">
			<a href="/">terug naar overzicht</a>
		</div>

		<h1>Over deze demo-applicatie</h1>

		<div class="row">
			<div class="col-sm-9">
				<p class="lead">
					Deze demo-applicatie is in opdracht van en in samenwerking met medewerkers van het Rijksmuseum Amsterdam gemaakt. Ons gezamenlijk doel: het bekijken, verbinden en schonen van tentoonstellingsdata. De demo is een - tijdelijk - hulpmiddel dat onvolkomenheden in en mogelijkheden van de data in beeld brengt. Het punt waarop data 'af' is bereik je nooit, maar we kunnen een eind in de richting komen.
				</p>
			</div>
			<div class="col-sm-3">

			</div>
		</div>

		<div class="row">
			<div class="col-sm-7">
				<h2>Tentoonstellingen en de collectie</h2>
				<p>
					Enkele honderden tentoonstellingen waren voor aanvang van het project al opgenomen in het collectieregistratiesysteem Adlib. Daarnaast circuleerden intern nog enkele lijsten waarop (veel) meer tentoonstellingen genoemd werden. Daarop voorkomende tentoonstellingen die nog niet in Adlib bekend waren, zijn toegevoegd.
				</p>
				<p>
					Eenmaal in Adlib kunnen er objecten uit de collectie aan een tentoonstelling gekoppeld worden. De demo is gemaakt op data die weer uit Adlib geëxporteerd is. In de overzichten kon ik zo de aantallen gekoppelde objecten tonen, in een rood bolletje. En op de tentoonstellingspagina worden de objecten zelf getoond.
				</p>

				<p>
					Zo kan je objecten bekijken binnen de context van een tentoonstelling, of die nu afgelopen jaar of decennia geleden heeft gelopen. Ja, met de catalogus kon dat al, maar je hebt ze thuis waarschijnlijk niet allemaal in de kast staan. De bibliotheek is nog aan het tellen - het zijn er waarschijnlijk zo'n vierhonderd. En dan zijn er nog de honderden tentoonstellingen waar geen catalogus bij is verschenen.
				</p>
			</div>
			<div class="col-sm-1">
			</div>
			<div class="col-sm-4">
				<img src="assets/img/overzicht.png" />

				<p class="small">
					Tentoonstellingenoverzicht in stadium dat nog wat schaafwerk kan gebruiken - met titels als <em>MOP 5</em>, <em>MOP 6</em> en <em>MOP 7</em>, een tentoonstelling waarvan het einde twee jaar voor het begin ligt en maar twee tentoonstellingen waar objecten aan verbonden zijn.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-7">
				<h2>Tentoongestelde objecten uit andere collecties</h2>

				<p>
					Nu kan je objecten uit je eigen collectie netjes met tentoonstellingen verbinden, met objecten uit andere collecties is dat een stuk lastiger. Zeker als je ook afbeeldingen en beschrijvingen wilt tonen zou dat een hels karwei zijn.
				</p>

				<p>
					Linked data to the rescue! In een wereld waarin data goed op elkaar aangesloten is, is het niet langer nodig alles in je eigen systeem bij te houden. Er zijn verschillende wegen waarlangs die aansluiting te realiseren is: rechtstreeks verbinden met de data van de uitlenende instelling, gebruik maken van tentoonstellingsgegevens van het RKD of naar Wikidata linken, op objectniveau of tentoonstellingsniveau.
				</p>

				<p>
					Het Amsterdam Museum houdt netjes alle tentoonstellingen bij waar objecten van hen te zien zijn. Daar zitten zo'n 225 tentoonstellingen in het Rijksmuseum bij. De identifiers die ze er daar aan hebben toegekend hebben we verbonden met de Rijksmuseum identifiers. Als het Amsterdam Museum haar informatie als linked data online zou publiceren, dan zou het vrij eenvoudig zijn om alle uitgeleende objecten bijvoorbeeld hier in de demo-app te tonen.
				</p>

				<p>
					 Zo ver is het echter nog niet, hoewel het Amsterdam Museum op dit gebied behoorlijk voorop loopt. En dan is er nog het simpele feit dat op Rijksmuseum tentoonstellingen objecten te zien zijn geweest van honderden instellingen. Voor elk van die instellingen uitzoeken of data online beschikbaar is, en op welke manier, daar kan je wel een fte mee vullen. Het zou handiger zijn als dit op de één of andere manier meer centraal geregeld zou zijn. 
				</p>

				<p>
					Het RKD zou een logische kandidaat zijn om in die leemte te voorzien. Ze hebben al data over meer dan 120.000 tentoonstellingen verzameld en beschikken met RKDimages over een gigantisch afbeeldingenarchief. De RKDartists en RKDimages identifiers worden al veel gebruikt, een RKDexhibitions identifier zou snel landen in de erfgoedwereld. Die identifier is nu nog niet online terug te vinden, maar met een op verzoek gemaakte dump kon ik laten zien met welke tentoonstellingen het RKD nu objecten heeft verbonden - de aantallen worden in het overzicht in blauwe bolletjes vermeld.
				</p>

				<p>
					De andere kandidaat is Wikidata, waar ook al veel data beschikbaar is en dat bovendien veel toegankelijker is, onder andere via een SPARQL endpoint. De aantallen objecten die op Wikidata aan een tentoonstelling gekoppeld zijn kunnen daardoor via een 'federated query' opgehaald worden, zodat, in de groene bolletjes, altijd de laatste stand van zaken te zien is.
				</p>

				<p>
					Er zijn verschillen. Wikidata wordt bijgehouden door 'vrijwilligers', de RKD data heeft meer 'autoriteit'. Op Wikidata zijn veel schilderijen present, vooral door het project The Sum of All Paintings zijn hele collecties in één klap online gezet. Tekeningen en werken in particuliere collecties zijn weer beter vertegenwoordigd in RKDimages. Zodra we het domein van de toegepaste kunst en historische objecten (meubels, kleding, gebruiksvoorwerpen) betreden is het overigens bij beiden meestal vergeefs zoeken.
				</p>

				<p>
					Dat je Wikidata zelf kunt editen is een groot voordeel. Er waren al zo'n twintig Rijksmuseum tentoonstellingen op Wikidata te vinden en aan twee daarvan - De Late Rembrandt en Rembrandt / Velazquez - heb ik objecten gekoppeld. Die objecten zijn ook weer met allerlei data verbonden, zodat een kaartje met uitlenende instellingen of links naar Wikipediapagina's over het werk in kwestie eenvoudig te maken zijn.
				</p>
			</div>
			<div class="col-sm-1">
			</div>
			<div class="col-sm-4">
				<img src="http://commons.wikimedia.org/wiki/Special:FilePath/Francisco%20de%20Zurbar%C3%A1n%20006.jpg?width=500px" />

				<p class="small">
					Met enkel objecten uit eigen collectie krijg je geen beeld van een tentoonstelling
				</p>


				<img src="https://images.rkd.nl/rkd/thumb/1000x1000/90ef04e3-513a-96f1-1e50-ef5a1e4fdc14.jpg" />

				<p class="small">
					De afbeelding van deze tekening van Goltzius, in particulier bezit, komt uit RKDimages
				</p>



				<img src="assets/img/map.png" />

				<p class="small">
					Het is niet verwonderlijk dat de op <em>Rembrandt / Velazquez</em> tentoongestelde werken vooral uit Madrid komen
				</p>


			</div>
		</div>



		<div class="row">
			<div class="col-sm-7">

				<h2>Recensies in de krant</h2>

				<p>



				<h2>Catalogi en affiches</h2>

				<h2>Foto's en archiefmateriaal</h2>

				<h2>Linked data</h2>

				<h2>Crowdsourcing</h2>
			</div>
			<div class="col-sm-1">
			</div>
			<div class="col-sm-4">


			</div>
		</div>
	</div>

</body>
</html>