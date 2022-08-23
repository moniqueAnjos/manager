function fetchEmployee() {
    var url_string = window.location.href;
    var url = new URL(url_string);
    idEmployee = url.searchParams.get("id");

    httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = returnProcess;
    httpRequest.open('GET', 'employee/' + idEmployee);
    httpRequest.send();

    function returnProcess() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                var dados = JSON.parse(httpRequest.responseText);
                var data = dados["result"][0];
                $("#name").val(data["name"]);
                $("#telephone").val(data["telephone"]);
                $("#email").val(data["email"]);
                $("#gender").val(data["gender"]);
            } else {
                console.log('Houve algum problema com a requisição.');
            }
        }
    }
}

function sendHttpRequest(method, route) {
    httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = returnProcess;
    httpRequest.open(method, route);
    httpRequest.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    httpRequest.send(serializeForm());

    function returnProcess() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                var dados = JSON.parse(httpRequest.responseText);
                if (dados["error"] == true) {
                    notify(dados["message"], 'erro');
                } else {
                    (routeRequest != 'newEmployee') ?
                    window.location.href = "listEmployees": document.getElementById("formEmployee").reset();
                    notify(dados["message"], 'sucesso');
                }
            } else {
                console.log('Houve algum problema com a requisição.');
            }
        }
    }
}

(() => {
    let httpRequest;
    document.getElementById("btnSave").addEventListener('click', makeRequestNew);
    document.getElementById("btnEdit").addEventListener('click', makeRequestEdit);

    function makeRequestEdit() {
        sendHttpRequest('PUT', 'employee/' + idEmployee);
    }

    function makeRequestNew() {
        sendHttpRequest('POST', 'employee');
    }
})();

function serializeForm() {
    return JSON.stringify({
        "name": $("#name").val(),
        "email": $("#email").val(),
        "telephone": $("#telephone").val(),
        "gender": $("#gender").val()
    });
}