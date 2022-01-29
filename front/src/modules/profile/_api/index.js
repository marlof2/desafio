import Api from "@/api";
const route = "profiles";


const getAllProfile = async (params) => {
  const result = await Api.get(`/${route}`);
  return result.data;
};

export default {
  getAllProfile
};
