<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
            if (!isset($_SESSION)) session_start();
            if (!isset($_SESSION['AdmLogin'])) {
                header("Location: ../Visuais/Painel.php"); exit;
            }
            include("../Uteis/HeadPainel.php");
        ?>
    </head>
<body>
    <?php
        include("../BancoDeDados/Conexao.php");
        $conexao = conectar();
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');
        
        $nome        = $_POST['nome_grupo'];
        $sigla       = $_POST['sigla_grupo'];
        $lider       = $_POST['lider_grupo'];
        // CHAVE PRIMARIA DE USUARIOS = LOGIN
        // CHAVE ESTRANGEIRA DE LIDERES = LIDER
    
        if(strlen($nome) > 50){
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");
        }

        else if(empty($nome)){
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");    
        }

        else if(empty($sigla)){
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");
        }

        else if(strlen($sigla) > 10){
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");
        }
        
        // Se não for letras e números, da erro!!
        else if(!ctype_alnum($sigla)){
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");    
        }

        else if(empty($lider)){
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");
        }                  
    ?>
    <form action="../Visuais/CadGrupo.php" method="post">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Grupo cadastrado com sucesso!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <input name="sigla" value="<?php echo $sigla; ?>" hidden>
              <div class="modal-footer">
                <button type="submit" class="btn btn-secondary">OK</button>
              </div>
            </div>
          </div>
        </div>
    </form>

    <form action="../Visuais/CadUsuario.php" method="post">
        <div class="modal fade" id="erro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Problemas nos dados informados!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <input name="sigla" value="<?php echo $sigla; ?>" hidden>
              <div class="modal-footer">
                <button type="submit" class="btn btn-secondary">OK</button>
              </div>
            </div>
          </div>
        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php
        include("../Uteis/ScriptsPainel.php");
        
        $buscaLogin = " SELECT `lider`
                        FROM `tb_lideres`
                        WHERE nome = '$lider'";
                        
        $resultado = $conexao->query($buscaLogin);
                    
        if ($resultado->num_rows > 0) {
            $saida = $resultado->fetch_assoc();
            $buscaEmail = " SELECT `email`
                            FROM `tb_usuarios`
                            WHERE `login` = '".$saida["lider"]."'";
            
            $resultado2 = $conexao->query($buscaEmail);
            
            if ($resultado2->num_rows > 0) {
                $saida2 = $resultado2->fetch_assoc();
                $mensagem    = "Lider, por favor acesse o Sistema SGGP e ative seu grupo: ".$nome."!";
                include("../Funcionais/Email.php");
                enviarEmail($saida2["email"], $mensagem);

                $insere = "INSERT INTO `tb_grupospesquisa` (`nome`, `sigla`, `lider`, `situacao`, `email`, `link`, `descricao`, `logotipo`, `data_inicio`) 
                                                    VALUES ('$nome', '$sigla', '".$saida["lider"]."', '2', NULL, NULL, NULL, NULL, NULL);";

                if ($conexao->query($insere) === TRUE) {
                    printf("<script>
                            $(document).ready(function(){
                            $('#myModal').modal('show');
                            });
                            </script>");
                    $conteudo = '<!DOCTYPE html>
                                 <html lang="pt">
                                    <head>
                                        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                                        <title>'.$sigla.'</title>
                                    </head>
                                    <frameset rows="100%" border="0"> 
                                        <?php
                                            $sigla = "'.$sigla.'";
                                            if(!isset($_SESSION)) session_start();
                                            $_SESSION[\'sigla\'] = $sigla;
                                        ?>
                                        <frame src="PaginaGrupos.php"> 
                                        </frameset>
                                        </html>';
                    $local = "../Grupos/".$conexao->insert_id.".php";
                    file_put_contents($local, $conteudo);
                }else{
                    printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");    
                }
        }
        else{
            printf("<script>
                    $(document).ready(function(){
                    $('#erro').modal('show');
                    });
                    </script>");    
        }
    }
    else{
            printf("<script>
                    $(document).ready(function(){
                    $('#erro').modal('show');
                    });
                    </script>");    
        }
         $resultado->close();
         $resultado2->close();
         $conexao->close();

    ?>
</body>
</html>