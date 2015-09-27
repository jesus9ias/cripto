<?php

date_default_timezone_set('America/Mexico_City');

$file_deckey = $_FILES['file_deckey'];
$file_to_dec = $_FILES['file_to_dec'];

$palabra = $_POST['secret_word'];
$file_name = $_POST['file_name'];

$fecha =  mktime();

move_uploaded_file($file_deckey['tmp_name'],'tmp_dec_keys/key_'.$fecha.'.key');
move_uploaded_file($file_to_dec['tmp_name'],'tmp_dats/txt_'.$fecha.'.dat');


//leer llave

$ruta = 'tmp_dec_keys/key_'.$fecha.'.key';
$json = file_get_contents($ruta);
/*$name = 'key_'.$fecha.'.key';
$fp=fopen($ruta,'r');
$json = fgets($fp);
fclose($fp);*/

$key = json_decode($json,1);

// leer el archivo a descifrar

$ruta = 'tmp_dats/txt_'.$fecha.'.dat';
$txt = file_get_contents($ruta);
/*$name = 'txt_'.$fecha.'.dat';
$fp=fopen($ruta,'r');
$txt = fgets($fp);
fclose($fp);*/

$palabra_md5 = md5($palabra);
$palabra_md5_array = array();
$palabra_md5_new_array = array();

$md5_list = array(0=>1,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,'a'=>10,'b'=>11,'c'=>12,'d'=>13,'e'=>14,'f'=>15);
$md5_new_list = array(0=>1,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,'a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5,'f'=>6);

for($i=0;$i<32;$i++){
	$palabra_md5_array[] = $palabra_md5{$i};
	$palabra_md5_new_array[] = $md5_list[$palabra_md5{$i}];
}

$txt_array = json_decode($txt,1);

$deciphered_txt = array();

function dec_1($letra,$md,$x,$y){
	$mul_key = bcmul($x,$y);
	$sum_key = bcadd($x,$y);
	$res_1 = bcadd(bcmod($mul_key,$md),$md);
	$res_2 = bcadd(bcmod($sum_key,$res_1),'1');
	$mul_2 = bcadd(bcmod($res_2,$res_1),'1');
	$mul_3 = bcmul($mul_2,$md);

	$sum_1 = bcadd($letra,$mul_3);
	$sub_1 = bcdiv($sum_1,$res_1);
	return $sub_1;
}

function dec_2($letra,$md,$x){
	$res_1 = bcadd(bcmod($x,$md),$md);
	$res_2 = bcadd(bcmod($x,$res_1),'1');
	$mul_2 = bcadd(bcmod($res_2,$res_1),'1');
	$mul_3 = bcmul($mul_2,$md);

	$sum_1 = bcadd($letra,$mul_3);
	$sub_1 = bcdiv($sum_1,$res_1);
	return $sub_1;
}

function dec_3($letra,$md,$y){
	$res_1 = bcadd(bcmod($y,$md),$md);
	$res_2 = bcadd(bcmod($y,$res_1),'1');
	$mul_2 = bcadd(bcmod($res_2,$res_1),'1');
	$mul_3 = bcmul($mul_2,$md);

	$sum_1 = bcadd($letra,$mul_3);
	$sub_1 = bcdiv($sum_1,$res_1);
	return $sub_1;
}

$x = array();
$y = array();

$q = 0;
for($a=0;$a<strlen($key['x']);$a++){
	if($q < 31){$q++;}else{$q=0;}

	if($key['x']{$a} == $palabra_md5_new_array[$q]){
		if( $key['x']{$a} % 2 == 0){
			$x[] = $key['x']{$a} + 1;
		}else{
			$x[] = $key['x']{$a} - 1;
		}
	}else{
		$x[] = $key['x'][$a];
	}
}

$x = implode('',$x);

$w = 0;
for($a=0;$a<strlen($key['y']);$a++){
	if($w < 31){$w++;}else{$w=0;}

	if($key['y']{$a} == $palabra_md5_new_array[$w]){
		if( $key['y']{$a} % 2 == 0){
			$y[] = $key['y']{$a} + 1;
		}else{
			$y[] = $key['y']{$a} - 1;
		}
	}else{
		$y[] = $key['y'][$a];
	}
}
$y = implode('',$y);

$n = 0;
foreach($txt_array as $k => $value){
	if($n < 31){$n++;}else{$n=0;}

	$letra_3 = dec_3($value,$palabra_md5_new_array[$n],$y);
	$letra_2 = dec_2($letra_3,$palabra_md5_new_array[$n],$x);
	$letra_1 = dec_1($letra_2,$palabra_md5_new_array[$n],$x,$y);

	$deciphered_txt[] = chr($letra_1);
}

//print_r($deciphered_txt);

$nuevo_txt = implode('',$deciphered_txt);

$ruta = 'tmp_desciphered/ciphered_'.$fecha.'.dat';
$name = 'ciphered_'.$fecha.'.dat';

$fp=fopen($ruta,'x');
fwrite($fp,$nuevo_txt);
fclose($fp);

header('Content-Type: text/plain-text');
header('Content-Length: '.filesize($ruta));
header('Content-Disposition: attachment; filename='.$file_name);
readfile($ruta);


?>