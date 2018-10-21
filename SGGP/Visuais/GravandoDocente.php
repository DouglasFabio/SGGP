<!DOCTYPE html>
<html dir="pag" lang="en">

    <?php

        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['AdmLogin']) && !isset($_SESSION['LiderLogin'])) {

          session_destroy();
            
          header("Location: PaginaInicial.php"); exit;

        }


        include("../Uteis/HeadPainel.php");
    
    ?>

    <body>
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
           
            <header class="topbar" data-navbarbg="skin6">
               
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                   
                    <?php
                    
                        include("PartesPainel/MenuSup.php");
                    
                    ?>
                    
                </nav>
                
            </header>
            
            <aside class="left-sidebar" data-sidebarbg="skin5">
                
                 <?php
                
                    include("PartesPainel/MenuLat.php");
                
                ?>
                
            </aside>
            
            <div class="page-wrapper">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-5 align-self-center">
                            <h4 class="page-title">Cadastro de Docentes</h4>
                        </div>
                        <div class="col-7 align-self-center">
                            <div class="d-flex align-items-center justify-content-end">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">SGGP</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Docente</li>
                                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Docente</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="container-fluid">
                  <script>
                        function retorna()
                        {
                            var x;
                            var r=confirm("Problemas nos dados informados!");
                            if (r==true)
                            {
                                window.location.href = 'Painel.php';
                            }
                            else
                            {
                                window.location.href = 'Painel.php';
                            }
                            document.getElementById("demo").innerHTML=x;
                        }
                    </script>
                    <?php
                        $sigla          = $_POST['sigla'];
                        $nome_docente   = $_POST['nome_docente'];
                        $link           = $_POST['link_docente'];
                        $formacao       = $_POST['formacao_academica'];
                        $data_inclusao  = $_POST['datainc_docente'];
                        $linhas_docente  = $_POST['linhasdocente'];
                        $data_linha     = $_POST['datavinc_linha']; 
                        date_default_timezone_set('America/Sao_Paulo');
                        $hoje = date("Y-m-d");
                        
                        $qtdLinhasSelecionadas = 0;
                        // Verificando quantas linhas (e suas datas) foram selecionadas
                        foreach($linhas_docente as $k => $v){ 
                            $qtdLinhasSelecionadas++;  
                        }
                    
                        if($formacao == "1"){
                            $formacao_academica = "Ensino Fundamental";
                        }
                        
                        else if($formacao == "2"){
                             $formacao_academica = "Ensino Médio";
                        }
                        
                        else if($formacao == "3"){
                             $formacao_academica = "Ensino Superior";
                             $nome_curso         = $_POST['nome_curso'];
                             
                        }
                        else if($formacao == "4"){
                             $formacao_academica = "Especialização";
                             $nome_curso         = $_POST['nome_curso'];
                             
                        }
                        else if($formacao == "5"){
                            $formacao_academica = "Mestrado";
                            $nome_curso         = $_POST['nome_curso'];
                       
                        }
                        else if($formacao == "6"){
                            $formacao_academica = "Doutorado";
                            $nome_curso         = $_POST['nome_curso'];
                        
                        }
                    
                    
                    if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0) {
                        
                        $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
                        $nome = $_FILES[ 'arquivo' ][ 'name' ];

                            $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );

                            // Converte a extensão para minúsculo
                            $extensao = strtolower ( $extensao );

                            // Somente imagens, .jpg;.jpeg;.gif;.png
                            // Aqui eu enfileiro as extensões permitidas e separo por ';'
                            // Isso serve apenas para eu poder pesquisar dentro desta String
                            if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {

                                $novoNome =  $nome_docente. '.' . $extensao;

                                // Concatena a pasta com o nome
                                $destino = '../Uteis/Imagens/Docentes/' . $novoNome;

                                // tenta mover o arquivo para o destino
                                if ( move_uploaded_file ( $arquivo_tmp, $destino ) ) {
                                    
                                    
                                    
                                    $insereParticipantes = "INSERT INTO `tb_participantes` (`nome`, `link`, `formacao_acad`,`nome_curso`,`grupo`, `data_sistema`,`data_inclusao`, `foto`, `tipo`) 
                                                                                    VALUES ('$nome_docente', '$link', '$formacao_academica', '$nome_curso','$sigla','$hoje','$data_inclusao','$destino', 1);";
                                    
                                   if ($conexao->query($insereParticipantes) === TRUE){
                                        $buscaID = "SELECT id FROM tb_participantes ORDER BY id DESC LIMIT 1";
                                        $result = $conexao->query($buscaID);
                                        /* numeric array */
                                        $saida = $result->fetch_assoc();
                                        $i = 0;
                                        while($i < $qtdLinhasSelecionadas){
                                            $insereLinhasDocentes  = "INSERT INTO `tb_linhasdocentes` (`inicio_vinculo`,`docente`, `linha_pesquisa`)
                                                                           VALUES ('$data_linha[$i]', '".$saida['id']."', '$linhas_docente[$i]');";
                                            $conexao->query($insereLinhasDocentes); 
                                            $i++;
                                        }    
                                        echo "<div class=\"row\">
                                            <div class=\"col-12\">
                                                <div class=\"card card-body\">
                                                    <center><h4 class=\"card-title\">Cadastro realizado com sucesso!</h4></center>
                                                    <a href=\"Painel.php\" id=\"cad_novo\" class=\"btn btn-secondary\">Visualizar grupos</a>
                                                </div>
                                            </div>";
                                   }else{
                                       echo "<script>retorna();</script>";
                                   }
                                    
                                  //  else{
                                   //     echo "<script>retorna();</script>";
                                    }
                                }
                             //   else{
                                //     echo "<script>retorna();</script>";   
                                }
                          //  }
                           // else{
                        //         echo "<script>retorna();</script>";
                           // }
                   // }
                   // else{
                    //     echo "<script>retorna();</script>";
                    //}
                        $conexao->close();

                    ?>

                </div>
                <footer class="footer text-center">
                    Todos os direitos reservados por SGGP. Desenvolvido por:
                    <a href="">SGGP</a>.
                </footer>
            </div>
        </div>
        
        <?php
        
                include("../Uteis/ScriptsPainel.php");
        
        ?>
        
    </body>

</html>