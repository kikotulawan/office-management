<template>
  <div class="container my-5">
    <h5 class="text-primary">Applicant Details</h5>
    <hr>
    <h5 class="fw-light">Applicant Name:</h5>
    <h3 class="mt-1">{{data.first_name}} {{data.middle_name}} {{data.last_name}}</h3>
    <p class="fw-light mt-4">Gender: <span class="fw-bold ms-1">{{data.gender}}</span></p>
    <p class="fw-light mt-2">Age: <span class="fw-bold ms-1">{{data.age}}</span></p>
    <p class="fw-light mt-2">Birthday: <span class="fw-bold ms-1">{{data.birthday | moment}}</span></p>
    <p class="fw-light mt-4" v-if="data.contact_number">Contact Number: <span class="fw-bold ms-1">{{data.contact_number}}</span></p>
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
        skills: '',
        edu_tertiary: '',
        edu_secondary: '',
        edu_primary: '',
        seminars_trainings: '',
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
    document.title = "Applicant - " + this.view_applicant.data.user.info.first_name + " " + this.view_applicant.data.user.info.last_name 
    await this.$store.dispatch("auth/checkUser"),
      (this.data = {
        id: this.view_applicant.id,
        first_name: this.view_applicant.data.user.info.first_name,
        middle_name: this.view_applicant.data.user.info.middle_name,
        last_name: this.view_applicant.data.user.info.last_name,
        gender: this.view_applicant.data.user.info.gender,
        age: this.view_applicant.data.user.info.age,
        birthday: this.view_applicant.data.user.info.birthday,
        contact_number: this.view_applicant.data.user.info.contact_number,
        address: this.view_applicant.data.user.info.address,
        email: this.view_applicant.data.user.email,
        edu_tertiary: this.view_applicant.data.user.info.edu_tertiary,
        edu_secondary: this.view_applicant.data.user.info.edu_secondary,
        edu_primary: this.view_applicant.data.user.info.edu_primary,
        skills: this.view_applicant.data.user.info.skills,
        seminars_trainings: this.view_applicant.data.user.info.seminars_trainings,
      });
  },
  computed: {
    ...mapState("applicant", ["view_applicant"]),
  },
};
</script>