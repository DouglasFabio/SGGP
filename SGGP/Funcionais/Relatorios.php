<?php

    $ano = $_POST['ano'];
    $gruponome = $_POST['grupo_pesquisa'];
    $relatorio = $_POST['relatorio'];

    /* Carrega a classe DOMPdf */
    require_once("../Uteis/dompdf/dompdf_config.inc.php");

    $BuscaSiglaNome = "SELECT sigla FROM tb_grupospesquisa WHERE nome = '".$gruponome."'";

    $resultado = $conexao->query($BuscaSiglaNome);

    if ($resultado->num_rows > 0) {

        $saida = $resultado->fetch_assoc();

        /* Cria a instância */
        $dompdf = new DOMPDF();

        switch ($relatorio) {
            case 1:
                $Busca = "SELECT s.nome FROM `tb_subespecialidades` AS s INNER JOIN `tb_linhasgrupos` AS lg ON lg.codigo_capes = s.codigo WHERE lg.grupo = '".$saida['sigla']."' AND year(lg.inicio_vinculo) <= ".$ano." AND (year(lg.fim_vinculo) >= ".$ano." OR lg.fim_vinculo IS NULL)"; 
                
                if ($resultado = $conexao->prepare($Busca)) {

                    $resultado->execute();

                    $resultado->bind_result($nome);

                    $exibe = '<table class="table table-hover">

                                            <thead>

                                                <tr>
                                                    <th scope="col">Nome da Linha</th> 
                                                </tr>

                                            </thead>

                                                <tbody>';

                    while ($resultado->fetch()) {

                        $exibe .= '<tr>
                        <td>'.$nome.'</td>
                                </tr>';

                    }

                    $exibe .= '</tbody>
                    </table>';

                }
                else {

                    printf( "Erro no SQL!");

                }
                
                break;
            case 2:
                $Busca = "SELECT s.nome FROM `tb_subespecialidades` AS s INNER JOIN `tb_linhasgrupos` AS lg ON lg.codigo_capes = s.codigo WHERE lg.grupo = '".$saida['sigla']."' AND year(lg.inicio_vinculo) <= ".$ano." AND (year(lg.fim_vinculo) >= ".$ano." OR lg.fim_vinculo IS NULL)";
                
                if ($resultado = $conexao->prepare($Busca)) {

                    $resultado->execute();

                    $resultado->bind_result($nome);

                    $exibe = '<table class="table table-hover">

                                            <thead>

                                                <tr>
                                                    <th scope="col">Nome das Linhas</th> 
                                                </tr>

                                            </thead>

                                                <tbody>';

                    while ($resultado->fetch()) {

                        $exibe .= '<tr>
                        <td>'.$nome.'</td>
                                </tr>';

                    }

                    $exibe .= '</tbody>
                    </table>';
                            
                    $resultado->close();

                }
                else {

                    printf( "Erro no SQL!");

                }
                $Busca = "SELECT p.nome FROM `tb_participantes` AS p WHERE p.grupo = '".$saida['sigla']."' AND ((year(p.data_inclusao) <= ".$ano." AND year(p.data_exclusao) >= ".$ano.") OR (year(p.data_inclusao) <= ".$ano." AND p.data_exclusao IS NULL)) AND p.tipo = 1;";
                
                if ($resultado = $conexao->prepare($Busca)) {

                    $resultado->execute();

                    $resultado->bind_result($nome);

                    $exibe .= '<table class="table table-hover">

                                            <thead>

                                                <tr>
                                                    <th scope="col">Docentes do Grupo</th> 
                                                </tr>

                                            </thead>

                                                <tbody>';

                    while ($resultado->fetch()) {

                        $exibe .= '<tr>
                        <td>'.$nome.'</td>
                                </tr>';

                    }

                    $exibe .= '</tbody>
                    </table>';
                            
                    $resultado->close();

                }
                else {

                    printf( "Erro no SQL!");

                }
                
                break;
            case 3:
                $Busca = "SELECT p.nome FROM `tb_participantes` AS p WHERE p.grupo = '".$saida['sigla']."' AND ((year(p.data_inclusao) <= ".$ano." AND year(p.data_exclusao) >= ".$ano.") OR (year(p.data_inclusao) <= ".$ano." AND p.data_exclusao IS NULL)) AND p.tipo = 1;";
                
                
                if ($resultado = $conexao->prepare($Busca)) {

                    $resultado->execute();

                    $resultado->bind_result($nome);

                    $exibe = '<table class="table table-hover">

                                            <thead>

                                                <tr>
                                                    <th scope="col">Docentes do Grupo</th> 
                                                </tr>

                                            </thead>

                                                <tbody>';

                    while ($resultado->fetch()) {

                        $exibe .= '<tr>
                        <td>'.$nome.'</td>
                                </tr>';

                    }

                    $exibe .= '</tbody>
                    </table>';

                }
                else {

                    printf( "Erro no SQL!");

                }
                
                break;
            case 4:
                $Busca = "SELECT p.nome, s.nome FROM `tb_participantes` AS p INNER JOIN `tb_linhasdocentes` AS ld ON p.id = ld.docente INNER JOIN `tb_subespecialidades` AS s ON ld.linha_pesquisa = s.codigo WHERE p.grupo = '".$saida['sigla']."' AND (year(p.data_inclusao) >= ".$ano." OR p.data_exclusao IS NULL)";
                
                if ($resultado = $conexao->prepare($Busca)) {

                    $resultado->execute();

                    $resultado->bind_result($nome, $linha);

                    $exibe = '<table class="table table-hover">

                                            <thead>

                                                <tr>
                                                    <th scope="col">Docente</th>
                                                    <th scope="col">Linha de Pesquisa</th>
                                                </tr>

                                            </thead>

                                                <tbody>';

                    while ($resultado->fetch()) {

                        $exibe .= '<tr>
                        <td>'.$nome.'</td>
                        <td>'.$linha.'</td>
                                </tr>';

                    }

                    $exibe .= '</tbody>
                    </table>';

                }
                else {

                    printf( "Erro no SQL!");

                }
                
                break;
            case 5:
                $Busca = "SELECT d.nome FROM `tb_projetospesquisa` AS p INNER JOIN `tb_alunos` AS d ON p.aluno = d.id WHERE p.grupo = '".$saida['sigla']."' AND (year(d.data_inicio) >= ".$ano." OR d.data_fim IS NULL);";
                
                if ($resultado = $conexao->prepare($Busca)) {

                    $resultado->execute();

                    $resultado->bind_result($nome);

                    $exibe = '<table class="table table-hover">

                                            <thead>

                                                <tr>
                                                    <th scope="col">Discentes do Grupo</th> 
                                                </tr>

                                            </thead>

                                                <tbody>';

                    while ($resultado->fetch()) {

                        $exibe .= '<tr>
                        <td>'.$nome.'</td>
                                </tr>';

                    }

                    $exibe .= '</tbody>
                    </table>';

                }
                else {

                    printf( "Erro no SQL!");

                }
                
                break;
            case 6:
                $Busca = "SELECT d.nome, pa.nome FROM `tb_projetospesquisa` AS p INNER JOIN `tb_alunos` AS d ON p.aluno = d.id INNER JOIN `tb_participantes` AS pa ON pa.id = p.docente WHERE p.grupo = '".$saida['sigla']."' AND (year(d.data_inicio) >= ".$ano." OR d.data_fim IS NULL);";
                
                if ($resultado = $conexao->prepare($Busca)) {

                    $resultado->execute();

                    $resultado->bind_result($nome, $orinome);

                    $exibe = '<table class="table table-hover">

                                            <thead>

                                                <tr>
                                                    <th scope="col">Discente</th>
                                                    <th scope="col">Orientador</th>
                                                </tr>

                                            </thead>

                                                <tbody>';

                    while ($resultado->fetch()) {

                        $exibe .= '<tr>
                        <td>'.$nome.'</td>
                        <td>'.$orinome.'</td>
                                </tr>';

                    }

                    $exibe .= '</tbody>
                    </table>';

                }
                else {

                    printf( "Erro no SQL!");

                }
                
                break;
            case 7:
                $Busca = "SELECT d.nome, pa.nome, s.nome FROM `tb_projetospesquisa` AS p INNER JOIN `tb_alunos` AS d ON p.aluno = d.id INNER JOIN `tb_participantes` AS pa ON pa.id = p.docente INNER JOIN `tb_subespecialidades` AS s ON p.linha = s.codigo WHERE p.grupo = '".$saida['sigla']."' AND (year(d.data_inicio) >= ".$ano." OR d.data_fim IS NULL);";
                
                if ($resultado = $conexao->prepare($Busca)) {

                    $resultado->execute();

                    $resultado->bind_result($nome, $orinome, $linha);

                    $exibe = '<table class="table table-hover">

                                            <thead>

                                                <tr>
                                                    <th scope="col">Discente</th>
                                                    <th scope="col">Orientador</th>
                                                    <th scope="col">Linha de Pesquisa</th>
                                                </tr>

                                            </thead>

                                                <tbody>';

                    while ($resultado->fetch()) {

                        $exibe .= '<tr>
                        <td>'.$nome.'</td>
                        <td>'.$orinome.'</td>
                        <td>'.$linha.'</td>
                                </tr>';

                    }

                    $exibe .= '</tbody>
                    </table>';

                }
                else {

                    printf( "Erro no SQL!");

                }
                
                break;
            case 8:
                $Busca =  "SELECT p.nome FROM `tb_participantes` AS p WHERE p.grupo = '".$saida['sigla']."' AND ((year(p.data_inclusao) <= ".$ano." AND year(p.data_exclusao) >= ".$ano.") OR (year(p.data_inclusao) <= ".$ano." AND p.data_exclusao IS NULL)) AND p.tipo = 0;";
                
                if ($resultado = $conexao->prepare($Busca)) {

                    $resultado->execute();

                    $resultado->bind_result($nome);

                    $exibe = '<table class="table table-hover">

                                            <thead>

                                                <tr>
                                                    <th scope="col">Técnico</th> 
                                                </tr>

                                            </thead>

                                                <tbody>';

                    while ($resultado->fetch()) {

                        $exibe .= '<tr>
                        <td>'.$nome.'</td>
                                </tr>';

                    }

                    $exibe .= '</tbody>
                    </table>';

                }
                else {

                    printf( "Erro no SQL!");

                }
                
                break;
            case 9:
                $Busca =  "SELECT e.nome FROM `tb_equipamentos` AS e WHERE e.grupo = '".$saida['sigla']."' AND (year(e.data_inicio) >= ".$ano." OR e.data_fim IS NULL);";
                
                if ($resultado = $conexao->prepare($Busca)) {

                    $resultado->execute();

                    $resultado->bind_result($nome);

                    $exibe = '<table class="table table-hover">

                                            <thead>

                                                <tr>
                                                    <th scope="col">Equipamentos</th> 
                                                </tr>

                                            </thead>

                                                <tbody>';

                    while ($resultado->fetch()) {

                        $exibe .= '<tr>
                        <td>'.$nome.'</td>
                                </tr>';

                    }

                    $exibe .= '</tbody>
                    </table>';

                }
                else {

                    printf( "Erro no SQL!");

                }
                
                break;
            case 10:
                $Busca =  "SELECT referencia FROM `tb_publicacoes` WHERE grupo = '".$saida['sigla']."' AND year(data) = ".$ano."";
                
                if ($resultado = $conexao->prepare($Busca)) {

                    $resultado->execute();

                    $resultado->bind_result($nome);

                    $exibe = '<table class="table table-hover">

                                            <thead>

                                                <tr>
                                                    <th scope="col">Publicações</th> 
                                                </tr>

                                            </thead>

                                                <tbody>';

                    while ($resultado->fetch()) {

                        $exibe .= '<tr>
                        <td>'.$nome.'</td>
                                </tr>';

                    }

                    $exibe .= '</tbody>
                    </table>';

                }
                else {

                    printf( "Erro no SQL!");

                }
                
                break;
            case 11:
                $Busca =  "SELECT titulo FROM `tb_projetospesquisa` WHERE data_fim IS NOT NULL AND year(data_fim) = ".$ano."";
                
                if ($resultado = $conexao->prepare($Busca)) {

                    $resultado->execute();

                    $resultado->bind_result($nome);

                    $exibe = '<table class="table table-hover">

                                            <thead>

                                                <tr>
                                                    <th scope="col">Titulo do Projeto já finalizado</th> 
                                                </tr>

                                            </thead>

                                                <tbody>';

                    while ($resultado->fetch()) {

                        $exibe .= '<tr>
                        <td>'.$nome.'</td>
                                </tr>';

                    }

                    $exibe .= '</tbody>
                    </table>';

                }
                else {

                    printf( "Erro no SQL!");

                }
                
                break;
        }
/*
        Carrega seu HTML
        $dompdf->load_html($exibe);

        Renderiza
        $dompdf->render();

        Exibe
        $dompdf->stream(
            "saida.pdf", Nome do arquivo de saída
            array(
                "Attachment" => false Para download, altere para true
            )
        );
        */
        
        
    }

    $conexao->close();

?>

