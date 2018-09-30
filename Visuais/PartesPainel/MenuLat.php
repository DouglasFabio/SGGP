<div class="scroll-sidebar" style="position:fixed;">
   
    <nav class="sidebar-nav">
       
        <ul id="sidebarnav">
          
           <li class="sidebar-item">

                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Painel.php" aria-expanded="false">

                        <i class="mdi mdi-home"></i>

                        <span class="hide-menu">Início</span>

                    </a>

            </li>
            
            <?php
            
                include("../BancoDeDados/Conexao.php");

                $conexao = conectar();
            
                if(isset($_SESSION['AdmTipo'])){
                    
                    $busca = "SELECT * FROM tb_permissoes WHERE id = 0";
                    
                    $resultado = $conexao->query($busca);
                
                    
                    // VERIFICAÇÃO 
                    if ($resultado->num_rows > 0) {

                        $saida = $resultado->fetch_assoc();
            
                        
                        if($saida['cdusuarios'] == 1){
                            
            ?>
                           
                            <li class="sidebar-item">
                               
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="CadUsuario.php" aria-expanded="false">
                                   
                                    <i class="mdi mdi-face"></i>
                                    
                                    <span class="hide-menu">Cadastrar Usuário</span>
                                    
                                </a>
                                
                            </li>
            <?php
                            
                        }
                        
                        if($saida['cdgrupo'] == 1){
                            
            ?>
                            <li class="sidebar-item">

                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="CadGrupo.php" aria-expanded="false">

                                        <i class="mdi mdi-account-multiple-plus"></i>

                                        <span class=" hide-menu"> Cadastrar Grupos de Pesquisa</span>

                                    </a>

                                </li>      
                            
            <?php
                        }
                        
                        
                        if($saida['edgrupo'] == 1){
                            
            ?>
                            <li class="sidebar-item">

                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="ManutencaoGruposGeral.php" aria-expanded="false">

                                        <i class="mdi mdi-account-edit"></i>

                                        <span class=" hide-menu"> Gerenciar Grupos Cadastrados</span>

                                    </a>

                                </li>      
                            
            <?php
                        }
                        
                        if($saida['permissoes'] == 1){
                            
            ?>
                            <li class="sidebar-item">
                               
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="ControlePermissoes.php" aria-expanded="false">
                                   
                                    <i class="mdi mdi-lock"></i>
                                    
                                    <span class="hide-menu">Controle de Permissões</span>
                                    
                                </a>
                                
                            </li>
            <?php
                    
                        }
                    }
                }
                
            ?>
            <?php
            /*-----------------------------------------------------------------------------------------------------------------------------------*/
                if(isset($_SESSION['LiderTipo'])){
                    
                    $busca = "SELECT * FROM tb_permissoes WHERE id = 1";
                    
                    $resultado = $conexao->query($busca);
                
                    if ($resultado->num_rows > 0) {

                        $saida = $resultado->fetch_assoc();
            
                        
                        if($saida['cdusuarios'] == 1){
                            
            ?>
                           
                            <li class="sidebar-item">
                               
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="CadUsuario.php" aria-expanded="false">
                                   
                                    <i class="mdi mdi-face"></i>
                                    
                                    <span class="hide-menu">Cadastrar Usuário</span>
                                    
                                </a>
                                
                            </li>
                            
            <?php
                        }
                        
                        if($saida['edgrupo'] == 1){
                            
            ?>
                           
                            <li class="sidebar-item">
                               
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="GerenciandoGrupos.php" aria-expanded="false">
                                   
                                    <i class="mdi mdi-face"></i>
                                    
                                    <span class="hide-menu">Gerenciar Grupos 
                                                               
                                                            <?php 
                                                                $conta = "SELECT situacao FROM tb_grupospesquisa WHERE situacao = 2 and lider = ".$_SESSION['LiderLogin'];
                            
                                                                $resultado = $conexao->query($conta);
                                                                
                                                               if($resultado->num_rows > 0){
                                                                    echo "(".$resultado->num_rows.")";
                                                               }
                                                            ?> 
                                    </span>
                                    
                                </a>
                                
                            </li>
                            
            <?php
                        }
                        
                        if($saida['permissoes'] == 1){
                            
            ?>
                            <li class="sidebar-item">
                               
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="ControlePermissoes.php" aria-expanded="false">
                                   
                                    <i class="mdi mdi-lock"></i>
                                    
                                    <span class="hide-menu">Controle de Permissões</span>
                                    
                                </a>
                                
                            </li>
            <?php
                    
                        }
                    }
                }
                        
            ?>               

        </ul>
        
    </nav>
    
</div>