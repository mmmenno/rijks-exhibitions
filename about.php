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
			<a href="index.php">terug naar overzicht</a>
		</div>

		<h1><a href="index.php">Rijksmuseum Tentoonstellingen</a></h1>

		<div class="row">
			<div class="col-sm-8">
				<p class="lead">
					Deze applicatie is in opdracht van en in samenwerking met medewerkers van het Rijksmuseum Amsterdam gemaakt. Ons gezamenlijk doel: het bekijken, verbinden en schonen van tentoonstellingsdata. Deze demo moet dan ook gezien worden als een - tijdelijk - hulpmiddel om onvolkomenheden in en mogelijkheden van de data in beeld te brengen. Het punt waarop data 'af' is bereik je nooit, maar we kunnen zo wel weer een eind in de richting komen.
				</p>
			</div>
			<div class="col-sm-4">
				<p class="small" style="margin-top: 28px;">
					De voor deze applicatie gebruikte tentoonstellingsdata is voorlopig (!) te vinden op de <a href="https://data.netwerkdigitaalerfgoed.nl/Rijksmuseum">SPARQLendpoint</a> van Netwerk Digitaal Erfgoed (thanks, NDE!). De collectiedata was daar al ontsloten vanwege de vorig jaar gehouden Hackalod, dus - linked data, hè - dat sloot meteen mooi op elkaar aan.
				</p>

				<p class="small">
					De data kan, zowel inhoudelijk als wat modellering betreft, nog gewijzigd worden. Ergo, jullie kunnen erbij, maar garanties op de houdbaarheid worden nog niet gegeven.
				</p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-7">
				<h2>Tentoonstellingen en de collectie</h2>
				<p>
					Enkele honderden tentoonstellingen waren voor aanvang van het project al opgenomen in het collectieregistratiesysteem Adlib. Daarnaast circuleerden intern nog enkele lijsten waarop (veel) meer tentoonstellingen genoemd werden. Daarop voorkomende tentoonstellingen die nog niet in Adlib bekend waren, zijn toegevoegd.
				</p>

				<p>
					Omdat de tentoonstellingslijsten tot nu toe eigenlijk alleen voor interne referentie bedoeld waren, zijn en worden de lijsten nagelopen om alles publicabel te krijgen. Titels als <em>MOP 5 - Tulpen</em> worden gewijzigd in <em>Meesterwerken op Papier - Tulpen in Amsterdam</em>, dateringen worden gecheckt en hier en daar wordt een vinkje in het recent aangemaakte veld 'niet publiceren' gezet om 'puur administratieve' tentoonstellingen uit de lijst te verwijderen. Deze klus is niet op een achternamiddag te doen en het zal nog wel even duren vooraleer perfectie bereikt is.
				</p>

				<p>
					Eenmaal in Adlib kunnen er objecten uit de collectie aan een tentoonstelling gekoppeld worden. De demo is gemaakt op data die weer uit Adlib geëxporteerd is. In de overzichten kon ik zo de aantallen gekoppelde objecten tonen (het rode bolletje). En op de tentoonstellingspagina worden de objecten zelf getoond.
				</p>

				<p>
					Zo kan je objecten bekijken binnen de context van een tentoonstelling, of die nu afgelopen jaar of decennia geleden heeft plaatsgevonden. Met de catalogus kon dat natuurlijk al, maar je hebt ze thuis waarschijnlijk niet allemaal in de kast staan. De bibliotheek is nog aan het tellen - het zijn er waarschijnlijk zo'n vierhonderd. En dan zijn er nog de honderden tentoonstellingen waar geen catalogus bij is verschenen.
				</p>
			</div>
			<div class="col-sm-1">
			</div>
			<div class="col-sm-4">
				<img src="assets/img/overzicht.png" />

				<p class="small">
					Tentoonstellingenoverzicht in stadium dat nog wat schaafwerk kan gebruiken - met titels als <em>MOP 5</em>, <em>MOP 6</em> en <em>MOP 7</em>, een tentoonstelling waarvan het einde twee jaar voor het begin ligt en maar twee tentoonstellingen waar objecten aan verbonden zijn
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-7">
				<h2>Tentoongestelde objecten uit andere collecties</h2>

				<p>
					Nu kan je objecten uit je eigen collectie zo netjes met tentoonstellingen verbinden, met objecten uit andere collecties is dat een stuk lastiger. Zeker als je ook afbeeldingen en beschrijvingen wilt tonen zou dat een hels karwei zijn.
				</p>

				<p>
					Linked data to the rescue! In een wereld waarin data goed op elkaar aangesloten is, is het niet langer nodig alles in je eigen systeem bij te houden. Er zijn verschillende wegen waarlangs die aansluiting te realiseren is: rechtstreeks verbinden met de data van de uitlenende instelling, gebruik maken van tentoonstellingsgegevens van het RKD of naar Wikidata linken, op objectniveau of tentoonstellingsniveau.
				</p>

				<p>
					Het Amsterdam Museum houdt netjes alle tentoonstellingen bij waar objecten van hen te zien zijn. Daar zitten zo'n 225 tentoonstellingen in het Rijksmuseum bij. De identifiers die ze er daar aan hebben toegekend hebben we verbonden met de Rijksmuseum identifiers. Als het Amsterdam Museum haar informatie als linked data online zou publiceren, dan zou het vrij eenvoudig zijn om alle uitgeleende objecten bijvoorbeeld hier in de demo-app te tonen.
				</p>

				<p>
					Al loopt het Amsterdam Museum op dit gebied behoorlijk voorop, zo ver is het nog niet. En dan is er nog het simpele feit dat op Rijksmuseum tentoonstellingen objecten te zien zijn geweest van honderden instellingen. Voor elk van die instellingen uitzoeken of data online beschikbaar is, en op welke manier, daar kan je wel een fte mee vullen. Het zou handiger zijn als dit op de één of andere manier meer centraal geregeld zou zijn. 
				</p>

				<p>
					Het RKD zou een logische kandidaat zijn om in die leemte te voorzien. Ze hebben al data over meer dan 120.000 tentoonstellingen verzameld en beschikken met RKDimages over een gigantisch afbeeldingenarchief. De RKDartists en RKDimages identifiers worden al veel gebruikt, een RKDexhibitions identifier zou snel landen in de erfgoedwereld. Die identifier is nu nog niet online terug te vinden, maar met een op verzoek gemaakte dump kon ik laten zien met welke tentoonstellingen het RKD nu objecten heeft verbonden - de aantallen worden in het overzicht in blauwe bolletjes vermeld.
				</p>

				<p>
					De andere kandidaat is Wikidata, waar ook al veel data beschikbaar is en dat bovendien veel toegankelijker is, onder andere via een SPARQL endpoint. De aantallen objecten die op Wikidata aan een tentoonstelling gekoppeld zijn kunnen daardoor via een 'federated query' opgehaald worden, zodat, in groene bolletjes dit keer, altijd de laatste stand van zaken te zien is.
				</p>

				<p>
					Er zijn verschillen. Wikidata wordt bijgehouden door 'vrijwilligers', de RKD data heeft meer 'autoriteit'. Op Wikidata zijn veel schilderijen present, vooral door het project <a href="https://www.wikidata.org/wiki/Wikidata:WikiProject_sum_of_all_paintings">The Sum of All Paintings</a> zijn hele collecties in één klap beschikbaar gekomen. Tekeningen en werken in particuliere collecties zijn weer beter vertegenwoordigd in RKDimages. Zodra we het domein van de toegepaste kunst en historische objecten (meubels, kleding, gebruiksvoorwerpen) betreden is het overigens bij beiden meestal vergeefs zoeken.
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

				<h2>In de media</h2>

				<p>
					Krantenartikelen helpen niet alleen een beeld te krijgen van een tentoonstelling, maar ook van de receptie ervan. In de artikelen komst soms ook de ontstaansgeschiedenis aan bod - opmerkelijk is bijvoorbeeld de door een motie van de VVD afgedwongen 'toeristentrekker' <a href="https://hicsuntleones.nl/tentoonstellingen-rijks/tentoonstelling/?id=1052519">Velazquez en zijn tijd</a>, die door de Telegraaf als 'gemiste kans' wordt omschreven. 
				</p>

				<p>
					Op <a href="https://www.delpher.nl/">Delpher</a> is over veel tentoonstellingen wel wat te vinden. Het probleem is eerder dat je te veel resultaten krijgt - zoeken op  Delpher komt vaak neer op veel filteren.
				</p>

				<p>
					Het helpt enorm dat we goede dateringen en titels van de tentoonstellingen hebben. In de link naar Delpher kunnen daardoor een aantal parameters meegegeven worden, waarmee veel gerichter gezocht kan worden. De resultaten zijn zo behoorlijk accuraat. Voor nu is gekozen het bij die link te houden en een aantal artikelen handmatig met tentoonstellingen te verbinden, maar geautomatiseerd zoeken is - met zo'n goede tentoonstellingenlijst - zeker een optie.
				</p>

				<p>
					Op <a href="https://openbeelden.nl/">Openbeelden</a> zijn nog een vijftiental beeldverslagen uit Polygoon- en NSBjournaals gevonden. Er is natuurlijk meer bewegend beeld beschikbaar, maar dat lijkt, door auteursrechtelijke kwesties en urls waarvan de persistentie op langere termijn ongewis is, iets minder makkelijk op te nemen. 
				</p>

			</div>
			<div class="col-sm-1">
			</div>
			<div class="col-sm-4">
				<img src="assets/img/krant.jpg" />

				<p class="small">
					Krantenartikelen geven een beeld van de tentoonstelling, maar ook van de receptie ervan
				</p>

			</div>
		</div>



		<div class="row">
			<div class="col-sm-7">

				<h2>Catalogi en affiches</h2>

				<p>
					Wanneer je meer wilt weten over een tentoonstelling is de eerste stap altijd die richting catalogus. Tenzij er exemplaren ontvreemd zijn zouden die allemaal te vinden moeten zijn in de bibliotheek van het museum. Bibliotheekmedewerkers hebben de afgelopen tijd links gelegd tussen een kleine tweehonderd tentoonstellingen en bijbehorende catalogi, zodat je met een klik jezelf een zoekactie kan besparen. Omgekeerd kunnen die links nu natuurlijk ook worden gelegd. De verwachting is dat het aantal tentoonstellingen waarbij één of meerdere catalogi verschenen tussen de drie- en vierhonderd ligt.
				</p>

				<p>
					Dat betekent dat tweederde van de tentoonstellingen het zonder catalogus heeft moeten doen. In het overzicht zie je zo meteen goed terug wat de belangrijke tentoonstellingen zijn (of werden geacht).
				</p>

				<p>
					Affiches zouden wat dat betreft ook 'een teken aan de wand' zijn. En daarbij natuurlijk een prachtig overzicht kunnen geven van anderhalve eeuw affiche-ontwerp. Niet voor niets waren de affiches begin dit millenium onderwerp van de tentoonstelling <a href="tentoonstelling/?id=1052608">Kom kijken : affiches van het Rijksmuseum</a>.

				<p>
					Het zou mooi zijn als er meer affiches online beschikbaar kunnen worden gemaakt. Daarvoor zal nog wel wat scanwerk en vooral ook speurwerk met betrekking tot rechthebbenden moeten worden verricht. Maar dat dat de moeite waard is zullen veel mensen onderschrijven.
				</p>

			</div>
			<div class="col-sm-1">
			</div>
			<div class="col-sm-4">
				<img src="assets/img/HA-0013503.jpg" />

				<p class="small">
					De foto van deze affiches bevindt zich in ieder geval binnen het publiek domein
				</p>

			</div>
		</div>

		<div class="row">
			<div class="col-sm-7">

				<h2>Foto's en archiefmateriaal</h2>

				<p>
					In Rijksstudio is al <a href="https://www.rijksmuseum.nl/nl/zoeken?q=tentoonstelling%20rijksmuseum&f=1&p=10&ps=12&type=foto&imgonly=True&st=Objects&ii=0">een aantal foto's</a> te vinden van tentoonstellingen en in het zogeheten <em>Historisch Archief</em> bevindt zich veel meer beeldmateriaal. Die foto's geven informatie die uit de catalogus niet naar voren komt. Welke werken hingen bij elkaar en hoe werden ze gepresenteerd?
				</p>

				<p>
					Voor zover de foto's in Rijksstudio staan, worden ze ook op de tentoonstellingspagina getoond. In de overzichten wordt het aantal foto's vermeld in een icoontje, waarvan de kleur zich vermoedelijk het beste als oudroze laat omschrijven.
				</p>

				<p>
					Archiefmateriaal is van belang voor kunsthistorisch onderzoek. Hoe kwam een tentoonstelling tot stand, welke bruiklenen werden geweigerd, wie drukte zijn of haar stempel op het uiteindelijke resultaat?
				</p>

				<p>
					Een groot deel - 'zestig strekkende meters' - van het Rijksmuseumarchief bevindt zich in het <a href="http://noord-hollandsarchief.nl/bronnen/archieven?mivast=236&mizig=210&miadt=236&micode=476&miview=inv2">Noord-Hollands Archief</a>. Bij een aantal tentoonstellingen hebben we links naar archieftoegangen opgenomen. Dat is gedaan als 'proof of concept' waarbij niet naar volledigheid is gestreefd - daarvoor is de persistentie van die links te onzeker. Naar individuele scans kan sowieso niet gelinkt worden.
				</p>

				<h2>Linked data</h2>

				<p>
					Als dit project iets heeft duidelijk gemaakt, dan is het dat iets ogenschijnlijk simpels als een tentoonstellingenoverzicht afhankelijk is van allerlei verschillende databronnen. Die databronnen kunnen binnen de eigen organisatie leven - bibliotheek en collectie worden bijgehouden in verschillende systemen -, maar ook in de wereld daarbuiten. RKD, Wikidata en het Noord-Hollands Archief zijn langsgekomen, maar het Stadsarchief Amsterdam heeft bijvoorbeeld ook materiaal over Rijksmuseumtentoonstellingen in haar collectie, en zelfs in het Stadsarchief Rotterdam ben ik wel eens wat tegengekomen.
				</p> 

				<p>
					Dat allemaal bijeen brengen kan eigenlijk alleen met linked data, en om dat te maken zijn vooraleerst goede identifiers nodig. Wat dat betreft heeft het Rijksmuseum nu een belangrijke stap gezet - elke tentoonstelling heeft zo'n identifier gekregen. De eigen bibliotheek, maar ook andere instellingen kunnen daar nu naar verwijzen.
				</p>

				<p>
					Om de data verder te verbinden maken we voor elke tentoonstelling binnenkort een Wikidata item aan, vanwaar weer wordt verwezen naar de Rijksmuseum identifier. Zo'n Wikidata item kan, zoals we gezien hebben, weer verbonden worden met tentoongestelde werken. Je kunt het ook gebruiken om zaken te beschrijven die niet in je eigen systeem passen - stel je wilt het 'hoofdonderwerp' van een tentoonstelling ergens kwijt en je hebt daar in je eigen systeem geen veld voor. Bijkomend voordeel van Wikidata is dat steeds meer instellingen het als een soort thesaurus gaan gebruiken.
				</p>

				<p>
					In zo'n groeiend web van verbonden data werk je niet meer alleen, maar laat je samen met collega-instellingen steeds meer puzzelstukjes op hun plaats vallen. Daar komt de hulp van Wikidatianen nog bij (Wikidata is ook gewoon een crowdsourceplatform).
				</p>

				<p>
					Het is nu al leuk (vinden ook de datanerds, kunsthistorici en familieleden die er een kijkje namen) om door dit in anderhalve maand gerealiseerde tentoonstellingsverleden te dwalen. Ik ben enorm benieuwd hoe zo'n overzicht er over een jaar of wat uit ziet.
				</p>

				<p>
					Menno den Engelse<br />
					Mei 2020
					
				</p>


			</div>
			<div class="col-sm-1">
			</div>
			<div class="col-sm-4">
				<img src="assets/img/HA-0010189.jpg" />

				<p class="small">
					De Rembrandttentoontstelling van 1969 - foto's als deze tonen niet alleen welke werken naast elkaar hingen, maar ook inrichtingselementen als deze opvallende verhoging in het midden van de zaal
				</p>


				<img src="assets/img/archief.jpg" />

				<p class="small">
					Een lijst met werken voor de Rembrandttentoonstelling van 1932, met doorgehaald maar nog wel leesbaar de werken die blijkbaar niet geleend konden worden
				</p>


				<img src="assets/img/NL-RtSA_4006_IA-1941-0048-01.jpg" />

				<p class="small">
					Affiche in de collectie van het Stadsarchief Rotterdam - binnenkort gekoppeld aan een tentoonstellingsidentifier?
				</p>

			</div>
		</div>
	</div>

</body>
</html>