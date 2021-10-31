<template>
  <div>
    <nav id="navbar">
      <input type="checkbox" id="nav" class="hidden">
      <label for="nav" class="nav-btn">
        <i></i>
        <i></i>
        <i></i>
      </label>
      <div class="nav-wrapper">
        <ul>
          <li><router-link to="/home/human-resources/branches"><span class="title">Branches</span></router-link>
          <li><router-link to="/home/human-resources/departments" ><span class="title">Departments</span></router-link></li>
          <li><router-link to="/home/human-resources/positions"><span class="title">Positions</span></router-link></li>
          <li><router-link to="/home/human-resources/employees"><span class="title">Employees</span></router-link></li>
          <li><router-link to="/home/human-resources/applicants"><span class="title">Applicants</span></router-link></li>
          <li><router-link to="/home/human-resources/jobopening"><span class="title">Job Opening</span></router-link></li>
          <li><router-link to="/home/human-resources/holidays"><span class="title">Holidays</span></router-link></li>
          <li><router-link to="/home/human-resources/breaks"><span class="title">Breaks</span></router-link></li>
          <li><router-link to="/home/human-resources/memos"><span class="title">Memos</span></router-link></li>
          <li><router-link to="/home/human-resources/policies"><span class="title">Policies</span></router-link></li>
          <li><router-link to="/home/human-resources/pay-periods"><span class="title">Pay Periods</span></router-link></li>
          <li><router-link to="/home/human-resources/leaves"><span class="title">Leaves</span></router-link></li>
        </ul>
      </div>
    </nav>
  </div>
</template>
<script>
import {mapActions, mapState} from 'vuex'
export default {
  async mounted(){
   await this.checkAuthUser();
  },
 computed: {
  ...mapState('auth', ['user']),
  
 },
 methods: {
   ...mapActions('auth', ['checkAuthUser']),
   getRoute(el){

  }
 }
}
</script>