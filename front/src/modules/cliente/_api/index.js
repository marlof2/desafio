import Api from "@/api";
const route = "cliente";
// import Jwt from '../../../api/jwt'

const save = async body => {
  const result = await Api.post(`/${route}/store`, body);
  return result.data;
};
const update = async body => {
  const result = await Api.put(`/${route}/update`, body.id ,body);
  return result.data;
};

const getAllCliente = async () => {
  const result = await Api.get(`/${route}/index`);
  return result.data.cliente;
};

const getClienteById = async id => {
  const result = await Api.get(`/${route}/clienteById/${id}`);
  return result.data;
};

const excluir = async id => {
  const result = await Api.delete(`/${route}/delete`, id);
  return result.data;
};


export default {
  save,
  update,
  getAllCliente,
  getClienteById,
  excluir,
};
