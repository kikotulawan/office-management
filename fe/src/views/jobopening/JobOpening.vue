<template>
    <div class="">
       <nav class="job-navigation">
           <h5 class="brandname">e-Office</h5>
           <div>
               <ul>
                   <!-- <li>
                       <a class="" href="">Home</a>
                   </li>
                   <li>
                       <a class="" href="">About</a>
                   </li> -->
                   <li>
                       <router-link class="job-login-btn text-light" to="/jobs/applicant/login">Login Account</router-link>
                       <router-link class="job-login-btn text-light" to="/jobs/applicant/login">Register</router-link>
                   </li>
               </ul>
           </div>
       </nav>
       <section class="container" style="height: 100vh;">
           <div class="row h-100 mb-4 align-items-center flex-column-reverse flex-sm-column-reverse flex-md-column-reverse flex-lg-row">
               <div class="col-10 col-md-7 col-lg-6">
                   <h1 class="job-hiring-heading">Work with Us! </h1>
                   <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ad, veniam distinctio possimus voluptatibus sit hic et asperiores pariatur, vitae quos rerum.</p>
                   <button class="btn btn-primary rounded-pill mt-4">Job Vacancies</button>
                   <div class="mt-5"> 
                    <small>** Scroll down to see available jobs</small>
                   </div>
               </div>
               <div class="col-10 col-md-7 col-lg-6 position-relative">
                   <img class="job-hiring-image img-fluid" src="@/assets/images/undraw_interview.svg" alt="" >
               </div>
           </div>
       </section>
       <section class="container">
           <h4 class="text-center text-uppercase mt-5">Available Jobs</h4>
           <p class="text-center">There are {{jobs.total}} total of jobs available</p>
           <div class="row mt-4 mb-5">
               <div v-for="(job, i) in jobs.data" :key="i" class="col-10 col-sm-10 col-md-6 col-lg-6">
                   <div class="card border-job p-4 mt-3">
                       <h5>{{job.job_title}}</h5>
                       <small>Posted on: {{job.created_at | moment}}</small>
                       <small>Salary: Php {{ job.job_salary_from }}k - {{ job.job_salary_to }}k</small>
                       <small class="mt-3 fw-bold">Qualification: <span class="fw-normal" v-html="job.job_min_qualification"></span></small>
                       <small class="mt-3"><span class="text-danger">Apply Until: </span>{{job.job_opening_expiration | moment}}</small>
                       <div class="d-block mt-4">
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
    </div>
</template>
<script>
import { mapState } from 'vuex'
import moment from 'moment'
export default {
    data(){
        return {
            isLoading: false,
            data: {
                job_title: '',
                salary: ''
            },
            sort: 'asc',
            modalId: '',
        }
    },
    filters: {
        moment: function (date) {
        return moment(date).format('MMMM D, YYYY');
        }
    },
    async mounted() {
        document.title = 'eOffice - Job Opening'
        await this.$store.dispatch('jobopening/getJobs', {page: 1, sort: this.sort})
    },
    computed: {
        ...mapState('jobopening', ['jobs']),
    },
    methods: {
       async getJobs(page = 1){
         await this.$store.dispatch('jobopening/getJobs', {page: page, sort: this.sort})
       },
       async applyJob(id){

           const data = {
               job_opening_id: id
           }

           if(localStorage.getItem('isAdmin')){
               const { status } = await this.$store.dispatch('auth/logoutUser')
               if(status == 200){
                   this.$router.push('/jobs/applicant/login')
               }
               else {
                   this.$toast.error('Somethign went wrong')
               }
           }
           else if(localStorage.getItem('isApplicant')){
              const {status} = await this.$store.dispatch('applicant/applyJob', data)
              if(status == 200){
                  this.$toast.success('Application successful!');
              }
              else {
                  this.$toast.error('Something went wrong');
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