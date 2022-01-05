<template>
  <div class="auth-wrapper auth-v1">
    <div class="auth-inner">
      <v-card class="auth-card">
        <!-- logo -->
        <v-card-title class="d-flex align-center justify-center py-7">
          <router-link
            to="/"
            class="d-flex align-center"
          >
            <v-img
              :src="require('@/assets/images/logos/logo2.png')"
              max-height="50px"
              max-width="50px"
              alt="logo"
              contain
              class="me-3 "
            ></v-img>

            <v-img
              :src="require('@/assets/images/logos/1.png')"
              max-height="100px"
              max-width="100px"
              alt="logo"
              contain
              class="me-3 "
            ></v-img>
          </router-link>
        </v-card-title>

        <!-- title -->
        <v-card-text class="align-center justify-center " >
          <p class="text-2xl font-weight-semibold text--primary mb-2">
            Bem Vindo! 👋🏻
          </p>
          <p class="mb-2">
            FAÇA LOGIN PARA INICIAR SUA SESSÃO!
          </p>
        </v-card-text>

        <!-- login form -->
        <v-card-text>
          <v-form>
            <v-text-field
              v-model="form.login"
              outlined
              label="Login"
              hide-details
              class="mb-3"
            ></v-text-field>

            <v-text-field
              v-model="form.password"
              outlined
              :type="isPasswordVisible ? 'text' : 'password'"
              label="Password"
              placeholder="············"
              :append-icon="isPasswordVisible ? icons.mdiEyeOffOutline : icons.mdiEyeOutline"
              hide-details
              @click:append="isPasswordVisible = !isPasswordVisible"
            ></v-text-field>

            <div class="d-flex align-center justify-space-between flex-wrap">

              <!-- forgot link -->
              <a
                href="javascript:void(0)"
                class="mt-1"
              >
                Esqueceu a Senha?
              </a>
            </div>

            <v-btn
              @click.prevent="submit()"
              block
              color="primary"
              class="mt-6"
            >
              Login
            </v-btn>
          </v-form>
        </v-card-text>
      </v-card>
      <v-overlay :value="overlay">
        <v-progress-circular
          indeterminate
          size="64"
          color="primary"
          :size="70"
          :width="7"
        ></v-progress-circular>
      </v-overlay>
    </div>

    <!-- background triangle shape  -->
    <img
      class="auth-mask-bg"
      height="173"
      :src="require(`@/assets/images/misc/mask-${$vuetify.theme.dark ? 'dark':'light'}.png`)"
    >

    <!-- tree -->
    <v-img
      class="auth-tree"
      width="247"
      height="185"
      src="@/assets/images/misc/tree.png"
    ></v-img>

    <!-- tree  -->
    <v-img
      class="auth-tree-3"
      width="377"
      height="289"
      src="@/assets/images/misc/tree-3.png"
    ></v-img>
  </div>
</template>

<script>
// eslint-disable-next-line object-curly-newline
import { mdiEyeOutline, mdiEyeOffOutline } from '@mdi/js'
import { ref } from '@vue/composition-api'
import {mapActions, mapGetters} from 'vuex'
import storeAuth from '../../auth/_store'
import Jwt from "../../../api/jwt";

export default {
  name: "index",
  setup() {
    const isPasswordVisible = ref(false)
    return {
      isPasswordVisible,
      icons: {
        mdiEyeOutline,
        mdiEyeOffOutline,
      },
    }
  },
  data() {
    return {
      form: {
        login: 'marlo',
        password: 'teste',
      },
      overlay: false,
    }
  },
  async created() {
  },
  methods: {
    ...mapActions({
      login: '$_auth/login',
    }),
    async submit() {
      if (this.form.login == "" || this.form.password == "") {
        return this.$swal('Preencha todos os campos!')
      }
      this.overlay = true
      await this.login(this.form)
      if (this.user.success) {
        Jwt.saveToken(this.user.token);
        this.$router.push({name: 'inicio'})
        this.overlay = true
      } else {
        this.overlay = false
        this.$swal.fire('Algo deu errado!', this.user.error, 'error')
      }
    },
  },
  computed: {
    ...mapGetters({
      user: '$_auth/me',
    }),
  },
  beforeCreate() {
    const STORE_AUTH = '$_auth';
    if (!(STORE_AUTH in this.$store._modules.root._children))
      this.$store.registerModule(STORE_AUTH, storeAuth)
  }
}
</script>

<style lang="scss">
@import '~@/plugins/vuetify/default-preset/preset/pages/auth.scss';
</style>
