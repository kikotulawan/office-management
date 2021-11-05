<template>
 <div>
  <div class="sidenav" id="admin-sidenav">
   <avatar class="ms-1 mt-4 mb-5 shadow-sm" :username="user.info.first_name + ' ' + user.info.last_name" :src="'http://127.0.0.1:8000/uploads/' + user.info.image" :size="46"></avatar>
   <router-link to="/home/dashboard" :class="getRoute == '/home' ? 'router-link-active' : ''"><i class="bi bi-pie-chart-fill me-2 bi-2x icon"></i><span class="title">Dashboard</span></router-link>
   <router-link v-if="$can('has_branches')" to="/home/human-resources"><i class="bi bi-diagram-3-fill me-2 bi-2x"></i> <span class="title">Branches</span></router-link>
   <router-link v-if="$can('has_permissions')" to="/home/permissions"><i class="bi bi-shield-fill-check me-2 bi-2x"></i> <span class="title">Permissions</span></router-link>
   <!-- <router-link to="/home/sales-and-marketing"><i class="bi bi-graph-up me-2 bi-3x"></i> <span class="title">Sales &amp; Marketing</span></router-link>
      <router-link to="/home/purschasing"><i class="bi bi-cart-fill me-2 bi-3x"></i> <span class="title">Purchasing</span></router-link>
      <router-link to="/home/accounting"><i class="bi bi-credit-card-fill me-2 bi-2x"></i> <span class="title">Accounting</span></router-link>
      <router-link to="/home/work-modules"><i class="bi bi-person-lines-fill me-2 bi-3x"></i> <span class="title">Work Modules</span></router-link>
      <router-link to="/home/corporate-directory"><i class="bi bi-diagram-3-fill me-2 bi-2x"></i><span class="title">Corporate Directory</span></router-link>
      <router-link to="/home/administration"><i class="bi bi-graph-up me-2 bi-3x"></i> <span class="title">Administration</span></router-link>
      <router-link to="/home/project-manager"><i class="bi bi-people-fill me-2 bi-3x"></i> <span class="title">Project Manager</span></router-link> -->
   <router-link v-if="$can('has_employees')" to="/home/human-resources/employees"><i class="bi bi-people-fill me-2 bi-3x"></i> <span class="title">Employees</span></router-link>
   <router-link v-if="$can('has_applicants')" to="/home/human-resources/applicants/allapplicants" :class="getRoute == '/home/human-resources/applicants/' ? 'router-link-active' : ''"
    ><i class="bi bi-person-square me-2 bi-3x"></i> <span class="title">Applicants</span></router-link
   >
   <router-link v-if="$can('has_jobopening')" to="/home/human-resources/jobopening"><i class="bi bi-list-nested me-2 bi-3x"></i> <span class="title">Job Opening</span></router-link>
   <router-link v-if="$can('has_memos')" to="/home/human-resources/memos"><i class="bi bi-journal-bookmark-fill me-2 bi-3x"></i> <span class="title">Memos</span></router-link>
   <router-link v-if="$can('has_departments')" to="/home/human-resources/departments"><i class="bi bi-archive-fill me-2 bi-3x"></i> <span class="title">Departments</span></router-link>
   <router-link v-if="$can('has_policies')" to="/home/human-resources/policies"><i class="bi bi-person-badge-fill me-2 bi-3x"></i> <span class="title">Positions</span></router-link>
   <router-link v-if="$can('has_benefits')" to="/home/human-resources/benefits"><i class="bi bi-exclamation-circle me-2 bi-3x"></i> <span class="title">Benefits</span></router-link>
   <router-link v-if="$can('has_payperiods')" to="/home/human-resources/pay-periods"><i class="bi bi-cash-stack me-2 bi-3x"></i> <span class="title">Pay Periods</span></router-link>

   <div class="logout-btn-div">
    <a href="" v-on:click.prevent="$bvModal.show('logoutModal')" class="mt-5 text-decoration-none logout-btn"> <i class="bi bi-box-arrow-in-right bi-2x logout-btn me-2"></i><span class="title">Logout</span></a>
   </div>
  </div>

  <b-modal id="logoutModal" centered title="Logout">
   <p class="my-4">Are you sure you want to log-out?</p>
   <template #modal-footer="{cancel}">
    <b-button variant="primary" size="sm" @click="cancel()"> Cancel </b-button>
    <b-button size="sm" variant="danger" v-on:click.prevent="logout">
     Logout
    </b-button>
   </template>
  </b-modal>
 </div>
</template>
<script>
 import { mapActions, mapState } from 'vuex';
 import Avatar from 'vue-avatar';
 export default {
  data() {
   return {
    isLoading: false,
   };
  },
  components: {
   Avatar,
  },
  async mounted() {
   await this.checkAuthUser();
  },
  computed: {
   ...mapState('auth', ['user']),
   getRoute: function() {
    return this.$route.path;
   },
  },
  methods: {
   ...mapActions('auth', ['checkAuthUser', 'logoutAuthUser']),
   async logout() {
    this.isLoading = true;
    const res = await this.logoutAuthUser();
    if (res.status == 200) {
     this.$router.push('/');
     this.$toast.info('Logged out');
     this.isLoading = false;
    } else if (res.status == 401) {
     this.$store.commit('auth/UNSET_USER');
     this.$router.push('/');
     this.$toast.error('You are not authorized!');
     this.isLoading = false;
    }
    this.isLoading = false;
   },
  },
 };
</script>
