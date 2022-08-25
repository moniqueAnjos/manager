new Vue({
    el: '#appForm',
    vuetify: new Vuetify(),
    data: () => ({
        alerta: factoryAlert('alerta'),
        updateRequested: updateRequested(),
        parameter: getParameter(),
        valid: true,
        title: 'Cadastro de Funcionário',
        locale: 'pt-BR',
        nameRules: [
            v => !!v || 'O Nome é obrigatório',
            v => (v && v.length <= 150) || 'O nome deve conter até 150 caracteres',
        ],
        emailRules: [
            v => !!v || 'O E-mail é obrigatório',
            v => /^(([^<>()[\]\\.,;:\s@']+(\.[^<>()\\[\]\\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) || 'E-mail inválido',
            v => (v && v.length <= 150) || 'O e-mail deve conter até 150 caracteres',
        ],
        telephoneRules: [
            v => !!v || 'O Telefone é obrigatório',
            v => /^[0-9]*$/.test(v) || 'Digite apenas numeros',
            v => (v && v.length >= 11) || 'O telefone está incompleto',
            v => (v && v.length <= 11) || 'O telefone deve conter 11 caracteres',
        ],
        gender: [{
                gender: 'F',
                genderTxt: 'Feminino'
            },
            {
                gender: 'M',
                genderTxt: 'Masculino'
            },
        ],
        objPrincipal: factoryEmployees(),
    }),

    methods: {
        save() {
            if (this.$refs.form.validate()) {
                self = this;
                self.objPrincipal.newEmployee()
                    .then(response => {
                        window.location.href = "listEmployees";
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        },
        changeEmployee() {
            self = this;
            self.objPrincipal.changeEmployee()
                .then(response => {
                    if (response.data.error == false) {
                        window.location.href = "listEmployees";
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        reset() {
            this.$refs.form.reset()
        },
        validateRequest() {
            self = this;
            if (self.updateRequested) {
                self.title = 'Alterar Funcionário';
                self.objPrincipal.id = self.parameter["id"];
                self.objPrincipal.getEmployee()
                    .then(response => {
                        self.objPrincipal.name = response.data.result.name;
                        self.objPrincipal.email = response.data.result.email;
                        self.objPrincipal.telephone = response.data.result.telephone;
                        self.objPrincipal.gender = response.data.result.gender;
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        }
    },
    created() {
        this.validateRequest();
    }
});



function updateRequested() {
    var currentUrl = window.location.pathname;
    return (currentUrl.includes("requestEditEmployee")) ? true : false;
}

function getParameter() {
    var query = location.search.slice(1);
    var partes = query.split('&');
    var data = {};
    partes.forEach(function(parte) {
        var chaveValor = parte.split('=');
        var chave = chaveValor[0];
        var valor = chaveValor[1];
        data[chave] = valor;
    });
    return data;
}