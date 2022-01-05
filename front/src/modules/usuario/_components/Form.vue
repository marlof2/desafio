<template>
  <v-col
    cols="12"
    lg="12"
    md="12"
  >
    <h1 v-if="!this.$route.params.id" class="spacing">Adicionar Usuário</h1>
    <h1 v-else class="spacing">Alterar Usuário</h1>
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
                <!--                <validation-provider rules="required" v-slot="{ errors }">-->
                <v-text-field
                  v-model="form.name"
                  maxlength="100"
                  label="Nome"
                  outlined
                  dense
                  hide-details
                  :rules="[rules.required]"
                ></v-text-field>
                <!--                  <span class="color-validate">{{ errors[0] }}</span>-->
                <!--                </validation-provider>-->
              </v-col>

              <v-col
                cols="12"
                md="6"
              >
                <!--                <validation-provider rules="required" v-slot="{ errors }">-->
                <v-text-field
                  v-model="form.cpf"
                  label="CPF"
                  outlined
                  dense
                  hide-details
                  v-mask="'###.###.###-##'"
                  :rules="[rules.required]"
                ></v-text-field>
                <!--                  <span class="color-validate">{{ errors[0] }}</span>-->
                <!--                </validation-provider>-->
              </v-col>

              <v-col
                cols="12"
                md="6"
              >
                <!--                <validation-provider rules="required" v-slot="{ errors }">-->
                <v-text-field
                  v-model="form.login"
                  label="Login"
                  outlined
                  dense
                  hide-details
                  :rules="[rules.required]"
                ></v-text-field>
                <!--                  <span class="color-validate">{{ errors[0] }}</span>-->
                <!--                </validation-provider>-->
              </v-col>

              <v-col
                cols="12"
                md="6"
              >
                <!--                <validation-provider rules="required" v-slot="{ errors }">-->
                <v-text-field
                  v-model="form.password"
                  :type="'password'"
                  label="Senha"
                  outlined
                  dense
                  hide-details
                  :rules="[rules.required]"
                ></v-text-field>
                <!--                  <span class="color-validate">{{ errors[0] }}</span>-->
                <!--                </validation-provider>-->
              </v-col>

              <v-col
                md="12"
                cols="12">
                <!--                <validation-provider rules="required|email" v-slot="{ errors }">-->
                <v-text-field
                  v-model="form.email"
                  label="Email"
                  outlined
                  dense
                  hide-details
                  :rules="[rules.required]"
                ></v-text-field>
                <!--                  <span class="color-validate">{{ errors[0] }}</span>-->
                <!--                </validation-provider>-->
              </v-col>


              <!--              <v-col cols="12">-->
              <!--                <v-divider color=""></v-divider>-->
              <!--              </v-col>-->

              <v-col
                cols="12"
                sm="6"
              >
                <!--                <validation-provider rules="required" v-slot="{ errors }">-->
                <v-select
                  v-model="form.id_setor"
                  :items="getSetor.setor"
                  item-value="id"
                  item-text="nome"
                  :menu-props="{ maxHeight: '400' }"
                  label="Setor"
                  :rules="[rules.required]"
                ></v-select>
                <!--                  <span class="color-validate">{{ errors[0] }}</span>-->
                <!--                </validation-provider>-->
              </v-col>

              <v-col
                cols="12"
                sm="6"
              >
                <!--                <validation-provider rules="required" v-slot="{ errors }">-->
                <v-select
                  v-model="form.id_perfil"
                  :items="getPerfis.perfis"
                  item-value="id"
                  item-text="nome"
                  :menu-props="{ maxHeight: '400' }"
                  label="Perfis"
                  :rules="[rules.required]"
                ></v-select>
                <!--                  <span class="color-validate">{{ errors[0] }}</span>-->
                <!--                </validation-provider>-->
              </v-col>
              <v-col class="mt-5" cols="12">
                <h2 class="">Gengênciar Funcionalidades e Ações.</h2>
                <v-divider class=""></v-divider>
              </v-col>
              <div class=" col-md-12">
                <v-row class="marginEu">
                  <v-col>
                    <h1 class="subtitle-1">Selecione as funcionalidades e ações para gengênciar o
                      acesso do
                      usuário.</h1>
                  </v-col>
                </v-row>

                <v-row
                  v-for="funcionalidade in getFuncionalidade.funcionalidades"
                  :key="funcionalidade.id"
                >
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-checkbox
                      v-model="form.id_funcionalidades[funcionalidade.id]"
                      :label="`${funcionalidade.nome_funcionalidade}`"
                      :value="funcionalidade.id"
                    ></v-checkbox>
                    <!--                    <v-select-->
                    <!--                      v-model="form.id_funcionalidades[funcionalidade.id]"-->
                    <!--                      :items="getFuncionalidade.funcionalidades"-->
                    <!--                      item-value="id"-->
                    <!--                      item-text="nome_funcionalidade"-->
                    <!--                      :menu-props="{ maxHeight: '400' }"-->
                    <!--                      label="Funcionalidades"-->
                    <!--                      chips-->
                    <!--                      :rules="[rules.required]"-->
                    <!--                    ></v-select>-->
                  </v-col>

                  <v-col
                    class="d-flex"
                    cols="6"
                    sm="6"
                    md="6"
                  >
                    <v-select
                      v-model="form.id_acoes[funcionalidade.id]"
                      :items="getAcoes.acoes"
                      item-value="id"
                      item-text="nome"
                      :menu-props="{ maxHeight: '400' }"
                      label="Acões"
                      multiple
                      chips
                      :rules="[rules.required]"
                    ></v-select>
                  </v-col>
                </v-row>
              </div>


              <v-col cols="12">
                <v-btn type="submit" color="primary">
                  Salvar
                </v-btn>
                <v-btn
                  outlined
                  class="mx-2"
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
import storeUser from "@/modules/usuario/_store"
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
        id_acoes: [],
        id_perfil: [],
        id_funcionalidades: [],
        id_setor: null,
        acoesDaFuncionalidade: [],
        cpf: null,
        login: null,
        name: null,
        password: null,
        ativo: 1,
        email: null,
      },
      rules: {
        required: (value) => !!value
      },
    }
  },
  methods: {
    ...mapActions({
      adicionar: '$_user/adicionar',
      perfis: '$_user/getPerfil',
      acoes: '$_user/getAcoes',
      setor: '$_user/getSetor',
      funcionalidade: '$_user/getFuncionalidade',
      user: '$_user/getUser',
    }),
    async onSubmit() {
      this.form.acoesDaFuncionalidade = []
      this.form.id_acoes.forEach((id_acao, id_funcionalidade) => {
        this.form.acoesDaFuncionalidade.push({
          id_funcionalidade: this.form.id_funcionalidades[id_funcionalidade],
          id_acao: id_acao
        })
      })
      try {
        const response = await this.adicionar(this.form)
        if (response.status == 200) {
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
            title: 'Adicionado com Sucesso!'
          })
          this.$router.push({name: 'usuario.index'})
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
    await this.perfis()
    await this.acoes()
    await this.setor()
    await this.funcionalidade()
    if (this.$route.params.id != undefined) {
      await this.user(this.$route.params.id)
    }
    // const acoes = this.getAcoes.acoes.map(acao => {
    //   return acao.id
    // })

  },
  computed: {
    ...mapGetters({
      getAllUsers: '$_user/getAllUsers',
      getUser: '$_user/getUser',
      getPerfis: '$_user/getPerfis',
      getAcoes: '$_user/getAcoes',
      getSetor: '$_user/getSetor',
      getFuncionalidade: '$_user/getFuncionalidade',
    }),
  },
  beforeCreate() {
    const STORE_USER = '$_user';
    if (!(STORE_USER in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USER, storeUser)
  },
  watch: {
    getUser: function (user) {
      if (this.$route.params.id != undefined) {
        // console.log(user.usuario.userperfil_funcionalidade_acao)
        // console.log(this.getFuncionalidade.funcionalidades)
        this.form.name = user.usuario.name
        this.form.cpf = user.usuario.cpf
        this.form.login = user.usuario.login
        this.form.password = user.usuario.senha
        this.form.email = user.usuario.email
        this.form.id_setor = user.usuario.id_setor
        this.form.id_perfil = user.usuario.id_perfil

        user.usuario.userperfil_funcionalidade_acao.forEach(element => {
          this.form.id_funcionalidades.push(element.id_funcionalidade)
        })

        console.log(this.form.id_funcionalidades)
        // console.log(arrayId_funcionalidade)

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
