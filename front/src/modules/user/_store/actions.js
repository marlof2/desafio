import api from '../_api'

const save = async (context, object) => {
  return await api.save(object);
}

const update = async (context, object) => {
  return await api.update(object);
}

const getAllUsers = async (context,params) => {
  const result =  await api.getAllUsers(params);
  context.commit("STORE_ALL_USERS", result)
}

const getUserById = async (context, id) => {
  const result =  await api.getUserById(id);
  context.commit("STORE_USER_BY_ID", result)
}

const excluir = async (context, id) => {
  return await api.excluir(id);
}

export default {
  save,
  update,
  getAllUsers,
  getUserById,
  excluir
}
