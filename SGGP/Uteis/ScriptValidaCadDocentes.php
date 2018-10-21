<script language="javascript" type="text/javascript">
function validar() {
    var nome = formCadDocentes.nome_docente.value;
    var link = formCadDocentes.link_docente.value;
    var formacao = formCadDocentes.formacao_academica.value;
    var nome_curso = formCadDocentes.nome_curso.value;
    var foto = formCadDocentes.arquivo.value;
    var linha = formCadDocentes.linha_docente.value;

   

    if (nome == "") {
        alert('Preencha o campo NOME');
        formCadDocentes.nome_docente.focus();
        return false;
    }

    if (link == "") {
        alert('Preencha o campo LINK');
        formCadDocentes.link_docente.focus();
        return false;
    }

    
    if (formacao == "") {
        alert('Preencha o campo FORMAÇÃO ACADÊMICA');
        formCadDocentes.formacao_academica.focus();
        return false;
    }
    
    if(formacao == 3 || formacao == 4 || formacao == 5 || formacao == 6){
        if (nome_curso == "") {
            alert('Preencha o campo NOME CURSO');
            formCadDocentes.nome_curso.focus();
            return false;
        }   
    } 
    
    if (foto == "") {
        alert('Insira uma foto');
        formCadDocentes.arquivo.focus();
        return false;
    }
    
     if (linha == "") {
        alert('Selecione uma LINHA DE PESQUISA');
        formCadDocentes.linha_docente.focus();
        return false;
    }
}
</script>
