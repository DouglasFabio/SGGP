<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6" style="background-color: #8275ff; line-height: 2.0;">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box" style="display:none">
                            <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-magnify font-20 mr-1"></i>
                                    <div class="ml-1 d-none d-sm-block" style="display:none">
                                        <span>Pesquisar</span>
                                    </div>
                                </div>
                            </a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter">
                                <a class="srh-btn">
                                    <i class="ti-close"></i>
                                </a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <?php
                           
                            if(isset($_SESSION['LiderLogin']))
                            {
                            
                            ?>
                                 <nav class="navbar navbar-inverse">
                                  <div class="container-fluid">
                                   <ul class="nav navbar-nav">
                                      <li><a class="dropdown-item" style="background-color: #b3b3ff ; border-radius: 1px; text-color:white;">Bem-vindo,  <?php echo $_SESSION['LiderNome']; ?></a></li>
                                <?php
                               
                            }
                            else if(isset($_SESSION['AdmLogin']))
                            {
                        ?>
                                
                        <nav class="navbar navbar-inverse">
                          <div class="container-fluid">
                           <ul class="nav navbar-nav">
                              <li><a class="dropdown-item" style="background-color: #b3b3ff ; border-radius: 1px; text-color:white;">Bem-vindo,  <?php echo $_SESSION['AdmLogin']; ?></a></li>
                        <?php
                            }
                        ?>
                          
                            
                              <li class="active"><a class="dropdown-item" href="../Visuais/PaginaInicial.php" style="background-color: #b3b3ff ; border-radius: 1px;"><i class="ti-home m-r-5 m-l-5" ></i> Página Inicial</a></li>
                              <li><a class="dropdown-item" href="../Visuais/TrocaSenha.php" style="background-color: #b3b3ff ; border-radius: 1px;"><i class="ti-lock m-r-5 m-l-5"></i> Alterar Senha</a></li>
                            
                        </ul>
                              <a class="btn btn-danger navbar-btn" href="../Funcionais/Logout.php" style="padding: .79rem .79rem;"><i class="ti-power-off m-r-5 m-l-5"></i> Logout</a>
                        </div>
                        </nav>
                        
                        
                        
                        
                        
                       
                        <!-- <li class="nav-item dropdown">
                           A TAG LI INSERE UM ESPAÇO PARA COLOCAR A LISTA 
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                 A DIV ACIMA INSERE MENU INTERNO 
                            </div>
                        </li> -->
                    </ul>
</div>