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

		<h1><?= $exhtitle ?></h1>

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


	</div>


<script>
	$('.infobutton').click(function(){
		console.log($(this).closest('.description'));
		$(this).siblings('.description').toggle();
	});
</script>
</body>
</html>