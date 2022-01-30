<template>
  <v-col
    cols="12"
    lg="12"
    md="12"
  >
    <h1 v-if="!this.$route.params.id" class="spacing">Adicionar Usuário</h1>
    <h1 v-else-if="this.$route.params.id && this.$route.name == 'usuario.editar'"
        class="spacing">
      Alterar Usuário</h1>
    <h1 v-else class="spacing">Visualizar Usuário</h1>
    <v-card elevation="5">
      <v-card-subtitle>
        <h2 class="">Dados do Usuário</h2>
        <v-divider color=""></v-divider>
      </v-card-subtitle>
      <v-card-text class="mt-3">
        <ValidationObserver v-slot="{ handleSubmit  }">
          <v-form @submit.prevent="handleSubmit (onSubmit)" class="multi-col-validation">
            <v-row>
              <v-col
                cols="12"
                md="6"
              >
                <validation-provider rules="required" v-slot="{ errors }">
                  <v-text-field
                    v-model="form.name"
                    maxlength="100"
                    label="Nome"
                    outlined
                    dense
                    hide-details
                    :rules="[rules.required]"
                    :disabled="disabledVisualizar()">
                    >
                  </v-text-field>
                  <span class="color-validate">{{ errors[0] }}</span>
                </validation-provider>
              </v-col>

              <v-col
                cols="12"
                md="6"
              >
                <validation-provider rules="required" v-slot="{ errors }">
                  <v-text-field
                    v-model="form.login"
                    label="Login"
                    outlined
                    dense
                    hide-details
                    :rules="[rules.required]"
                    :disabled="disabledVisualizar()">
                    >
                  </v-text-field>
                  <span class="color-validate">{{ errors[0] }}</span>
                </validation-provider>
              </v-col>

              <v-col
                cols="12"
                md="6"
                v-if="$route.name == 'usuario.adicionar'"
              >
                <validation-provider rules="required" v-slot="{ errors }">
                  <v-text-field
                    v-model="form.password"
                    :type="'password'"
                    label="Senha"
                    outlined
                    dense
                    hide-details
                    :rules="[rules.required]"
                    :disabled="disabledVisualizar()">
                    >
                  </v-text-field>
                  <span class="color-validate">{{ errors[0] }}</span>
                </validation-provider>
              </v-col>

              <v-col
                ms="6"
                cols="12"
                :md="$route.name == 'usuario.adicionar' ? '6' : '12' "
              >
                <validation-provider rules="required|email" v-slot="{ errors }">
                  <v-text-field
                    v-model="form.email"
                    label="Email"
                    outlined
                    dense
                    hide-details
                    :rules="[rules.required]"
                    :disabled="disabledVisualizar()">
                    >
                  </v-text-field>
                  <span class="color-validate">{{ errors[0] }}</span>
                </validation-provider>
              </v-col>

              <v-col class="mt-5" cols="12">
                <h2 class="">Gengênciar Ações.</h2>
                <v-divider class=""></v-divider>
              </v-col>
              <div class=" col-md-12">
                <v-row class="marginEu">
                  <v-col>
                    <h1 class="subtitle-1">Selecione as ações para gengênciar o
                      acesso do
                      usuário.</h1>
                  </v-col>
                </v-row>

                <v-row
                >

                  <v-col
                    cols="6"
                    sm="6"
                    md="6"
                  >
                    <validation-provider rules="required" v-slot="{ errors }">
                      <v-select
                        v-model="form.id_actions"
                        :items="getActions[0]"
                        item-value="id"
                        item-text="name"
                        :menu-props="{ maxHeight: '400' }"
                        label="Acões"
                        multiple
                        outlined
                        dense
                        chips
                        hide-details
                        :rules="[rules.required]"
                        :disabled="disabledVisualizar()">
                        >
                      </v-select>
                      <span class="color-validate">{{ errors[0] }}</span>
                    </validation-provider>
                  </v-col>

                  <v-col
                    cols="12"
                    sm="6"
                  >
                    <validation-provider rules="required" v-slot="{ errors }">
                      <v-select
                        v-model="form.id_profile"
                        :items="getProfile[0]"
                        item-value="id"
                        item-text="name"
                        :menu-props="{ maxHeight: '400' }"
                        label="Perfil"
                        :rules="[rules.required]"
                        outlined
                        dense
                        hide-details
                        :disabled="disabledVisualizar()">
                        >
                      </v-select>
                      <span class="color-validate">{{ errors[0] }}</span>
                    </validation-provider>
                  </v-col>
                </v-row>
              </div>


              <v-col cols="12">
                <v-btn type="submit"
                       color="primary"
                       :disabled="disabledVisualizar()">
                  Salvar
                </v-btn>
                <v-btn
                  outlined
                  class="mx-2"
                  @click="backToIndex()"
                >
                  Voltar
                </v-btn>
              </v-col>
            </v-row>
          </v-form>
        </ValidationObserver>
      </v-card-text>
    </v-card>
  </v-col>
