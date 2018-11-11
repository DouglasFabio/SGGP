<!DOCTYPE html>
                                                                <html lang="pt">
                                                                <head>
                                                                    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                                                                <title>GDI</title>
                                                                </head>
                                                                <frameset rows="100%" border="0"> 
                                                                <?php
                                                                    $sigla = "GDI";
                                                                    if(!isset($_SESSION)) session_start();
                                                                    $_SESSION['sigla'] = $sigla;
                                                                ?>
                                                                <frame src="PaginaGrupos.php"> 
                                                                </frameset>
                                                                </html>