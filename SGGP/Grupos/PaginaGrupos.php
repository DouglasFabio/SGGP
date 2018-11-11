<!DOCTYPE html>
<html lang="en">
 <link href="https://fonts.googleapis.com/css?family=Kodchasan:600i" rel="stylesheet">

 <?php
    
    if (!isset($_SESSION)) session_start();
    
	include("../Uteis/HeadPagInicial.php");
    
    $sigla = $_SESSION['sigla'];
    
    include("../BancoDeDados/Conexao.php");
    $conexao = conectar();

    $busca = "SELECT `logotipo`, `nome`, `link`, `descricao`, `data_inicio`, `lider`, `email` FROM `tb_grupospesquisa` WHERE `sigla` = '". $sigla."'";


   $resultado = $conexao->query($busca);
                                                                
   if($resultado->num_rows > 0){
       
        $saida = $resultado->fetch_assoc();
       
        $busca2 = "SELECT `nome` FROM `tb_lideres` WHERE `lider` = '". $saida['lider']."'";
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
    <header class="masthead" style="background-image: url('<?php echo $saida['logotipo']; ?>')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <img class="img-thumbnail" style=" max-width:300px; max-height:200px; width: auto; height: auto;" src="<?php echo $saida['logotipo']; ?>" alt="">
              <h1><?php echo $sigla; ?></h1>
              <h2 class="post-title" style="font-family: Kodchasan;"><?php echo $saida['nome']; ?></h2>
                <br>
              <h2 class="post-title" style="font-family: Kodchasan;"><?php echo $saida2['nome']; ?></h2>
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
              
              <h3 class="post-subtitle" style="text-align: justify; font-weight: normal; font-family:\'Open Sans\',\'Helvetica Neue\',Helvetica,Arial,sans-serif">
                 <?php echo $saida['descricao']; ?>
              </h3>
              <br>
              <p class="post-meta"> Veja o currículo completo: <a target = "_top" href="http://<?php echo $saida['link']; ?>"> <?php echo $saida['link']; ?> </a>                  
              </p>
              <br>
              <p class="post-meta"> Grupo ativo desde: <?php echo $saida['data_inicio']; }?>                 
              </p>
              <br>
              <p class="post-meta"> Integrantes                 
              </p>
              <table class="table table-hover">
                               
                    
                  <tbody>
                       <?php

                        $busca2 = "SELECT id, nome, grupo, tipo, data_exclusao, link, formacao_acad, nome_curso, data_inclusao, foto  FROM tb_participantes WHERE grupo ='".$sigla."' ORDER BY tipo asc";

                            if ($resultado2 = $conexao->prepare($busca2)) {

                                $resultado2->execute();

                                $resultado2->bind_result($id, $nome, $grupo, $tipo, $data_exclusao, $link, $formacao_acad, $nome_curso, $data_inclusao, $foto);

                                while ($resultado2->fetch()) {
                                    if($data_exclusao != ""){
                                             
                                    }
                                    else if($tipo == "0"){
                                        printf('<tr>
                                                <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">Nome</th>
                                                        <th scope="col">Tipo</th>
                                                    </tr>
                                                </thead>
                                                <td><img class="img-thumbnail" style=" max-width:100px; max-height:100px; width: auto; height: auto;" src="'.$foto.'" alt=""></td>
                                                <td>'.$nome.'</td>
                                                <td><form action="../Visuais/Membros.php" method="post">
                                                <input type="text" name="membro" value="'.$id.'" hidden>
                                                <button type="submit" class="btn btn-outline-info" style="color: #0085a1;">TÉCNICO</button></form></td>
                                                </tr>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Participante desde:</th>
                                                        <th scope="col">Formação</th>
                                                        <th scope="col">Lattes</th>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                <td>'.$data_inclusao.'</td>
                                                <td>'.$formacao_acad.'</td>
                                                <td><a href="http://'.$link.'">'.$link.'</a></td>
                                                </tr>');
                                    }
                                    else if($tipo == "1"){
                                        printf('<tr>
                                                <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">Nome</th>
                                                        <th scope="col">Tipo</th>
                                                    </tr>
                                                </thead>
                                                <td><img class="img-thumbnail" style=" max-width:100px; max-height:100px; width: auto; height: auto;" src="'.$foto.'" alt=""></td>
                                                <td>'.$nome.'</td>
                                                <td><form action="../Visuais/Membros.php" method="post">
                                                <input type="text" name="membro" value="'.$id.'" hidden>
                                                <button type="submit" class="btn btn-outline-info" style="color: #33d6ff;">DOCENTE</button></form></td></tr>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Participante desde:</th>
                                                        <th scope="col">Formação</th>
                                                        <th scope="col">Lattes</th>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                <td>'.$data_inclusao.'</td>
                                                <td>'.$formacao_acad.'</td>
                                                <td><a href="http://'.$link.'">'.$link.'</a></td>
                                                </tr>
                                                ');
                                    }
                                }   
                            }
                            else {
                                printf( "Erro no SQL!");
                            }
                            $resultado2->close();   
                        ?>
                </tbody>
                  
                </table>
              
              <br>
              <p class="post-meta"> Linhas de Pesquisa Relacionadas                
              </p>
              <table class="table table-hover">
                               
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Descricao</th>
                        </tr>
                    </thead>
                  <tbody>
                       <?php

                        $busca3 = "SELECT e.nome, e.codigo, l.codigo_capes, l.grupo, l.descricao FROM tb_linhasgrupos AS l INNER JOIN tb_subespecialidades AS e WHERE l.grupo ='".$sigla."' AND l.codigo_capes = e.codigo";

                            if ($resultado3 = $conexao->prepare($busca3)) {

                                $resultado3->execute();

                                $resultado3->bind_result($nome, $codigo, $codigocapes, $grupo, $descricao);

                                while ($resultado3->fetch()) {
                                    if($data_exclusao != ""){
                                             
                                    }
                                    else if($tipo == "0"){
                                        printf('<tr>
                                                <td>'.$nome.'</td>
                                                <td>'.$descricao.'</td></tr>');
                                    }
                                    else if($tipo == "1"){
                                        printf('<tr>
                                                <td>'.$nome.'</td>
                                                <td>'.$descricao.'</td></tr>');
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
              
              <br>
              <p class="post-meta"> Projetos de Pesquisa                
              </p>
              <table class="table table-hover">
                               
                    <thead>
                        <tr>
                            <th scope="col">Título</th>
                            <th scope="col">Orientador</th>
                            <th scope="col">Orientado</th>
                            <th scope="col">Área de Pesquisa</th>
                            <th scope="col">Bolsa</th>
                            <th scope="col">Publicações</th>
                        </tr>
                    </thead>
                  <tbody>
                       <?php
                        
                        $busca4 = "SELECT p.id, p.titulo, d.nome, a.nome, l.nome, p.tipo FROM tb_projetospesquisa as p INNER JOIN tb_participantes as d ON p.docente = d.id INNER JOIN tb_alunos as a ON p.aluno = a.id INNER JOIN tb_subespecialidades as l ON p.linha = l.codigo WHERE p.grupo = '".$sigla."';";

                            if ($resultado4 = $conexao->prepare($busca4)) {

                                $resultado4->execute();

                                $resultado4->bind_result($id, $titulo, $docente, $discente, $linha, $bolsa);

                                while ($resultado4->fetch()) {
                                    printf('<tr>
                                              <td>'.$titulo.'</td>
                                              <td>'.$docente.'</td>
                                              <td>'.$discente.'</td>
                                              <td>'.$linha.'</td>
                                              <td>'.$bolsa.'</td>
                                              <td><form action="../Visuais/PubliProj.php" method="post">
                                                <input type="text" name="proj" value="'.$id.'" hidden>
                                                <input type="text" name="sigla" value="'.$sigla.'" hidden>
                                                <button type="submit" class="btn btn-outline-info" style="color: #0085a1;">PUBLICAÇÕES</button></form></td>
                                            </tr>');
                                }   
                            }
                            else {
                                printf( "Erro no SQL!");
                            }
                            $resultado4->close();   
                        ?>
                </tbody>
                  
                </table>
              
              <br>
              <p class="post-meta"> Publicações do Grupo                
              </p>
              <table class="table table-hover">
                               
                    <thead>
                        <tr>
                            <th scope="col">Referência</th>
                        </tr>
                    </thead>
                  <tbody>
                       <?php

                        $busca5 = "SELECT referencia FROM `tb_publicacoes` WHERE grupo = '".$sigla."' ORDER BY data DESC";

                            if ($resultado5 = $conexao->prepare($busca5)) {

                                $resultado5->execute();

                                $resultado5->bind_result($ref);

                                while ($resultado5->fetch()) {
                                        printf('<tr>
                                                <td>'.$ref.'</td>
                                                </tr>');
                                    
                                }   
                            }
                            else {
                                printf( "Erro no SQL!");
                            }
                            $resultado5->close();   
                        ?>
                </tbody>
                  
                </table>
              
              <br>
              <p class="post-meta"> Discentes do Grupo                
              </p>
              <table class="table table-hover">
                               
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Lattes</th>
                            <th scope="col">Linha de Pesquisa</th>
                        </tr>
                    </thead>
                  <tbody>
                       <?php

                        $busca6 = "SELECT a.nome, a.curso, a.link, l.nome FROM tb_alunos as a INNER JOIN tb_projetospesquisa as p ON a.id = p.aluno INNER JOIN tb_subespecialidades as l ON p.linha = l.codigo WHERE p.grupo = '".$sigla."';";

                            if ($resultado6 = $conexao->prepare($busca6)) {

                                $resultado6->execute();

                                $resultado6->bind_result($nome, $curso, $link, $linha);

                                while ($resultado6->fetch()) {
                                    printf('<tr>
                                            <td>'.$nome.'</td>
                                            <td>'.$curso.'</td>
                                            <td>'.$link.'</td>
                                            <td>'.$linha.'</td>
                                            </tr>');
                                }   
                            }
                            else {
                                printf( "Erro no SQL!");
                            }
                            $resultado6->close();   
                        ?>
                </tbody>
                  
                </table>
              <br>
              <p class="post-meta"> Equipamentos disponiveis do grupo                
              </p>
              <table class="table table-hover">
                               
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                        </tr>
                    </thead>
                  <tbody>
                       <?php

                        $busca7 = "SELECT nome, descricao FROM tb_equipamentos WHERE grupo = '".$sigla."'; ";

                            if ($resultado7 = $conexao->prepare($busca7)) {

                                $resultado7->execute();

                                $resultado7->bind_result($nome, $descricao);

                                while ($resultado7->fetch()) {
                                    printf('<tr>
                                            <td>'.$nome.'</td>
                                            <td>'.$descricao.'</td>
                                            </tr>');
                                }   
                            }
                            else {
                                printf( "Erro no SQL!");
                            }
                            $resultado7->close();   
                        ?>
                </tbody>
                  
                </table>
            <p class="copyright text-muted">Desenvolvido por SGGP. &copy; Todos os direitos reservados.</p>
          </div>
        </div>
      </div>
        
    </footer>

 <?php
	include("../Uteis/ScriptsPagInicial.php");

?>


  </body>

</html>
