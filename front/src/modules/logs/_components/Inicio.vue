<template>
  <v-row>
    <v-col
      cols="12"
      lg="12"
      md="12"
    >
      <h1 class="spacing">Consultar Logs</h1>
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
              <v-col md="6" cols="10">
                <v-text-field
                  v-model="pesquisar"
                  label="Pesquisar"
                  single-line
                  hide-details
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="1" md="1">
                <v-btn small @click="indexLog()">
                  Pesquisar
                </v-btn>
              </v-col>
              <v-col cols="12" sm="6">
              </v-col>
            </v-row>
          </v-card-title>
          <v-data-table
            :headers="headers"
            :items="items"
            class="elevation-1"
            :hide-default-footer="true"
            :items-per-page="20"
          >
            <template v-slot:item.acao="{item}">
              <Acao :idUser="item.id" @reload-delete="reloadUsers()"></Acao>
            </template>
          </v-data-table>
          <v-row class="mt-5">
            <v-col cols="12" sm="2" md="2">
              <v-select
                v-model="per_page"
                :items="pageSizes"
                label="Arquivos por página."
                @change="handlePageSizeChange"
              ></v-select>
            </v-col>
            <v-col cols="12" sm="7">
              <v-pagination
                v-model="page"
                :length="last_page"
                total-visible="7"
                @input="handlePageChange"
              ></v-pagination>
            </v-col>
            <v-col class="text-right" cols="12" sm="2" md="3">
              ({{ this.totalPages }}) Resultados encontrados
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>


<script>
import {mdiPlus, mdiMagnify} from '@mdi/js';
import {mapActions, mapGetters} from 'vuex'
import storeLogs from "@/modules/logs/_store"
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
      items: [],
      pesquisar: '',
      page: 1,
      last_page: null,
      totalPages: 0,
      per_page: 10,
      pageSizes: [5, 10, 15],
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
        {text: 'Nome', value: 'name'},
        {text: 'Login', value: 'login'},
        {text: 'Data/Hora', value: 'data/hora'},
      ],
    }
  },
  methods: {
    ...mapActions({
      index: '$_logs/index',
    }),
    async reloadUsers() {
      await this.indexLog()
    },
    adicionar() {
      return this.$router.push({name: 'usuario.adicionar'})
    },
    getRequestParams(search, page, per_page) {
      let params = {};
      if (search) {
        params["search"] = search;
      }
      if (page) {
        params["page"] = page - 1;
      }
      if (per_page) {
        params["per_page"] = per_page;
      }
      return params;
    },
    async indexLog() {
      const params = this.getRequestParams(this.pesquisar, this.page + 1, this.per_page);

      const response = await this.index(params)
      // const response = this.listAllUsers[0]
      this.items = response[0].data
      this.page = response[0].current_page
      this.last_page = response[0].last_page
      this.totalPages = response[0].total;
      this.pesquisar = ''
    },
    handlePageChange(value) {
      this.page = value;
      this.indexLog();
    },
    handlePageSizeChange(size) {
      this.per_page = size;
      this.page = 1;
      this.indexLog();
    },
  },
  computed: {
    ...mapGetters({
      // listAllUsers: '$_user/listAllUsers',
    }),
  },
  beforeCreate() {
    const STORE_LOGS = '$_logs';
    if (!(STORE_LOGS in this.$store._modules.root._children))
      this.$store.registerModule(STORE_LOGS, storeLogs)
  },
  async mounted() {
    this.indexLog();
    // this.$route.query = {query:{page:this.page}}

  },
  watch: {},
}

</script>

<style scoped>
.spacing {
  margin-bottom: 20px
}
</style>
