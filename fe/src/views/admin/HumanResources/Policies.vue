<template>
    <div>
       <div class="container-fluid">
        <div class="card p-5 mt-3 mb-5">
            <h5 class="mt-1">Work Policy</h5>
            <p class="text-muted">Listed below are your policy</p>
            <div class="d-flex justify-content-end mb-2 mt-2">
                <div class="me-2 ">
                    <input type="text" class="form-control" id="searchbar" placeholder="Search here">
                </div>
                <button class="btn btn-primary btn-sm shadow-none" @click="$bvModal.show('addPolicyModal')"> <i class="bi bi-plus"></i>Add  Policy</button>
            </div>
            <b-skeleton-table
                :rows="5"
                :columns="4"
                :table-props="{ bordered: true, striped: false }"
                class="mt-4"
                v-if="initialLoading"
                ></b-skeleton-table>
            <table class="table table-striped table-hover mt-4">
                <caption>Showing {{policies.from}} to {{policies.to}} of {{policies.total}} data</caption>
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="cursor-pointer" v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'">Name <i class="bi" :class="sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'"></i></th>
                    <th scope="col">Schedule</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(policy, i) in policies.data" :key="i">
                        <td scope="row">{{policies.from + i}}</td>
                        <td>{{policy.name}}</td>
                        <td>{{policy.address}}</td>
                        <td>
                            <a href="" class="btn btn-secondary btn-sm rounded-pill shadow-none" @click.prevent="data = {...branch}; $bvModal.show('updateBranchModal')">
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
            <div class="row mt-3" v-if="policies.data">
              <pagination :showDisabled="true" :align="'right'" :data="policies" @pagination-change-page="getPolicies">
                <span slot="prev-nav">&laquo;</span>
                <span slot="next-nav">&raquo;</span>
              </pagination>
            </div>
        </div>
        <div class="card p-5 mt-3 mb-5">
            <h5 class="mt-1">Overtime Policy</h5>
            <p class="text-muted">Listed below are your overtime policy</p>
            <div class="d-flex justify-content-end mb-2 mt-2">
                <div class="me-2 ">
                    <input type="text" class="form-control" id="searchbar" placeholder="Search here">
                </div>
                <button class="btn btn-primary btn-sm shadow-none" @click="$bvModal.show('addOvertimePolicyModal')"> <i class="bi bi-plus"></i>Overtime Policy</button>
            </div>
            <b-skeleton-table
                :rows="5"
                :columns="4"
                :table-props="{ bordered: true, striped: false }"
                class="mt-4"
                v-if="initialLoading"
                ></b-skeleton-table>
            <table class="table table-striped table-hover mt-4" v-else>
                <caption>Showing {{policies.from}} to {{policies.to}} of {{policies.total}} data</caption>
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="cursor-pointer" v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'">Name <i class="bi" :class="sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'"></i></th>
                    <th scope="col">Start Time</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(policy, i) in policies.data" :key="i">
                        <td scope="row">{{policies.from + i}}</td>
                        <td>{{policy.name}}</td>
                        <td>{{policy.address}}</td>
                        <td>
                            <a href="" class="btn btn-secondary btn-sm rounded-pill shadow-none" @click.prevent="data = {...branch}; $bvModal.show('updateBranchModal')">
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
            <div class="row mt-3" v-if="policies.data">
              <pagination :showDisabled="true" :align="'right'" :data="policies" @pagination-change-page="getPolicies">
                <span slot="prev-nav">&laquo;</span>
                <span slot="next-nav">&raquo;</span>
              </pagination>
            </div>
        </div>


       </div>

       <b-modal id="addPolicyModal" centered title="Add Policy">
          <form ref="policyform" class="p-2">
            <label class="">Policy Name</label>
            <input v-model="data.name" class="form-control" type="text">
            <label class="mt-2">Select Day(s)</label>
            <select v-model="data.days" class="form-select" size="5"  multiple aria-label="multiple select day">
                <option value="0">Sunday</option>
                <option value="1">Monday</option>
                <option value="2">Tuesday</option>
                <option value="3">Wednesday</option>
                <option value="4">Thursday</option>
                <option value="5">Friday</option>
                <option value="6">Saturday</option>
            </select>
            <label class="mt-2">Morning Schedule</label>
            <div class="d-block">
                <date-picker class="w-100" v-model="data.time.am" format="hh:mm a" type="time" range></date-picker>
            </div>
            <label class="mt-2">Afternoon Schedule</label>
           <div class="d-block">
                <date-picker class="w-100" v-model="data.time.pm" format="hh:mm a" type="time" range></date-picker>
            </div>
            <label class="mt-2">Grace Period</label>
            <input v-model="data.name" class="form-control" type="text">
          </form>
            <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
            <b-button variant="success" v-on:click.prevent="saveBranch" :disabled="isLoading">
                Save Policy
            </b-button>
            </template>
        </b-modal>

       <b-modal id="addOvertimePolicyModal" centered title="Add Overtime">
          <form ref="policyform" class="p-2">
            <label class="">Overtime Policy</label>
            <input v-model="overtime.name" class="form-control" type="text">
            <label class="mt-2">Start Time</label>
            <div class="d-block">
                <date-picker class="w-100" v-model="overtime.start" format="hh:mm a" type="time"></date-picker>
            </div>
          </form>
            <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
            <b-button variant="success" v-on:click.prevent="saveBranch" :disabled="isLoading">
                Save Policy
            </b-button>
            </template>
        </b-modal>

    </div>
