<template>
  <div id="app">
    <router-view/>
  </div>
</template>
<script>
import API from './store/base/index'
export default {
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
        console.log('not admin')
      }
      // const bearer_token = localStorage.getItem('auth') || ''
      // API.defaults.headers.common['Authorization'] = `Bearer ${bearer_token}`
    }
  }
}
</script>