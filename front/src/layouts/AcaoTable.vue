<template>
  <v-menu
    offset-x
    right
    nudge-bottom="14"
    min-width="230"
    content-class="user-profile-menu-content"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-icon color="" size="22" v-bind="attrs"
              v-on="on">
        {{ icons.mdiMenu }}
      </v-icon>
    </template>

    <v-list>

      <!--      <v-divider></v-divider>-->

      <!-- Profile -->
      <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon color="info" size="22">
            {{ icons.mdiSync }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title @click="editar(idUser)">Editar</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <!-- Settings -->
      <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon color="warning" size="22">
            {{ icons.mdiEye }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title @click="visualizar(idUser)">Visualizar</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon color="error" size="22">
            {{ icons.mdiDelete }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title @click="excluir(idUser)">Excluir</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
import {
  mdiMenu,
  mdiSync,
  mdiDelete,
  mdiEye,
} from '@mdi/js'
import {mapActions, mapGetters} from "vuex"
import storeSetor from "@/modules/setor/_store";
// import storeAuth from "@/modules/auth/_store"

export default {
  props: ['idUser'],
  data() {
    return {
      icons: {
        mdiMenu,
        mdiSync,
        mdiDelete,
        mdiEye
      },
    }
  },
  mounted() {
    // console.log(this.idUser)
  },
  methods: {
    ...mapActions({
      logout: '$_auth/logout',
      delete: '$_setor/excluir',
      getAllSetor: '$_setor/getAllSetor',
    }),
    editar(id) {
      return this.$router.push({path: this.$router.currentRoute.path + `/editar/${id}`})
    },
    visualizar(id) {
      return this.$router.push({path: this.$router.currentRoute.path + `/visualizar/${id}`})
    },
    async excluir(id) {
      this.$swal.fire({
        title: 'Tem Certeza que deseja excluir ?',
        text: "Esta ação não poderá ser desfeita !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Excluir'
      }).then(async (result, response) => {
        if (result.isConfirmed) {
          try {
            response = await this.delete(id)
            if (response.status == 200) {
              this.$swal.fire(
                'Excluido!',
                'Usuario excluido com sucesso!',
                'success'
              )
              this.$emit("reload-setor")
            }
          } catch (erro) {
            this.$swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: erro,
            })
          }

        }
      })
    }
  },
  computed: {
    ...mapGetters({
      user: '$_auth/me',
      listAllSetor: '$_setor/listAllSetor',
    })
  },
  beforeCreate() {
    const STORE_AUTH = '$_auth';
    if (!(STORE_AUTH in this.$store._modules.root._children))
      this.$store.registerModule(STORE_AUTH, storeAuth)
    const STORE_SETOR = '$_setor';
    if (!(STORE_SETOR in this.$store._modules.root._children))
      this.$store.registerModule(STORE_SETOR, storeSetor)
  }
}
</script>
