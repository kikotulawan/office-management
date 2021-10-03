<template>
    <div class="jobs-portal">
       <div class="container p-5">
       <h2 class="text-center mt-3 fw-bold">eOffice is now Recruiting!</h2>
        <div class="card p-5 mt-5 mb-5">
            <h5 class="mt-1">Job Vacancies</h5>
            <p class="text-muted">There are {{jobs.total}} total of job(s) available.</p>
            <div class="d-flex justify-content-end mb-2 mt-2">
                <div class="me-2 ">
                    <input type="text" class="form-control" id="searchbar" placeholder="Search a job">
                </div>
            </div>
            <table class="table table-striped table-hover mt-4">
                <caption>Showing {{jobs.from}} to {{jobs.to}} of {{jobs.total}} data</caption>
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="cursor-pointer" v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'">Job Title <i class="bi" :class="sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'"></i></th>
                    <th scope="col">Date Posted</th>
                    <th scope="col">Apply Until</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(job, i) in jobs.data" :key="i">
                        <td scope="row">{{jobs.from + i}}</td>
                        <td class="text-nowrap">{{job.job_title}}</td>
                        <td>{{job.created_at | moment}}</td>
                        <td class="text-danger">{{job.job_opening_expiration | moment}}</td>
                        <td>PHP {{ job.job_salary_from }} - {{ job.job_salary_to }}</td>
                        <td>
                            <a href="" class="text-decoration-none">Details</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--- INITIAL CONFIGURATION FOR PAGINATION -->
            <!--- TO-DO -->
            <!--- 1. SEARCH FUNCTIONALITY  -->
            <!--- 1. PAGINATION - CHANGE - PAGE FIX -->
            <div class="row mt-3" v-if="jobs.data">
              <pagination :showDisabled="true" :align="'right'" :data="jobs" @pagination-change-page="getJobs">
                <span slot="prev-nav">&laquo;</span>
                <span slot="next-nav">&raquo;</span>
              </pagination>
            </div>
        </div>
       </div>
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
    },
    watch: {
        sort(){
            this.getJobs()
        }
    }
}
</script>