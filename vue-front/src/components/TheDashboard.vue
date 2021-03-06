<template>
  <div class="TheDashboard">
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <router-link :to="{ name: 'dashboard' }" class="navbar-brand col-sm-3 col-md-2 mr-0">Odin Note</router-link>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <router-link :to="{ name: 'logout' }" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</router-link>
        </li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar" v-show="!isLoading">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <router-link :to="{ name: 'dashboard' }" class="nav-link"><i class="fas fa-home"></i> Dashboard</router-link>
              </li>
            </ul>
            <template v-if="notebook">
              <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">Anotações</h6>
              <ul class="nav flex-column">
                <li class="nav-item" v-for="note in notes" :key="note._id">
                  <router-link :to="{name: 'note', params: {notebookId: notebook._id, noteId: note._id}}" class="nav-link"><i class="fas fa-caret-right"></i> {{note.name}}</router-link>
                </li>
              </ul>
            </template>
          </div>
        </nav>

        <div id="loading" v-show="isLoading">
          <div class="cube1"></div>
          <div class="cube2"></div>
        </div>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <router-view></router-view>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
  import notebookService from '../common/services/notebook'
  import {COMPONENT_LOADING, COMPONENT_LOADED} from '../vuex/mutation-types'

export default {
  name: 'TheDashboard',

  data () {
    return {
      notes: [],
      notebook: undefined
    }
  },

  methods: {
    fetchNotes (notebookId) {
      this.$store.commit(COMPONENT_LOADING)
      notebookService.get(notebookId).then(response => {
        this.notebook = response.notebook
        this.notes = response.notes
      }).catch(error => {
        console.log(error)
      }).then(() => {
        this.$store.commit(COMPONENT_LOADED)
      })
    }
  },

  created () {
    if(this.$store.state.route.params.notebookId) {
      this.fetchNotes(this.$store.state.route.params.notebookId)
    }
  },

  computed: {
    httpRequestCount () {
      return this.$store.state.httpRequestCount
    },

    isLoading () {
      return this.$store.state.isLoading
    }
  },

  watch: {
    '$store.state.route.params.notebookId' (to, from) {
      if (to)
        this.fetchNotes(to)
      else {
        this.notes = [];
        this.notebook = undefined;
      }
    }
  },

}
</script>

<style scoped>

.TheDashboard{
  background: #ffffff;
  height: 100%;
}

.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 100; /* Behind the navbar */
  padding: 48px 0 0; /* Height of navbar */
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
  font-size: .875rem;

}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: .5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

@supports ((position: -webkit-sticky) or (position: sticky)) {
  .sidebar-sticky {
    position: -webkit-sticky;
    position: sticky;
  }
}

.sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.sidebar .nav-link .fas {
  margin-right: 4px;
  color: #999;
}

.sidebar .nav-link.active {
  color: #007bff;
}

.sidebar .nav-link:hover .fas,
.sidebar .nav-link.active .fas {
  color: inherit;
}

.sidebar-heading {
  font-size: .75rem;
  text-transform: uppercase;
}

[role="main"] {
  padding-top: 48px; /* Space for fixed navbar */
}

.navbar-brand {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: 1rem;
  background-color: rgba(0, 0, 0, .25);
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
}

.navbar {
  padding: .75rem 1rem;
  border-width: 0;
  border-radius: 0;
}

/* Page Loading */
#loading {
  position: absolute;
  left: 50%;
  top: 50%;
  width: 64px;
  height: 64px;
  margin-left: -32px;
  margin-top: -32px;
  z-index: 99999;
}

.cube1, .cube2 {
  background-color: #333;
  width: 20px;
  height: 20px;
  position: absolute;
  top: 0;
  left: 0;

  -webkit-animation: cubemove 1.8s infinite ease-in-out;
  animation: cubemove 1.8s infinite ease-in-out;
}

.cube2 {
  -webkit-animation-delay: -0.9s;
  animation-delay: -0.9s;
}

@-webkit-keyframes cubemove {
  25% {
    -webkit-transform: translateX(42px) rotate(-90deg) scale(0.5)
  }
  50% {
    -webkit-transform: translateX(42px) translateY(42px) rotate(-180deg)
  }
  75% {
    -webkit-transform: translateX(0px) translateY(42px) rotate(-270deg) scale(0.5)
  }
  100% {
    -webkit-transform: rotate(-360deg)
  }
}

@keyframes cubemove {
  25% {
    transform: translateX(42px) rotate(-90deg) scale(0.5);
    -webkit-transform: translateX(42px) rotate(-90deg) scale(0.5);
  }
  50% {
    transform: translateX(42px) translateY(42px) rotate(-179deg);
    -webkit-transform: translateX(42px) translateY(42px) rotate(-179deg);
  }
  50.1% {
    transform: translateX(42px) translateY(42px) rotate(-180deg);
    -webkit-transform: translateX(42px) translateY(42px) rotate(-180deg);
  }
  75% {
    transform: translateX(0px) translateY(42px) rotate(-270deg) scale(0.5);
    -webkit-transform: translateX(0px) translateY(42px) rotate(-270deg) scale(0.5);
  }
  100% {
    transform: rotate(-360deg);
    -webkit-transform: rotate(-360deg);
  }
}

</style>