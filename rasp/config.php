<?
header("Content-Type: application/x-javascript");
$hash = "bx_random_hash";
$config = array("appmap" =>
	array("main" => "rasp",
		"left" => "/rasp/left.php",
		"right" => "/rasp/right.php",
		"settings" => "/rasp/settings.php",
		"hash" => substr($hash, rand(1, strlen($hash)))
	)
);
echo json_encode($config);
?>