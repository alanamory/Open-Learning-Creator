<?php

$file = $_POST['data'];
echo $file;
unlink($file);

?>