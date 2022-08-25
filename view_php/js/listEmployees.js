new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    data() {
        return {
            page: 1,
            last_page: null,
            alerta: factoryAlert('alerta'),
            dialogueDelete: false,
            showGrid: true,
            semRegistros: 'Nenhum registro encontrado',
            search: '',
            locale: 'pt-BR',
            headers: [{
                    text: 'Código',
                    align: 'start',
                    value: 'id',
                },
                {
                    text: 'Nome',
                    value: 'name',
                },
                {
                    text: 'E-mail',
                    value: 'email',
                },
                {
                    text: 'Telefone',
                    value: 'telephone',
                },
                {
                    text: 'Ações',
                    value: 'actions',
                }
            ],
            mainList: [],
            objPrincipal: factoryEmployees(),
        }

    },
    watch: {
        dialogueDelete(val) {
            val || this.closeDelete()
        },
        page() {
            return this.getList()
        }
    },
    methods: {
        getId(item) {
            if (item !== null) {
                return item.id
            }
            return '';
        },
        getName(item) {
            if (item !== null) {
                return item.name
            }
            return 'NOME NÃO ENCONTRADO';
        },
        getEmail(item) {
            if (item !== null) {
                return item.email
            }
            return '';
        },
        getTelephone(item) {
            if (item !== null) {
                return item.telephone
            }
            return '';
        },
        getGender(item) {
            if (item !== null) {
                return item.genderFormat
            }
            return '';
        },
        getList() {
            this.objPrincipal.index(this.search, this.page)
                .then(dados => {
                    this.mainList = dados.data.result;
                    this.last_page = dados.data.last_page;
                });
        },
        cleanEmployee() {
            this.objPrincipal = factoryEmployees();
        },
        deleteEmployee(item) {
            this.objPrincipal.id = item.id;
            this.dialogueDelete = true
        },
        prepareToChange(item) {
            window.location.href = "requestEditEmployee?id=" + item.id;
        },
        deleteEmployeeConfirm() {
            self = this;
            self.objPrincipal.delete()
                .then(response => {
                    self.alerta.mostra(response.data.message, 'success');
                    self.getList();
                    self.closeDelete();
                })
                .catch(function(error) {
                    console.log(error);
                });

        },
        closeDelete() {
            this.dialogueDelete = false
            this.cleanEmployee();
        },
    },
    created() {
        this.getList();
    }
})