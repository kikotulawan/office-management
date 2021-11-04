<template>
  <div>
    <div class="container-fluid">
      <div class="loader d-flex justify-content-center align-items-center" v-if="isLoading">
      <div class="spinner-grow text-dark spinner-grow-lg" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
      <div class="card p-5 mt-3 mb-5" v-if="!isLoading">
        <h5 class="mt-1">New Applicants</h5>
        <p class="text-muted">Review new applicants below</p>
        <div class="d-flex justify-content-end mb-2 mt-2" v-if="newApplicants.data.length > 0">
          <div class="me-2 ">
            <input
              type="text"
              class="form-control"
              id="searchbar"
              placeholder="Search here"
            />
          </div>
        </div>
        <h5 class="text-center mt-5"  v-if="newApplicants.data.length == 0">No new applicants found on the database</h5>
        <table class="table table-striped table-hover mt-4" v-if="newApplicants.data.length > 0">
          <caption>
            Showing {{newApplicants.from}} to {{newApplicants.to}} of {{newApplicants.total}} data
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
              <th scope="col">Email</th>
              <th scope="col">Applied Position</th>
              <th scope="col">Application Date</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(newApp, n) in newApplicants.data" :key="n">
              <td scope="row">{{newApplicants.from + n}}</td>
              <td class="text-nowrap">{{newApp.user.info.first_name}} {{newApp.user.info.last_name}}</td>
              <td>{{newApp.user.email}}</td>
              <td>{{newApp.jobapplied.job_title}}</td>
              <td>{{newApp.created_at | moment}}</td>
              <td class="text-nowrap">
                <button class="btn text-primary text-decoration-none shadow-none pt-0" @click="setViewNewApplicant(newApp)">Review Applicant</button>
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
    initialLoading: false,
      sort: 'asc',
    };
  },
  created(){
    document.title = "Human Resource - Initial Screening"
  },
  async mounted(){
      this.isLoading = true
      await this.$store.dispatch('auth/checkAuthUser')    
      await this.$store.dispatch('applicant/getNewApplicants', {page: 1, sort: this.sort})
      this.isLoading = false
  },
  computed: {
    ...mapState('applicant', ['newApplicants']),
  },
  filters: {
    moment: function(date) {
      return moment(date).format("MMMM D, YYYY");
    },
  },
  methods: {
  async getNewApplicants(page = 1){
      await this.$store.dispatch('applicant/getNewApplicants', {page: page, sort: this.sort})
    },
  setViewNewApplicant(data) {
      this.$store.commit('applicant/SET_VIEW_NEW_APPLICANT', { data: data });
      this.$router.push({ name: 'newapplicant', params: { slug: data.id } });
    },
  },
  watch: {
    sort(){
        this.getNewApplicants()
    }
  },
};
</script>
