<template>
  <v-col
    cols="12"
    lg="12"
    md="12"
  >
    <h1 v-if="!this.$route.params.id" class="spacing">Adicionar Cliente</h1>
    <h1 v-else-if="this.$route.params.id && this.$route.name == 'cliente.editar' " class="spacing">
      Alterar Cliente</h1>
    <h1 v-else class="spacing">Visualizar Cliente</h1>
    <v-card elevation="5">
      <v-card-text class="mt-3">
        <ValidationObserver v-slot="{ handleSubmit  }">
          <v-form @submit.prevent="handleSubmit(onSubmit)" class="multi-col-validation">
            <v-col
              cols="12"
              md="6"
            >
              <validation-provider rules="required" v-slot="{ errors }">
                <v-text-field
                  :disabled="disabledVisualizar()"
                  v-model="form.codigo_setor"
                  maxlength="100"
                  label="Código do setor"
                  outlined
                  dense
                  hide-details
                  :rules="[rules.required]"
                ></v-text-field>
                <span class="color-validate">{{ errors[0] }}</span>
              </validation-provider>
            </v-col>

            <v-col
              cols="12"
              md="6"
            >
              <validation-provider rules="required" v-slot="{ errors }">
                <v-text-field
                  :disabled="disabledVisualizar()"
                  v-model="form.nome"
                  label="Nome"
                  outlined
                  dense
                  hide-details
                  :rules="[rules.required]"
                ></v-text-field>
                <span class="color-validate">{{ errors[0] }}</span>
              </validation-provider>
            </v-col>

            <v-col
              cols="12"
              md="6"
              class="mt-5"
            >
              <!--              <validation-provider rules="required" v-slot="{ errors }">-->
              <p class="title">Ativar/Inativar Setor</p>
              <v-switch
                hint="Inativo"
                persistent-hint
                v-model="form.ativo"
                :messages="messages"
                :disabled="disabledVisualizar()"
              ></v-switch>
              <!--                <span class="color-validate">{{ errors[0] }}</span>-->
              <!--              </validation-provider>-->
            </v-col>

            <v-col cols="12">
              <v-btn
                type="submit"
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
          </v-form>
        </ValidationObserver>
      </v-card-text>
    </v-card>
  </v-col>
</template>


<script>
import {mapActions, mapGetters} from 'vuex'
import {ValidationProvider, extend, ValidationObserver} from 'vee-validate';
import {required} from 'vee-validate/dist/rules';
import storeCliente from "@/modules/cliente/_store"

extend('required', {
  ...required,
  message: 'Campo Obrigatório!',
});
export default {
  components: {ValidationProvider, ValidationObserver},
  data() {
    return {
      form: {
        codigo_setor: null,
        nome: null,
        ativo: 0,
        id: null,
      },
      showMessages: false,
      rules: {
        required: (value) => !!value
      },
    }
  },
  methods: {
    ...mapActions({
      save: '$_cliente/save',
      update: '$_cliente/update',
      getClienteById: '$_cliente/getClienteById',
    }),
    disabledVisualizar() {
      return this.$route.name === 'cliente.visualizar'
    },
    async onSubmit() {
      try {

        if (this.$route.params.id != undefined) {

          this.form.id = this.$route.params.id
          const response = await this.update(this.form)

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
              title: 'Alterado com Sucesso!'
            })
            this.$router.push({name: 'cliente.index'})
          }
        } else {
          const response = await this.save(this.form)
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
            this.$router.push({name: 'cliente.index'})
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
    backToIndex() {
      return this.$router.push({name: 'cliente.index'})
    }
  },
  async mounted() {
    if (this.$route.params.id != undefined) {
      await this.getSetorById(this.$route.params.id)
    }
  },
  computed: {
    ...mapGetters({
      listClienteById: '$_cliente/listClienteById',
    }),
    messages() {
      return this.form.ativo ? ['Ativo'] : undefined
    },
  },
  beforeCreate() {
    const STORE_CLIENTE = '$_cliente';
    if (!(STORE_CLIENTE in this.$store._modules.root._children))
      this.$store.registerModule(STORE_CLIENTE, storeCliente)
  },
  watch: {
    listSetorById: function (setor) {
      if (this.$route.params.id != undefined) {
        this.form.nome = setor[0].nome
        this.form.codigo_setor = setor[0].codigo_setor
        this.form.ativo = setor[0].ativo
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
