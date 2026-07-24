<?php 
$data = $_POST['data'];
$time = $_POST['time'];
file_put_contents('temp/'.$time.'.html', $data);
chmod('temp/'.$time.'.html', 0777);

echo $time;

?>
