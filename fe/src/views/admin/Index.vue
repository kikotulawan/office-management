<template>
  <div class="admin">
   <Sidenav />
   <Navbar />
   <div class="main-content">
     <router-view name="dashboard"/>
     <router-view name="humanresources"/>
   </div>
  </div>
</template>
<script>
import Sidenav from '../components/admin/Sidebar.vue'
import Navbar from '../components/admin/Navbar.vue'
export default {
  components: {Sidenav, Navbar},
  async mounted() {
    await this.$store.dispatch('auth/checkAuthUser')
  },
  methods: {
  },
  computed: {
    getRoute: function(){
      return this.$route.path
    }
  },
  watch: {
    getRoute(){
       let sidebar = document.getElementById('admin-sidenav')
       sidebar.classList.remove('sidenav-active')
    }
  }

}
</script>