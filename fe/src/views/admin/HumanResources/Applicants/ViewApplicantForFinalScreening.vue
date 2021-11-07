<template>
 <div class="container pb-5">
  <div class="loader d-flex justify-content-center align-items-center" v-if="isLoading">
   <div class="spinner-grow text-dark spinner-grow-lg" role="status">
    <span class="visually-hidden">Loading...</span>
   </div>
  </div>
  <div class="row" v-if="!isLoading">
   <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
    <div class="card p-5 mt-4">
     <div class="applicant-data-container">
      <router-link to="/home/human-resources/applicants/finalscreening" class="btn btn-primary mb-3"><i class="bi bi-arrow-left-short me-2"></i>Return</router-link>
      <h5 class="text-center fw-light">Applicant Details</h5>
      <hr />
      <p class="">
       Applicant Name: <span class="fw-bold ms-1">{{ data.first_name }} {{ data.middle_name }} {{ data.last_name }}</span>
      </p>
      <!-- <p class="fw-light mt-4">Application Status: <span class="fw-bold ms-1">{{data.application_status}}</span></p> -->
      <p class="fw-light mt-2">
       Gender: <span class="fw-bold ms-1">{{ data.gender }}</span>
      </p>
      <p class="fw-light mt-2">
       Age: <span class="fw-bold ms-1">{{ data.age }}</span>
      </p>
      <p class="fw-light mt-2">
       Birthday: <span class="fw-bold ms-1">{{ data.birthday | moment }}</span>
      </p>
      <p class="fw-light mt-2" v-if="data.contact_number">
       Contact Number: <span class="fw-bold ms-1">{{ data.contact_number }}</span>
      </p>
      <p class="fw-light mt-2" v-if="data.civil_status">
       Civil Status: <span class="fw-bold ms-1">{{ data.civil_status }}</span>
      </p>
      <p class="fw-light mt-2" v-if="data.nationality">
       Nationality: <span class="fw-bold ms-1">{{ data.nationality }}</span>
      </p>
      <p class="fw-light mt-2">
       Email: <span class="fw-bold ms-1">{{ data.email }}</span>
      </p>
      <p class="fw-light mt-2">
       Address: <span class="fw-bold ms-1">{{ data.address }}</span>
      </p>
      <h5 class="text-center fw-light mt-5">Educational Background</h5>
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
      <p class="mt-2 text-danger text-center" v-if="!data.edu_primary && !data.edu_secondary && !data.edu_tertiary">No Education Background</p>
      <h5 class="text-center fw-light mt-5">Skills Summary</h5>
      <hr />
      <p class="fw-light" v-if="data.skills"><span class="fw-normal ms-1" v-html="data.skills"></span></p>
      <p class="text-center text-danger" v-if="!data.skills">Applicant have no skills</p>
      <h5 class="text-center fw-light mt-5">Seminars and Trainings</h5>
      <hr />
      <p class="fw-light" v-if="data.seminars_trainings"><span class="fw-normal ms-1" v-html="data.seminars_trainings"></span></p>
      <p class="text-center text-danger" v-if="!data.seminars_trainings">Applicant have no attended seminars nor trainings</p>

      <h5 class="text-center fw-light mt-5">Job Details</h5>
      <hr />
      <p>
       Job Title: <span class="fw-bold ms-1">{{ data.job_title }}</span>
      </p>
      <p class="fw-light mt-3">Description: <br /><span class="fw-normal" v-html="data.job_description"></span></p>
      <p class="fw-light mt-3">
       Job type: <span class="fw-bold ms-1">{{ data.job_type }}</span>
      </p>
      <p class="fw-light mt-1">
       Work Location:
       <span class="fw-bold ms-1">{{ data.job_work_location }}</span>
      </p>
      <h5 class="text-center fw-light mt-5">Job Eligibility</h5>
      <hr />
      <p class="fw-light">
       Years of Work Experience: <span class="fw-bold ms-1">{{ data.job_min_experience }}</span>
      </p>
      <p class="fw-light mt-2">
       Qualification: <span class="fw-bold ms-1">{{ data.job_min_qualification }}</span>
      </p>
      <p class="fw-normal mt-2">Required Skills: <br /><span class="fw-bold" v-html="data.job_skills"></span></p>
     </div>
    </div>
   </div>

   <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 pt-2">
    <div class="card p-5 mt-3">
     <h5 class="text-center fw-light">Interview Evaluation Result</h5>
     <hr />
     <p class="fw-bold text-center">REMARKS</p>
     <p class="fw-bold mt-5">Communication Skills</p>
     <p class="mt-1">{{ data.remark1 }}</p>
     <p class="fw-bold mt-4">Work Experiences</p>
     <p class="mt-1">{{ data.remark2 }}</p>
     <p class="fw-bold mt-4">Job Related Skills</p>
     <p class="mt-1">{{ data.remark3 }}</p>
     <p class="fw-bold mt-4">Education Background and Training</p>
     <p class="mt-1">{{ data.remark4 }}</p>
     <p class="fw-bold mt-4">Interviewer Remark</p>
     <p class="mt-1">{{ data.remarks }}</p>
     <p class="mt-5 text-center">
      Applicant Overall Interview Rating: <span class="ms-1 fw-bold">{{ data.total }} / 5</span>
     </p>
     <p class="mt-2 text-center">
      Evaluation Date Submitted: <span class="ms-1 fw-bold">{{ data.eval_date | moment }}</span>
     </p>
     <p class="mt-2 text-center">
      Interviewer: <span class="ms-1 fw-bold">{{ data.assigned_interviewer }}</span>
     </p>
     <div class="d-inline-flex justify-content-center align-items-center mt-5">
      <button class="btn shadow-none btn-primary" @click="$bvModal.show('onboardingModal')">Move to onboarding</button>
      <button class="btn shadow-none btn-danger ms-3">Reject</button>
     </div>
    </div>
   </div>
  </div>

  <b-modal id="onboardingModal" centered title="Applicant Onboarding">
   <p class="text-center p-4">Are you sure to move candidate to onboarding?</p>
   <template #modal-footer="{ cancel }">
    <b-button variant="secondary" @click="cancel()" :disabled="isLoading">
     Cancel
    </b-button>
    <b-button variant="success" v-on:click.prevent="" :disabled="isLoading" @click="confirmSubmit">
     Confirm
    </b-button>
   </template>
  </b-modal>
 </div>
