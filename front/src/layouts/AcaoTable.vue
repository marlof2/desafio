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
      <!-- Profile -->
      <v-list-item link v-if="verifyUser() || ProfileAdmin()">
        <v-list-item-icon class="me-2">
          <v-icon color="info" size="22">
            {{ icons.mdiSync }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title @click="editar(idUser)">Editar</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider v-if="hide() || verifyUser()"></v-divider>
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
      <v-divider v-if="hide()"></v-divider>
      <v-list-item link v-if="hide()">
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
import storeAuth from "@/modules/auth/_store"
import Api from "@/api";

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
    // console.log(this.getAuth[0])
  },
  methods: {
    ...mapActions({
      logout: '$_auth/logout',
    }),
    ProfileAdmin(){
    return this.getAuth[0].id_profile == 1
    },
    verifyUser(){
    return this.getAuth[0].id == this.idUser
    },
    hide() {
      if (this.getAuth[0].id_profile === 2) {
        return false
      } else {
        return true
      }
    },
    editar(id) {
      return this.$router.push({path: this.$router.currentRoute.path + `/editar/${id}`})
    },
    visualizar(id) {
      return this.$router.push({path: this.$router.currentRoute.path + `/visualizar/${id}`})
    },
    async excluir(id) {
      const pathRoute = this.$router.currentRoute.path
      this.$swal.fire({
        title: 'Tem Certeza que deseja excluir ?',
        text: "Esta ação não poderá ser desfeita !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Excluir'
      }).then(async (result) => {
        if (result.isConfirmed) {
          try {
            const response = await Api.delete(`http://127.0.0.1:8000/api${pathRoute}/destroy`, id);
            if (response.data.success) {
              this.$swal.fire(
                'Excluido!',
                'Usuario excluido com sucesso!',
                'success'
              )
              this.$emit("reload-delete")
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
      getAuth: '$_auth/getAuth',
    })
  },
  beforeCreate() {
    const STORE_AUTH = '$_auth';
    if (!(STORE_AUTH in this.$store._modules.root._children))
      this.$store.registerModule(STORE_AUTH, storeAuth)
  }
}
</script>