</template>


<script>
import {mapActions, mapGetters} from 'vuex'
import storeUser from "@/modules/user/_store"
import storeAction from "@/modules/actions/_store"
import storeProfile from "@/modules/profile/_store"
import {ValidationProvider, extend, ValidationObserver} from 'vee-validate';
import {required, email} from 'vee-validate/dist/rules';

extend('required', {
  ...required,
  message: 'Campo Obrigatório!',
});
extend('email', {
  ...email,
  message: 'Insira um e-mail valido!',
});
export default {
  components: {ValidationProvider, ValidationObserver},
  data() {
    return {
      form: {
        login: null,
        name: null,
        password: null,
        email: null,
        id_profile: null,
        id_actions: [],
      },
      rules: {
        required: (value) => !!value
      },
    }
  },
  methods: {
    ...mapActions({
      update: '$_user/update',
      save: '$_user/save',
      profiles: '$_profile/getAllProfile',
      action: '$_actions/getAllActions',
      user: '$_user/getUserById',
    }),
    disabledVisualizar() {
      return this.$route.name === 'usuario.visualizar'
    },
    backToIndex() {
      return this.$router.push({name: 'usuario.index'})
    },
    async onSubmit() {
      try {
        if (this.$route.params.id != undefined) {
          this.form.id = this.$route.params.id
          const response = await this.update(this.form)
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
            this.$router.push({name: 'usuario.index'})
          }
        } else {
          const response = await this.save(this.form)
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
            this.$router.push({name: 'usuario.index'})
          }
        }

      } catch (erro) {
        this.$swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: erro,
        })
      }
    },
  },
  async mounted() {
    await this.profiles()
    await this.action()
    if (this.$route.params.id != undefined) {
      await this.user(this.$route.params.id)
    }
  },
  computed: {
    ...mapGetters({
      listUserById: '$_user/listUserById',
      getProfile: '$_profile/listAllProfiles',
      getActions: '$_actions/listAllActions',
    }),
  },
  beforeCreate() {
    const STORE_USER = '$_user';
    if (!(STORE_USER in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USER, storeUser)
    const STORE_ACTION = '$_actions';
    if (!(STORE_ACTION in this.$store._modules.root._children))
      this.$store.registerModule(STORE_ACTION, storeAction)
    const STORE_PROFILE = '$_profile';
    if (!(STORE_PROFILE in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PROFILE, storeProfile)
  },
  watch: {
    listUserById: function (user) {
      if (this.$route.params.id != undefined) {
        this.form.name = user.data.name
        this.form.login = user.data.login
        this.form.password = user.data.senha
        this.form.email = user.data.email
        this.form.id_profile = user.data.id_profile
        user.data.user_action.forEach(action => {
          this.form.id_actions.push(action.id_action)
        })

      }
    }
  },
}

</script>

<style scoped>
.spacing {
  margin-bottom: 20px
}

.marginEu {
  margin-top: -18px
}

.color-validate {
  color: red !important;
}

span {
  display: block;
}
</style>
