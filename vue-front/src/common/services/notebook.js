import Vue from 'vue'

export default {
  fetchAll (config = {}) {
    return Vue.axios.get(`/api/notebook`, config)
      .then((response) => Promise.resolve(response.data))
      .catch((error) => Promise.reject(error))
  },

  get (notebookId, config = {}) {
    return Vue.axios.get(`/api/notebook/${notebookId}`, config)
      .then((response) => Promise.resolve(response.data))
      .catch((error) => Promise.reject(error))
  },

  getNote (notebookId, noteId, config = {}) {
    return Vue.axios.get(`/api/notebook/${notebookId}/note/${noteId}`, config)
      .then((response) => Promise.resolve(response.data))
      .catch((error) => Promise.reject(error))
  },

  addNote (notebookId, payload, config = {}) {
    return Vue.axios.post(`/api/notebook/${notebookId}/`, payload, config)
      .then((response) => Promise.resolve(response.data))
      .catch((error) => Promise.reject(error))
  }
}