</template>
<script>
import { mapState } from 'vuex'
export default {
    data(){
        return {
            data: {
                name: '',
                days: '',
                time: {
                    am: {
                        start: '',
                        end: '',
                    },
                    pm: {
                        start: '',
                        end: ''
                    }
                },
                
                graceperiod: '',
            },
            overtime: {
                    
            },
            options: [
                {value: 0, text: 'Sunday'},
                {value: 1, text: 'Monday'},
                {value: 2, text: 'Tuesday'},
                {value: 3, text: 'Wednesday'},
                {value: 4, text: 'Thursday'},
                {value: 5, text: 'Friday'},
                {value: 6, text: 'Saturday'},
            ],
            sort: 'asc',
            modalId: '',
        }
    },
    async mounted() {
        this.initialLoading = true
        document.title = 'Human Resource - Policies'
        await this.$store.dispatch('auth/checkUser')
        await this.$store.dispatch('policies/getPolicies', {page: 1, sort: this.sort})
        this.$root.$on('bv::modal::show', (modalId) => {
            this.modalId = modalId.componentId
        })
        this.$root.$on('bv::modal::hide', (modalId) => {
            this.data.name = ''
            this.data.address = ''
            this.data.contact_number = ''
            this.data.person_in_charge = ''
        })
        this.initialLoading = false
    },
    computed: {
        ...mapState('policies', ['policies']),
    },
    methods: {
       async getPolicies(page = 1){
         await this.$store.dispatch('policies/getPolicies', {page: page, sort: this.sort})
       },
       async updatePolicy(){
           if(this.data.name.trim() == '') return this.$toast.error('Name for the branch is required')
           if(this.data.address.trim() == '') return this.$toast.error('Address for the branch is required')
           if(this.data.contact_number.trim() == '') return this.$toast.error('Contact for the branch is required')
           if(this.data.person_in_charge.trim() == '') return this.$toast.error('Person in charge of the branch is required')

           this.isLoading = true
           const { data, status } = await this.$store.dispatch('policies/updatePolicy', this.data)
           this.checkStatus(data, status, 'update')
       },
       async savePolicy(){
           if(this.data.name.trim() == '') return this.$toast.error('Name for the branch is required')
           if(this.data.address.trim() == '') return this.$toast.error('Address for the branch is required')
           if(this.data.contact_number.trim() == '') return this.$toast.error('Contact for the branch is required')
           if(this.data.person_in_charge.trim() == '') return this.$toast.error('Person in charge of the branch is required')

           this.isLoading = true
           const { data, status } = await this.$store.dispatch('policies/savePolicy', this.data)
           this.checkStatus(data, status, '', 'policies/getPolicies')
       },
       closeModal(){
           this.data.name = ''
           this.data.address = ''
           this.data.contact_number = ''
           this.data.person_in_charge = ''
           this.$bvModal.hide(this.modalId)
       }
    },
    watch: {
        sort(){
            this.getBranches()
        }
    }
}
</script>

