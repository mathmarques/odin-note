<template>
  <div class="DashboardHome" v-if="!isLoading">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Dashboard</h1>
    </div>
    <p>Olá {{getMeFirstName}}!</p> Selecione o caderno que deseja acessar!
    <table class="table">
      <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Curso</th>
        <th scope="col">Ação</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="notebook in notebooks" :key="notebook._id">
        <td>{{notebook.name}}</td>
        <td>-</td>
        <td><router-link :to="{name: 'notebook', params: {notebookId: notebook._id}}" class="nav-link"><i class="fas fa-caret-right"></i> Abrir</router-link></td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  import notebookService from '../../common/services/notebook'
  import {COMPONENT_LOADING, COMPONENT_LOADED} from '../../vuex/mutation-types'

  import { mapGetters } from 'vuex'

export default {
  name: 'DashboardHome',
  data () {
    return {
      notebooks: [],
      form: {
        name: undefined
      }
    }
  },

  methods: {
    fetchNotebooks () {
      this.$store.commit(COMPONENT_LOADING)
      notebookService.fetchAll().then(response => {
        this.notebooks = response.notebooks
      }).catch(error => {
        console.log(error);
      }).then(() => {
        this.$store.commit(COMPONENT_LOADED)
      })
    }
  },

  created () {
    this.fetchNotebooks()
  },

  computed: {
    ...mapGetters([
      'getMeFirstName'
    ]),

    isLoading () {
      return this.$store.state.isLoading
    }
  }
}
</script>

<style scoped>
</style>
