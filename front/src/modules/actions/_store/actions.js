import api from '../_api'


const getAllActions = async (context) => {
  const result =  await api.getAllActions();
  context.commit("STORE_ALL_ACTIONS", result)
}


export default {
  getAllActions,
}
