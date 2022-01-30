import api from '../_api'

const index = async (context,params) => {
  return  await api.index(params);
}

export default {
  index,
}
