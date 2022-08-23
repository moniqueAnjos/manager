<?php
require_once 'cabecalho.html';
?>
<div class="conteudo-pagina">
    <div class="titulo-pagina">
        <h1>Listar Funcionários</h1>
    </div>

    <div class="informacao-pagina">
        <div class="corpoListagem">
            <table id="listagemFunc" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Sexo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<?php
require_once 'rodape.html';
?>
<script src="view_php/js/listEmployees.js"></script>
<script src="view_php/js/notify.js"></script>