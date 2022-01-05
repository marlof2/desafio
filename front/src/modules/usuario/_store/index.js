import mutations from './mutations';
import actions from './actions';
import getters from './getters';

const state = {
  users: [],
  user:[],
  perfis:[],
  acoes:[],
  setor:[],
  funcionalidades:[],
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
