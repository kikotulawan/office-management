<template>
  <div>
    <div class="container-fluid">
        <div class="loader d-flex justify-content-center align-items-center" v-if="isLoading">
      <div class="spinner-grow text-dark spinner-grow-lg" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
      <div class="card p-5 mt-3 mb-5" v-if="!isLoading">
        <h5 class="mt-1">For Interview Applicants</h5>
        <p class="text-muted">Review applicants for interview below</p>
        <div class="d-flex justify-content-end mb-2 mt-2" v-if="forInterviewApplicants.data.length > 0">
          <div class="me-2 ">
            <input
              type="text"
              class="form-control"
              id="searchbar"
              placeholder="Search here"
            />
          </div>
        </div>
        <h5 class="text-center mt-5" v-if="forInterviewApplicants.data.length == 0">No applicants for interview found on the database</h5>
        <table class="table table-striped table-hover mt-4" v-if="forInterviewApplicants.data.length > 0">
          <caption>
            Showing {{forInterviewApplicants.from}} to {{forInterviewApplicants.to}} of {{forInterviewApplicants.total}} data
          </caption>
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th
                scope="col"
                class="cursor-pointer"
                v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'"
              >
                Name
                <i
                  class="bi"
                  :class="
                    sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'
                  "
                ></i>
              </th>
              <th scope="col">Assigned Interviewer</th>
              <th scope="col">Interview Date</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(intApp, t) in forInterviewApplicants.data" :key="t">
              <td scope="row">{{forInterviewApplicants.from + t}}</td>
              <td>{{intApp.user.info.first_name}} {{intApp.user.info.last_name}}</td>
              <td>{{intApp.assigned_interviewer}}</td>
              <td>{{intApp.schedule | moment}}</td>
              <td class="text-nowrap">
                <button class="btn text-primary text-decoration-none shadow-none pt-0" @click="setViewInterviewApplicant(intApp)">Review Applicant</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from 'vuex'
import moment from "moment";
export default {
  data() {
    return {
      sort: 'asc',
    };
  },
  created(){
    document.title = "Human Resource - Applicants"
  },
  async mounted(){
      this.isLoading = true
      await this.$store.dispatch('auth/checkAuthUser')    
      await this.$store.dispatch('applicant/getForInterviewApplicants', {page: 1, sort: this.sort})
      this.isLoading = false
  },
  computed: {
    ...mapState('applicant', ['forInterviewApplicants']),
  },
  filters: {
    moment: function(date) {
      return moment(date).format("MMMM D, YYYY");
    },
  },
  methods: {
  async getForInterviewApplicants(page = 1){
      await this.$store.dispatch('applicant/getForInterviewApplicants', {page: page, sort: this.sort})
    },
  setViewInterviewApplicant(data) {
      this.$store.commit('applicant/SET_VIEW_INTERVIEW_APPLICANT', { data: data });
      this.$router.push({ name: 'interviewapplicant', params: { slug: data.id } });
    },
  },
  watch: {
    sort(){
        this.getForInterviewApplicants()
    }
  },
};
</script>
