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
const register = async (context, object) => {
  return await api.register(object);
}

const logout = async ({commit}) => {
  await api.logout()
  commit('STORE_ME_LOGOUT')
}

const updatePerfil = async (context, object) => {
  const result = await api.updatePerfil(object)
  return result
  // context.commit("STORE_ME", result)
}

export default {
  me,
  logout,
  updatePerfil,
  login,
  register,
}
