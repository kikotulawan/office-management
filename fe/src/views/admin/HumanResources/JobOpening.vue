<template>
  <div>
    <div class="container-fluid">
      <div class="card p-5 mt-3 mb-5">
        <h5 class="mt-1 text-primary">Post a Job</h5>
        <div class="row mt-5">
          <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
            <p>Job Title</p>
          </div>
          <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
            <input
              type="text"
              class="form-control shadow-none"
              placeholder="eg. Accountant"
            />
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
            <p>Job Description</p>
          </div>
          <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
            <textarea
              type="text"
              rows="5"
              class="form-control shadow-none"
            ></textarea>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
            <p>Job Requirements</p>
          </div>
          <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
            <textarea
              type="text"
              rows="5"
              class="form-control shadow-none"
            ></textarea>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
            <p>Salary Range</p>
          </div>
          <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <input
                  type="number"
                  class="form-control shadow-none"
                  placeholder="from"
                />
              </div>
              <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <input
                  type="number"
                  class="form-control shadow-none"
                  placeholder="to"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
            <p>Job Type</p>
          </div>
          <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
            <select class="form-select shadow-none">
              <option value="Full-time" selected>Full-time</option>
              <option value="Part-time">Part-time</option>
              <option value="Contract">Contract</option>
              <option value="Freelance">Freelance</option>
            </select>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
            <p>Min. Experience</p>
          </div>
          <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
            <select class="form-select shadow-none">
              <option value="1-3 years" selected>1-3 years</option>
              <option value="3-5 years">3-5 years</option>
              <option value="5-10 years">5-10 years</option>
              <option value="More than 10 years">More than 10 years</option>
            </select>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
            <p>Min. Qualification</p>
          </div>
          <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
            <select class="form-select shadow-none">
              <option value="College Graduate" selected
                >College Graduate</option
              >
              <option value="High-school Graduate">High-school Graduate</option>
              <option value="Not Required">Not Required</option>
            </select>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
            <p>Skills</p>
          </div>
          <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
            <textarea
              type="text"
              rows="5"
              class="form-control shadow-none"
            ></textarea>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
            <p>Work Location</p>
          </div>
          <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
            <input v-model="data.work_location" type="text" class="form-control shadow-none" :disabled="isHomebased"/>
          </div>
        </div>
        <div class="row mt-1">
          <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2"></div>
          <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
            <div class="form-check">
              <input
                v-model="isHomebased"
                class="form-check-input shadow-none"
                type="checkbox"
                id="flexCheckDefault"
              />
              <label class="form-check-label" for="flexCheckDefault">
                This is a home-based role
              </label>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
            <p>Email</p>
          </div>
          <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
            <input type="text" class="form-control shadow-none" />
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
            <p>Company Name</p>
          </div>
          <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
            <input type="text" class="form-control shadow-none" />
          </div>
        </div>
        <div class="d-flex justify-content-end mt-4">
          <button class="btn btn-primary rounded-3 px-5">Post Job</button>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="card p-5 mt-3 mb-5">
        <h5 class="mt-1">Job Posted</h5>
        <p class="text-muted">Manage all job opening below</p>
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
            Showing
            {{
              jobopening.from
            }}
            to
            {{
              jobopening.to
            }}
            of
            {{
              jobopening.total
            }}
            data
          </caption>
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th
                scope="col"
                class="cursor-pointer"
                v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'"
              >
                Job Title
                <i
                  class="bi"
                  :class="
                    sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'
                  "
                ></i>
              </th>
              <th scope="col">Date Posted</th>
              <th scope="col">Salary</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(job, i) in jobopening.data" :key="i">
              <td scope="row">{{ jobopening.from + i }}</td>
              <td class="text-nowrap">{{ job.job_title }}</td>
              <td>{{ job.created_at | moment }}</td>
              <td>PHP {{ job.salary }}</td>
              <td>
                <a
                  href=""
                  class="btn btn-secondary btn-sm rounded-pill shadow-none me-2"
                  @click.prevent="
                    data = { ...job };
                    $bvModal.show('updateJobOpeningModal');
                  "
                >
                  <i class="bi bi-pencil"></i>
                </a>
                <a
                  href=""
                  class="btn btn-primary btn-sm rounded-pill shadow-none"
                >
                  <i class="bi bi-eye-fill"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
        <!--- INITIAL CONFIGURATION FOR PAGINATION -->
        <!--- TO-DO -->
        <!--- 1. SEARCH FUNCTIONALITY  -->
        <!--- 1. PAGINATION - CHANGE - PAGE FIX -->
        <div class="row mt-3" v-if="jobopening.data">
          <pagination
            :showDisabled="true"
            :align="'right'"
            :data="jobopening"
            @pagination-change-page="getJobOpening"
          >
            <span slot="prev-nav">&laquo;</span>
            <span slot="next-nav">&raquo;</span>
          </pagination>
        </div>
      </div>
    </div>

    <b-modal id="addJobOpeningModal" centered title="Add Job Opening">
      <form ref="jobopeningform" class="p-2">
        <label class="">Job Title</label>
        <input
          v-model="data.job_title"
          class="shadow-none form-control"
          type="text"
        />
        <label class="mt-2">Salary</label>
        <div class="input-group">
          <span class="input-group-text bg-light" id="basic-addon1">PHP</span>
          <input
            v-model="data.salary"
            type="text"
            placeholder="ex. 12k-20k monthly or weekly"
            class="shadow-none form-control"
          />
        </div>
      </form>
      <template #modal-footer="{cancel}">
        <b-button variant="secondary" @click="cancel()" :disabled="isLoading">
          Cancel
        </b-button>
        <b-button
          variant="success"
          v-on:click.prevent="saveJobOpening"
          :disabled="isLoading"
        >
          Post Job
        </b-button>
      </template>
    </b-modal>

    <b-modal id="updateJobOpeningModal" centered title="Update Job Opening">
      <form ref="jobopeningform" class="p-2">
        <label class="">Job Title</label>
        <input
          v-model="data.job_title"
          class="shadow-none form-control"
          type="text"
        />
        <label class="mt-2">Salary</label>
        <div class="input-group">
          <span class="input-group-text bg-light" id="basic-addon1">PHP</span>
          <input
            v-model="data.salary"
            type="text"
            placeholder="ex. 12k-20k monthly or weekly"
            class="shadow-none form-control"
          />
        </div>
      </form>
      <template #modal-footer="{cancel}">
        <b-button variant="secondary" @click="cancel()" :disabled="isLoading">
          Cancel
        </b-button>
        <b-button
          variant="success"
          v-on:click.prevent="updateJobOpening"
          :disabled="isLoading"
        >
          Update Job Opening
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
<script>
import { mapState } from "vuex";
import moment from "moment";
export default {
  data() {
    return {
      isLoading: false,
      isHomebased: false,
      data: {
        job_title: "",
        salary: "",
        work_location: "",
      },
      sort: "asc",
      modalId: "",
    };
  },
  filters: {
    moment: function(date) {
      return moment(date).format("MMMM D, YYYY, h:mm a");
    },
  },
  props: {
      homebased: function() {
          if (this.isHomebased == true) return this.data.work_location == "Homebased"
      }
  },
  async mounted() {
    document.title = "Human Resource - Job Opening";
    await this.$store.dispatch("auth/checkUser");
    await this.$store.dispatch("jobopening/getJobOpening", {
      page: 1,
      sort: this.sort,
    });
    this.$root.$on("bv::modal::show", (modalId) => {
      this.modalId = modalId.componentId;
    });
    this.$root.$on("bv::modal::hide", (modalId) => {
      this.data.job_title = "";
      this.data.salary = "";
    });
  },
  computed: {
    ...mapState("jobopening", ["jobopening"]),
  },
  methods: {
    async getJobOpening(page = 1) {
      await this.$store.dispatch("jobopening/getJobOpening", {
        page: page,
        sort: this.sort,
      });
    },
    async saveJobOpening() {
      if (this.data.job_title.trim() == "")
        return this.$toast.error("Job Title is required");
      if (this.data.salary.trim() == "")
        return this.$toast.error("Salary for the job is required");

      this.isLoading = true;
      const { data, status } = await this.$store.dispatch(
        "jobopening/saveJobOpening",
        this.data
      );
      this.checkStatus(data, status, "", "jobopening/getJobOpening");
    },
    async updateJobOpening() {
      if (this.data.job_title.trim() == "")
        return this.$toast.error("Job Title is required");
      if (this.data.salary.trim() == "")
        return this.$toast.error("Salary for the job is required");

      this.isLoading = true;
      const { data, status } = await this.$store.dispatch(
        "jobopening/updateJobOpening",
        this.data
      );
      this.checkStatus(data, status, "update");
    },
    closeModal() {
      this.data.job_title = "";
      this.data.salary = "";
      this.$bvModal.hide(this.modalId);
    },
  },
  watch: {
    sort() {
      this.getJobOpening();
    },
  },
};
</script>
