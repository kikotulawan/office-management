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
  mounted() {
    this.sideBarMobile()
  },
  methods: {
   sideBarMobile(){
    //  let sidebar = document.getElementById('admin-sidenav')
    //  let sidebarBtn = document.getElementById('navbtn')
    //  let closeNavBtn = document.getElementById('close-nav')

    //  sidebarBtn.addEventListener('click', function(){
    //    sidebar.classList.add('sidenav-active')

    //  })

    //  closeNavBtn.addEventListener('click', function(){
    //   sidebar.classList.remove('sidenav-active')
    //  })
   },
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