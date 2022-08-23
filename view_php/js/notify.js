function notify(mensagem, tipo) {
    pNnotify = $('.ui-pnotify');
    if (pNnotify.length) {
        return false;
    }
    titulo = 'Sucesso!';
    tipoMsg = '';
    if (tipo == 'erro') {
        titulo = 'Erro!';
    }
    if (tipo == 'sucesso') {
        tipoMsg = 'success';
    }
    if (tipo == 'erro') {
        tipoMsg = 'error';
    }
    new PNotify({
        title: titulo,
        text: mensagem,
        type: tipoMsg,
        delay: 10000
    });
}