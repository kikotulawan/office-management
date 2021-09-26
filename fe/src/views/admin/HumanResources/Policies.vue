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
                        <td>{{policy.policy_name}}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <span>Morning Schedule</span>
                                <span>{{policy.morning_start}} - {{policy.morning_end}}</span><br/>
                            </div>
                            <div class="d-flex flex-column">
                                <span>Afternoon Schedule</span>
                                <span>{{policy.afternoon_start}} - {{policy.afternoon_end}}</span><br/>
                            </div>
                             <div class="d-flex">
                                <span>Schedule</span>
                            </div>
                            <div class="d-flex">
                                <span v-for="(pDay, i) in policy.policydays" :key="i">{{returnDay(pDay.day) + ", &nbsp;"}}</span>
                            </div>
                        </td>
                        <td>
                            <a v-on:click.prevent="$bvModal.show()" href="" class="btn btn-secondary btn-sm rounded-pill shadow-none me-2" @click.prevent="data = {...branch}; $bvModal.show('updateBranchModal')">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a v-on:click.prevent="delete_data.id = policy.id; $bvModal.show('deletePolicyModal')" href="" class="btn btn-danger btn-sm rounded-pill shadow-none" @click.prevent="data = {...branch}; $bvModal.show('updateBranchModal')">
                                <i class="bi bi-trash"></i>
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
                        <td>{{policy.policy_name}}</td>
                        <td>{{policy.address}}</td>
                        <td>
                            <a href="" class="btn btn-secondary btn-sm rounded-pill shadow-none" @click.prevent="data = {...branch}; $bvModal.show('updateBranchModal')">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="" class="btn btn-danger btn-sm rounded-pill shadow-none" @click.prevent="data = {...branch}; $bvModal.show('updateBranchModal')">
                                <i class="bi bi-trash"></i>
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
            <input v-model="data.policy_name" class="form-control" type="text">
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
            <div class="row">
                <div class="col-6">
                <date-picker
                    v-model="data.morning_start"
                    :time-picker-options="{
                        start: '00:00',
                        step: '01:00',
                        end: '12:00',
                    }"
                    value-type="format"
                    format="hh:mm a"
                    type="time"
                    placeholder="hh:mm a"
                    ></date-picker>
                </div>
                <div class="col-6">
                    <date-picker
                        v-model="data.morning_end"
                        :time-picker-options="{
                            start: '00:00',
                            step: '01:00',
                            end: '12:00',
                        }"
                        value-type="format"
                        format="hh:mm a"
                        type="time"
                        placeholder="hh:mm a"
                        ></date-picker>
                </div>
            </div>
            <label class="mt-2">Afternoon Schedule</label>
           <div class="row">
                <div class="col-6">
                <date-picker
                    v-model="data.afternoon_start"
                    :time-picker-options="{
                        start: '13:00',
                        step: '01:00',
                        end: '24:00',
                    }"
                    value-type="format"
                    format="hh:mm a"
                    type="time"
                    placeholder="hh:mm a"
                    ></date-picker>
                </div>
                <div class="col-6">
                    <date-picker
                        v-model="data.afternoon_end"
                        :time-picker-options="{
                            start: '13:00',
                            step: '01:00',
                            end: '24:00',
                        }"
                        value-type="format"
                        format="hh:mm a"
                        type="time"
                        placeholder="hh:mm a"
                        ></date-picker>
                </div>
            </div>
            <label class="mt-2">Grace Period</label>
            <input v-model="data.grace_period" class="form-control" type="text">
          </form>
            <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
            <b-button variant="success" v-on:click.prevent="savePolicy" :disabled="isLoading">
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


       <b-modal id="deletePolicyModal" centered title="Delete Work Policy">
          <p>Are you sure you want to delete this policy?</p>
          <template #modal-footer = {cancel} >
            <b-button variant="secondary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
            <b-button variant="success" v-on:click.prevent="deleteWorkPolicy" :disabled="isLoading">
                Delete Policy
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
                policy_name: '',
                days: [],
                morning_start: '',
                morning_end: '',
                afternoon_start: '',
                afternoon_end: '',
                grace_period: '',
            },
            overtime: {
                    
            },
            
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
            this.data.policy_name = ''
            this.data.grace_period = ''
            this.data.days = []
            this.data.morning_start = ''
            this.data.morning_end = ''
            this.data.afternoon_start = ''
            this.data.afternoon_end = ''
        })
        this.initialLoading = false
    },
    computed: {
        ...mapState('policies', ['policies']),
    },
    methods: {
       returnDay(day){
           let data = [
               'Sunday',
               'Monday',
               'Tuesday',
               'Wednesday',
               'Thursday,',
               'Friday',
               'Saturday',
           ] 
           
           return data[day]
       },
       async getPolicies(page = 1){
         await this.$store.dispatch('policies/getPolicies', {page: page, sort: this.sort})
       },
       async updatePolicy(){
           if(this.data.name.trim() == '') return this.$toast.error('Name for the branch is required')

           this.isLoading = true
           const { data, status } = await this.$store.dispatch('policies/updatePolicy', this.data)
           this.checkStatus(data, status, 'update')
       },
       async deleteWorkPolicy(){
           this.isLoading = true
           const { data, status } = await this.$store.dispatch('policies/deletePolicy', this.delete_data)
           this.checkStatus(data, status, '')
       },
       async savePolicy(){
           if(this.data.policy_name.trim() == '') return this.$toast.error('Policy name is required')
           if(this.data.days.length == 0) return this.$toast.error('Please select atleast 1 day')
           if(this.data.morning_start == '') return this.$toast.error('Morning start time is required')
           if(this.data.morning_end == '') return this.$toast.error('Morning end time is required')
           if(this.data.afternoon_start == '') return this.$toast.error('Afternoon start time is required')
           if(this.data.afternoon_end == '') return this.$toast.error('Afternoon end time is required')
           if(this.data.grace_period == '') return this.$toast.error('Grace period is required')
           
           this.isLoading = true

           const { data, status } = await this.$store.dispatch('policies/savePolicy', this.data)
           this.checkStatus(data, status, '', 'policies/getPolicies')
       },
       closeModal(){
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

