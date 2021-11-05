<template>
 <div>
  <nav class="job-navigation" :class="scrollpx >= 40 ? 'nav-scrolled' : ''">
   <h5 class="brandname">e-Office</h5>
   <div>
    <ul>
     <li v-if="!user">
      <router-link class="job-login-btn text-light me-3" to="/jobs/applicant/login">Login Account</router-link>
      <router-link class="job-login-btn text-light" to="/jobs/applicant/login">Register</router-link>
     </li>
     <li v-else>
      <router-link class="me-3" to="/jobs">Job Vacancies</router-link>
      <router-link class="me-3" to="/applicant/home/appliedjobs">Application Status</router-link>
      <router-link class="me-3" to="/applicant/home/profile">Profile</router-link>
      <a class="job-login-btn text-light me-3" href="" v-on:click.prevent="$bvModal.show('logoutModal')">Logout</a>
     </li>
    </ul>
   </div>
  </nav>
  <div class="container vh-100 d-flex align-items-center">
   <div class="row pt-4 mb-5">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
     <div class="card border-job p-5 mt-3 mb-5">
      <h3>{{ data.job_title }}</h3>
      <p>Posted on: {{ data.created_at | moment }}</p>
      <p>Salary: Php {{ data.job_salary_from }}k - {{ data.job_salary_to }}k</p>
      <p class="mt-3 fw-bold">
       Description:
       <br />
       <span class="fw-normal" v-html="data.job_description"></span>
      </p>
      <p class="mt-3 fw-bold">
       Qualification:
       <span class="fw-normal" v-html="data.job_min_qualification"></span>
      </p>
      <p class="mt-3 fw-bold">
       Minimum Experience:
       <span class="fw-normal" v-html="data.job_min_experience"></span>
      </p>
      <p class="mt-3 fw-bold">
       Requirements:
       <br />
       <span class="fw-normal" v-html="data.job_requirements"></span>
      </p>
      <p class="mt-3 fw-bold">Job Type: <br /><span class="fw-normal" v-html="data.job_type"></span></p>
      <p class="mt-3 fw-bold">Job Work Location: <br /><span class="fw-normal" v-html="data.job_work_location"></span></p>
      <p class="mt-3"><span class="text-danger">Apply Until: </span>{{ data.job_opening_expiration | moment }}</p>
      <div class="d-block mt-4">
       <button class="btn btn-primary btn-sm" v-on:click.prevent="applyJob(data.id)">
        Apply Now
       </button>
      </div>
     </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-5 p-5">
     <img class="job-hiring-image img-fluid" src="@/assets/images/2.svg" alt="" />
    </div>
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
 import moment from 'moment';
 export default {
  data() {
   return {
    isLoading: false,
    scrollpx: 0,
    data: {
     job_title: '',
     job_type: '',
     job_work_location: '',
     job_description: '',
     job_requirements: '',
     job_min_experience: '',
     created_at: '',
     job_salary_from: '',
     job_salary_to: '',
     job_min_qualification: '',
     job_opening_expiration: '',
    },
    sort: 'asc',
    modalId: '',
   };
  },
  filters: {
   moment: function(date) {
    return moment(date).format('MMMM D, YYYY');
   },
  },
  async mounted() {
   await this.$store.dispatch('auth/checkAuthUser'),
    (this.data = {
     id: this.view_job.id,
     job_title: this.view_job.job_title,
     job_type: this.view_job.job_type,
     job_work_location: this.view_job.job_work_location,
     job_description: this.view_job.job_description,
     job_requirements: this.view_job.job_requirements,
     job_min_experience: this.view_job.job_min_experience,
     job_salary_from: this.view_job.job_salary_from,
     created_at: this.view_job.created_at,
     job_salary_to: this.view_job.job_salary_to,
     job_min_qualification: this.view_job.job_min_qualification,
     job_opening_expiration: this.view_job.job_opening_expiration,
    });
  },
  created() {
   window.addEventListener('scroll', this.handleScroll);
  },
  destroyed() {
   window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
   ...mapActions('auth', ['logoutAuthUser']),
   async logout() {
    this.isLoading = true;
    const res = await this.logoutAuthUser();
    if (res.status == 200) {
     this.$router.push('/jobs/applicant/login');
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
   async applyJob(id) {
    const job_data = {
     job_opening_id: id,
    };

    // if (localStorage.getItem("isAdmin")) {
    //   const { status } = await this.$store.dispatch("auth/logoutUser");
    //   if (status == 200) {
    //     this.$router.push("/jobs/applicant/login");
    //   } else {
    //     this.$toast.error("Something went wrong");
    //   }
    // }
    if (localStorage.getItem('isUser')) {
     const { status, data } = await this.$store.dispatch('applicant/applyJob', job_data);
     if (status == 200) {
      this.$toast.success('Application successful!');
     } else {
      this.$toast.error(data.msg);
     }
    } else {
     this.$toast.success('You must login first');
     this.$router.push('/jobs/applicant/login');
    }
   },
  },
  computed: {
   ...mapState('jobopening', ['view_job']),
   ...mapState('auth', ['user']),
  },
 };
</script>
<style scoped>
 nav.job-navigation {
  height: 100px;
  width: 100%;
  position: relative;
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

 .job-hiring-heading {
  font-size: 4rem;
  font-weight: 600;
 }

 .border-job {
  border-left: 8px solid rgb(30, 110, 201) !important;
 }
</style>
