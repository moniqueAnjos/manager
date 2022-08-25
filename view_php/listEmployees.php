<?php
require_once 'cabecalho.html';
?>
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
<br>
<div id="app" class="app">
    <br />
    <br />
    <v-app id="inspire">
        <alerta :alerta="alerta">

        </alerta>
        <v-card-title>
            Funcionários Cadastrados
            <v-spacer></v-spacer>
        </v-card-title>
        <v-data-table :headers="headers" :items="mainList" :items-per-page="10" class="elevation-1">
            <template v-slot:item.actions="{ item }">
                <v-btn class="buttonGrid" @click="prepareToChange(item)">
                    <v-icon small>
                        mdi-pencil
                    </v-icon>
                </v-btn>
                <v-btn class="buttonGrid" @click="deleteEmployee(item)">
                    <v-icon small>
                        mdi-delete
                    </v-icon>
                </v-btn>
            </template>
            <template v-slot:item.id="{ item }">
                {{ getId(item) }}
            </template>
            <template v-slot:item.name="{ item }">
                {{ getName(item) }}
            </template>
            <template v-slot:item.email="{ item }">
                {{ getEmail(item) }}
            </template>
            <template v-slot:item.telephone="{ item }">
                {{ getTelephone(item) }}
            </template>
            <template v-slot:item.gender="{ item }">
                {{ getGender(item) }}
            </template>
        </v-data-table>
        <v-dialog v-model="dialogueDelete" max-width="600px" persistent>
            <v-card>
                <v-card-title class="text-h5">Você deseja realmente remover esse Funcionário?</v-card-title>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="deleteEmployeeConfirm">SIM</v-btn>
                    <v-btn color="blue darken-1" text @click="closeDelete">NÃO</v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-app>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script src="https://cdn.jsdelivr.net/npm/v-mask@2.3.0/dist/v-mask.min.js"></script>
<?php
require_once 'rodape.html';
?>
<script src="view_php/js/factoryEmployees.js"></script>
<script src="view_php/js/listEmployees.js"></script>