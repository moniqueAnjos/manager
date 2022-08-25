function factoryAlert(nameComponet) {
    let alerta = {};
    alerta.nameComponet = nameComponet;

    function limpa() {
        Vue.component(this.nameComponet, {
            props: {
                alerta: factoryAlert(),
            },
            template: ''
        })
    }

    function mostra(msg, tipo) {
        Vue.component(this.nameComponet, {
            props: {
                alerta: factoryAlert(),
            },
            template: '<v-alert type="' + tipo + '" dismissible outlined prominent shaped text>' +
                msg + '</v-alert>'
        })
    }

    alerta.limpa = limpa;
    alerta.mostra = mostra;
    return alerta;
}