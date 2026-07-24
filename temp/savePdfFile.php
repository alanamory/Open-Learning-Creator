<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$htmlData = $_POST['data'];
$filename = time();
file_put_contents($filename.'.html', $htmlData);

echo $filename.'.html';

?>