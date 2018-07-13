/* globals localStorage */
import _ from 'lodash'
import authService from '../../common/services/auth'

import {AUTHENTICATE, AUTHENTICATE_FAILURE, AUTH_FETCHED, AUTH_LOGGED_OUT} from '../mutation-types'

const state = {
  me: undefined,
  error: undefined
}

const mutations = {
  [AUTHENTICATE] (state, data) {
    state.me = data.user
  },

  [AUTHENTICATE_FAILURE] (state, data) {
    state.error = data.message
  },

  [AUTH_FETCHED] (state, data) {
    state.me = data.me
  },

  [AUTH_LOGGED_OUT] (state) {
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
      } else {
        authService.me().then(response => {
          console.log(response);
          commit(AUTH_FETCHED, response)
          resolve()
        }).catch(error => {
          console.log(error);
          reject(error)
        })
      }
    })
  }
}

const getters = {
  getMeFirstName: state => {
    return state.me ? _.words(state.me.usuario)[0] : ''
  }
}

export default {
  state,
  mutations,
  actions,
  getters
}
