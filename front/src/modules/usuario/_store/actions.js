import api from '../_api'
// import Jwt from '../../../api/jwt'

const me = async ({commit}) => {
  const result = await api.me();
  commit("STORE_ME", result)
}
const login = async (context, object) => {
  const result = await api.login(object);
  context.commit("STORE_ME", result)
}
const adicionar = async (context, object) => {
  return await api.adicionar(object);
}

const listAllUser = async (context) => {
  const result =  await api.listAllUser();
  context.commit("STORE_ALL_USERS", result)
}

const getPerfil = async ({commit}) => {
 const result = await api.getPerfil()
  commit('STORE_GET_PERFIS', result)
}
const getAcoes = async ({commit}) => {
 const result = await api.getAcoes()
  commit('STORE_GET_ACOES', result)
}
const getSetor = async ({commit}) => {
 const result = await api.getSetor()
  commit('STORE_GET_SETOR', result)
}
const getUser = async ({commit}, id) => {
 const result = await api.getUser(id)
  commit('STORE_GET_USER', result)
}
const getFuncionalidade = async ({commit}) => {
 const result = await api.getFuncionalidade()
  commit('STORE_GET_FUNCIONALIDADE', result)
}

const updatePerfil = async (context, object) => {
  const result = await api.updatePerfil(object)
  return result
  // context.commit("STORE_ME", result)
}
const excluir = async (context, id) => {
  const result = await api.excluir(id)
  return result
}

export default {
  me,
  getPerfil,
  updatePerfil,
  listAllUser,
  login,
  adicionar,
  excluir,
  getAcoes,
  getSetor,
  getFuncionalidade,
  getUser,
}
