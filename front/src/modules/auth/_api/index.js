import Api from "@/api";
const route = "auth";
// import Jwt from '../../../api/jwt'

const register = async body => {
  const result = await Api.post(`/${route}/register`, body);
  return result.data;
};

const updateUser = async body =>{
  const result = await Api.post(`/${route}/update`, body);
  return result.data;
}

const me = async () => {
  const result = await Api.get(`/${route}/me`);
  return result.data;
};
const userAuth = async () => {
  const result = await Api.get(`/${route}/userAuth`);
  return result.data;
};

const login = async body => {
  const result = await Api.post(`${route}/login`, body);
  return result.data;
};


const logout = async () => {
  const result = await Api.get(`${route}/logout`);
  return result.data;
};


export default {
  register,
  me,
  userAuth,
  login,
  logout,
  updateUser
};
