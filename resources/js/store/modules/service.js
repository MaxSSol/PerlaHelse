export default {
  namespaced: true,
  state: {
    error: false,
    types: {},
  },
  getters: {
    getErrorStatus: state => state.error,
    getServiceTypes: state => state.types,
    getServiceByType: state => type => state.types.filter(t => t.Ref === type),
  },
  mutations: {
    SET_ERROR(state, error) {
      state.error = error;
    },

    SET_TYPES(state, types) {
      state.types = types;
    },
  },
  actions: {
    fetchServiceTypes({ commit }) {
      // eslint-disable-next-line no-undef
      axios.get('/api/service/types')
        .then(res => commit('SET_TYPES', res.data.data))
        .catch(() => commit('SET_ERROR', true));
    },
  },
};
