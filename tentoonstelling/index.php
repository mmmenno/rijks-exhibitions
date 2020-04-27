<?php

include("../functions.php");

// in: $_GET['id'] out: $exhibition
include("../queries/exhibition.php");


// in: $_GET['id'] out: $rkdimages
include("../queries/rkd.php");


$wdimages = array();
if(isset($exhibition['results']['bindings'][0]['wdtt']['value'])){
	$wdtt = $exhibition['results']['bindings'][0]['wdtt']['value'];
	// in: $wdtt out: $wdimages
	include("../queries/wikidata.php");
}
//print_r($wdimages);

$exh = $exhibition['results']['bindings'][0];
$exhtitle = $exh['exhtitle']['value'];

$duration = durationInfo($exh['start'],$exh['end']);
if($duration['days']){
	$width = $duration['days'] * (100/365);
	if($width > 100){ $width = 100; }
	$durationstyle = "width: " . $width . "%";
	if($width < 0){ $durationstyle = "background-color: #DC110C;"; }
}else{
	$durationstyle = "display: none";
}

$delpherlink = 'https://www.delpher.nl/nl/kranten/results?query=';
$delpherlink .= 'Rijksmuseum+and+tentoonstelling';
$delpherlink .= wordsFromTitleAsQueryString($exhtitle);
$delpherlink .= '&page=1&sortfield=date&cql%5B%5D=(date+_gte_+%22';
$delpherlink .= date("d-m-Y",strtotime($duration['startdate'] . ' -3 days'));
$delpherlink .= '%22)&cql%5B%5D=(date+_lte_+%22';
$delpherlink .= date("d-m-Y",strtotime($duration['enddate']));
$delpherlink .= '%22)&coll=ddd';

$crowdsourcelink = "../crowdsourcing/add-article.php?ttid=" . $_GET['id'] . "&title=";
$crowdsourcelink .= urlencode($exhtitle);


?>
<!doctype html>
<html lang="nl">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<!-- jQuery -->
	<script
	src="https://code.jquery.com/jquery-3.4.1.min.js"
	integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.1.0/dist/leaflet.css" integrity="sha512-wcw6ts8Anuw10Mzh9Ytw4pylW8+NAD4ch3lqm9lzAsTxg0GFeJgoAtxuCLREZSC5lUXdVyo/7yfsqFjQ4S+aKw==" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.1.0/dist/leaflet.js" integrity="sha512-mNqn2Wg7tSToJhvHcqfzLMU6J4mkOImSPTxVZAdo+lcPlk+GhZmYgACEe0x35K7YzW1zJ7XyJV/TT1MrdXvMcA==" crossorigin=""></script>
  	
  	<link rel="stylesheet" href="../assets/css/styles.css">

	<title>Tentoonstelling Rijksmuseum</title>
