<template>
  <div>
    <nav id="navbar" v-if="!isLoading">
      <input type="checkbox" id="nav" class="hidden">
      <label for="nav" class="nav-btn">
        <i></i>
        <i></i>
        <i></i>
      </label>
      <div class="nav-wrapper">
        <ul>
          <li><router-link to="/home/human-resources/applicants/allapplicants" ><span class="title">All Applicants</span></router-link></li>
          <li><router-link to="/home/human-resources/applicants/initialscreening"><span class="title">Initial Screening</span></router-link></li>
          <li><router-link to="/home/human-resources/applicants/interview"><span class="title">Interview</span></router-link></li>
          <li><router-link to="/home/human-resources/applicants/finalscreening"><span class="title">Final Screening</span></router-link></li>
          <li><router-link to="/home/human-resources/applicants/onboarding"><span class="title">Onboarding</span></router-link></li>
          <li><router-link to="/home/human-resources/applicants/rejected"><span class="title">Failed</span></router-link></li>
          <li><router-link to="/home/human-resources/applicants/blacklist"><span class="title">Blacklist</span></router-link></li>
        </ul>
      </div>
    </nav>
  </div>
</template>
<script>
import {mapActions, mapState} from 'vuex'
export default {
  async mounted(){
    this.isLoading = true
   await this.checkAuthUser();
    this.isLoading = false
  },
 computed: {
  ...mapState('auth', ['user']),
 },
 methods: {
   ...mapActions('auth', ['checkAuthUser']),
  getRoute: function(){
    return this.$route.path
  }
 }
}
</script>