<template>
  <v-row>
    <v-col
      cols="12"
      lg="12"
      md="12"
    >
      <h1 class="spacing">Consultar Cliente</h1>
    </v-col>

    <v-col
      cols="12"
      lg="12"
      md="12"
    >
      <v-card elevation="5">
        <v-card-text class="mt-3">
          <v-card-title>
            <v-row>
              <v-col md="4" cols="12">
                <v-btn
                  @click="adicionar()"
                  color="success">
                  Adicionar
                  <v-icon
                    dark
                    right
                  >
                    {{ icons.mdiPlus }}
                  </v-icon>
                </v-btn>
              </v-col>
              <v-col md="7" cols="10">
                <v-text-field
                  v-model="Pesquisar"
                  label="Filtro universal"
                  single-line
                  hide-details
                  dense
                ></v-text-field>
              </v-col>
              <v-col md="1" cols="2">
                <v-icon
                  dark
                  right
                  color="black"
                >
                  {{ icons.mdiMagnify }}
                </v-icon>
              </v-col>
            </v-row>
          </v-card-title>
          <v-data-table
            :headers="headers"
            :items="listAllCliente.data"
            class="elevation-1"
            :search="Pesquisar"
          >
            <template v-slot:item.acao="{item}">
              <Acao :idUser="item.id" @reload-cliente="reloadCliente()"></Acao>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>


<script>
import {mdiPlus, mdiMagnify} from '@mdi/js';
import {mapActions, mapGetters} from 'vuex'
import storeCliente from "@/modules/cliente/_store"
import Acao from "../../../layouts/AcaoTable"

export default {
  components: {
    Acao
  },
  data() {
    return {
      form: {
        cpf: null,
        name: null,
      },
      Pesquisar: '',
      icons: {
        mdiPlus,
        mdiMagnify
      },
      headers: [
        {
          text: 'Ação',
          align: 'start',
          value: 'acao',
        },
        {text: 'Nome', value: 'nome'},
        {text: 'CPF', value: 'cpf'},
        {text: 'Email', value: 'email'},
        {text: 'Telefone', value: 'telefone'},
        {text: 'Endereço', value: 'endereco'},
      ],
    }
  },
  methods: {
    ...mapActions({
      getAllCliente: '$_cliente/getAllCliente',
    }),
    async reloadCliente() {
      await this.getAllCliente()
    },
    adicionar() {
      return this.$router.push({name: 'cliente.adicionar'})
    }
  },
  computed: {
    ...mapGetters({
      listAllCliente: '$_cliente/listAllCliente',
    }),
  },
  beforeCreate() {
    const STORE_CLIENTE = '$_cliente';
    if (!(STORE_CLIENTE in this.$store._modules.root._children))
      this.$store.registerModule(STORE_CLIENTE, storeCliente)
  },
  async mounted() {
    await this.getAllCliente()
    console.log(this.listAllCliente)
  },
  watch: {},
}

</script>

<style scoped>
.spacing {
  margin-bottom: 20px
}
</style>
