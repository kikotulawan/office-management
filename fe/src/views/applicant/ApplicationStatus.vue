<template>
  <div class="container my-5">
    <div class="card p-5 mt-3 mb-5">
      <h5 class="mt-1">Application Status</h5>
      <p class="text-muted">
        Your application status on a job vacancy are listed below
      </p>
      <div class="d-flex justify-content-end mb-2 mt-2">
        <div class="me-2 ">
          <input
            type="text"
            class="form-control"
            id="searchbar"
            placeholder="Search here"
          />
        </div>
      </div>
      <h5
        class="text-center mt-5"
        v-if="applicationStatus.data.length == 0 && !initialLoading"
      >
        No applied job found on the database
      </h5>
      <b-skeleton-table
        :rows="7"
        :columns="6"
        :table-props="{ bordered: true, striped: true }"
        class="mt-4"
        v-if="initialLoading"
      ></b-skeleton-table>
      <table class="table table-striped table-hover mt-4" v-if="applicationStatus.data.length > 0">
        <caption class="mt-4">
          Showing
          {{
            applicationStatus.from
          }}
          to
          {{
            applicationStatus.to
          }}
          of
          {{
            applicationStatus.total
          }}
          data
        </caption>
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th
              scope="col"
              class="cursor-pointer"
              v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'"
            >
              Job Applied
              <i
                class="bi"
                :class="
                  sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'
                "
              ></i>
            </th>
            <th scope="col">Date Applied</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(app, i) in applicationStatus.data" :key="i">
            <td scope="row">{{ applicationStatus.from + i }}</td>
            <td>{{ app.jobapplied.job_title }}</td>
            <td>{{ app.created_at | moment }}</td>
            <td>{{app.status}}</td>
            <td><a href="" class="text-decoration-none">View Status</a></td>
          </tr>
        </tbody>
      </table>
      <div class="row mt-3" v-if="applicationStatus.data">
        <pagination
          :showDisabled="true"
          :align="'right'"
          :data="applicationStatus"
          @pagination-change-page="getApplicationStaus"
        >
          <span slot="prev-nav">&laquo;</span>
          <span slot="next-nav">&raquo;</span>
        </pagination>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import moment from "moment";
export default {
  data(){
      return {
          initialLoading: false,
          sort: 'asc'
      }
  },
  filters: {
    moment: function(date) {
      return moment(date).format("MMMM D, YYYY");
    },
  },
  async created() {
    document.title = "eOffice - Application Status";
    await this.$store.dispatch("applicant/getApplicationStatus", {
      page: 1,
      sort: this.sort,
    });
  },
  computed: {
    ...mapState("applicant", ["applicationStatus"]),
  },
  methods: {
    async getApplicationStaus(page = 1) {
      await this.$store.dispatch("applicant/getApplicationStatus", {
        page: page,
        sort: this.sort,
      });
    },
  },
  watch: {
    sort() {
      this.getApplicationStaus();
    },
  },
};
</script>

<style></style>
