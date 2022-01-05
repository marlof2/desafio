import mutations from './mutations';
import actions from './actions';
import getters from './getters';

const state = {
  setores: [],
  setor: [],
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
