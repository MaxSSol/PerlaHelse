export default {
  namespaced: true,
  state: {
    error: false,
    result: {},
    isSuccess: false,
  },
  getters: {
    getErrorStatus: state => state.error,
    getResult: state => state.result,
    getIsSuccess: state => state.isSuccess,
  },
  mutations: {
    SET_ERROR(state, error) {
      state.error = error;
    },

    SET_RESULT(state, result) {
      state.result = result;
    },

    SET_IS_SUCCESS(state, status) {
      state.isSuccess = status;
    },
  },
  actions: {
    fetchDocumentPrice({ commit }, params) {
      console.log(params);
      // eslint-disable-next-line no-undef
      axios.get('/api/document/price', {
        params: params,
      })
        .then(res => {
          commit('SET_RESULT', res.data.data);
          commit('SET_IS_SUCCESS', true);
        })
        .catch(() => commit('SET_ERROR', true));
    },
  },
};
