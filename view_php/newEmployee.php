<?php
require_once 'cabecalho.html';
?>
<div class="conteudo-pagina">
    <div class="titulo-pagina">
        <h1 id="title"></h1>
    </div>

    <div class="informacao-pagina">
        <div class="contato-principal">
            <div id='msgReturn'></div>
            <form id="formEmployee" accept-charset="utf-8">
                <input maxlength="150" id="name" name="name" type="text" placeholder="Nome" class="borda-preta">
                <br>
                <input maxlength="11" id="telephone" name="telephone" type="text" placeholder="Telefone" class="borda-preta">
                <br>
                <input maxlength="150" id="email" name="email" type="text" placeholder="E-mail" class="borda-preta">
                <br>
                <select id="gender" name="gender" class="borda-preta">
                    <option value="">Sexo</option>
                    <option value="F">Feminino</option>
                    <option value="M">Masculino</option>
                </select>
                <br>
                <button id="btnSave" type="button" class="borda-preta">ENVIAR</button>
                <button style="display:none;" id="btnEdit" type="button" class="borda-preta">EDITAR</button>
            </form>
        </div>
    </div>
</div>
<?php
require_once 'rodape.html';
?>
<script>
    idEmployee = '';
    $(document).ready(function() {
        routeRequest = '<?php print $urlRota; ?>';
        if (routeRequest == 'requestEditEmployee') {
            $("#title").html('Editar Funcionário');
            $("#btnSave").hide();
            $("#btnEdit").show();
            fetchEmployee();
        } else {
            $("#title").html('Novo Funcionário');
            $("#btnSave").show();
            $("#btnEdit").hide();
        }
    });
</script>
<script src="view_php/js/newEmployees.js"></script>
<script src="view_php/js/notify.js"></script>