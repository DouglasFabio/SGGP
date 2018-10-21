<?php
function busca($cont){
                $conexao = new mysqli("localhost", "root", "", "bd_sggp");
                mysqli_set_charset( $conexao, 'utf8');
                
                $busca = "SELECT sa.id_grandearea, sa.codigo, sa.nome FROM tb_subareas as sa INNER JOIN tb_grandesareas as ga ON ga.id = sa.id_grandearea WHERE sa.id_grandearea = ".$cont;
                
                $result = $conexao->query($busca);
                while($row = $result->fetch_array())
                {
                    $rows[] = $row;
                }
                return $rows;            
}

function busca2($cont2){
                $conexao = new mysqli("localhost", "root", "", "bd_sggp");
                mysqli_set_charset( $conexao, 'utf8');
                
                $busca = "SELECT es.id_subarea, es.codigo, es.nome FROM tb_especialidades as es INNER JOIN tb_subareas as sa ON sa.id = es.id_subarea WHERE es.id_subarea =".$cont2;
                
                $result = $conexao->query($busca);
                while($row = $result->fetch_array())
                {
                    $rows[] = $row;
                }
                return $rows;            
}

function busca3($cont3){
                $conexao = new mysqli("localhost", "root", "", "bd_sggp");
                mysqli_set_charset( $conexao, 'utf8');
                
                $busca = "SELECT se.id_especialidade, se.codigo, se.nome FROM tb_subespecialidades as se INNER JOIN tb_especialidades as es ON es.id = se.id_especialidade WHERE se.id_especialidade ='".$cont3."'ORDER BY es.id";
                
                $result = $conexao->query($busca);
                while($row = $result->fetch_array())
                {
                    $rows[] = $row;
                }
                return $rows;            
}


?>