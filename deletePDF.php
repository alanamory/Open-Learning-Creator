<?php

$filename = $_POST['data'];
echo $filename;
unlink($filename);

?>
