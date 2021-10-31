<template>
 <div>
  <div class="container pe-0 pe-sm-0 pe-md-2 pe-lg-4 pe-xl-4">
   <div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
     <div class="card pe-5 ps-5 pb-4 pt-4">
       <div class="d-flex flex-column me-auto mt-2">
        <h5>Role Permission</h5>
        <p class="mb-4"><small>Listed below are the roles and its permission</small></p>
       </div>
       <div class="d-flex justify-content-end mt-2">
        <div class="col-6 col-sm-5 col-md-5 col-lg-4 col-xl-3">
          <input
            type="text"
            v-model="search"
            class="form-control"
            id="floatingSearchDep"
            placeholder="Search here"
          />
        </div>
       </div>
       <div class="table-responsive mt-3">
         <div class="text-center" v-if="permissions.data == 0">No roles available</div>
         <b-skeleton-table
          :rows="6"
          :columns="4"
          :table-props="{ bordered: false, striped: true }"
          v-if="initialLoading || isSearching"
         ></b-skeleton-table>
        <table class="table table-hover" v-else>
        <caption>Showing {{permissions.from}} to {{permissions.to}} out of {{permissions.total}} accounts</caption>
        <thead >
         <tr>
          <th scope="col">ID</th>
          <th scope="col" class="text-nowrap">Role</th>
          <th scope="col">Permissions</th>
          <th scope="col">Actions</th>
         </tr>
        </thead>
        <tbody >
         <tr v-for="(role, i) in permissions.data" :key="i">
          <th scope="row" class="cursor-pointer" >{{permissions.from + i}}</th>
          <td class="text-nowrap cursor-pointer" v-on:click.prevent="viewdata = role; $bvModal.show('viewModal')">{{role.role}}</td>
          <td> 
            <p v-if="role.permission.length == 0">No permissions found for this role</p>
           <b-badge v-for="(p, i) in role.permission" :key="i" pill variant="primary" class="me-2 font-weight-400">{{p.permission}}</b-badge>
          </td>
          <td>
           <div class="d-flex">
            <button
             v-on:click.prevent="data = JSON.parse(JSON.stringify(role)); $bvModal.show('updateModal')"
             href=""
             v-b-tooltip.hover
             title="Update Permission"
             class="btn btn-sm btn-success rounded-pill me-2">
             <i class="bi bi-pencil-square"></i>
            </button>
            <button href="" v-if="role.permission.length != 0" v-on:click.prevent="delete_id = role.id; $bvModal.show('deleteModal')"
             v-b-tooltip.hover title="Delete Permission" class="btn btn-sm btn-danger rounded-pill">
             <i class="bi bi-trash"></i>
            </button>
           </div>
          </td>
         </tr>
        </tbody>
       </table>
      </div>
      <div class="row mt-3" v-if="permissions.data">
      <pagination :showDisabled="true" :align="'right'"
        :data="permissions"
        @pagination-change-page="permissionsSearch">
        <span slot="prev-nav">&laquo;</span>
        <span slot="next-nav">&raquo;</span>
      </pagination>
     </div>
     </div>
    </div>
   </div>
  </div>

   <!-- VIEW MODAL --->
   <b-modal id="viewModal" centered :title="viewdata.role">
    <p class="mb-2">Permissions granted</p>
    <b-badge v-for="(p, i) in viewdata.permission" :key="i" pill variant="primary" class="me-2 font-weight-400">{{p.permission}}</b-badge>
    <template #modal-footer="{cancel}">
     <b-button variant="primary" size="sm" @click="cancel()" :disabled="isLoading"> Close </b-button>
    </template>
   </b-modal>
   <!-- DELETE MODAL --->
   <b-modal id="deleteModal" centered title="Confirm Delete">
    <p class="">This will delete all permissions for this role. Are you sure you want to delete this?</p>
    <template #modal-footer="{cancel}">
     <b-button variant="primary" size="sm" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
     <b-button size="sm" variant="danger" v-on:click.prevent="deletePermission" :disabled="isLoading">
      Delete
     </b-button>
    </template>
   </b-modal>
  <!--- UPDATE MODAL ---->
   <b-modal id="updateModal" centered title="Update Permission">
    <label for="permissions" class="mb-2">Type to add permissions</label>
    <tags-input element-id="permissions"
    v-model="data.permission"
    :existing-tags="rolepermissions"
    typeahead-style="dropdown"
    discard-search-text="Permissions"
    id-field="id"
    text-field="permission"
    :only-existing-tags="true"
    placeholder=" "
    :typeahead="true"></tags-input>
    <template #modal-footer="{cancel}">
     <b-button variant="primary" size="sm" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
     <b-button size="sm" variant="success" v-on:click.prevent="updatePermissions" :disabled="isLoading">
      Update
     </b-button>
    </template>
   </b-modal>
 </div>
</template>
<script>
import VoerroTagsInput from '@voerro/vue-tagsinput';
import {mapState} from 'vuex'
const _ = require('lodash');
export default {
  data(){
   return {
    initialLoading: false,
    isLoading: false,
    search: '',
    isSearching: false,
    delete_id: '',
    data: {
      permissions: []
    },
    viewdata: ''
   }
  },
  components: { "tags-input": VoerroTagsInput },
  watch: {
   search: function(after, before) {
    this.debouncedPermissionSearch()
   },
  },
  created: function () {
    this.debouncedPermissionSearch = _.debounce(this.searchPermission, 1000)
  },
  async mounted(){
    this.initialLoading = true
    document.title = "Role Permission - Touchless Information Management"
    await this.$store.dispatch('permission/getRolePermissions')
    await this.$store.dispatch('permission/getAllPermissions')
    this.initialLoading = false
  },
  computed: {
   ...mapState('permission', ['permissions', 'rolepermissions'])
  },
  methods: {
   async getRolePermissions(page = 1) {
     await this.$store.dispatch('permission/getRolePermissions', page);
   },
   async searchPermission(page) {
    this.isSearching = true;
    let data = {
     search: this.search,
    };
    await this.$store.dispatch('permission/searchRolePermission', { page: page, data: data });
    this.isSearching = false;
   },
   async permissionsSearch(page = 1) {
    if (this.search == '') {
     await this.getRolePermissions(page);
    } else {
     await this.searchPermission(page);
    }
   },
   async deletePermission(){
     this.isLoading = true
     const { status, data } = await this.$store.dispatch('permission/deleteRolePermission', this.delete_id)
     if(status == 200){
       this.$store.commit('permission/REMOVE_PERMISSIONS', this.delete_id)
       this.$toast.success(data.msg);
       this.$bvModal.hide('deleteModal')
     }
     this.isLoading = false
   },
   async updatePermissions(){
     this.isLoading = true
     const { status, data } = await this.$store.dispatch('permission/updateRolePermission', this.data)
     if(status == 200){
       this.$store.dispatch('permission/getRolePermissions', 1)
       this.$toast.success(data.msg);
       this.$bvModal.hide('updateModal')
     }
     this.isLoading = false
   }
  }
 };
</script>
<style>
@import url('https://cdn.jsdelivr.net/npm/@voerro/vue-tagsinput@2.7.1/dist/style.css');
</style>