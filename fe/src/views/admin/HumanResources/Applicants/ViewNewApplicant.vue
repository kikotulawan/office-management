<template>
  <div class="container my-5">
    <div class="row">
      <div class="col-6">
        <h5 class="text-primary">Job Details</h5>
        <hr />
        <p>Job Title:</p>
        <h3 class="">{{ data.job_title }}</h3>
        <p class="fw-light mt-3">
          Description: <br /><span
            class="fw-normal"
            v-html="data.job_description"
          ></span>
        </p>
        <p class="fw-light mt-3">
          Job type: <span class="fw-bold ms-1">{{ data.job_type }}</span>
        </p>
        <p class="fw-light mt-1">
          Work Location:
          <span class="fw-bold ms-1">{{ data.job_work_location }}</span>
        </p>
        <h5 class="text-primary mt-5">Job Eligibility</h5>
        <hr />
        <p class="fw-light">
          Years of Work Experience: <br /><span class="fw-bold">{{
            data.job_min_experience
          }}</span>
        </p>
        <p class="fw-light mt-2">
          Qualification: <br /><span class="fw-bold">{{
            data.job_min_qualification
          }}</span>
        </p>
        <p class="fw-normal mt-2">
          Required Skills: <br /><span
            class="fw-normal"
            v-html="data.job_skills"
          ></span>
        </p>
        <div class="d-block mt-5">
          <button class="btn shadow-none btn-success me-1" @click="$bvModal.show('approveModal');"><i class="bi bi-check-lg me-2"></i>Approve</button>
          <button class="btn shadow-none btn-danger mx-1" @click="$bvModal.show('rejectModal');"><i class="bi bi-x-lg me-2"></i>Reject</button>
          <button class="btn shadow-none btn-dark mx-1" @click="$bvModal.show('blacklistModal');"><i class="bi bi-person-x-fill me-2"></i>Add to Blacklist</button>
        </div>
      </div>
      <div class="col-6">
        <h5 class="text-primary">Applicant Details</h5>
        <hr />
        <p class="fw-light">Applicant Name:</p>
        <h3 class="">
          {{ data.first_name }} {{ data.middle_name }} {{ data.last_name }}
        </h3>
        <p class="fw-light mt-3">
          Gender: <span class="fw-bold ms-1">{{ data.gender }}</span>
        </p>
        <p class="fw-light mt-1">
          Age: <span class="fw-bold ms-1">{{ data.age }}</span>
        </p>
        <p class="fw-light mt-2" v-if="data.contact_number">
          Contact Number:
          <span class="fw-bold ms-1">{{ data.contact_number }}</span>
        </p>
        <p class="fw-light mt-2">
          Email: <span class="fw-bold ms-1">{{ data.email }}</span>
        </p>
        <p class="fw-light mt-2">
          Address: <span class="fw-bold ms-1">{{ data.address }}</span>
        </p>
        <h5 class="text-primary mt-5">Educational Background</h5>
        <hr />
        <p class="fw-light" v-if="data.edu_tertiary">
          Tertiary: <span class="fw-bold ms-1">{{ data.edu_tertiary }}</span>
        </p>
        <p class="fw-light mt-2" v-if="data.edu_secondary">
          Secondary: <span class="fw-bold ms-1">{{ data.edu_secondary }}</span>
        </p>
        <p class="fw-light mt-2" v-if="data.edu_primary">
          Primary: <span class="fw-bold ms-1">{{ data.edu_primary }}</span>
        </p>
        <p
          class="fw-bold mt-2 text-danger"
          v-if="!data.edu_primary && !data.edu_secondary && !data.edu_tertiary"
        >
          No Education Background
        </p>
        <h5 class="text-primary mt-5">Skills Summary</h5>
        <hr />
        <p class="fw-light" v-if="data.skills">
          <span class="fw-normal ms-1" v-html="data.skills"></span>
        </p>
        <p class="fw-bold text-danger" v-if="!data.skills">
          Applicant have no skills
        </p>
        <h5 class="text-primary mt-5">Seminars and Trainings</h5>
        <hr />
        <p class="fw-light" v-if="data.seminars_trainings">
          <span class="fw-normal ms-1" v-html="data.seminars_trainings"></span>
        </p>
        <p class="fw-bold text-danger" v-if="!data.seminars_trainings">
          Applicant have no attended seminars nor trainings
        </p>
        <h5 class="text-primary mt-5">Work Experiences</h5>
        <hr />
        <p class="fw-light" v-if="data.work_experiences">
          <span class="fw-normal ms-1" v-html="data.work_experiences"></span>
        </p>
        <p class="fw-bold text-danger" v-if="!data.work_experiences">
          Applicant have no work experience yet
        </p>
      </div>
    </div>

    <b-modal id="approveModal" centered title="Approved - Schedule an interview">
      <p>Please select interview date</p>
      <input type="date" class="form-control">
      <p class="mt-2">Assign interviewer</p>
      <select class="form-select">
        <option value="">Select</option>
      </select>
      <template #modal-footer="{ cancel }">
        <b-button variant="secondary" @click="cancel()" :disabled="isLoading">
          Cancel
        </b-button>
        <b-button
          variant="success"
          v-on:click.prevent=""
          :disabled="isLoading"
        >
          Confirm
        </b-button>
      </template>
    </b-modal>

    <b-modal id="rejectModal" centered title="Reject">
      <p>Are you sure to reject applicant?</p>
      <template #modal-footer="{ cancel }">
        <b-button variant="secondary" @click="cancel()" :disabled="isLoading">
          Cancel
        </b-button>
        <b-button
          variant="danger"
          v-on:click.prevent=""
          :disabled="isLoading"
        >
          Confirm
        </b-button>
      </template>
    </b-modal>

    <b-modal id="blacklistModal" centered title="Reject">
      <p>Applicant will be moved to blacklist. Are you sure?</p>
      <template #modal-footer="{ cancel }">
        <b-button variant="secondary" @click="cancel()" :disabled="isLoading">
          Cancel
        </b-button>
        <b-button
          variant="danger"
          v-on:click.prevent=""
          :disabled="isLoading"
        >
          Confirm
        </b-button>
      </template>
    </b-modal>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import moment from "moment";
