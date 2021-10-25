<template>
  <div>
    <div class="container-fluid">
      <div class="card p-5 mt-3 mb-5">
        <h5 class="mt-1">All Applicants</h5>
        <p class="text-muted">Manage all applicants below</p>
        <div class="d-flex justify-content-end mb-2 mt-2" v-if="allApplicants.data.length > 0">
          <div class="me-2 ">
            <input
              type="text"
              class="form-control"
              id="searchbar"
              placeholder="Search here"
            />
          </div>
        </div>
        <h5 class="text-center mt-5"  v-if="allApplicants.data.length == 0 && !initialLoading">No applicants found on the database</h5>
        <table class="table table-striped table-hover mt-4" v-if="allApplicants.data.length > 0">
          <caption>
            Showing {{allApplicants.from}} to {{allApplicants.to}} of {{allApplicants.total}} data
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
              <th scope="col">Gender</th>
              <th scope="col">Applied Position</th>
              <th scope="col">Application Date</th>
              <th scope="col">Applicant Status</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(app, i) in allApplicants.data" :key="i">
              <td scope="row">{{allApplicants.from + i}}</td>
              <td class="text-nowrap">{{app.user.info.first_name}} {{app.user.info.last_name}}</td>
              <td>{{app.user.info.gender}}</td>
              <td>{{app.jobapplied.job_title}}</td>
              <td>{{app.user.created_at | moment}}</td>
              <td>{{app.status}}</td>
              <td>
                <router-link to="view/applicant" class="text-decoration-none">View Applicant</router-link>
              </td>
            </tr>
          </tbody>
        </table>
        <!--- 1. PAGINATION - CHANGE - PAGE FIX -->
        <!-- <div class="row mt-3" v-if="branches.data">
          <pagination
            :showDisabled="true"
            :align="'right'"
            :data="branches"
            @pagination-change-page="getBranches"
          >
            <span slot="prev-nav">&laquo;</span>
            <span slot="next-nav">&raquo;</span>
          </pagination>
        </div> -->
      </div>
    </div>

    <div class="container-fluid">
      <div class="card p-5 mt-3 mb-5">
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
        <h5 class="text-center mt-5"  v-if="newApplicants.data.length == 0 && !initialLoading">No new applicants found on the database</h5>
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
              <td>{{newApp.jobapplied.created_at | moment}}</td>
              <td class="text-nowrap">
                <a href="" class="text-decoration-none shadow-none"
                  ><small>
                    Review Application
                  </small>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="container-fluid">
      <div class="card p-5 mt-3 mb-5">
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
        <h5 class="text-center mt-5" v-if="forInterviewApplicants.data.length == 0 && !initialLoading">No applicants for interview found on the database</h5>
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
              <td>{{intApp.user.info.first_name}} {{intApp.user.info.last_name}}</td>
              <td>{{intApp.jobapplied.created_at | moment}}</td>
              <td class="text-nowrap">
                <a
                  href=""
                  class="text-decoration-none shadow-none"
                ><small>
                    Review Application
                </small>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="container-fluid">
      <div class="card p-5 mt-3 mb-5">
        <h5 class="mt-1">For Final Screening Applicants</h5>
        <p class="text-muted">Review applicants for final screening below</p>
        <div class="d-flex justify-content-end mb-2 mt-2" v-if="forFinalScreeningApplicants.data.length > 0">
          <div class="me-2 ">
            <input
              type="text"
              class="form-control"
              id="searchbar"
              placeholder="Search here"
            />
          </div>
        </div>
        <h5 class="text-center mt-5" v-if="forFinalScreeningApplicants.data.length == 0 && !initialLoading">No applicants for final screening found on the database</h5>
        <table class="table table-striped table-hover mt-4" v-if="forFinalScreeningApplicants.data.length > 0">
          <caption>
            Showing {{forFinalScreeningApplicants.from}} to {{forFinalScreeningApplicants.to}} of {{forFinalScreeningApplicants.total}} data
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
              <th scope="col">Interview Result</th>
              <th scope="col">Assigned Interviewer</th>
              <th scope="col">Interviewed On</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(fsApp, f) in forFinalScreeningApplicants.data" :key="f">
              <td scope="row">{{forFinalScreeningApplicants.from + f}}</td>
              <td>{{fsApp.user.info.first_name}} {{fsApp.user.info.last_name}}</td>
              <td><label class="badge bg-success">{{fsApp.result}}</label></td>
              <td>{{fsApp.assigned_interviewer}}</td>
              <td>{{fsApp.created_at | moment}}</td>
              <td class="text-nowrap">
                <a
                  href=""
                  class="text-decoration-none shadow-none"
                ><small>
                    Review Application
                </small>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- <div class="row mt-3" v-if="branches.data">
          <pagination
            :showDisabled="true"
            :align="'right'"
            :data="branches"
            @pagination-change-page="getBranches"
          >
            <span slot="prev-nav">&laquo;</span>
            <span slot="next-nav">&raquo;</span>
          </pagination>
        </div> -->
      </div>
    </div>

    <div class="container-fluid">
      <div class="card p-5 mt-3 mb-5">
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
        <h5 class="text-center mt-5" v-if="forRequirementsApplicants.data.length == 0 && !initialLoading">No applicants for requirements found on the database</h5>
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
      sort: 'asc'
    };
  },
  async mounted() {},
  async created(){
      await this.$store.dispatch('applicant/getApplicants', {page: 1, sort: this.sort})
      await this.$store.dispatch('applicant/getNewApplicants', {page: 1, sort: this.sort})
      await this.$store.dispatch('applicant/getForInterviewApplicants', {page: 1, sort: this.sort})
      await this.$store.dispatch('applicant/getForFinalScreeningApplicants', {page: 1, sort: this.sort})
      await this.$store.dispatch('applicant/getForRequirementsApplicants', {page: 1, sort: this.sort})
  },
  computed: {
    ...mapState('applicant', ['allApplicants', 'newApplicants', 'forInterviewApplicants', 'forFinalScreeningApplicants', 'forRequirementsApplicants']),
  },
  filters: {
    moment: function(date) {
      return moment(date).format("MMMM D, YYYY");
    },
  },
  methods: {
  async getApplicants(page = 1){
      await this.$store.dispatch('applicant/getApplicants', {page: page, sort: this.sort})
    },
  async getNewApplicants(page = 1){
      await this.$store.dispatch('applicant/getNewApplicants', {page: page, sort: this.sort})
    },
  async getForInterviewApplicants(page = 1){
      await this.$store.dispatch('applicant/getForInterviewApplicants', {page: page, sort: this.sort})
    },
  async getForFinalScreeningApplicants(page = 1){
      await this.$store.dispatch('applicant/getForFinalScreeningApplicants', {page: page, sort: this.sort})
    },
  async getForRequirementsApplicants(page = 1){
      await this.$store.dispatch('applicant/getForRequirementsApplicants', {page: page, sort: this.sort})
    },
  },
  watch: {
    sort(){
        this.getApplicants(),
        this.getNewApplicants(),
        this.getForInterviewApplicants(),
        this.getForFinalScreeningApplicants(),
        this.getForRequirementsApplicants()
    }
  },
};
</script>
