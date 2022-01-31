<template>
  <div class="auth-wrapper auth-v1">
    <div class="auth-inner">
      <v-card class="auth-card">

        <!-- title -->
        <v-card-text class="align-center justify-center ">
          <p class="text-2xl font-weight-semibold text--primary mb-2">
            Bem Vindo! 👋🏻
          </p>
          <p class="mb-2">
            FAÇA LOGIN PARA INICIAR SUA SESSÃO!
          </p>
        </v-card-text>

        <!-- login form -->
        <v-card-text>
          <ValidationObserver v-slot="{ handleSubmit }">
            <v-form @submit.prevent="handleSubmit(submit)" class="multi-col-validation">
              <validation-provider rules="required" v-slot="{ errors }">
                <v-text-field
                  v-model="form.login"
                  outlined
                  label="Login"
                  hide-details
                ></v-text-field>
                <span class="mb-3 color-validate">{{ errors[0] }}</span>
              </validation-provider>
              <div class="mb-3"></div>
              <validation-provider rules="required" v-slot="{ errors }">
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
                <span class="color-validate">{{ errors[0] }}</span>
              </validation-provider>

              <div class="d-flex align-center justify-space-between flex-wrap">
                <router-link to="register" class="mt-1">
                  Registre-se
                </router-link>
              </div>
              <v-btn
                type="submit"
                block
                color="primary"
                class="mt-6"
              >
                Login
              </v-btn>
            </v-form>
          </ValidationObserver>
        </v-card-text>
      </v-card>
      <v-overlay :value="overlay">
        <v-progress-circular
          indeterminate
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
import {mdiEyeOutline, mdiEyeOffOutline} from '@mdi/js'
import {ref} from '@vue/composition-api'
import {mapActions, mapGetters} from 'vuex'
import storeAuth from '../../auth/_store'
import Jwt from "../../../api/jwt";
import {ValidationProvider, extend, ValidationObserver} from 'vee-validate';
import {required} from 'vee-validate/dist/rules';

extend('required', {
  ...required,
  message: 'Campo Obrigatório!',
});

export default {
  components: {ValidationProvider, ValidationObserver},
  name: "index",
  data() {
    return {
      form: {
        login: 'marlo',
        password: 'teste',
      },
      overlay: false,
      isPasswordVisible: false,
      icons: {
        mdiEyeOutline,
        mdiEyeOffOutline,
      },
      rules: {
        required: (value) => !!value
      },
    }
  },
  async created() {
  },
  methods: {
    ...mapActions({
      login: '$_auth/login',
    }),
    async submit() {
      try {
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
      } catch (e) {
        this.$swal.fire('Algo deu errado!', e.message, 'error')
      }
    }
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
.color-validate {
  color: red !important;
}

@import '~@/plugins/vuetify/default-preset/preset/pages/auth.scss';
</style>
