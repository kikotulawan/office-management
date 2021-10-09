<template>
  <div>
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
          <button
            class="btn btn-primary btn-sm shadow-none"
            @click="$bvModal.show('addJobOpeningModal')"
          >
            <i class="bi bi-plus"></i>Post a Job
          </button>
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
              <th scope="col" class="cursor-pointer" v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'">
                Job Title
                <i class="bi" :class="sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'"></i>
              </th>
              <th scope="col">Date Posted</th>
              <th scope="col">Open Until</th>
              <th scope="col">Salary</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(job, i) in jobopening.data" :key="i">
              <td scope="row">{{ jobopening.from + i }}</td>
              <td class="text-nowrap">{{ job.job_title }}</td>
              <td>{{ job.created_at | moment }}</td>
              <td class="text-danger">
                {{ job.job_opening_expiration | moment }}
              </td>
              <td>PHP {{ job.job_salary_from }} - {{ job.job_salary_to }}</td>
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
                  @click.prevent="
                    data = { ...job };
                    $bvModal.show('viewJobOpeningModal');
                  "
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

    <b-modal
      id="addJobOpeningModal"
      size="lg"
      scrollable
      centered
      title="Add Job Opening"
    >
      <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
          <p class="text-primary fw-bold">Job Title</p>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
          <input
            v-model="data.job_title"
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
          <vue-editor
            v-model="data.job_description"
            :editorToolbar="customToolbar"
          ></vue-editor>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
          <p>Job Requirements</p>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
          <vue-editor
            v-model="data.job_requirements"
            :editorToolbar="customToolbar"
          ></vue-editor>
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
                v-model="data.job_salary_from"
                type="number"
                class="form-control shadow-none"
                placeholder="from"
              />
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <input
                v-model="data.job_salary_to"
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
          <select v-model="data.job_type" class="form-select shadow-none">
            <option value="Full-time" selected>Full-time</option>
            <option value="Part-time">Part-time</option>
            <option value="Contract">Contract</option>
            <option value="Freelance">Freelance</option>
          </select>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
          <p>Min. Work Experience</p>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
          <select
            v-model="data.job_min_experience"
            class="form-select shadow-none"
          >
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
          <select
            v-model="data.job_min_qualification"
            class="form-select shadow-none"
          >
            <option value="College Graduate" selected>College Graduate</option>
            <option value="High-school Graduate">High-school Graduate</option>
            <option value="Not Required">No Qualification Required</option>
          </select>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
          <p>Skills</p>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
          <vue-editor
            v-model="data.job_skills"
            :editorToolbar="customToolbar"
          ></vue-editor>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
          <p>Work Location</p>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
          <input
            v-model="data.job_work_location"
            type="text"
            class="form-control shadow-none"
            :disabled="isHomebased"
          />
        </div>
      </div>
      <div class="row mt-1">
        <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2"></div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
          <div class="form-check">
            <input
              v-model="isHomebased"
              v-on:click="isHomebasedChecked"
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
          <p class="text-danger">Apply Until</p>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
          <input
            v-model="data.job_opening_expiration"
            type="date"
            class="form-control shadow-none"
          />
        </div>
      </div>
      <template #modal-footer="{ cancel }">
        <b-button
          size="sm"
          variant="secondary"
          @click="cancel()"
          :disabled="isLoading"
        >
          Cancel
        </b-button>
        <b-button
          size="sm"
          variant="primary"
          @click="saveJobOpening"
          :disabled="isLoading"
        >
          Post Job
        </b-button>
      </template>
    </b-modal>

    <b-modal
      id="updateJobOpeningModal"
      size="lg"
      centered
      scrollable
      title="Update Job Opening"
    >
      <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
          <p>Job Title</p>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
          <input
            v-model="data.job_title"
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
          <vue-editor
            v-model="data.job_description"
            :editorToolbar="customToolbar"
          ></vue-editor>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
          <p>Job Requirements</p>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
          <vue-editor
            v-model="data.job_requirements"
            :editorToolbar="customToolbar"
          ></vue-editor>
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
                v-model="data.job_salary_from"
                type="number"
                class="form-control shadow-none"
                placeholder="from"
              />
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <input
                v-model="data.job_salary_to"
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
          <select v-model="data.job_type" class="form-select shadow-none">
            <option value="Full-time" selected>Full-time</option>
            <option value="Part-time">Part-time</option>
            <option value="Contract">Contract</option>
            <option value="Freelance">Freelance</option>
          </select>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
          <p>Min. Work Experience</p>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
          <select
            v-model="data.job_min_experience"
            class="form-select shadow-none"
          >
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
          <select
            v-model="data.job_min_qualification"
            class="form-select shadow-none"
          >
            <option value="College Graduate" selected>College Graduate</option>
            <option value="High-school Graduate">High-school Graduate</option>
            <option value="Not Required">No Qualification Required</option>
          </select>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
          <p>Skills</p>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
          <vue-editor
            v-model="data.job_skills"
            :editorToolbar="customToolbar"
          ></vue-editor>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
          <p>Work Location</p>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
          <input
            v-model="data.job_work_location"
            type="text"
            class="form-control shadow-none"
            :disabled="isHomebased"
          />
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
          <p class="text-danger">Apply Until</p>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
          <input
            v-model="data.job_opening_expiration"
            type="date"
            class="form-control shadow-none"
          />
        </div>
      </div>
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

    <b-modal
      id="viewJobOpeningModal"
      centered
      scrollable
      title="View Job Opening"
    >
      <div class="row">
        <div class="col-12">
          <p class="text-primary fw-bold"><small>Job Title</small></p>
          <p class="mt-1">{{ data.job_title }}</p>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <p class="text-primary fw-bold"><small>Job Description</small></p>
          <div v-html="data.job_description"></div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <p class="text-primary fw-bold"><small>Job Requirements</small></p>
          <div v-html="data.job_requirements"></div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <p class="text-primary fw-bold"><small>Salary Range</small></p>
          <p class="mt-1">
            PHP {{ data.job_salary_from }} - {{ data.job_salary_to }}
          </p>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <p class="text-primary fw-bold"><small>Job Type</small></p>
          <p class="mt-1">{{ data.job_type }}</p>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <p class="text-primary fw-bold">
            <small>Min. Work Experience</small>
          </p>
          <p class="mt-1">{{ data.job_min_experience }}</p>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <p class="text-primary fw-bold"><small>Min. Qualification</small></p>
          <p class="mt-1">{{ data.job_min_qualification }}</p>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <p class="text-primary fw-bold"><small>Skills</small></p>
          <div v-html="data.job_skills"></div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <p class="text-primary fw-bold"><small>Work Location</small></p>
          <p class="mt-1">{{ data.job_work_location }}</p>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <p class="text-danger fw-bold"><small>Apply Until</small></p>
          <p class="mt-1">{{ data.job_opening_expiration | moment }}</p>
        </div>
      </div>
      <template #modal-footer="{cancel}">
        <b-button variant="secondary" @click="cancel()">
          Close
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
<script>
import { mapState } from "vuex";
import { VueEditor } from "vue2-editor";
import moment from "moment";
export default {
  components: {
    VueEditor,
  },
  data() {
    return {
      isLoading: false,
      isHomebased: false,
      data: {
        job_title: "",
        job_description: "",
        job_requirements: "",
        job_type: "",
        job_salary_from: "",
        job_salary_to: "",
        job_min_experience: "",
        job_min_qualification: "",
        job_skills: "",
        job_work_location: "",
        job_opening_expiration: "",
      },
      customToolbar: [
        ["bold", "italic", "underline"],
        [{ list: "ordered" }, { list: "bullet" }],
        ["image", "code-block"],
      ],
      sort: "asc",
      modalId: "",
    };
  },
  filters: {
    moment: function(date) {
      return moment(date).format("MMMM D, YYYY");
    },
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
      (this.data.job_title = ""),
        (this.data.job_description = ""),
        (this.data.job_requirements = ""),
        (this.data.job_type = ""),
        (this.data.job_salary_from = ""),
        (this.data.job_salary_to = ""),
        (this.data.job_min_experience = ""),
        (this.data.job_min_qualification = ""),
        (this.data.job_skills = ""),
        (this.data.job_work_location = ""),
        (this.data.job_opening_expiration = "");
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
      if (this.data.job_description.trim() == "")
        return this.$toast.error("Job Description is required");
      if (this.data.job_requirements.trim() == "")
        return this.$toast.error("Job Requirements is required");
      if (this.data.job_salary_from.trim() == "")
        return this.$toast.error("Salary for the job is required");
      if (this.data.job_salary_to.trim() == "")
        return this.$toast.error("Salary for the job is required");
      if (this.data.job_type == 0)
        return this.$toast.error("Job Type is required");
      if (this.data.job_min_experience == 0)
        return this.$toast.error("Job Min. Experience is required");
      if (this.data.job_min_qualification == 0)
        return this.$toast.error("Job Min. Qualification is required");
      if (this.data.job_skills.trim() == "")
        return this.$toast.error("Job Skills is required");
      if (this.data.job_work_location.trim() == "")
        return this.$toast.error("Job Work Location is required");

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
      if (this.data.job_description.trim() == "")
        return this.$toast.error("Job Description is required");
      if (this.data.job_requirements.trim() == "")
        return this.$toast.error("Job Requirements is required");
      if (this.data.job_salary_from.trim() == "")
        return this.$toast.error("Salary for the job is required");
      if (this.data.job_salary_to.trim() == "")
        return this.$toast.error("Salary for the job is required");
      if (this.data.job_type == 0)
        return this.$toast.error("Job Type is required");
      if (this.data.job_min_experience == 0)
        return this.$toast.error("Job Min. Experience is required");
      if (this.data.job_min_qualification == 0)
        return this.$toast.error("Job Min. Qualification is required");
      if (this.data.job_skills.trim() == "")
        return this.$toast.error("Job Skills is required");
      if (this.data.job_work_location.trim() == "")
        return this.$toast.error("Job Work Location is required");

      this.isLoading = true;
      const { data, status } = await this.$store.dispatch(
        "jobopening/updateJobOpening",
        this.data
      );
      this.checkStatus(data, status, "update");
    },
    closeModal() {
      (this.data.job_title = ""),
        (this.data.job_description = ""),
        (this.data.job_requirements = ""),
        (this.data.job_type = ""),
        (this.data.job_salary_from = ""),
        (this.data.job_salary_to = ""),
        (this.data.job_min_experience = ""),
        (this.data.job_min_qualification = ""),
        (this.data.job_skills = ""),
        (this.data.job_work_location = ""),
        (this.data.job_opening_expiration = ""),
        this.$bvModal.hide(this.modalId);
    },
    isHomebasedChecked() {
      if (this.isHomebased == false) {
        this.data.job_work_location = "Home-based";
      } else {
        this.data.job_work_location = "";
      }
    },
  },
  watch: {
    sort() {
      this.getJobOpening();
    },
  },
};
</script>