</template>

<script>
 import { mapActions, mapState } from 'vuex';
 import moment from 'moment';
 export default {
  data() {
   return {
    isLoading: false,
    addComment: false,
    scrollpx: 0,
    data: {
     int_id: '',
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
     assigned_interviewer: '',
     job_title: '',
     job_skills: '',
     job_description: '',
     job_type: '',
     job_min_experience: '',
     job_min_qualification: '',
     job_work_location: '',
     int_schedule: '',
     user_id: '',
     job_applied_id: '',
     remark1: '',
     communication_skills: 0,
     experience: 0,
     remarks: '',
     remark2: '',
     remark4: '',
     remark3: '',
     job_related_skills: 0,
     education_training: 0,
     total: 0,
     eval_date: '',
    },
    remarks: '',
    sort: 'asc',
    modalId: '',
    approved: false,
    communication_skills: 0,
    experience: 0,
    job_related_skills: 0,
    education_training: 0,
    total: 0,
   };
  },
  filters: {
   moment: function(date) {
    return moment(date).format('MMMM D, YYYY @ hh:mm A');
   },
  },
  created() {},
  async mounted() {
   this.isLoading = true;
   this.tabs = false;
   await this.$store.dispatch('auth/checkAuthUser');
   this.data = {
    eval_date: this.view_fs_applicant.data.interview.created_at,
    remarks: this.view_fs_applicant.data.interview.comment,
    remark1: this.view_fs_applicant.data.interview.remark1,
    remark2: this.view_fs_applicant.data.interview.remark2,
    remark3: this.view_fs_applicant.data.interview.remark3,
    communication_skills: this.view_fs_applicant.data.interview.communication_skills,
    total: this.view_fs_applicant.data.interview.total_rating,
    remark4: this.view_fs_applicant.data.interview.remark4,
    experience: this.view_fs_applicant.data.interview.experience,
    job_related_skills: this.view_fs_applicant.data.interview.job_related_skills,
    education_training: this.view_fs_applicant.data.interview.education_training,
    id: this.view_fs_applicant.id,
    int_id: this.view_fs_applicant.data.id,
    user_id: this.view_fs_applicant.data.user_id,
    application_status: this.view_fs_applicant.data.status,
    int_schedule: this.view_fs_applicant.data.interview.schedule,
    assigned_interviewer: this.view_fs_applicant.data.interview.assigned_interviewer,
    first_name: this.view_fs_applicant.data.user.info.first_name,
    middle_name: this.view_fs_applicant.data.user.info.middle_name,
    last_name: this.view_fs_applicant.data.user.info.last_name,
    gender: this.view_fs_applicant.data.user.info.gender,
    age: this.view_fs_applicant.data.user.info.age,
    civil_status: this.view_fs_applicant.data.user.info.civil_status,
    nationality: this.view_fs_applicant.data.user.info.nationality,
    birthday: this.view_fs_applicant.data.user.info.birthday,
    contact_number: this.view_fs_applicant.data.user.info.contact_number,
    address: this.view_fs_applicant.data.user.info.address,
    email: this.view_fs_applicant.data.user.email,
    edu_tertiary: this.view_fs_applicant.data.user.info.edu_tertiary,
    edu_secondary: this.view_fs_applicant.data.user.info.edu_secondary,
    edu_primary: this.view_fs_applicant.data.user.info.edu_primary,
    skills: this.view_fs_applicant.data.user.info.skills,
    seminars_trainings: this.view_fs_applicant.data.user.info.seminars_trainings,
    job_applied_id: this.view_fs_applicant.data.jobapplied.id,
    job_title: this.view_fs_applicant.data.jobapplied.job_title,
    job_description: this.view_fs_applicant.data.jobapplied.job_description,
    job_skills: this.view_fs_applicant.data.jobapplied.job_skills,
    job_type: this.view_fs_applicant.data.jobapplied.job_type,
    job_work_location: this.view_fs_applicant.data.jobapplied.job_work_location,
    job_min_experience: this.view_fs_applicant.data.jobapplied.job_min_experience,
    job_min_qualification: this.view_fs_applicant.data.jobapplied.job_min_qualification,
   };
   this.isLoading = false;
  },
  methods: {
   closeModal() {
    this.data.int_schedule = '';
    this.$bvModal.hide(this.modalId);
   },
   async confirmSubmit() {
    this.isLoading = true;
    const { data, status } = await this.$store.dispatch('applicant/approveApplicantFs', this.data);
    this.fsApproveCheckStatus(data, status, '', '');
   },
  },
  computed: {
   ...mapState('applicant', ['view_fs_applicant']),
   getRoute: function() {
    return this.$route.path;
   },
  },
 };
</script>
