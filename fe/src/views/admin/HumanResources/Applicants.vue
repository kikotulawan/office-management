<template>
  <div>
    <div class="container-fluid">
      <div class="card p-5 mt-3 mb-5">
        <h5 class="mt-1">All Applicants</h5>
        <p class="text-muted">Manage all applicants below</p>
        <div class="d-flex justify-content-end mb-2 mt-2">
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
              <td><label class="badge bg-primary">For Screening</label></td>
              <td>
                <a
                  href=""
                  class="text-decoration-none shadow-none"
                ><small>
                    View Details
                </small>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
        <!--- INITIAL CONFIGURATION FOR PAGINATION -->
        <!--- TO-DO -->
        <!--- 1. SEARCH FUNCTIONALITY  -->
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
        <div class="d-flex justify-content-end mb-2 mt-2">
          <div class="me-2 ">
            <input
              type="text"
              class="form-control"
              id="searchbar"
              placeholder="Search here"
            />
          </div>
        </div>
        <table class="table table-striped table-hover mt-4">
          <caption>
            Showing 0 to 0 of 0 data
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
            <tr>
              <td scope="row">1</td>
              <td class="text-nowrap">Yvan Sabay</td>
              <td>sabayyvan2018@gmail.com</td>
              <td>Accountant</td>
              <td>August 14, 2021</td>
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
        <!--- INITIAL CONFIGURATION FOR PAGINATION -->
        <!--- TO-DO -->
        <!--- 1. SEARCH FUNCTIONALITY  -->
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
        <h5 class="mt-1">For Interview Applicants</h5>
        <p class="text-muted">Review applicants for interview below</p>
        <div class="d-flex justify-content-end mb-2 mt-2">
          <div class="me-2 ">
            <input
              type="text"
              class="form-control"
              id="searchbar"
              placeholder="Search here"
            />
          </div>
        </div>
        <table class="table table-striped table-hover mt-4">
          <caption>
            Showing 0 to 0 of 0 data
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
            <tr>
              <td scope="row">1</td>
              <td>Ezikiel Pura Tulawan</td>
              <td>Yvan Sabay</td>
              <td>October 4, 2021</td>
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
        <!--- INITIAL CONFIGURATION FOR PAGINATION -->
        <!--- TO-DO -->
        <!--- 1. SEARCH FUNCTIONALITY  -->
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
        <h5 class="mt-1">For Final Screening Applicants</h5>
        <p class="text-muted">Review applicants for final screening below</p>
        <div class="d-flex justify-content-end mb-2 mt-2">
          <div class="me-2 ">
            <input
              type="text"
              class="form-control"
              id="searchbar"
              placeholder="Search here"
            />
          </div>
        </div>
        <table class="table table-striped table-hover mt-4">
          <caption>
            Showing 0 to 0 of 0 data
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
              <th scope="col">Interview Date</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td scope="row">1</td>
              <td>Lowell Tebrero</td>
              <td><label class="badge bg-success">PASSED</label></td>
              <td>Yvan Sabay</td>
              <td>October 6, 2021</td>
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
        <!--- INITIAL CONFIGURATION FOR PAGINATION -->
        <!--- TO-DO -->
        <!--- 1. SEARCH FUNCTIONALITY  -->
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
        <h5 class="mt-1">For Submission of Requirements</h5>
        <p class="text-muted">Review applicants requirements below</p>
        <div class="d-flex justify-content-end mb-2 mt-2">
          <div class="me-2 ">
            <input
              type="text"
              class="form-control"
              id="searchbar"
              placeholder="Search here"
            />
          </div>
        </div>
        <table class="table table-striped table-hover mt-4 text-nowrap">
          <caption>
            Showing 0 to 0 of 0 data
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
            <tr>
              <td scope="row">1</td>
              <td>Christian Segura</td>
              <td><label class="badge bg-danger">INCOMPLETE</label></td>
              <td>October 30, 2021</td>
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
        <!--- INITIAL CONFIGURATION FOR PAGINATION -->
        <!--- TO-DO -->
        <!--- 1. SEARCH FUNCTIONALITY  -->
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
  </div>
  <!-- <div>
        <p class="fw-bold">TABLES</p>
        <p>New Applicants table</p>
        <p>For Intreview table</p>
        <p>For Final Screening table</p>
        <p>For Submission of Requirements table</p>
        <p>Blacklist table</p>
        <p>Failed Applicant table</p>
        <br>
        <p class="fw-bold">JOB APPLICATION PROCESS</p>
        <p>Step 1: Applicant Screening - PASS, FAILED OR REJECTED</p>
        <p>Step 2: Applicant For Interview - PASS, FAILED OR REJECTED</p>
        <p>Step 3: Applicant For Final Screening - PASS, FAILED OR REJECTED</p>
        <br>
        <p class="fw-bold text-success">IF THE APPLICANT COMPLETED/PASSED ALL STEPS ABOVE, PROCEED TO ONBOARDING.</p>
        <p class="fw-bold text-danger">IF THE APPLICANT IS FAILED, APPLICANT CAN STILL APPLY FOR A JOB OPENING.</p>
        <p class="fw-bold text-danger">IF AND ONLY IF THE APPLICANT IS REJECTED, APPLICANT WILL BE MOVED TO BLACKLIST AND WON'T BE ABLE TO APPLY FOR A JOB OPENING.</p>
        <br>
        <p class="fw-bold">ONBOARDING PROCESS</p>
        <p>Step 1: Applicant Submission of Requirements - PASS, FAILED OR REJECTED</p>
        <p>Step 2: If Applicant submitted all the requirements, Applicant will be moved to Employees Database and the HR will assign the supervisor, policies and pay periods for the applicant.</p>
        <br><br>
    </div> -->
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
  },
  computed: {
    ...mapState('applicant', ['allApplicants']),
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
  },
  watch: {
    sort(){
        this.getApplicants()
    }
  },
};
</script>
