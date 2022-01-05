import api from '../_api'
// import Jwt from '../../../api/jwt'

const save = async (context, object) => {
  return await api.save(object);
}

const update = async (context, object) => {
  return await api.update(object);
}

const getAllSetor = async (context) => {
  const result =  await api.getAllSetor();
  context.commit("STORE_ALL_SETOR", result)
}

const getSetorById = async (context, id) => {
  const result =  await api.getSetorById(id);
  context.commit("STORE_SETOR_BY_ID", result)
}

const excluir = async (context, id) => {
  return await api.excluir(id);
}

export default {
  save,
  update,
  getAllSetor,
  getSetorById,
  excluir
}
