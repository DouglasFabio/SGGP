<script language="javascript" type="text/javascript">
function validar() {
    var nome = formCadUsuarios.nome_lider.value;
    var email = formCadUsuarios.email_lider.value;
    var prontuario = formCadUsuarios.prontuario_lider.value;

    if (nome == "" && nome.length >50) {
        alert('Preencha o campo NOME corretamente.\nLimite: 50 caracteres');
        formCadUsuarios.nome_lider.focus();
        return false;
    }

    if (email == "") {
        alert('Preencha o campo com seu email');
        formCadUsuarios.email_lider.focus();
        return false;
    }

    if (prontuario == "") {
        alert('Preencha o Prontuário');
        formCadUsuarios.prontuario_lider.focus();
        return false;
    }
}
</script>
