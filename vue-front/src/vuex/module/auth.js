/* globals localStorage */
import _ from 'lodash'
import authService from '../../common/services/auth'

import {AUTHENTICATE, AUTHENTICATE_FAILURE, AUTH_FETCHED, AUTH_LOGGED_OUT} from '../mutation-types'

const state = {
  token: localStorage.getItem('token'),
  me: undefined,
  error: undefined
}

const mutations = {
  [AUTHENTICATE] (state, data) {
    state.token = data.token
    localStorage.setItem('token', state.token)
    state.me = data.me
  },

  [AUTHENTICATE_FAILURE] (state, data) {
    state.error = data.message
  },

  [AUTH_FETCHED] (state, data) {
    state.me = data.me
  },

  [AUTH_LOGGED_OUT] (state) {
    state.token = undefined
    localStorage.removeItem('token')
    state.me = undefined
  }
}

const actions = {
  authenticate ({commit}, payload) {
    return new Promise((resolve, reject) => {
      authService.authenticate(payload).then(response => {
        commit(AUTHENTICATE, response)
        resolve(response)
      }).catch(error => {
        if (error.response) {
          commit(AUTHENTICATE_FAILURE, error.response.data)
        }
        reject()
      })
    })
  },

  me ({commit, state}) {
    return new Promise((resolve, reject) => {
      if (state.me) {
        resolve()
      } else if (state.token) {
        authService.fetch().then(response => {
          commit(AUTH_FETCHED, response)
          resolve()
        }).catch(error => {
          reject(error)
        })
      } else {
        reject()
      }
    })
  }
}

const getters = {
  getMeFirstName: state => {
    return state.me ? _.words(state.me.nome)[0] : ''
  }
}

export default {
  state,
  mutations,
  actions,
  getters
}
