import Vue from 'vue'

export default {
  me (config = {}) {
    return Vue.axios.get('/api/me', config)
      .then((response) => Promise.resolve(response.data))
      .catch((error) => Promise.reject(error))
  },
  authenticate (payload, config = {}) {
    return Vue.axios.post('/api/auth', payload, config)
      .then((response) => Promise.resolve(response.data))
      .catch((error) => Promise.reject(error))
  }
}
