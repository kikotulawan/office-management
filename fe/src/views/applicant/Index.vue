<template>
 <div class="applicant">
  <nav class="job-navigation" :class="scrollpx >= 40 ? 'nav-scrolled' : ''">
   <h5 class="brandname">e-Office</h5>
   <div>
    <ul>
     <li>
      <router-link class="me-3" to="/jobs">Job Vacancies</router-link>
      <router-link class="me-3" to="/applicant/home/appliedjobs">Application Status</router-link>
      <router-link class="me-3" to="/applicant/home/profile">Profile</router-link>
      <a class="job-login-btn text-light me-3" href="" v-on:click.prevent="$bvModal.show('logoutModal')">Logout</a>
     </li>
    </ul>
   </div>
  </nav>
  <div class="main-content">
   <router-view name="profile" />
   <router-view name="appliedjobs" />
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
 export default {
  data() {
   return {
    isLoading: false,
    scrollpx: 0,
   };
  },
  created() {
   window.addEventListener('scroll', this.handleScroll);
  },
  destroyed() {
   window.removeEventListener('scroll', this.handleScroll);
  },
  async mounted() {
   await this.$store.dispatch('auth/checkAuthUser');
  },
  methods: {
   ...mapActions('auth', ['logoutAuthUser']),
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
   handleScroll() {
    this.scrollpx = window.scrollY;
   },
  },
 };
</script>
<style scoped>
 nav.job-navigation {
  height: 100px;
  width: 100%;
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  justify-content: space-between;
  padding: 3rem 8rem;
 }
 .nav-scrolled {
  position: fixed !important;
  height: 40px;
  background: white;
  margin-top: 0;
  padding: 2rem 4rem !important;
  box-shadow: 0px 0px 4px rgba(43, 43, 43, 0.295);
  z-index: 10 !important;
  top: 0;
  right: 0;
  transition: all 250ms;
 }
 .brandname {
  font-size: 1.5rem;
  font-weight: 600;
 }
 .job-login-btn {
  padding: 0.5rem 1rem;
  background-color: rgb(34, 123, 224);
  color: white;
  border-radius: 20px;
 }

 .job-login-btn:hover {
  border: none !important;
  background-color: rgb(30, 110, 201);
  color: rgb(228, 228, 228);
 }

 .job-login-btn::after {
  background: transparent !important;
 }
</style>
