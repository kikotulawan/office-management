<template>
  <div class="container mt-4 mb-5">
      <h5 class="fw-bold mb-2">Welcome, {{user.info.first_name}} {{user.info.last_name}}</h5>
      <p>You can manage you account below, complete all fields to get a higher chance of getting employed.</p>
        <div class="d-block mt-4">
         <input type="checkbox" v-model="isDisabled" class="btn-check" id="btn-check" autocomplete="off" />
         <label class="btn shadow-none btn-primary" for="btn-check" v-if="!isDisabled">Update Profile</label>
         <label class="btn shadow-none btn-danger" for="btn-check" v-if="isDisabled">Cancel</label>
         <button class="btn shadow-none btn-success ms-3" v-if="isDisabled">Save Profile</button>
        </div>
      <hr>
      <div class="col-12 col-sm-12 col-md-8 col-lg-10 col-xl-10 mt-5" >
        <h5 class="fw-bold text-primary">Your Basic Information</h5>
        <div class="mb-3 mt-4 row">
           <label class="col-sm-2 col-form-label">First Name:</label>
           <div class="col-sm-10">
            <input v-model="user.info.first_name" type="text" class="form-control" :disabled="!isDisabled">
           </div>
        </div>
        <div class="mb-3 mt-3 row">
           <label class="col-sm-2 col-form-label">Middle Name:</label>
           <div class="col-sm-10">
            <input v-model="user.info.middle_name" type="text" class="form-control" :disabled="!isDisabled">
           </div>
        </div>
        <div class="mb-3 mt-3 row">
           <label class="col-sm-2 col-form-label">Last Name:</label>
           <div class="col-sm-10">
            <input v-model="user.info.last_name" type="text" class="form-control" :disabled="!isDisabled">
           </div>
        </div>
        <div class="mb-3 mt-3 row">
           <label class="col-sm-2 col-form-label">Age:</label>
           <div class="col-sm-10">
            <input v-model="user.info.age" type="number" class="form-control" :disabled="!isDisabled">
           </div>
        </div>
        <div class="mb-3 mt-3 row">
           <label class="col-sm-2 col-form-label">Birthday:</label>
           <div class="col-sm-10">
            <input v-model="user.info.birthday" type="date" class="form-control" :disabled="!isDisabled">
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
        <!-- --------------------------------------------------------- -->
        <h5 class="fw-bold text-primary mt-5">Your Contact Info</h5>
        <div class="mb-3 mt-4 row">
           <label class="col-sm-2 col-form-label">Contact Number:</label>
           <div class="col-sm-10">
            <input v-model="user.info.contact_number" type="number" class="form-control" :disabled="!isDisabled">
           </div>
        </div>
        <p class="fw-bold mt-4 text-danger"><small>In case of emergency</small></p>
        <div class="mb-3 mt-3 row">
           <label class="col-sm-2 col-form-label">Emergency Contact Person:</label>
           <div class="col-sm-10">
            <input v-model="user.info.emergency_contact_person" type="text" class="form-control" :disabled="!isDisabled">
           </div>
        </div>
        <div class="mb-3 mt-3 row">
           <label class="col-sm-2 col-form-label">Emergency Contact Number:</label>
           <div class="col-sm-10">
            <input v-model="user.info.emergency_contact_number" type="number" class="form-control" :disabled="!isDisabled">
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
        <h5 class="fw-bold text-primary mt-5">Documents</h5>
        <p>Please check box if you have the specific document</p>
        <div class="mb-5 mt-3 row ms-1">
           <div class="form-check">
                <input class="form-check-input cursor-pointer" type="checkbox" value="" :disabled="!isDisabled">
                <label class="form-check-label">
                    PSA Birth Certificate
                </label>
            </div>
           <div class="form-check mt-1">
                <input class="form-check-input cursor-pointer" type="checkbox" value="" :disabled="!isDisabled">
                <label class="form-check-label">
                    NBI Clearance
                </label>
            </div>
           <div class="form-check mt-1">
                <input class="form-check-input cursor-pointer" type="checkbox" value="" :disabled="!isDisabled">
                <label class="form-check-label">
                    PAG-IBIG
                </label>
            </div>
           <div class="form-check mt-1">
                <input class="form-check-input cursor-pointer" type="checkbox" value="" :disabled="!isDisabled">
                <label class="form-check-label">
                    SSS
                </label>
            </div>
           <div class="form-check mt-1">
                <input class="form-check-input cursor-pointer" type="checkbox" value="" :disabled="!isDisabled">
                <label class="form-check-label">
                    Philhealth
                </label>
            </div>
           <div class="form-check mt-1">
                <input class="form-check-input cursor-pointer" type="checkbox" value="" :disabled="!isDisabled">
                <label class="form-check-label">
                    Tax Forms
                </label>
            </div>
           <div class="form-check mt-1">
                <input class="form-check-input cursor-pointer" type="checkbox" value="" :disabled="!isDisabled">
                <label class="form-check-label">
                    Diploma and Transcript of Records
                </label>
            </div>
            <p class="mt-3 ms-0 p-0"><span class="text-danger">Note: </span>Documents must be updated.</p>
        </div>
      </div>
  </div>
  <!-- ADD FIELD FOR NATIONALITY -->
  <!-- ADD FIELD FOR CIVIL STATUS -->
  <!-- ADD FIELD FOR BIRTHPLACE -->
  <!-- ADD FIELD FOR CHARACTER REFERENCES -->
  <!-- ADD FIELD FOR EDUCATION: TERTIARY, SECONDARY, PRIMARY -->
  <!-- ADD TEXT-AREA USING VUE-EDITOR FOR SKILLS AND SUMMARY -->
  <!-- ADD TEXT-AREA USING VUE-EDITOR FOR SEMINARS AND TRAINING -->
  <!-- ADD TEXT-AREA USING VUE-EDITOR FOR APPLICANT OBJECTIVES -->
  <!-- REMOVE REQUIREMENTS CHECKBOXES -->
</template>

<script>
import { mapActions, mapState } from 'vuex'
export default {
    data(){
        return {
            isDisabled: false
        }
    },
    async mounted() {
        document.title = 'eOffice - Job Opening'
        await this.$store.dispatch('auth/checkAuthUser')
    },
    methods: {},
    computed: {
        ...mapState('auth', ['user']),
    },
}
</script>

<style scoped>
    .form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
    border: 0;
    border-bottom: solid 1px #000;
    border-radius: 0;
    opacity: 1;
}
    .form-select:disabled, .form-select[readonly] {
    background-color: #ffffff;
    border: 0;
    opacity: 1;
    background-image: none;
}
</style>