export default {
  data() {
    return {
      isLoading: false,
      addComment: false,
      scrollpx: 0,
      data: {
        job_title: "",
        job_skills: "",
        job_description: "",
        job_type: "",
        job_min_experience: "",
        job_min_qualification: "",
        job_work_location: "",
        first_name: "",
        middle_name: "",
        last_name: "",
        gender: "",
        age: "",
        birthday: "",
        contact_number: "",
        address: "",
        email: "",
        skills: "",
        edu_tertiary: "",
        edu_secondary: "",
        edu_primary: "",
        seminars_trainings: "",
        work_experiences: "",
      },
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
    document.title =
      "New Applicant - " +
      this.view_new_applicant.data.user.info.first_name +
      " " +
      this.view_new_applicant.data.user.info.last_name;
    await this.$store.dispatch("auth/checkUser"),
      (this.data = {
        id: this.view_new_applicant.id,
        job_title: this.view_new_applicant.data.jobapplied.job_title,
        job_description: this.view_new_applicant.data.jobapplied
          .job_description,
        job_skills: this.view_new_applicant.data.jobapplied.job_skills,
        job_type: this.view_new_applicant.data.jobapplied.job_type,
        job_work_location: this.view_new_applicant.data.jobapplied
          .job_work_location,
        job_min_experience: this.view_new_applicant.data.jobapplied
          .job_min_experience,
        job_min_qualification: this.view_new_applicant.data.jobapplied
          .job_min_qualification,
        first_name: this.view_new_applicant.data.user.info.first_name,
        middle_name: this.view_new_applicant.data.user.info.middle_name,
        last_name: this.view_new_applicant.data.user.info.last_name,
        gender: this.view_new_applicant.data.user.info.gender,
        age: this.view_new_applicant.data.user.info.age,
        birthday: this.view_new_applicant.data.user.info.birthday,
        contact_number: this.view_new_applicant.data.user.info.contact_number,
        address: this.view_new_applicant.data.user.info.address,
        email: this.view_new_applicant.data.user.email,
        edu_tertiary: this.view_new_applicant.data.user.info.edu_tertiary,
        edu_secondary: this.view_new_applicant.data.user.info.edu_secondary,
        edu_primary: this.view_new_applicant.data.user.info.edu_primary,
        skills: this.view_new_applicant.data.user.info.skills,
        seminars_trainings: this.view_new_applicant.data.user.info
          .seminars_trainings,
        work_experiences: this.view_new_applicant.data.user.info
          .work_experiences,
      });
  },
  computed: {
    ...mapState("applicant", ["view_new_applicant"]),
  },
};
</script>
