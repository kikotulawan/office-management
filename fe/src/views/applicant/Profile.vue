<template>
 <div class="container pb-5 mt-4">
  <h5 class="fw-bold mb-2">Welcome, {{ user.info.first_name }} {{ user.info.last_name }}</h5>
  <p>You can manage you account below, complete all fields to get a higher chance of getting employed.</p>
  <div class="d-block mt-4">
   <input type="checkbox" v-model="isDisabled" class="btn-check" id="btn-check" autocomplete="off" />
   <label class="btn shadow-none btn-primary" for="btn-check" v-if="!isDisabled">Update Profile</label>
   <label class="btn shadow-none btn-danger" for="btn-check" v-if="isDisabled">Cancel</label>
   <button class="btn shadow-none btn-success ms-3" v-if="isDisabled">Save Profile</button>
  </div>
  <hr />
  <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10 mt-5">
   <h5 class="fw-bold text-primary">Your Basic Information</h5>
   <div class="mb-3 mt-4 row">
    <label class="col-sm-2 col-form-label">First Name:</label>
    <div class="col-sm-10">
     <input v-model="user.info.first_name" type="text" class="form-control" :disabled="!isDisabled" />
    </div>
   </div>
   <div class="mb-3 mt-3 row">
    <label class="col-sm-2 col-form-label">Middle Name:</label>
    <div class="col-sm-10">
     <input v-model="user.info.middle_name" type="text" class="form-control" :disabled="!isDisabled" />
    </div>
   </div>
   <div class="mb-3 mt-3 row">
    <label class="col-sm-2 col-form-label">Last Name:</label>
    <div class="col-sm-10">
     <input v-model="user.info.last_name" type="text" class="form-control" :disabled="!isDisabled" />
    </div>
   </div>
   <div class="mb-3 mt-3 row">
    <label class="col-sm-2 col-form-label">Age:</label>
    <div class="col-sm-10">
     <input v-model="user.info.age" type="number" class="form-control" :disabled="!isDisabled" />
    </div>
   </div>
   <div class="mb-3 mt-3 row">
    <label class="col-sm-2 col-form-label">Birthday:</label>
    <div class="col-sm-10">
     <input v-model="user.info.birthday" type="date" class="form-control" :disabled="!isDisabled" />
    </div>
   </div>
   <div class="mb-3 mt-3 row">
    <label class="col-sm-2 col-form-label">Birthplace:</label>
    <div class="col-sm-10">
     <input v-model="user.info.birthplace" type="text" class="form-control" :disabled="!isDisabled" />
    </div>
   </div>
   <div class="mb-3 mt-3 row">
    <label class="col-sm-2 col-form-label">Gender:</label>
    <div class="col-sm-10">
     <select v-model="user.info.gender" class="form-select" :disabled="!isDisabled">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
     </select>
    </div>
   </div>
   <div class="mb-3 mt-3 row">
    <label class="col-sm-2 col-form-label">Nationality:</label>
    <div class="col-sm-10">
     <input v-model="user.info.nationality" type="text" class="form-control" :disabled="!isDisabled" />
    </div>
   </div>
   <div class="mb-3 mt-3 row">
    <label class="col-sm-2 col-form-label">Civil Status:</label>
    <div class="col-sm-10">
     <select v-model="user.info.civil_status" class="form-select" :disabled="!isDisabled">
      <option value="Single">Single</option>
      <option value="Married">Married</option>
      <option value="Divorced">Divorced</option>
      <option value="Widowed">Widowed</option>
     </select>
    </div>
   </div>
   <!-- --------------------------------------------------------- -->
   <h5 class="fw-bold text-primary mt-5">Your Contact Info</h5>
   <div class="mb-3 mt-4 row">
    <label class="col-sm-2 col-form-label">Contact Number:</label>
    <div class="col-sm-10">
     <input v-model="user.info.contact_number" type="number" class="form-control" :disabled="!isDisabled" />
    </div>
   </div>
   <p class="fw-bold mt-4 text-danger"><small>In case of emergency</small></p>
   <div class="mb-3 mt-3 row">
    <label class="col-sm-2 col-form-label">Emergency Contact Person:</label>
    <div class="col-sm-10">
     <input v-model="user.info.emergency_contact_person" type="text" class="form-control" :disabled="!isDisabled" />
    </div>
   </div>
   <div class="mb-3 mt-3 row">
    <label class="col-sm-2 col-form-label">Emergency Contact Number:</label>
    <div class="col-sm-10">
     <input v-model="user.info.emergency_contact_number" type="number" class="form-control" :disabled="!isDisabled" />
    </div>
   </div>
   <!-- --------------------------------------------------------- -->
   <h5 class="fw-bold text-primary mt-5">Your Current Address</h5>
   <p>Please indicate your real and current address</p>
   <div class="mb-3 mt-4 row">
    <label class="col-sm-2 col-form-label">Address:</label>
    <div class="col-sm-10">
     <textarea v-model="user.info.address" type="text" class="form-control" :disabled="!isDisabled"></textarea>
    </div>
   </div>
   <!-- --------------------------------------------------------- -->
   <h5 class="fw-bold text-primary mt-5">Education</h5>
   <p>Please include school/university name and school year</p>
   <div class="mb-3 mt-4 row">
    <label class="col-sm-2 col-form-label">Tertiary:</label>
    <div class="col-sm-10">
     <input v-model="user.info.edu_tertiary" type="text" class="form-control" placeholder="e.g. Unibersidad ng Manila, Philippines, S.Y. 2018-2021" :disabled="!isDisabled" />
    </div>
   </div>
   <div class="mb-3 mt-3 row">
    <label class="col-sm-2 col-form-label">Secondary:</label>
    <div class="col-sm-10">
     <input v-model="user.info.edu_secondary" type="text" class="form-control" placeholder="e.g. Manila National Highschool, Philippines, S.Y. 2014-2018" :disabled="!isDisabled" />
    </div>
   </div>
   <div class="mb-3 mt-3 row">
    <label class="col-sm-2 col-form-label">Primary:</label>
    <div class="col-sm-10">
     <input v-model="user.info.edu_primary" type="text" class="form-control" placeholder="e.g. Manila Elementary School, Philippines, S.Y. 2008-2014" :disabled="!isDisabled" />
    </div>
   </div>
   <!-- --------------------------------------------------------- -->
   <h5 class="fw-bold text-primary mt-5">Your Skills</h5>
   <p>Please use bullet form if many</p>
   <div class="mb-3 mt-4">
    <vue-editor :disabled="!isDisabled" v-model="user.info.skills" :editorToolbar="customToolbar"></vue-editor>
   </div>
   <!-- --------------------------------------------------------- -->
   <h5 class="fw-bold text-primary mt-5">Seminars and Trainings Attended</h5>
   <p>Please use bullet form if many</p>
   <div class="mb-3 mt-4">
    <vue-editor :disabled="!isDisabled" v-model="user.info.seminars_trainings" :editorToolbar="customToolbar"></vue-editor>
   </div>
   <!-- --------------------------------------------------------- -->
   <h5 class="fw-bold text-primary mt-5">Work Experiences</h5>
   <p>Please use bullet form if many</p>
   <div class="mb-3 mt-4">
    <vue-editor :disabled="!isDisabled" v-model="user.info.work_experiences" :editorToolbar="customToolbar"></vue-editor>
   </div>
  </div>
 </div>
 <!-- ADD FIELD FOR CHARACTER REFERENCES -->
 <!-- ADD TEXT-AREA USING VUE-EDITOR FOR SKILLS AND SUMMARY -->
 <!-- ADD TEXT-AREA USING VUE-EDITOR FOR SEMINARS AND TRAINING -->
 <!-- ADD TEXT-AREA USING VUE-EDITOR FOR APPLICANT OBJECTIVES -->
 <!-- REMOVE REQUIREMENTS CHECKBOXES -->
</template>

<script>
 import { mapActions, mapState } from 'vuex';
 import { VueEditor } from 'vue2-editor';
 export default {
  components: {
   VueEditor,
  },
  data() {
   return {
    isDisabled: false,
    customToolbar: [
     ['bold', 'italic', 'underline'],
     [{ list: 'ordered' }, { list: 'bullet' }],
    ],
   };
  },
  async mounted() {
   document.title = 'eOffice - Job Opening';
   await this.$store.dispatch('auth/checkAuthUser');
  },
  methods: {},
  computed: {
   ...mapState('auth', ['user']),
  },
 };
</script>

<style scoped>
 .form-control:disabled,
 .form-control[readonly] {
  background-color: #ffffff;
  border: 0;
  border-bottom: solid 1px #000;
  border-radius: 0;
  opacity: 1;
 }
 .form-select:disabled,
 .form-select[readonly] {
  background-color: #ffffff;
  border: 0;
  border-bottom: solid 1px #000;
  border-radius: 0;
  opacity: 1;
  background-image: none;
 }
</style>
