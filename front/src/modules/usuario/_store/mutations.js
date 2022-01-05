import Jwt from "../../../api/jwt";
import router from "../../../router"

const STORE_ALL_USERS = (state, users) => {
  state.users = users
}
const STORE_ME_LOGOUT = (state) => {
  router.push({name: 'login'})
  state.me = []
  Jwt.destroyToken()
}
const STORE_GET_USER = (state, user) => {
  state.user = user
}
const STORE_GET_PERFIS = (state, perfis) => {
  state.perfis = perfis
}
const STORE_GET_ACOES = (state, acoes) => {
  state.acoes = acoes
}
const STORE_GET_SETOR = (state, setor) => {
  state.setor = setor
}
const STORE_GET_FUNCIONALIDADE = (state, funcionalidades) => {
  state.funcionalidades = funcionalidades
}


export default{
  STORE_ALL_USERS,
  STORE_ME_LOGOUT,
  STORE_GET_USER,
  STORE_GET_PERFIS,
  STORE_GET_ACOES,
  STORE_GET_FUNCIONALIDADE,
  STORE_GET_SETOR,
}
