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
<body>



	<div class="container">

		<div id="topnavbar">
			<a href="about.php">over deze applicatie</a>
		</div>

		<h1>Rijksmuseum Tentoonstellingen</h1>

		<div id="decades">
			<?php
			for($i=1880; $i<2020; $i+=10){
				if($i==$_GET['startyear']){
					echo '<a style="text-decoration:underline" href="index.php?startyear=' . $i . '">' . $i . '\'s</a>';
				}else{
					echo '<a href="index.php?startyear=' . $i . '">' . $i . '\'s</a>';
				}
			}
			?>
		</div>

		<div class="row">
			<div id="legend" class="col-sm">
				<div class="worksicon rm-works">3</div>= RM objecten
				<div class="worksicon rm-works-noimg">3</div>= RM objecten zonder afb
				<div class="worksicon rkd-works">3</div>= RKDimages
				<div class="worksicon wd-works">3</div>= Wikidata images
				<div class="worksicon reviews">3</div>= krantenartikelen
				<div class="worksicon rm-cats">1</div>= catalogi
				<div class="duration" style="width: 45px; display: inline-block;"></div> = lengte tentoonstelling
			</div>
		</div>

		<div class="row">

			<?php
			$i = 0;
			foreach ($exhibitions['results']['bindings'] as $exh) {
				$i++;

				$title = $exh['title']['value'];
				$ttid = str_replace("https://id.rijksmuseum.nl/", "", $exh['tt']['value']);
				$rmworks = $exh['cRmImg']['value'];
				$rmworkswithoutimgs = $exh['cRmNoImg']['value'];
				$rkdworks = $exh['cRkdImg']['value'];
				$wdworks = $exh['cWdImg']['value'];
				$cats = $exh['cCat']['value'];

				$duration = durationInfo($exh['start'],$exh['end']);
				if($duration['days']){
					$width = $duration['days'] * (100/365);
					if($width > 100){ $width = 100; }
					$durationstyle = "width: " . $width . "%";
					if($width < 0){ $durationstyle = "background-color: #DC110C;"; }
				}else{
					$durationstyle = "display: none";
				}

				//print_r($exh);

				echo '<div class="col-sm">';
					echo '<h3><a href="tentoonstelling/?id=' . $ttid . '">' . $title . '</a></h3>';
					echo '<div class="duration" style="' . $durationstyle . '"></div>';
					echo '<div class="small">' . $duration['line'] . '</div>';
					echo '<div class="small light">' . $exh['tt']['value'] . '</div>';
					if($rmworks){
						echo '<div class="worksicon rm-works">' . $rmworks . '</div>';
					}
					if($rmworkswithoutimgs){
						echo '<div class="worksicon rm-works-noimg">' . $rmworkswithoutimgs . '</div>';
					}
					if($rkdworks){
						echo '<div class="worksicon rkd-works">' . $rkdworks . '</div>';
					}
					if($wdworks){
						echo '<div class="worksicon wd-works">' . $wdworks . '</div>';
					}
					if($cats){
						echo '<div class="worksicon rm-cats">' . $cats . '</div>';
					}
					//echo $exh['start']['value'];
				echo '</div>';

				if($i%3==0){
					echo '</div>';
					echo '<div class="row">';
				}
			}
			for($x=0; $x<(3-$i%3); $x++){
				echo '<div class="col-sm">';
				echo '</div>';
			}
			?>
		</div>
	</div>

</body>
</html>