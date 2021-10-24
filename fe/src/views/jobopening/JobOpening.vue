<template>
    <div class="">
       <nav class="job-navigation" :class="scrollpx >= 40 ? 'nav-scrolled' : ''">
           <h5 class="brandname">e-Office</h5>
           <div>
               <ul>
                   <li v-if="!user">
                       <router-link  class="job-login-btn text-light me-3" to="/jobs/applicant/login">Login Account</router-link>
                       <router-link class="job-login-btn text-light" to="/jobs/applicant/login">Register</router-link>
                   </li>
                   <li v-else>
                       <router-link class="me-3" to="/jobs">Job Vacancies</router-link>
                       <router-link class="me-3" to="/applicant/home/appliedjobs"
              >Application Status</router-link
            >
                       <router-link class="me-3" to="/applicant/home/profile">Profile</router-link>
                       <a class="job-login-btn text-light me-3" href="" v-on:click.prevent="$bvModal.show('logoutModal')">Logout</a>
                   </li>
               </ul>
           </div>
       </nav>
       <section class="container" style="height: 100vh;">
           <div class="row h-100 mb-4 align-items-center flex-column-reverse flex-sm-column-reverse flex-md-column-reverse flex-lg-row">
               <div class="col-10 col-md-7 col-lg-6">
                   <h1 class="job-hiring-heading">Work with Us! </h1>
                   <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ad, veniam distinctio possimus voluptatibus sit hic et asperiores pariatur, vitae quos rerum.</p>
                   <div class="mt-5"> 
                    <small><i class="bi bi-arrow-down"></i> Scroll down to see available jobs</small>
                   </div>
               </div>
               <div class="col-10 col-md-7 col-lg-6 position-relative">
                   <img class="job-hiring-image img-fluid" src="@/assets/images/undraw_interview.svg" alt="" >
               </div>
           </div>
       </section>
       <section class="container">
           <h4 class="text-center text-uppercase mt-3">Available Jobs</h4>
           <p class="text-center">There are {{jobs.total}} total of jobs available</p>
           <div class="row mt-4 mb-5">
               <div v-for="(job, i) in jobs.data" :key="i" class="col-10 col-sm-10 col-md-6 col-lg-6">
                   <div class="card border-job p-4 mt-3 mb-5">
                       <h5>{{job.job_title}}</h5>
                       <small>Posted on: {{job.created_at | moment}}</small>
                       <small>Salary: Php {{ job.job_salary_from }}k - {{ job.job_salary_to }}k</small>
                       <small class="mt-3 fw-bold">Qualification: <span class="fw-normal" v-html="job.job_min_qualification"></span></small>
                       <small class="mt-3"><span class="text-danger">Apply Until: </span>{{job.job_opening_expiration | moment}}</small>
                       <div class="d-block mt-4">
                        <button class="btn btn-primary btn-sm me-3" @click="setViewJob(job)">More Details</button>
                        <button class="btn btn-primary btn-sm" v-on:click.prevent="applyJob(job.id)">Apply Now</button>
                       </div>
                   </div>
               </div>
               <div class="row mt-3" v-if="jobs.data">
                    <pagination :showDisabled="true" :align="'right'" :data="jobs" @pagination-change-page="getJobs">
                        <span slot="prev-nav">&laquo;</span>
                        <span slot="next-nav">&raquo;</span>
                    </pagination>
               </div>
           </div>
       </section>

       
        <b-modal id="logoutModal" centered title="Logout">
            <p class="my-4">Are you sure you want to log-out?</p>
            <template #modal-footer = {cancel} >
            <b-button variant="primary" size="sm" @click="cancel()"> Cancel </b-button>
            <b-button size="sm" variant="danger" v-on:click.prevent="logout">
                Logout
            </b-button>
            </template>
        </b-modal>
    </div>
</template>
<script>
import { mapActions, mapState } from 'vuex'
import moment from 'moment'
export default {
    data(){
        return {
            isLoading: false,
            scrollpx: 0,
            data: {
                job_title: '',
                salary: ''
            },
            sort: 'asc',
            modalId: '',
        }
    },
    created() {
    window.addEventListener('scroll', this.handleScroll);
    },
    destroyed() {
        window.removeEventListener('scroll', this.handleScroll);
    },
    filters: {
        moment: function (date) {
            return moment(date).format('MMMM D, YYYY');
        }
    },
    async mounted() {
        document.title = 'eOffice - Job Opening'
        await this.$store.dispatch('auth/checkAuthUser')
        await this.$store.dispatch('jobopening/getJobs', {page: 1, sort: this.sort})
    },
    computed: {
        ...mapState('jobopening', ['jobs']),
        ...mapState('auth', ['user']),
    },
    methods: {
        ...mapActions('auth', ['logoutAuthUser']),
        handleScroll() {
            this.scrollpx = window.scrollY;
        },
        async logout(){
            this.isLoading = true
            const res = await this.logoutAuthUser()
            if(res.status == 200){
                this.$router.push('/jobs/applicant/login')
                this.$toast.info('Logged out')
                this.isLoading = false
            }
            else if (res.status == 401){
                this.$store.commit('auth/UNSET_USER')
                this.$router.push('/')
                this.$toast.error('You are not authorized!')
                this.isLoading = false
            }
            this.isLoading = false
        },
       async getJobs(page = 1){
         await this.$store.dispatch('jobopening/getJobs', {page: page, sort: this.sort})
       },
       setViewJob(data) {
        this.$store.commit('jobopening/SET_VIEW_JOB', { data: data });
        this.$router.push({ name: 'viewjob', params: { slug: data.id } });
        },
       async applyJob(id){

           const job_data = {
               job_opening_id: id
           }

           if(localStorage.getItem('isAdmin')){
               const { status } = await this.$store.dispatch('auth/logoutUser')
               if(status == 200){
                   this.$router.push('/jobs/applicant/login')
               }
               else {
                   this.$toast.error('Something went wrong')
               }
           }
           else if(localStorage.getItem('isApplicant')){
              const {status, data} = await this.$store.dispatch('applicant/applyJob', job_data)
              if(status == 200){
                  this.$toast.success('Application successful!');
              }
              else {
                  this.$toast.error(data.msg);
              }
           }
           else{
               this.$toast.success('You must login first')
               this.$router.push('/jobs/applicant/login')
           }
       }
    },
    watch: {
        sort(){
            this.getJobs()
        }
    }
}
</script>
<style>
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
    padding: .5rem 1rem;
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
    border-left: 4px solid rgb(30, 110, 201) !important;
}


</style>