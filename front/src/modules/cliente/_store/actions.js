import api from '../_api'
// import Jwt from '../../../api/jwt'

const save = async (context, object) => {
  return await api.save(object);
}

const update = async (context, object) => {
  return await api.update(object);
}

const getAllCliente = async (context) => {
  const result =  await api.getAllCliente();
  context.commit("STORE_ALL_CLIENTE", result)
}

const getClienteById = async (context, id) => {
  const result =  await api.getClienteById(id);
  context.commit("STORE_CLIENTE_BY_ID", result)
}

const excluir = async (context, id) => {
  return await api.excluir(id);
}

export default {
  save,
  update,
  getAllCliente,
  getClienteById,
  excluir
}
