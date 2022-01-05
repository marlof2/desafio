import Api from "@/api";
const route = "setor";
// import Jwt from '../../../api/jwt'

const save = async body => {
  const result = await Api.post(`/${route}/store`, body);
  return result.data;
};
const update = async body => {
  const result = await Api.put(`/${route}/update`, body.id ,body);
  return result.data;
};

const getAllSetor = async () => {
  const result = await Api.get(`/${route}/index`);
  return result.data;
};

const getSetorById = async id => {
  const result = await Api.get(`/${route}/getSetor/${id}`);
  return result.data;
};

const excluir = async id => {
  const result = await Api.delete(`/${route}/delete`, id);
  return result.data;
};


export default {
  save,
  update,
  getAllSetor,
  getSetorById,
  excluir,
};
