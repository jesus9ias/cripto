<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<title>Algoritmo Simétrico JAES</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="" />
	<meta name="keywords" content="---" />

	<link rel="stylesheet" type="text/css" href="css/main_style.css" />
	<link rel="stylesheet" type="text/css" href="css/block_style.css" />
	<link rel="stylesheet" type="text/css" href="css/app_style.css" />
	<link rel="stylesheet" type="text/css" href="css/media_block_style.css" />
	<link rel="stylesheet" type="text/css" href="css/media_app_style.css" />

	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bignumber/bignumber.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
</head>
<body>
	<div id="general">
		<div id="head">
			<h1 class="main_title">Algoritmo Simétrico JAES</h1>
		</div>

		<div id="tabs">
			<a href="#block_generar" class="tab tab_used">Generar Llave</a>
			<a href="#block_enc" class="tab">Encriptar</a>
			<a href="#block_dec" class="tab">Desencriptar</a>
			<div class="clear"></div>
		</div>

		<div id="block_generar" class="block block_1 block_content block_used">
			<div class="block block_2_inner">
				<p class="text"><span class="num">1</span> Pasa el mouse encima del recuadro hasta completar la barra de progreso.</p>
				<div id="block_mouse"></div>
				<div id="new_key_progress"><div class="progress_show"></div></div>
			</div>
			<div class="block block_2_inner">
				<p class="text"><span class="num">2</span> Obtén tu llave y guardala muy bien.</p>
				<a href="#" id="new_key_button" class="button">Obtener llave</a>
				
				<form id="form_new_key" action="download_key.php" method="post" target="_blank"><textarea id="block_new_key" name="block_new_key" rows="15"></textarea></form>
				

				<a href="#" id="new_key_copy" class="button">Copiar</a>
				<a href="#" id="new_key_download" class="button">Descargar</a>
			</div>
			<div class="clear"></div>
		</div>

		<div id="block_enc" class="block block_1 block_content">
			<div class="block block_2_inner">
				<form id="enc_form" action="enc.php" target="_blank" method="post" enctype="multipart/form-data">
					<p class="text"><span class="num">1</span> Introduce una palabra o frase que solo tu debes conocer.</p>
					<input type="text" id="new_secret_word" name="new_secret_word" />
					<div class="clear"></div>
					
					<label for="file_key" class="label"><span class="num">2</span> Elige la llave a usar.</label>
					<input type="file" id="file_key" name="file_key" />
					
					<label for="file_to_enc"  class="label"><span class="num">3</span> Elige el archivo a cifrar</label>
					<input type="file" id="file_to_enc" name="file_to_enc" />

					<div class="clear"></div>

					<a href="#" id="enc_button" class="button">Encriptar</a>
				</form>
			</div>
			<div class="clear"></div>
		</div>

		<div id="block_dec" class="block block_1 block_content">
			<div class="block block_2_inner">
				<form id="dec_form" action="dec.php" target="_blank" method="post" enctype="multipart/form-data">
					<p class="text"><span class="num">1</span> Introduce la palabra o frace que usaste para cifrar.</p>
					<input type="text" id="secret_word" name="secret_word" />
					<p class="text"><span class="num">2</span> Introduce el nombre (con extensión) de salida del archivo descifrado.</p>
					<input type="text" id="file_name" name="file_name" />
					<div class="clear"></div>
					
					<label for="file_deckey" class="label"><span class="num">3</span> Selecciona la llave con la que cifraste.</label>
					<input type="file" id="file_deckey" name="file_deckey" />
					
					<label for="file_to_dec"  class="label"><span class="num">4</span> Elige el archivo a descifrar.</label>
					<input type="file" id="file_to_dec" name="file_to_dec" />

					<div class="clear"></div>

					<a href="#" id="dec_button" class="button">Descifrar</a>
				</form>
			</div>
			<div class="clear"></div>
		</div>

		<div class="clear"></div>
	</div>
</body>
</html>
