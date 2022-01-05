import mutations from './mutations';
import actions from './actions';
import getters from './getters';

const state = {
  clientes: [],
  cliente: [],
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
