<template>
  <div id="app">
    <router-view/>
  </div>
</template>
<script>
import API from './store/base/index'
import events from './router/events'
export default {
  mixins: [events],
  created(){
    this.setHeaders()
  },
  mounted(){
    this.setHeaders()
  },
  watch: {
    $route: 'setHeaders'
  },
  methods: {
    async setHeaders(){
      if(localStorage.getItem('isAdmin')){
        await this.$store.dispatch('auth/checkUser')
      }
      else {
       await this.$store.dispatch('auth/checkAuthUser')
          API.get("/auth/user/permission").then((response) => {
            this.$ability.update([{ subject: "all", action: response.data }]);
            });
      }
      // const bearer_token = localStorage.getItem('auth') || ''
      // API.defaults.headers.common['Authorization'] = `Bearer ${bearer_token}`
    }
  }
}
</script>