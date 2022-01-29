import mutations from './mutations';
import actions from './actions';
import getters from './getters';

const state = {
  actions: [],
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
