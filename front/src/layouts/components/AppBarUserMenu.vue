<template>
  <v-menu
    offset-y
    left
    nudge-bottom="14"
    min-width="230"
    content-class="user-profile-menu-content"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-badge
        bottom
        color="success"
        overlap
        offset-x="12"
        offset-y="12"
        class="ms-4"
        dot
      >
        <v-avatar
          size="40px"
          v-bind="attrs"
          v-on="on"
        >
          <v-img :src="require('@/assets/images/avatars/1.png')"></v-img>
        </v-avatar>
      </v-badge>
    </template>
    <v-list>
      <div class="pb-3 pt-2">
        <v-badge
          bottom
          color="success"
          overlap
          offset-x="12"
          offset-y="12"
          class="ms-4"
          dot
        >
          <v-avatar size="40px">
            <v-img :src="require('@/assets/images/avatars/1.png')"></v-img>
          </v-avatar>
        </v-badge>
        <div
          class="d-inline-flex flex-column justify-center ms-3"
          style="vertical-align:middle"
        >
          <span class="text--primary font-weight-semibold mb-n1">
            {{ getUser.name }}
          </span>
          <small class="text--disabled text-capitalize">{{this.getPerfil(this.user.id_profile)}}</small>
        </div>
      </div>

      <v-divider></v-divider>

      <!-- Profile -->
      <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon size="22">
            {{ icons.mdiAccountOutline }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title  @click="perfis()">Profile</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <!-- Settings -->
      <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon size="22">
            {{ icons.mdiCogOutline }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Settings</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-divider class="my-2"></v-divider>

      <!-- Logout -->
      <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon size="22">
            {{ icons.mdiLogoutVariant }}
          </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title @click="logout()">Logout</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
import {
  mdiAccountOutline,
  mdiLogoutVariant,
  mdiCogOutline,
} from '@mdi/js'
import {mapActions, mapGetters} from "vuex"
import storeAuth from "@/modules/auth/_store"

export default {
  props: ['getUser'],
  setup() {
    return {
      icons: {
        mdiAccountOutline,
        mdiCogOutline,
        mdiLogoutVariant,
      },
    }
  },
  mounted() {
  },
  methods: {
    ...mapActions({
      logout: '$_auth/logout'
    }),
    getPerfil(id_perfil) {
      let perfil = ''
      switch (id_perfil) {
        case 1:
          return perfil = 'Admin'
          break;
        case 2:
          return perfil = 'Cliente'
          break;
      }
    },
    perfis(){
      return this.$router.push({ path: `users/editar/${this.user.id}`})
    }
  },
  computed: {
    ...mapGetters({
      user: '$_auth/me'
    })
  },
  beforeCreate() {
    const STORE_AUTH = '$_auth';
    if (!(STORE_AUTH in this.$store._modules.root._children))
      this.$store.registerModule(STORE_AUTH, storeAuth)
  }
}
</script>

<style lang="scss">
.user-profile-menu-content {
  .v-list-item {
    min-height: 2.5rem !important;
  }
}
</style>
