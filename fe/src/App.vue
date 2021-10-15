<template>
  <div id="app">
    <router-view/>
  </div>
</template>
<script>
import API from './store/base/index'
export default {
  watch: {
    $route: 'setHeaders'
  },
  methods: {
    async setHeaders(){
      const bearer_token = localStorage.getItem('auth') || ''
      API.defaults.headers.common['Authorization'] = `Bearer ${bearer_token}`
    }
  }
}
</script>