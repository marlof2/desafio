import Api from "@/api";
const route = "actions";


const getAllActions = async (params) => {
  const result = await Api.get(`/${route}`);
  return result.data;
};

export default {
  getAllActions
};
