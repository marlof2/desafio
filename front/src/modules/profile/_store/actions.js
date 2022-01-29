import api from '../_api'

const getAllProfile = async (context) => {
  const result =  await api.getAllProfile();
  context.commit("STORE_ALL_PROFILE", result)
}

export default {
  getAllProfile,
}
