export default {
  namespaced: true,
  state: {
    error: false,
    types: {},
  },
  getters: {
    getCargoTypes: state => state.types,
    getErrorStatus: state => state.error,
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
    fetchCargoTypes({ commit }) {
      // eslint-disable-next-line no-undef
      axios.get('/api/cargo/types')
        .then(res => commit('SET_TYPES', res.data.data))
        .catch(() => commit('SET_ERROR', true));
    },
  },
};
