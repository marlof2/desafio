import Api from "@/api";
const route = "logs";


const index = async (params) => {
  const result = await Api.query(`/${route}`, params);
  return result.data;
};



export default {
  index,
};
