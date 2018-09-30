<?php

    include("../BancoDeDados/Conexao.php");

    $conexao = conectar();

    $busca = "SELECT * FROM `tb_usuarios` WHERE `tipo` = 0";

    $resultado = $conexao->query($busca);

    if ($resultado->num_rows == 0) {

    }
    else{

         header('Location: ../Visuais/PaginaInicial.php');

    }

    $conexao->close();

?>