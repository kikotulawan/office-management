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
      <router-link to="/home/human-resources/applicants/interview" class="btn btn-primary mb-3"><i class="bi bi-arrow-left-short me-2"></i>Return</router-link>
      <!-- <label class="btn mb-3 shadow-none btn-success ms-2" for="btn-check" v-if="!approved"><i class="bi bi-check-lg me-2"></i>Approve</label>
            <input type="checkbox" v-model="approved" class="btn-check" id="btn-check" autocomplete="off" /> -->
      <h5 class="text-primary mt-4">Applicant Details</h5>
      <hr />
      <h5 class="fw-light">Applicant Name:</h5>
      <h3 class="mt-1">
       {{ data.first_name }} {{ data.middle_name }} {{ data.last_name }},
       {{ data.age }}
      </h3>
      <!-- <p class="fw-light mt-4">Application Status: <span class="fw-bold ms-1">{{data.application_status}}</span></p> -->
      <p class="fw-light mt-4">
       Gender: <span class="fw-bold ms-1">{{ data.gender }}</span>
      </p>
      <p class="fw-light mt-2">
       Birthday: <span class="fw-bold ms-1">{{ data.birthday | moment }}</span>
      </p>
      <p class="fw-light mt-4" v-if="data.contact_number">
       Contact Number:
       <span class="fw-bold ms-1">{{ data.contact_number }}</span>
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
      <p class="fw-bold mt-2 text-danger" v-if="!data.edu_primary && !data.edu_secondary && !data.edu_tertiary">
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
      <br />
     </div>
     <div class="row mt-5">
      <div class="col-12">
       <h5 class="text-primary">Job Details</h5>
       <hr />
       <p>Job Title:</p>
       <h3 class="">{{ data.job_title }}</h3>
       <p class="fw-light mt-3">Description: <br /><span class="fw-normal" v-html="data.job_description"></span></p>
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
        Years of Work Experience: <br /><span class="fw-bold">{{ data.job_min_experience }}</span>
       </p>
       <p class="fw-light mt-2">
        Qualification: <br /><span class="fw-bold">{{ data.job_min_qualification }}</span>
       </p>
       <p class="fw-normal mt-2">Required Skills: <br /><span class="fw-normal" v-html="data.job_skills"></span></p>
      </div>
     </div>
    </div>
   </div>

   <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 pt-2">
    <div class="card p-5 mt-3">
     <!-- <p  class="text-justified"><small>Once the applicant is done taking interview, the assigned interviewer can enable the evaluation form to evaluate the candidate in terms of user-defined criteria.</small></p> -->
     <h4 class="mb-4 fw-bold text-center border p-3">Interview Evaluation Form</h4>

     <div class="row">
      <!-- <div class="col-6 text-left">
                <p class="">Applicant Name:</p>
                <hr class="g-0 p-0 m-0">
                <h5 class="pt-2 ">{{data.first_name}} {{data.middle_name}} {{data.last_name}}</h5>
              </div>
              <div class="col-6 text-left">
                <p class="">Assigned Interviewer:</p>
                <hr class="g-0 p-0 m-0">
                <h5 class="pt-2">{{data.assigned_interviewer}}</h5>
              </div>
            </div>
            <div class="row my-4" >
              <div class="col-6 text-left">
                <p class="">Position Applied:</p>
                <hr class="g-0 p-0 m-0">
                <h5 class="pt-2">{{data.job_title}}</h5>
              </div>
              <div class="col-6 text-left">
                <p class="">Interview Date:</p>
                <hr class="g-0 p-0 m-0">
                <h5 class="pt-2">{{data.int_schedule | moment}}</h5>
              </div> -->
     </div>
     <div>
      <p class=" text-muted">
       Please check the appropriate rating for each of the categories below. Take note that all fields are required for evaluation.
      </p>
      <p class="pt-3 text-muted">
       1 - Outstanding 2 - Above Satisfactory 3 - Satisfactory 4 - Below Satisfactory 5 - Unsatisfactory
      </p>
      <div class="col-12 mt-4">
       <p>Communication Skills</p>
      </div>
      <div class="col-12 mt-2">
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.communication_skills" name="inlineRadioOptions" value="5" />
        <label class="form-check-label">1</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.communication_skills" name="inlineRadioOptions" value="4" />
        <label class="form-check-label">2</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.communication_skills" name="inlineRadioOptions" value="3" />
        <label class="form-check-label">3</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.communication_skills" name="inlineRadioOptions" value="2" />
        <label class="form-check-label">4</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.communication_skills" name="inlineRadioOptions" value="1" />
        <label class="form-check-label">5</label>
       </div>
       <textarea class="form-control shadow-none mt-2" v-model="data.remark1" placeholder="Comments"></textarea>
      </div>
      <div class="col-12 mt-4">
       <p>Work Experience</p>
      </div>
      <div class="col-12 mt-2">
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.experience" name="inlineRadioOptions2" value="5" />
        <label class="form-check-label">1</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.experience" name="inlineRadioOptions2" value="4" />
        <label class="form-check-label">2</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.experience" name="inlineRadioOptions2" value="3" />
        <label class="form-check-label">3</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.experience" name="inlineRadioOptions2" value="2" />
        <label class="form-check-label">4</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.experience" name="inlineRadioOptions2" value="1" />
        <label class="form-check-label">5</label>
       </div>
       <textarea class="form-control shadow-none mt-2" v-model="data.remark2" placeholder="Comments"></textarea>
      </div>
      <div class="col-12 mt-4">
       <p>Job Related Skills</p>
      </div>
      <div class="col-12 mt-2">
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.job_related_skills" name="inlineRadioOptions3" value="5" />
        <label class="form-check-label">1</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.job_related_skills" name="inlineRadioOptions3" value="4" />
        <label class="form-check-label">2</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.job_related_skills" name="inlineRadioOptions3" value="3" />
        <label class="form-check-label">3</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.job_related_skills" name="inlineRadioOptions3" value="2" />
        <label class="form-check-label">4</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.job_related_skills" name="inlineRadioOptions3" value="1" />
        <label class="form-check-label">5</label>
       </div>
       <textarea class="form-control shadow-none mt-2" v-model="data.remark3" placeholder="Comments"></textarea>
      </div>
      <div class="col-12 mt-4">
       <p>Education/Training</p>
      </div>
      <div class="col-12 mt-2">
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.education_training" name="inlineRadioOptions4" value="5" />
        <label class="form-check-label">1</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.education_training" name="inlineRadioOptions4" value="4" />
        <label class="form-check-label">2</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.education_training" name="inlineRadioOptions4" value="3" />
        <label class="form-check-label">3</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.education_training" name="inlineRadioOptions4" value="2" />
        <label class="form-check-label">4</label>
       </div>
       <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" v-model="data.education_training" name="inlineRadioOptions4" value="1" />
        <label class="form-check-label">5</label>
       </div>
       <textarea class="form-control shadow-none mt-2" v-model="data.remark4" placeholder="Comments"></textarea>
      </div>
      <p class="mt-4">Interviewer's note:</p>
      <textarea class="form-control shadow-none mt-2" v-model="data.remarks" placeholder="Type your note here"></textarea>
      <div class="d-inline">
       <!-- <button class="btn btn-success mt-5 mx-2">Confirm Evaluation</button> -->
       <!-- <label class="btn shadow-none btn-danger me-2 mt-5" for="btn-check" v-if="approved">Cancel</label> -->
       <button class="btn btn-success mt-5" @click="submitForm">Confirm Evaluation</button>
      </div>
     </div>
    </div>
   </div>
  </div>

  <b-modal id="failedModal" centered title="Interview Failed">
   <p>Interview Remarks</p>
   <textarea type="text" class="form-control shadow-none" v-model="data.remarks"></textarea>
   <template #modal-footer="{ cancel }">
    <b-button variant="secondary" @click="cancel()" :disabled="isLoading">
     Cancel
    </b-button>
    <b-button variant="success" v-on:click.prevent="" :disabled="isLoading">
     Confirm
    </b-button>
   </template>
  </b-modal>

  <b-modal id="confirmModal" centered title="Evaluation Result">
   <p>Overall rating is {{ data.total }}/5 - <span class="text-success" v-if="data.total >= 2.5">Passed</span><span class="text-danger" v-else>Failed</span></p>
   <p class="mt-2" v-if="data.total >= 2.5">Applicant will proceed for final screening.</p>
   <p class="mt-2" v-else>Applicant will be moved to failed table.</p>
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
    },
    sort: 'asc',
    modalId: '',
    approved: false,
   };
  },
  filters: {
   moment: function(date) {
    return moment(date).format('MMMM D, YYYY');
   },
  },
  created() {},
  async mounted() {
   this.isLoading = true;
   this.tabs = false;
   await this.$store.dispatch('auth/checkAuthUser');
   this.data = {
    remarks: this.data.remarks,
    remark1: this.data.remark1,
    remark2: this.data.remark2,
    remark3: this.data.remark3,
    communication_skills: this.data.communication_skills,
    total: this.data.total,
    remark4: this.data.remark4,
    experience: this.data.experience,
    job_related_skills: this.data.job_related_skills,
    education_training: this.data.education_training,
    id: this.view_interview_applicant.id,
    int_id: this.view_interview_applicant.data.id,
    user_id: this.view_interview_applicant.data.user_id,
    application_status: this.view_interview_applicant.data.status,
    int_schedule: this.view_interview_applicant.data.schedule,
    assigned_interviewer: this.view_interview_applicant.data.assigned_interviewer,
    first_name: this.view_interview_applicant.data.user.info.first_name,
    middle_name: this.view_interview_applicant.data.user.info.middle_name,
    last_name: this.view_interview_applicant.data.user.info.last_name,
    gender: this.view_interview_applicant.data.user.info.gender,
    age: this.view_interview_applicant.data.user.info.age,
    civil_status: this.view_interview_applicant.data.user.info.civil_status,
    nationality: this.view_interview_applicant.data.user.info.nationality,
    birthday: this.view_interview_applicant.data.user.info.birthday,
    contact_number: this.view_interview_applicant.data.user.info.contact_number,
    address: this.view_interview_applicant.data.user.info.address,
    email: this.view_interview_applicant.data.user.email,
    edu_tertiary: this.view_interview_applicant.data.user.info.edu_tertiary,
    edu_secondary: this.view_interview_applicant.data.user.info.edu_secondary,
    edu_primary: this.view_interview_applicant.data.user.info.edu_primary,
    skills: this.view_interview_applicant.data.user.info.skills,
    seminars_trainings: this.view_interview_applicant.data.user.info.seminars_trainings,
    job_applied_id: this.view_interview_applicant.data.jobapplied.id,
    job_title: this.view_interview_applicant.data.jobapplied.job_title,
    job_description: this.view_interview_applicant.data.jobapplied.job_description,
    job_skills: this.view_interview_applicant.data.jobapplied.job_skills,
    job_type: this.view_interview_applicant.data.jobapplied.job_type,
    job_work_location: this.view_interview_applicant.data.jobapplied.job_work_location,
    job_min_experience: this.view_interview_applicant.data.jobapplied.job_min_experience,
    job_min_qualification: this.view_interview_applicant.data.jobapplied.job_min_qualification,
   };
   this.isLoading = false;
  },
  methods: {
   closeModal() {
    this.data.int_schedule = '';
    this.$bvModal.hide(this.modalId);
   },
   submitForm() {
    if (this.data.communication_skills == 0) return this.$toast.error('Communication skill rating is required');
    if (this.data.remark1.trim() == '' || this.data.remark1.match(/(\w+)/g).length < 8) return this.$toast.error('Remarks are required at least 8 words.');
    if (this.data.experience == 0) return this.$toast.error('Work experience rating is required');
    if (this.data.remark2.trim() == '' || this.data.remark2.match(/(\w+)/g).length < 8) return this.$toast.error('Remarks are required at least 8 words.');
    if (this.data.job_related_skills == 0) return this.$toast.error('Job related skill rating is required');
    if (this.data.remark3.trim() == '' || this.data.remark3.match(/(\w+)/g).length < 8) return this.$toast.error('Remarks are required at least 8 words.');
    if (this.data.education_training == 0) return this.$toast.error('Education and training rating is required');
    if (this.data.remark4.trim() == '' || this.data.remark4.match(/(\w+)/g).length < 8) return this.$toast.error('Remarks are required at least 8 words.');
    if (this.data.remarks.trim() == '' || this.data.remarks.match(/(\w+)/g).length < 8) return this.$toast.error('Remarks are required at least 8 words.');
    let total = [this.data.communication_skills * 1 + this.data.experience * 1 + this.data.job_related_skills * 1 + this.data.education_training * 1] / 4;
    this.data.total = Math.round((total + Number.EPSILON) * 100) / 100;
    this.$bvModal.show('confirmModal');
   },
   async confirmSubmit() {
    if (this.data.total >= 2.5) {
     this.isLoading = true;
     const { data, status } = await this.$store.dispatch('applicant/approveApplicantInterview', this.data);
     this.interviewApproveCheckStatus(data, status, '', '');
    } else {
     this.isLoading = true;
     const { data, status } = await this.$store.dispatch('applicant/failedApplicant', this.data);
     this.failedApplicantCheckStatus(data, status, '', '');
    }
    this.$bvModal.show('confirmModal');
   },
  },
  computed: {
   ...mapState('applicant', ['view_interview_applicant']),
   getRoute: function() {
    return this.$route.path;
   },
  },
 };
</script>
