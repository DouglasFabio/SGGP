<?php

    include("../BancoDeDados/Conexao.php");

    $conexao = conectar();

    $cdusuariosA = $_POST['cdusuariosA'];
    if ($cdusuariosA == "") $cdusuariosA = 0;
    else $cdusuariosA = 1;

    $cdusuariosL = $_POST['cdusuariosL'];
    if ($cdusuariosL == "") $cdusuariosL = 0;
    else $cdusuariosL = 1;

    $permissoesA = $_POST['permissoesA'];
    if ($permissoesA == "") $permissoesA = 0;
    else $permissoesA = 1;

    $permissoesL = $_POST['permissoesL'];
    if ($permissoesL == "") $permissoesL = 0;
    else $permissoesL = 1;

    if (!empty($error)) echo $error;

    $atualiza = "UPDATE tb_permissoes SET cdusuarios = '$cdusuariosA', permissoes = '$permissoesA' WHERE id = 0;";
    $atualiza2 = "UPDATE tb_permissoes SET cdusuarios = '$cdusuariosL', permissoes = '$permissoesL' WHERE id = 1;";

   if ($conexao->query($atualiza) == TRUE && $conexao->query($atualiza2) == TRUE) {

       header('Location: ../Visuais/GravandoPermissoes.php');

   }

    else {

        echo "Erro ao tentar salvar: " . $conexao->error;

   }


    $conexao->close();

?>