<template>
 <div>
  <div class="container-fluid">
   <div class="loader d-flex justify-content-center align-items-center" v-if="isLoading">
    <div class="spinner-grow text-dark spinner-grow-lg" role="status">
     <span class="visually-hidden">Loading...</span>
    </div>
   </div>
   <div class="card p-5 mt-3 mb-5" v-if="!isLoading">
    <h5 class="mt-1">For Final Screening Applicants</h5>
    <p class="text-muted">Review applicants for final screening below</p>
    <div class="d-flex justify-content-end mb-2 mt-2" v-if="forFinalScreeningApplicants.data.length > 0">
     <div class="me-2 ">
      <input type="text" class="form-control" id="searchbar" placeholder="Search here" />
     </div>
    </div>
    <h5 class="text-center mt-5" v-if="forFinalScreeningApplicants.data.length == 0">No applicants for final screening found on the database</h5>
    <table class="table table-striped table-hover mt-4" v-if="forFinalScreeningApplicants.data.length > 0">
     <caption>
      Showing
      {{
       forFinalScreeningApplicants.from
      }}
      to
      {{
       forFinalScreeningApplicants.to
      }}
      of
      {{
       forFinalScreeningApplicants.total
      }}
      data
     </caption>
     <thead>
      <tr>
       <th scope="col">ID</th>
       <th scope="col" class="cursor-pointer" v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'">
        Name
        <i class="bi" :class="sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'"></i>
       </th>
       <th scope="col">Assigned Interviewer</th>
       <th scope="col">Interviewed On</th>
       <th scope="col">Evaluation Rating</th>
       <th scope="col"></th>
      </tr>
     </thead>
     <tbody>
      <tr v-for="(fsApp, f) in forFinalScreeningApplicants.data" :key="f">
       <td scope="row">{{ forFinalScreeningApplicants.from + f }}</td>
       <td>{{ fsApp.user.info.first_name }} {{ fsApp.user.info.last_name }}</td>
       <td>{{ fsApp.interview.assigned_interviewer }}</td>
       <td>{{ fsApp.created_at | moment }}</td>
       <td><star-rating :rating="fsApp.interview.total_rating" :round-start-rating="false" :read-only="true" :star-size="20" /></td>
       <td class="text-nowrap">
        <button class="btn text-primary text-decoration-none shadow-none pt-0" @click="setViewFSApplicant(fsApp)">Review Applicant</button>
       </td>
      </tr>
     </tbody>
    </table>
   </div>
  </div>
 </div>
</template>
<script>
 import { mapState } from 'vuex';
 import StarRating from 'vue-star-rating';
 import moment from 'moment';
 export default {
  components: {
   StarRating,
  },
  data() {
   return {
    sort: 'asc',
   };
  },
  created() {
   document.title = 'Human Resource - Applicants';
  },
  async mounted() {
   this.isLoading = true;
   await this.$store.dispatch('auth/checkAuthUser');
   await this.$store.dispatch('applicant/getForFinalScreeningApplicants', { page: 1, sort: this.sort });
   this.isLoading = false;
  },
  computed: {
   ...mapState('applicant', ['forFinalScreeningApplicants']),
  },
  filters: {
   moment: function(date) {
    return moment(date).format('MMMM D, YYYY');
   },
  },
  methods: {
   async getForFinalScreeningApplicants(page = 1) {
    await this.$store.dispatch('applicant/getForFinalScreeningApplicants', { page: page, sort: this.sort });
   },
   setViewFSApplicant(data) {
    this.$store.commit('applicant/SET_VIEW_FS_APPLICANT', { data: data });
    this.$router.push({ name: 'finalscreeningapplicant', params: { slug: data.id } });
   },
  },
  watch: {
   sort() {
    this.getForFinalScreeningApplicants();
   },
  },
 };
</script>
