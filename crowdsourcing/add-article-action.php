<?php


if(strlen($_POST['field-url'])){
	// not supposed to happen, gently move away
	header('Location: https://hicsuntleones.nl/tentoonstellingen-rijks/');
	exit;
}

unset($_POST['field-url']);

$jsondata = json_encode($_POST);

//echo $jsondata;

file_put_contents("reviews.ndjson", $jsondata . "\n", FILE_APPEND);

$msg = "link naar artikel opgeslagen, dank je wel";


header('Location: ../tentoonstelling/?id=' . $_POST['ttid'] . '&msg=' . urlencode($msg));
exit;

?>