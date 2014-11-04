<?php
set_error_handler('error_handler', E_ALL);
function error_handler($errno, $errstr, $errfile, $errline)
{
	if (ob_get_length()) {
		ob_clean();
	}
	$error_message = 'Nomor Errror : ' . $errno . chr(50) . "<br>" .
					 'Keterangan Error : ' . $errstr . "<br>" .
					 'Berkas Error : ' . $errfile . ', baris ' . $errline . '.';
	echo $error_message;
	exit;
}

?>