export default {
  namespaced: true,
  state: {
    city: {},
    cities: {},
    error: false,
  },
  getters: {
    getCity: state => state.city,
    getCities: state => state.cities,
    getErrorStatus: state => state.error,
    getCityByString: state => city => state.city.filter(c => c.Description === city),
  },
  mutations: {
    SET_CITY(state, city) {
      state.city = city;
    },

    SET_CITIES(state, cities) {
      state.cities = cities;
    },

    SET_ERROR(state, error) {
      state.error = error;
    },
  },
  actions: {
    fetchCities({ commit }) {
      // eslint-disable-next-line no-undef
      axios.get('/api/cities')
        .then(res => commit('SET_CITIES', res.data.data))
        .catch(() => commit('SET_ERROR', true));
    },

    fetchCity({ commit }, city) {
      // eslint-disable-next-line no-undef
      axios.get('/api/cities', {
        params: {
          'city': city,
        },
      })
        .then(res => commit('SET_CITY', res.data.data))
        .catch(() => commit('SET_ERROR', true));
    },
  },
};
