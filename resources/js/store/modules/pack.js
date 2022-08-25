export default {
  namespaced: true,
  state: {
    error: false,
    types: {},
  },
  getters: {
    getPackTypes: state => state.types,
    getErrorStatus: state => state.error,
  },
  mutations: {
    SET_TYPES(state, types) {
      state.types = types;
    },

    SET_ERROR(state, error) {
      state.error = error;
    },
  },
  actions: {
    fetchPackTypes({ commit }) {
      // eslint-disable-next-line no-undef
      axios.get('/api/pack/types')
        .then(res => commit('SET_TYPES', res.data.data))
        .catch(() => commit('SET_ERROR', true));
    },
  },
};
