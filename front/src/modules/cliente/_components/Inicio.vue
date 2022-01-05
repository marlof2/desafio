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
                  label="Pesquisar"
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
            :items="listAllSetor.setor"
            class="elevation-1"
            :search="Pesquisar"
          >
            <template v-slot:item.ativo="{ item }">
              <v-chip
                :color="getColor(item.ativo)"
                dark
              >
                {{ item.ativo ? 'Sim' : 'Não' }}
              </v-chip>
            </template>
            <template v-slot:item.acao="{item}">
              <Acao :idUser="item.id" @reload-setor="reloadSetor()"></Acao>
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
        {text: 'Cod Setor', value: 'codigo_setor'},
        {text: 'Nome', value: 'nome'},
        {text: 'Ativo', value: 'ativo'},
      ],
    }
  },
  methods: {
    ...mapActions({
      getAllCliente: '$_cliente/getAllCliente',
    }),
    async reloadSetor() {
      await this.getAllCliente()
    },
    getColor(ativo) {
      if (ativo == 1) {
        return 'success'
      } else {
        return 'error'
      }
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
    // console.log(this.getIdsParaActions())
  },
  watch: {
  },
}

</script>

<style scoped>
.spacing {
  margin-bottom: 20px
}
</style>
