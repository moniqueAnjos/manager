<?php
require_once 'cabecalho.html';
?>
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
<br>
<div id="appForm" class="appForm">
    <br />
    <br />
    <v-app id="">
        <alerta :alerta="alerta">

        </alerta>
        <v-card-title>
            {{ title }}
            <v-spacer></v-spacer>
        </v-card-title>
        <template>
            <v-form ref="form">
                <v-text-field v-model="objPrincipal.name" :counter="150" :rules="nameRules" label="Name" required></v-text-field>

                <v-text-field v-model="objPrincipal.email" :counter="150" :rules="emailRules" label="E-mail" required></v-text-field>

                <v-text-field type="number" :counter="11" v-model="objPrincipal.telephone" :rules="telephoneRules" label="Telefone" required></v-text-field>

                <v-select :items="gender" item-text="genderTxt" item-value="gender" item-text="genderTxt" item-value="gender" v-model="objPrincipal.gender" :items="gender" :rules="[v => !!v || 'Item is required']" label="Gênero" required>

                </v-select>

                <v-btn v-if="!updateRequested" :disabled="!valid" color="success" @click="save">
                    SALVAR
                </v-btn>

                <v-btn v-if="updateRequested" :disabled="!valid" color="success" @click="changeEmployee">
                    ALTERAR
                </v-btn>

                <v-btn color="error" @click="reset">
                    LIMPAR
                </v-btn>
            </v-form>
        </template>
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
<script src="view_php/js/newEmployees.js"></script>