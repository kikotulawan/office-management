<template>
  <div>
    <div class="container-fluid">
      <div class="loader d-flex justify-content-center align-items-center" v-if="isLoading">
      <div class="spinner-grow text-dark spinner-grow-lg" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
      <div class="card p-5 mt-3 mb-5" v-if="!isLoading">
        <h5 class="mt-1">For Submission of Requirements</h5>
        <p class="text-muted">Review applicants requirements below</p>
        <div class="d-flex justify-content-end mb-2 mt-2" v-if="forRequirementsApplicants.data.length > 0">
          <div class="me-2 ">
            <input
              type="text"
              class="form-control"
              id="searchbar"
              placeholder="Search here"
            />
          </div>
        </div>
        <h5 class="text-center mt-5" v-if="forRequirementsApplicants.data.length == 0">No applicants for requirements found on the database</h5>
        <table class="table table-striped table-hover mt-4 text-nowrap" v-if="forRequirementsApplicants.data.length > 0">
          <caption>
            Showing {{forRequirementsApplicants.from}} to {{forRequirementsApplicants.to}} of {{forRequirementsApplicants.total}} data
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
              <th scope="col">Requirements Status</th>
              <th scope="col">Submission Deadline</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(reqApp, r) in forRequirementsApplicants.data" :key="r">
              <td scope="row">{{forRequirementsApplicants.from + r}}</td>
              <td>{{reqApp.user.info.first_name}} {{reqApp.user.info.last_name}}</td>
              <td><label class="badge bg-danger">{{reqApp.result}}</label></td>
              <td>{{reqApp.created_at | moment}}</td>
              <td class="text-nowrap">
                <a
                  href=""
                  class="text-decoration-none shadow-none"
                ><small>
                    Review Requirements
                </small>
                </a>
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
      await this.$store.dispatch('applicant/getForRequirementsApplicants', {page: 1, sort: this.sort})
      this.isLoading = false
  },
  computed: {
    ...mapState('applicant', ['forRequirementsApplicants']),
  },
  filters: {
    moment: function(date) {
      return moment(date).format("MMMM D, YYYY");
    },
  },
  methods: {
  async getForRequirementsApplicants(page = 1){
      await this.$store.dispatch('applicant/getForRequirementsApplicants', {page: page, sort: this.sort})
    },
  },
  watch: {
    sort(){
        this.getForRequirementsApplicants()
    }
  },
};
</script>
