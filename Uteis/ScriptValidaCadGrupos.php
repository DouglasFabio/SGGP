<script language="javascript" type="text/javascript">
function validar() {
    var nome = formCadGrupos.nome_grupo.value;
    var sigla = formCadGrupos.sigla_grupo.value;
    var lider = formCadGrupos.lider_grupo.value;
    var comboLideres = document.formCadGrupos.lider_grupo;
    
    if (nome == "" || nome.length == 0) {
        alert('Preencha o campo NOME');
        formCadGrupos.nome_lider.focus();
        return false;
    }
    else if (nome.length > 50) {
        retorno = 0;
        alert('LIMITE: 50 caracteres.\nPor favor, corrija!');
        formCadGrupos.nome_lider.focus();
        return retorno;
    }
    else if (sigla == "" || sigla.length == 0 || !sigla.trim) {
        alert('Preencha o campo SIGLA');
        formCadGrupos.sigla_grupo.focus();
        return false;
    }
    else if (sigla.length > 10) {
        alert('LIMITE: 10 caracteres.\nPor favor, corrija!');
        formCadGrupos.sigla_grupo.focus();
        return false;
    }
    else if 
        if (comboLideres.options[comboLideres.selectedIndex].value == "" ){
                alert("Escolha um líder antes de prosseguir!");
        }
}
</script>

