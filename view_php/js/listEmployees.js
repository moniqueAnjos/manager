function fetchData() {
    httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = returnProcess;
    httpRequest.open('GET', 'employeeAll');
    httpRequest.send();

    function returnProcess() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                var dados = JSON.parse(httpRequest.responseText);
                assemblyTable(dados["result"]);

            } else {
                console.log('Houve algum problema com a requisição.');
            }
        }
    }
}

function assemblyTable(dados) {
    for (i = 0; i < dados.length; i++) {
        var rowNode = oTable
            .row.add([dados[i].id,
                dados[i].name,
                dados[i].email,
                dados[i].telephone,
                dados[i].genderFormat,
                ' <button onclick="editEmployee(' + dados[i].id + ')" id="btnEdit" type="button" class="buttonGrid">Editar</button>' +
                '<button onclick="deleteEmployee(' + dados[i].id + ')" id="btnEdit" type="button" class="buttonGrid buttonExcluir">Excluir</button>'
            ])
            .draw()
            .node();
        $(rowNode).css('cursor', 'pointer');
        oTable.draw();
    }
}

function editEmployee(id) {
    window.location.href = "requestEditEmployee?id=" + id;
}

function deleteEmployee(id) {
    if (window.confirm("Você realmente deseja deletar este funcionário?")) {
        httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = returnProcess;
        httpRequest.open('DELETE', 'employee/' + id);
        httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        httpRequest.send("id=" + id);

        function returnProcess() {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    var dados = JSON.parse(httpRequest.responseText);
                    oTable.clear().draw();
                    assemblyTable(dados["result"]);
                    notify(dados["message"], 'sucesso');
                } else {
                    notify('Houve algum problema com a requisição.', 'erro');
                }
            }
        }
    }
}

$(document).ready(function() {
    oTable = $('#listagemFunc').DataTable({
        deferRender: true,
        scrollY: 300,
        scrollCollapse: true,
        scroller: true,
        order: false,
    });
    fetchData();
});