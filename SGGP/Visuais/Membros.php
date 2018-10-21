<!DOCTYPE html>
<html lang="en">
 <link href="https://fonts.googleapis.com/css?family=Kodchasan:600i" rel="stylesheet">

 <?php
    
	include("../Uteis/HeadPagInicial.php");
    
    $membro = $_POST['membro'];
    
    include("../BancoDeDados/Conexao.php");
    $conexao = conectar();

    $busca = "SELECT `id`, `nome`, `link`, `formacao_acad`, `nome_curso`, `grupo`, `data_inclusao`, `data_exclusao`, `foto`, `tipo` FROM `tb_participantes` WHERE `id` = ".$membro;


   $resultado = $conexao->query($busca);
                                                                
   if($resultado->num_rows > 0){
       
        $saida = $resultado->fetch_assoc();

        $busca2 = "SELECT `ano`, `atividade`, `participante` FROM `tb_tecnicos` WHERE `participante` =".$membro;

        $resultado2 = $conexao->query($busca2);
        $saida2 = $resultado2->fetch_assoc();
    
?>

  <body style="background-color: #ffffff">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="../Visuais/PaginaInicial.php" target = "_top">Início</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" target = "_top">Grupos de Pesquisa</a>
            </li>
            <li class="nav-item">
                <?php
                    if(isset($_SESSION['AdmLogin']) || isset($_SESSION['LiderLogin'])){
                ?>
                        <a class="nav-link" href="../Visuais/Login.php" target = "_top">Painel</a>
                <?php
                    }
                    else{
                ?>
                        <a class="nav-link" href="../Visuais/Login.php" target = "_top">Login</a>
                <?php
                    }
                ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <!-- Page Header -->
    <header class="masthead">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <img class="img-thumbnail" style=" max-width:300px; max-height:200px; width: auto; height: auto;" src="<?php echo $saida['foto']; ?>" alt="">
              <h1><?php echo $saida['grupo']; ?></h1>
              <h2 class="post-title" style="font-family: Kodchasan;"><?php echo $saida['nome']; ?></h2>
                <br>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            
          </div>
        </div>
      </div>
    <!-- Footer --> 
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
              
              <br>
              <p class="post-meta"> Formação Academica                 
              </p>
              <table class="table table-hover">
               <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>    
                    
                  <tbody>
                       <?php
                            printf('<tr>
                                        <td>'.$saida['formacao_acad'].'</td>
                                        <td>'.$saida['nome_curso'].'</td>
                                        <td>'.$saida2['ano'].'</td>
                                    </tr>');      
                        ?>
                </tbody>
                  
                </table>
              <?php
                if($saida['tipo'] == 1){
              ?>
              <br>
              <p class="post-meta"> Linhas de Pesquisa Relacionadas                
              </p>
              <table class="table table-hover">
                               
                    <thead>
                        <tr>
                            <th scope="col">Linha</th>
                            <th scope="col">Inicio do Vinculo</th>
                        </tr>
                    </thead>
                  <tbody>
                       <?php

                        $busca3 = "SELECT `id`, `inicio_vinculo`, `fim_vinculo`, `docente`, `linha_pesquisa` FROM `tb_linhasdocentes` WHERE `docente` =".$membro;

                            if ($resultado3 = $conexao->prepare($busca3)) {

                                $resultado3->execute();

                                $resultado3->bind_result($id, $inicio_vinculo, $fim_vinculo, $docente, $linha_pesquisa);

                                while ($resultado3->fetch()) {
                                    if($data_exclusao != ""){
                                             
                                    }
                                    else{
                                        printf('<tr>
                                                <td>'.$linha_pesquisa.'</td>
                                                <td>'.$inicio_vinculo.'</td></tr>');
                                    }
                                }   
                            }
                            else {
                                printf( "Erro no SQL!");
                            }
                            $resultado3->close();   
                        ?>
                </tbody>
                  
                </table>
              <?php
                }
                if($saida['tipo'] == 1){
              ?>
              <br>
              <p class="post-meta"> Atividade: <?php echo $saida2['atividade']; ?>                   
              </p>
              <?php
                }
                ?>
              <br>
              <p class="post-meta"> Veja o currículo completo: <a target = "_top" href="http://<?php echo $saida['link']; ?>"> <?php echo $saida['link']; ?> </a>                  
              </p>
              <br>
              <p class="post-meta"> Grupo ativo desde: <?php echo $saida['data_inclusao'];?>                 
              </p>
            <p class="copyright text-muted">Desenvolvido por SGGP. &copy; Todos os direitos reservados.</p>
          </div>
        </div>
      </div>
        
    </footer>

 <?php
   }
	include("../Uteis/ScriptsPagInicial.php");

?>


  </body>

</html>
