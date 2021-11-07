<template>
 <div>
  <div class="container-fluid">
   <div class="loader d-flex justify-content-center align-items-center" v-if="isLoading">
    <div class="spinner-grow text-dark spinner-grow-lg" role="status">
     <span class="visually-hidden">Loading...</span>
    </div>
   </div>
   <div class="card p-5 mt-3 mb-5" v-if="!isLoading">
    <h5 class="mt-1">All Applicants</h5>
    <p class="text-muted">Manage all applicants below</p>
    <div class="d-flex justify-content-end mb-2 mt-2" v-if="allApplicants.data.length > 0">
     <div class="me-2 ">
      <input type="text" class="form-control" id="searchbar" placeholder="Search here" />
     </div>
    </div>
    <h5 class="text-center mt-5" v-if="allApplicants.data.length == 0">No applicants found on the database</h5>
    <table class="table table-striped table-hover mt-4" v-if="allApplicants.data.length > 0">
     <caption>
      Showing
      {{
       allApplicants.from
      }}
      to
      {{
       allApplicants.to
      }}
      of
      {{
       allApplicants.total
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
       <th scope="col">Gender</th>
       <th scope="col">Email</th>
       <th scope="col">Contact</th>
       <th scope="col">Stage</th>
       <th scope="col"></th>
      </tr>
     </thead>
     <tbody>
      <tr v-for="(app, i) in allApplicants.data" :key="i">
       <td scope="row">{{ allApplicants.from + i }}</td>
       <td class="text-nowrap">{{ app.user.info.first_name }} {{ app.user.info.last_name }}</td>
       <td>{{ app.user.info.gender }}</td>
       <td>{{ app.user.email }}</td>
       <td>{{ app.user.info.contact_number }}</td>
       <td>{{ app.status }}</td>
       <td>
        <button class="btn text-primary text-decoration-none shadow-none pt-0" @click="setViewApplicant(app)">View Applicant</button>
       </td>
      </tr>
     </tbody>
    </table>
    <!--- 1. PAGINATION - CHANGE - PAGE FIX -->
    <!-- <div class="row mt-3" v-if="branches.data">
          <pagination
            :showDisabled="true"
            :align="'right'"
            :data="branches"
            @pagination-change-page="getBranches"
          >
            <span slot="prev-nav">&laquo;</span>
            <span slot="next-nav">&raquo;</span>
          </pagination>
        </div> -->
   </div>
  </div>
 </div>
</template>
<script>
 import { mapState } from 'vuex';
 import moment from 'moment';
 export default {
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
   await this.$store.dispatch('applicant/getApplicants', { page: 1, sort: this.sort });
   this.isLoading = false;
  },
  computed: {
   ...mapState('applicant', ['allApplicants']),
  },
  filters: {
   moment: function(date) {
    return moment(date).format('MMMM D, YYYY');
   },
  },
  methods: {
   async getApplicants(page = 1) {
    await this.$store.dispatch('applicant/getApplicants', { page: page, sort: this.sort });
   },
   setViewApplicant(data) {
    this.$store.commit('applicant/SET_VIEW_APPLICANT', { data: data });
    this.$router.push({ name: 'viewapplicant', params: { slug: data.id } });
   },
  },
  watch: {
   sort() {
    this.getApplicants();
   },
  },
 };
</script>
