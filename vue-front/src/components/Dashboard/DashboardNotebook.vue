<template>
  <div class="DashboardNotebook" v-if="!isLoading">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Notebook</h1>
    </div>
      <p>Selecione uma anotação no menu lateral.</p>
  </div>
</template>

<script>
  import notebookService from '../../common/services/notebook'
  import {COMPONENT_LOADING, COMPONENT_LOADED} from '../../vuex/mutation-types'

  export default {
    name: 'DashboardHome',
    data () {
      return {
        note: undefined,
      }
    },

    methods: {
      fetchNote (noteId, notebookId) {
        this.$store.commit(COMPONENT_LOADING)
        notebookService.getNote(notebookId, noteId).then(response => {
          this.note = response.note
        }).catch(error => {
          console.log(error);
        }).then(() => {
          this.$store.commit(COMPONENT_LOADED)
        })
      }
    },

    created () {
      if(this.$store.state.route.params.noteId)
        this.fetchNotebooks(this.$store.state.route.params.noteId, this.$store.state.route.params.notebookId)
    },

    computed: {
      isLoading () {
        return this.$store.state.isLoading
      }
    },

    watch: {
      '$store.state.route.params.noteId' (to, from) {
        this.fetchNotebooks(to, this.$store.state.route.params.notebookId)
      }
    },
  }
</script>

<style scoped>
</style>
