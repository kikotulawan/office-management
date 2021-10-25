<template>
  <div class="container my-5">
    <h5 class="text-primary">Applicant Details</h5>
    <hr>
    <h5 class="fw-light">Applicant Name:</h5>
    <h3 class="mt-1">{{data.first_name}} {{data.middle_name}} {{data.last_name}}</h3>
    <p class="fw-light mt-4">Gender: <span class="fw-bold ms-1">{{data.gender}}</span></p>
    <p class="fw-light mt-2">Age: <span class="fw-bold ms-1">{{data.age}}</span></p>
    <p class="fw-light mt-2">Birthday: <span class="fw-bold ms-1">{{data.birthday | moment}}</span></p>
    <p class="fw-light mt-4">Contact Number: <span class="fw-bold ms-1">{{data.contact_number}}</span></p>
    <p class="fw-light mt-2">Email: <span class="fw-bold ms-1">{{data.email}}</span></p>
    <p class="fw-light mt-2">Address: <span class="fw-bold ms-1">{{data.address}}</span></p>
    <h5 class="text-primary mt-5">Educational Background</h5>
    <hr>
    <p class="fw-light">Tertiary: <span class="fw-bold ms-1">Leyte Normal University, Bachelor of Arts and Sciences in Information Technology, S.Y. 2018-2021</span></p>
    <p class="fw-light mt-2">Secondary: <span class="fw-bold ms-1">Leyte National Highschool, S.Y. 2014-2018</span></p>
    <p class="fw-light mt-2">Primary: <span class="fw-bold ms-1">Mother of Christ Montesorri School, S.Y. 2010-2014</span></p>
    <h5 class="text-primary mt-5">Skills Summary</h5>
    <hr>
    <p class="fw-light">-<span class="fw-bold ms-1">Advance knowledge in Graphic Designing</span></p>
    <h5 class="text-primary mt-5">Seminars and Trainings</h5>
    <hr>
    <p class="fw-light">-<span class="fw-bold ms-1">OJT PRE-DEPLOYMENT ORIENTATION</span></p>
    <br>
    <input type="checkbox" v-model="addComment" class="btn-check" id="btn-check" autocomplete="off" />
    <label class="btn shadow-none btn-primary mt-2" for="btn-check" v-if="!addComment">Add Comment</label>
    <label class="btn shadow-none btn-danger mt-2" for="btn-check" v-if="addComment">Cancel</label>
    <button v-if="addComment" class="btn btn-success ms-2 mt-2">Comment</button>
    <textarea v-if="addComment" class="form-control mt-2" rows="5" placeholder="Type your comment here"></textarea>
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
      });
  },
  computed: {
    ...mapState("applicant", ["view_applicant"]),
  },
};
</script>