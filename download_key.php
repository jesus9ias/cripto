<?php

$key = $_POST['block_new_key'];

$fecha = mktime();

$ruta = 'keys/key_'.$fecha.'.key';
$name = 'key_'.$fecha.'.key';

$fp=fopen($ruta,'x');
fwrite($fp,$key);
fclose($fp);

header('Content-Type: text/plain-text');
header('Content-Length: '.filesize($ruta));
header('Content-Disposition: attachment; filename='.$name);
readfile($ruta);

?>