<template>
    <div>
       <div class="container-fluid">
        <div class="card p-5 mt-3 mb-5">
            <h5 class="mt-1">Departments</h5>
            <p class="text-muted">Manage the departments below</p>
            <div class="d-flex justify-content-end mb-2 mt-2">
                <div class="me-2 ">
                    <input type="text" class="form-control" id="searchbar" placeholder="Search here">
                </div>
                <button class="btn btn-primary btn-sm shadow-none" @click="$bvModal.show('addBranchModal')"> <i class="bi bi-plus"></i>Add Department</button>
            </div>
            <table class="table table-striped table-hover mt-4">
                <caption>Showing {{departments.from}} to {{departments.to}} of {{departments.total}} data</caption>
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="cursor-pointer" v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'">Name <i class="bi" :class="sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'"></i></th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Person in Charge</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(department, i) in departments.data" :key="i">
                        <td scope="row">{{departments.from + i}}</td>
                        <td>{{department.name}}</td>
                        <td>{{department.contact_number}}</td>
                        <td>{{department.person_in_charge}}</td>
                        <td>
                            <a href="" class="btn btn-secondary btn-sm rounded-pill shadow-none" @click.prevent="data = {...department}; $bvModal.show('updateBranchModal')">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--- INITIAL CONFIGURATION FOR PAGINATION -->
            <!--- TO-DO -->
            <!--- 1. SEARCH FUNCTIONALITY  -->
            <!--- 1. PAGINATION - CHANGE - PAGE FIX -->
            <div class="row mt-3" v-if="departments.data">
              <pagination :showDisabled="true" :align="'right'" :data="departments" @pagination-change-page="getDepartments">
                <span slot="prev-nav">&laquo;</span>
                <span slot="next-nav">&raquo;</span>
              </pagination>
            </div>
        </div>
       </div>

       <b-modal id="addBranchModal" centered title="Add Department">
          <form ref="branchform" class="p-2">
            <label class="">Name</label>
            <input v-model="data.name" class="shadow-none form-control" type="text">
            <label class="">Contact Number</label>
            <input v-model="data.contact_number" class="shadow-none form-control" type="number">
            <label class="">Person in Charge</label>
            <select v-model="data.person_in_charge" class="shadow-none form-select">
                <option value="Administrator" selected>Administrator</option>
            </select>
          </form>
            <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
            <b-button variant="success" v-on:click.prevent="saveDepartment" :disabled="isLoading">
                Save Department
            </b-button>
            </template>
        </b-modal>

       <b-modal id="updateBranchModal" centered title="Update Department">
          <form ref="branchform" class="p-2">
            <label class="">Name</label>
            <input v-model="data.name" class="shadow-none form-control" type="text">
            <label class="">Contact Number</label>
            <input v-model="data.contact_number" class="shadow-none form-control" type="number">
            <label class="">Person in Charge</label>
            <select v-model="data.person_in_charge" class="shadow-none form-select">
                <option value="Administrator">Administrator</option>
            </select>
          </form>
            <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
            <b-button variant="success" v-on:click.prevent="updateDepartment" :disabled="isLoading">
                Update Department
            </b-button>
            </template>
        </b-modal>
    </div>
</template>
<script>
import {vresponse} from '@/assets/js/validation_response/index.js'
import { mapState } from 'vuex'
export default {
    mixins: [vresponse],
    data(){
        return {
            isLoading: false,
            data: {
                name: '',
                contact_number: '',
                person_in_charge: [0],
            },
            sort: 'asc',
            modalId: '',
        }
    },
    async mounted() {
        document.title = 'Human Resource - Branches'
        await this.$store.dispatch('auth/checkUser')
        await this.$store.dispatch('departments/getDepartments', {page: 1, sort: this.sort})
        this.$root.$on('bv::modal::show', (modalId) => {
            this.modalId = modalId.componentId
        })
        this.$root.$on('bv::modal::hide', (modalId) => {
            this.data.name = ''
            this.data.contact_number = ''
            this.data.person_in_charge = ''
        })
    },
    computed: {
        ...mapState('departments', ['departments'])
    },
    methods: {
       async getDepartments(page = 1){
         await this.$store.dispatch('departments/getDepartments', {page: page, sort: this.sort})
       },
       async updateDepartment(){
           if(this.data.name.trim() == '') return this.$toast.error('Name for the department is required')
           if(this.data.contact_number.trim() == '') return this.$toast.error('Contact for the department is required')
           if(this.data.person_in_charge.trim() == '') return this.$toast.error('Person in charge of the department is required')

           this.isLoading = true
           const { data, status } = await this.$store.dispatch('departments/updateDepartment', this.data)

           this.checkStatus(data, status, 'update','departments/getDepartments');
       },
       async saveDepartment(){
           if(this.data.name.trim() == '') return this.$toast.error('Name for the department is required')
           if(this.data.contact_number.trim() == '') return this.$toast.error('Contact for the department is required')
           if(this.data.person_in_charge.trim() == '') return this.$toast.error('Person in charge of the department is required')

           this.isLoading = true
           const { data, status } = await this.$store.dispatch('departments/saveDepartment', this.data)
           this.checkStatus(data, status, '','departments/getDepartments');
       },
       closeModal(){
           this.data.name = ''
           this.data.contact_number = ''
           this.data.person_in_charge = ''
           this.$bvModal.hide(this.modalId)
       }
    },
    watch: {
        sort(){
            this.getDepartments()
        }
    }
}
</script>

