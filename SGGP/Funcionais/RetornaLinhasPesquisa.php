<?php
    $pdo = new PDO("mysql:host=localhost; dbname=bd_sggp; charset=utf8;", "root", "toor", $opcoes);
    $dados = $pdo->prepare("SELECT * FROM tb_capes");
    $dados->execute();
    echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>