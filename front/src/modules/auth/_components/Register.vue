<template>
  <div class="auth-wrapper auth-v1">
    <div class="auth-inner">
      <v-card class="auth-card">

        <!-- title -->
        <v-card-text>
          <p class="text-2xl font-weight-semibold text--primary mb-2">
            Crie sua conta agora. 🚀
          </p>
        </v-card-text>

        <!-- login form -->
        <v-card-text>
          <ValidationObserver v-slot="{ handleSubmit }">
            <v-form @submit.prevent="handleSubmit(submit)" class="multi-col-validation">
              <validation-provider rules="required" v-slot="{ errors }">
                <v-text-field
                  v-model="form.name"
                  outlined
                  label="Nome"
                  hide-details
                  class="mb-3"
                ></v-text-field>
                <span class="mb-3 color-validate">{{ errors[0] }}</span>
              </validation-provider>

              <validation-provider rules="required" v-slot="{ errors }">
                <v-text-field
                  v-model="form.login"
                  outlined
                  label="login"
                  hide-details
                  class="mb-3"
                ></v-text-field>
                <span class="mb-3 color-validate">{{ errors[0] }}</span>
              </validation-provider>
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
                  class="mb-3"
                ></v-text-field>
                <span class="mb-3 color-validate">{{ errors[0] }}</span>
              </validation-provider>
              <validation-provider rules="required" v-slot="{ errors }">
                <v-text-field
                  v-model="form.email"
                  outlined
                  label="Email"
                  hide-details
                  class="mb-3"
                ></v-text-field>
                <span class="mb-3 color-validate">{{ errors[0] }}</span>
              </validation-provider>

              <v-btn
                type="submit"
                block
                color="primary"
                class="mt-6"
              >
                Criar Conta
              </v-btn>
            </v-form>
          </ValidationObserver>
        </v-card-text>
      </v-card>
    </div>

    <!-- background triangle shape  -->
    <img
      class="auth-mask-bg"
      height="190"
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
import {mapActions} from "vuex";
import Jwt from "@/api/jwt";
import storeAuth from "@/modules/auth/_store";
import {ValidationProvider, extend, ValidationObserver} from 'vee-validate';
import {required} from 'vee-validate/dist/rules';

extend('required', {
  ...required,
  message: 'Campo Obrigatório!',
});

export default {
  components: {ValidationProvider, ValidationObserver},
  data() {
    return {
      form: {
        name: '',
        login: '',
        password: '',
        email: '',

      },
      overlay: false,
      isPasswordVisible: false,
      icons: {
        mdiEyeOutline,
        mdiEyeOffOutline,
      },
    }
  },
  async created() {
  },
  methods: {
    ...mapActions({
      register: '$_auth/register',
    }),
    async submit() {
      try {
        this.overlay = true
        const response = await this.register(this.form)
        if (response.success) {
          const Toast = this.$swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 8000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', this.$swal.stopTimer)
              toast.addEventListener('mouseleave', this.$swal.resumeTimer)
            }
          })
          Toast.fire({
            icon: 'success',
            title: response.msg
          })
          this.$router.push({name: 'login'})
          this.overlay = true
        }
      } catch (e) {
        this.$swal.fire('Algo deu errado!', e.message, 'error')
      }
    }
    ,
    beforeCreate() {
      const STORE_AUTH = '$_auth';
      if (!(STORE_AUTH in this.$store._modules.root._children))
        this.$store.registerModule(STORE_AUTH, storeAuth)
    }
  },
}
</script>

<style lang="scss">
@import '~@/plugins/vuetify/default-preset/preset/pages/auth.scss';

.color-validate {
  color: red !important;
}
</style>
