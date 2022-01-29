import Api from "@/api";
const route = "users";
// import Jwt from '../../../api/jwt'

const save = async body => {
  const result = await Api.post(`/${route}/store`, body);
  return result.data;
};
const update = async body => {
  const result = await Api.put(`/${route}/update`, body.id ,body);
  return result.data;
};

const getAllUsers = async (params) => {
  const result = await Api.query(`/${route}`, params);
  return result.data;
};

const getUserById = async id => {
  const result = await Api.get(`/${route}/show/${id}`);
  return result.data;
};

const excluir = async id => {
  const result = await Api.delete(`/${route}/delete`, id);
  return result.data;
};


export default {
  save,
  update,
  excluir,
  getAllUsers,
  getUserById
};
