<template>
  <v-row>
    <v-col
      cols="12"
      lg="12"
      md="12"
    >
      <h1 class="spacing">Consultar Usuários</h1>
      <!--      <v-card elevation="5">-->
      <!--        <v-card-title>Filtro</v-card-title>-->
      <!--        <v-divider></v-divider>-->
      <!--        <v-card-text class="mt-3">-->
      <!--          <v-form class="multi-col-validation">-->
      <!--            <v-row>-->
      <!--              <v-col-->
      <!--                cols="12"-->
      <!--                md="6"-->
      <!--              >-->
      <!--                <v-text-field-->
      <!--                  v-model="form.name"-->
      <!--                  label="Nome"-->
      <!--                  outlined-->
      <!--                  dense-->
      <!--                  hide-details-->
      <!--                ></v-text-field>-->
      <!--              </v-col>-->

      <!--              <v-col-->
      <!--                cols="12"-->
      <!--                md="6"-->
      <!--              >-->
      <!--                <v-text-field-->
      <!--                  v-model="form.cpf"-->
      <!--                  label="CPF"-->
      <!--                  outlined-->
      <!--                  dense-->
      <!--                  hide-details-->
      <!--                ></v-text-field>-->
      <!--              </v-col>-->


      <!--              <v-col cols="12">-->
      <!--                <v-btn color="primary">-->
      <!--                  Pesquisar-->
      <!--                </v-btn>-->
      <!--                <v-btn-->
      <!--                  type="reset"-->
      <!--                  outlined-->
      <!--                  class="mx-2"-->
      <!--                >-->
      <!--                  Limpar-->
      <!--                </v-btn>-->
      <!--              </v-col>-->
      <!--            </v-row>-->
      <!--          </v-form>-->
      <!--        </v-card-text>-->
      <!--      </v-card>-->
    </v-col>


    <v-col
      cols="12"
      lg="12"
      md="12"
    >
      <v-card elevation="5">
        <!--        <v-col>-->
        <!--          <v-btn-->
        <!--            @click="adicionar()"-->
        <!--            color="success">-->
        <!--            Adicionar-->
        <!--            <v-icon-->
        <!--              dark-->
        <!--              right-->
        <!--            >-->
        <!--              {{ icons.mdiPlus }}-->
        <!--            </v-icon>-->
        <!--          </v-btn>-->
        <!--        </v-col>-->
        <v-divider></v-divider>
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
            :items="getAllUsers.users"
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
            <template v-slot:item.perfil="{item}">
              {{ retornaPerfis(item) }}
            </template>
            <template v-slot:item.setor="{item}">
              {{ item.setor.nome }}
            </template>
            <template v-slot:item.cpf="{item}">
              {{ item.cpf }}
            </template>
            <template v-slot:item.acao="{item}">
              <Acao :idUser="item.id"></Acao>
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
import storeUser from "@/modules/usuario/_store"
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
        {text: 'nome', value: 'name'},
        {text: 'Perfil', value: 'perfil'},
        {text: 'Setor', value: 'setor'},
        {text: 'CPF', value: 'cpf'},
        {text: 'Email', value: 'email'},
        {text: 'Ativo', value: 'ativo'},
      ],
    }
  },
  methods: {
    ...mapActions({
      listAllUser: '$_user/listAllUser',
    }),
    getColor(ativo) {
      if (ativo == 1) {
        return 'success'
      } else {
        return 'error'
      }
    },
    retornaPerfis(item) {
      let perfis = item.perfil
      let retorno = ''
      perfis.forEach((perfil) => {
        retorno += perfil.nome + ', '
      })
      retorno = retorno.substring(0, retorno.length - 2)
      return retorno
    },
    adicionar() {
      return this.$router.push({name: 'usuario.adicionar'})
    }
  },
  computed: {
    ...mapGetters({
      getAllUsers: '$_user/getAllUsers',
    }),
  },
  beforeCreate() {
    const STORE_USER = '$_user';
    if (!(STORE_USER in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USER, storeUser)
  },
  async mounted() {
    await this.listAllUser()
    // console.log(this.getIdsParaActions())
  },
  watch: {
    options: {
      handler() {
        this.getAllUsers.users
      },
      deep: true,
    },
  },
}

</script>

<style scoped>
.spacing {
  margin-bottom: 20px
}
</style>
