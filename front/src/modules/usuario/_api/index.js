import Api from "@/api";
const route = "users";
// import Jwt from '../../../api/jwt'

const adicionar = async body => {
  const result = await Api.post(`/${route}/adicionar`, body);
  return result.data;
};

const updateUser = async body =>{
  const result = await Api.post(`/${route}/update`, body);
  return result.data;
}

const listAllUser = async () => {
  const result = await Api.get(`/${route}/listAllUser`);
  return result.data;
};

const login = async body => {
  const result = await Api.post(`${route}/login`, body);
  return result.data;
};

const passwordReset = async body => {
  const result = await Api.post(`v1/${route}/password-reset`, body);
  return result.data;
};

const getPerfil = async () => {
  const result = await Api.get(`/perfil`);
  return result.data;
};
const getAcoes = async () => {
  const result = await Api.get(`/acao`);
  return result.data;
};
const getSetor = async () => {
  const result = await Api.get(`/setor`);
  return result.data;
};
const getFuncionalidade = async () => {
  const result = await Api.get(`/funcionalidade`);
  return result.data;
};
const getUser = async  id => {
  const result = await Api.get(`/${route}/getUser/${id}`);
  return result.data;
};


export default {
  adicionar,
  listAllUser,
  login,
  passwordReset,
  getPerfil,
  updateUser,
  getAcoes,
  getSetor,
  getFuncionalidade,
  getUser,
};
