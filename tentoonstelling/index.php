<?php

include("../functions.php");

// in: $_GET['id'] out: $exhibition
include("../queries/exhibition.php");


// in: $_GET['id'] out: $rkdimages
include("../queries/rkd.php");



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

	<link rel="stylesheet" href="../assets/css/styles.css">

	<title>Tentoonstelling Rijksmuseum</title>
</head>
<body>



	<div class="container">

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

		<h2>Bij het RKD gevonden tentoongestelde werken</h2>

		<div class="row">

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