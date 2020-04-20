<?php

include("../functions.php");


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

		<h2 class="exhibitiontitle">Recensie toevoegen bij tentoonstelling "<?= urldecode($_GET['title']) ?>"</h2>

		<form action="add-article-action.php" method="POST">

			<input name="ttid" id="ttid" class="form-control" type="hidden" value="<?= $_GET['ttid'] ?>" />

			<label for="permalink">Permalink / URL artikel (bij Delpher te vinden links onderaan, onder 'Details')</label>
			<input id="permalink" name="permalink" class="form-control" type="url" value="" placeholder="bijv. 'https://resolver.kb.nl/resolve?urn=ddd:010957050:mpeg21:a0166' of 'https://www.parool.nl/cs-b26694ed'" required="required" />

			<label for="titel">Kop / titel</label>
			<input id="titel" name="titel" class="form-control" type="text" value="" placeholder="kop / titel van de recensie" required="required" />

			<label for="krant">Krant</label>
			<input id="krant" name="krant" required="required" class="form-control" type="text" value="" placeholder="naam van de krant" />

			<label for="datum">Publicatiedatum krant</label>
			<input id="datum" name="datum" required="required" class="form-control" type="text" value="" placeholder="dd-mm-jjjj" />

			<input name="field-url" id="field-url" class="form-control" type="url" value="" placeholder="http://etc" />

			<input class="btn-primary btn" type="submit" value="verzenden" />

		</form>


	</div>


<script>
	$('.infobutton').click(function(){
		console.log($(this).closest('.description'));
		$(this).siblings('.description').toggle();
	});
</script>
</body>
</html>