</head>
<body>

	<div class="container">

		<div id="topnavbar">
			<a href="../about.php">over deze applicatie</a>
		</div>

		<h1><a href="../">Rijksmuseum Tentoonstellingen</a></h1>

		<?php if(isset($_GET['msg'])){ ?>
			<div class="msg"><?= $_GET['msg'] ?></div>
		<?php } ?>

		<h2 class="exhibitiontitle"><?= $exhtitle ?></h2>

		<div id="dates">
			<span class="light" style="float: right;">https://id.rijksmuseum.nl/<?= $_GET['id'] ?></span>
			<h2><?= $duration['line'] ?></h2>
			<div class="duration" style="<?= $durationstyle ?>"></div>
		</div>

		<div class="row">

			<?php
			$i = 0;
			foreach ($exhibition['results']['bindings'] as $img) {

				if(!isset($img['obj']['value'])){
					continue;
				}

				$i++;

				$title = $img['title']['value'];
				$imgurl = false;
				if(isset($img['img']['value'])){
					$imgurl = str_replace("=s0", "", $img['img']['value']);
				}
				$desc = $img['desc']['value'];
				$artist = $img['artist']['value'];
				$permalink = $img['permalink']['value'];

				

				echo '<div class="col-sm exh-object">';
					if($imgurl){
						echo '<a target="_blank" href="' . $permalink . '"><img src="' . $imgurl . '" /></a>';
					}else{
						echo '<a class="no-img" target="_blank" href="' . $permalink . '">afbeelding niet beschikbaar</a>';
					}
					if(strlen($desc)){
						echo '<button class="infobutton">i</button>';
					}
					echo '<em>' . $title . "</em><br />";
					echo '<strong>' . $artist . "</strong><br />";
					if(strlen($desc)){
						echo '<div class="description">' . $desc . "</div>";
					}
				echo '</div>';

				if($i%4==0){
					echo '</div>';
					echo '<div class="row">';
				}
			}
			for($x=0; $x<(4-$i%4); $x++){
				echo '<div class="col-sm">';
				echo '</div>';
			}
			?>
		</div>



		<?php if(count($rkdimages['results']['bindings'])){ ?>

		<h2>Tentoongestelde objecten volgens het RKD</h2>

		<div class="row rkd">

			<?php
			$i = 0;
			foreach ($rkdimages['results']['bindings'] as $img) {

				$i++;

				$title = $img['title']['value'];
				$imgurl = false;
				if(isset($img['img']['value'])){
					$imgurl = str_replace("=s0", "", $img['img']['value']);
				}
				$desc = $img['desc']['value'];
				$artist = $img['artistLabel']['value'];
				$institute = $img['instLabel']['value'];
				$permalink = $img['permalink']['value'];

				

				echo '<div class="col-sm exh-object">';
					if($imgurl){
						echo '<a target="_blank" href="' . $permalink . '"><img src="' . $imgurl . '" /></a>';
					}else{
						echo '<a class="no-img" target="_blank" href="' . $permalink . '">afbeelding niet beschikbaar</a>';
					}
					echo '<em>' . $title . "</em><br />";
					echo '<strong>' . $artist . "</strong><br />";
					echo $institute;
				echo '</div>';

				if($i%6==0){
					echo '</div>';
					echo '<div class="row rkd">';
				}
			}
			for($x=0; $x<(6-$i%6); $x++){
				echo '<div class="col-sm">';
				echo '</div>';
			}
			?>
		</div>

		<?php } ?>



		<?php if(count($wdimages['results']['bindings'])){ ?>

		<h2>Tentoongestelde objecten volgens Wikidata</h2>

		<div class="row wikidata">

			<div class="col-sm-6">
				<?php include("wikidata-map.php"); ?>
			</div>

			<?php
			$i = 3;
			$last = "";
			foreach ($wdimages['results']['bindings'] as $img) {

				if($img['work']['value']==$last){
					continue;
				}
				$last = $img['work']['value'];

				$i++;

				$title = $img['workLabel']['value'];
				if(strlen($img['workarticle']['value'])){
					$title = '<a href="' . $img['workarticle']['value'] . '">' . $img['workLabel']['value'] . '</a>';
				}
				$imgurl = false;
				if(isset($img['img']['value'])){
					$imgurl = $img['img']['value'] . "?width=300px";
				}
				$desc = $img['desc']['value'];
				$artist = $img['makerLabel']['value'];
				$institute = $img['collectionLabel']['value'];
				if(strlen($img['article']['value'])){
					$institute = '<a href="' . $img['article']['value'] . '">' . $img['collectionLabel']['value'] . '</a>';
				}
				$permalink = $img['work']['value'];

				

				echo '<div class="col-sm exh-object">';
					if($imgurl){
						echo '<a target="_blank" href="' . $permalink . '"><img src="' . $imgurl . '" /></a>';
					}else{
						echo '<a class="no-img" target="_blank" href="' . $permalink . '">afbeelding niet beschikbaar</a>';
					}
					echo '<em>' . $title . "</em><br />";
					echo '<strong>' . $artist . "</strong><br />";
					echo $institute; 
				echo '</div>';

				if($i%6==0){
					echo '</div>';
					echo '<div class="row wikidata">';
				}
			}
			for($x=0; $x<(6-$i%6); $x++){
				echo '<div class="col-sm">';
				echo '</div>';
			}
			?>
		</div>

		<?php } ?>



		<h2>In de media</h2>

		<div class="row">
			<div class="col-sm">
				<?php if((int)$duration['startyear']<1996){ ?>
					<p>
						<a target="_blank" href="<?= $delpherlink ?>">Zoek zelf in Delpher</a> naar artikelen over deze tentoonstelling. We hebben al wat parameters in de link gestopt, zodat je artikelen binnen de juiste periode vindt waarin gerept wordt over een tentoonstelling, het Rijksmuseum en tenminste één woord uit de titel van de tentoonstelling.
					</p>
					<p>
						Een recensie of artikel gevonden waarvan je denkt dat anderen het ook graag bij deze tentoonstelling zouden lezen? Meld het ons <a href="<?= $crowdsourcelink ?>">hier</a>. 
					</p>
				<?php }else{ ?>
					<p>
						Anders dan bij oudere tentoonstellingen hier geen link naar Delpher, aangezien je daar geen kranten van na 1995 treft.
					</p>
					<p>
						Elders een recensie gevonden waarvan je denkt dat anderen het ook graag bij deze tentoonstelling zouden lezen? Meld het ons <a href="<?= $crowdsourcelink ?>">hier</a>.
					</p>
				<?php } ?>

				
			</div>
			<div class="col-sm">
			</div>
			<div class="col-sm">
			</div>
		</div>


	</div>


<script>
	$('.infobutton').click(function(){
		console.log($(this).closest('.description'));
		$(this).siblings('.description').toggle();
	});
</script>
</body>
</html>