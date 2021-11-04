<template>
  <div class="container mb-5">
    <div class="loader d-flex justify-content-center align-items-center" v-if="isLoading">
      <div class="spinner-grow text-dark spinner-grow-lg" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    <div class="applicant-data-container" v-if="!isLoading">
      <div class="card p-5">
        <div class="d-flex">

    <router-link to="/home/human-resources/applicants/allapplicants" class="btn btn-primary mb-4"><i class="bi bi-arrow-left-short me-2"></i>Return</router-link>
        </div>

    <h5 class="text-primary">Applicant Details</h5>
    <hr>
    <h5 class="fw-light">Applicant Name:</h5>
    <h3 class="mt-1">{{data.first_name}} {{data.middle_name}} {{data.last_name}}, {{data.age}}</h3>
    <!-- <p class="fw-light mt-4">Application Status: <span class="fw-bold ms-1">{{data.application_status}}</span></p> -->
    <p class="fw-light mt-4">Gender: <span class="fw-bold ms-1">{{data.gender}}</span></p>
    <p class="fw-light mt-2">Birthday: <span class="fw-bold ms-1">{{data.birthday | moment}}</span></p>
    <p class="fw-light mt-4" v-if="data.contact_number">Contact Number: <span class="fw-bold ms-1">{{data.contact_number}}</span></p>
    <p class="fw-light mt-2" v-if="data.civil_status">Civil Status: <span class="fw-bold ms-1">{{data.civil_status}}</span></p>
    <p class="fw-light mt-2" v-if="data.nationality">Nationality: <span class="fw-bold ms-1">{{data.nationality}}</span></p>
    <p class="fw-light mt-2">Email: <span class="fw-bold ms-1">{{data.email}}</span></p>
    <p class="fw-light mt-2">Address: <span class="fw-bold ms-1">{{data.address}}</span></p>
    <h5 class="text-primary mt-5">Educational Background</h5>
    <hr>
    <p class="fw-light" v-if="data.edu_tertiary">Tertiary: <span class="fw-bold ms-1">{{data.edu_tertiary}}</span></p>
    <p class="fw-light mt-2" v-if="data.edu_secondary">Secondary: <span class="fw-bold ms-1">{{data.edu_secondary}}</span></p>
    <p class="fw-light mt-2" v-if="data.edu_primary">Primary: <span class="fw-bold ms-1">{{data.edu_primary}}</span></p>
    <p class="fw-bold mt-2 text-danger" v-if="!data.edu_primary && !data.edu_secondary && !data.edu_tertiary">No Education Background</p>
    <h5 class="text-primary mt-5">Skills Summary</h5>
    <hr>
    <p class="fw-light" v-if="data.skills"><span class="fw-normal ms-1" v-html="data.skills"></span></p>
    <p class="fw-bold text-danger" v-if="!data.skills">Applicant have no skills</p>
    <h5 class="text-primary mt-5">Seminars and Trainings</h5>
    <hr>
    <p class="fw-light" v-if="data.seminars_trainings"><span class="fw-normal ms-1" v-html="data.seminars_trainings"></span></p>
    <p class="fw-bold text-danger" v-if="!data.seminars_trainings">Applicant have no attended seminars nor trainings</p>
    <br>
    <div class="d-inline-flex mt-3">
    <h5 class="text-primary mt-1 me-3">Comments</h5>
    <label class="btn btn-sm shadow-none btn-primary" for="btn-check" v-if="!addComment">Add Comment</label>
    </div>
    <hr>
    <p class="fw-bold text-danger" v-if="!addComment">No comments</p>
    <textarea v-if="addComment" class="form-control mt-2" rows="5" placeholder="Type your comment here"></textarea>
    <input type="checkbox" v-model="addComment" class="btn-check" id="btn-check" autocomplete="off" />
    <label class="btn shadow-none btn-danger mt-4" for="btn-check" v-if="addComment">Cancel</label>
    <button v-if="addComment" class="btn btn-success ms-2 mt-4">Comment</button>
      </div>
    </div>
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
        first_name: '',
        middle_name: '',
        last_name: '',
        gender: '',
        age: '',
        birthday: '',
        contact_number: '',
        address: '',
        email: '',
        civil_status: '',
        nationality: '',
        skills: '',
        edu_tertiary: '',
        edu_secondary: '',
        edu_primary: '',
        seminars_trainings: '',
        application_status: '',
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
  created(){
    document.title = ("Applicant - " + this.view_applicant.data.user.info.first_name + " " + this.view_applicant.data.user.info.last_name)
  },
  async mounted() {
    this.isLoading = true
    await this.$store.dispatch("auth/checkAuthUser"),
      this.data = {
        id: this.view_applicant.id,
        application_status: this.view_applicant.data.status,
        first_name: this.view_applicant.data.user.info.first_name,
        middle_name: this.view_applicant.data.user.info.middle_name,
        last_name: this.view_applicant.data.user.info.last_name,
        gender: this.view_applicant.data.user.info.gender,
        age: this.view_applicant.data.user.info.age,
        civil_status: this.view_applicant.data.user.info.civil_status,
        nationality: this.view_applicant.data.user.info.nationality,
        birthday: this.view_applicant.data.user.info.birthday,
        contact_number: this.view_applicant.data.user.info.contact_number,
        address: this.view_applicant.data.user.info.address,
        email: this.view_applicant.data.user.email,
        edu_tertiary: this.view_applicant.data.user.info.edu_tertiary,
        edu_secondary: this.view_applicant.data.user.info.edu_secondary,
        edu_primary: this.view_applicant.data.user.info.edu_primary,
        skills: this.view_applicant.data.user.info.skills,
        seminars_trainings: this.view_applicant.data.user.info.seminars_trainings,
      };
    this.isLoading = false
  },
  computed: {
    ...mapState("applicant", ["view_applicant"]),
  },
};
</script>