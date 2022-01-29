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
                <v-btn small @click="getUsers()">
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
import storeUser from "@/modules/user/_store"
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
        {text: 'Perfil', value: 'profile_name'},
        {text: 'Login', value: 'login'},
        {text: 'Email', value: 'email'},
      ],
    }
  },
  methods: {
    ...mapActions({
      getAllUsers: '$_user/getAllUsers',
    }),
    async reloadUsers() {
      await this.getUsers()
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
    async getUsers() {
      const params = this.getRequestParams(this.pesquisar, this.page + 1, this.per_page);

      await this.getAllUsers(params)
      const response = this.listAllUsers[0]
      this.items = response.data
      this.page = response.current_page
      this.last_page = response.last_page
      this.totalPages = response.total;
      this.pesquisar = ''
    },
    handlePageChange(value) {
      this.page = value;
      this.getUsers();
    },
    handlePageSizeChange(size) {
      this.per_page = size;
      this.page = 1;
      this.getUsers();
    },
  },
  computed: {
    ...mapGetters({
      listAllUsers: '$_user/listAllUsers',
    }),
  },
  beforeCreate() {
    const STORE_USER = '$_user';
    if (!(STORE_USER in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USER, storeUser)
  },
  async mounted() {
    this.getUsers();
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
