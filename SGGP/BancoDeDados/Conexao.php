<?php

	error_reporting(0);
	ini_set(“display_errors”, 0 );

?>

<?php
function conectar(){

	$conexao = new mysqli("localhost", "root", "toor", "bd_sggp");
    mysqli_set_charset( $conexao, 'utf8');

	if ($conexao->connect_error) {

    		return die("Connection failed: " . $conn->connect_error);

	}
	else{

		return $conexao;
	
	}

}
?>